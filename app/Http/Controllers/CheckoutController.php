<?php

namespace App\Http\Controllers;

use App\Enum\PaymentStatus;
use App\Enum\PaymentType;
use App\Events\NotificationPayment;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Uocnv\BaokimPayment\Clients\VA;
use Uocnv\BaokimPayment\Exceptions\CollectionRequestException;
use Uocnv\BaokimPayment\Exceptions\InvalidSignatureException;
use Uocnv\BaokimPayment\Exceptions\SignFailedException;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            $userId      = session()->get('guest_id');
            $addresses[] = session()->get('address');
            $cart        = Cart::where('guest_id', $userId)->with('items.product')->first();
        } else {
            $userId    = $user->id;
            $addresses = $user->addresses;
            $cart      = Cart::where('user_id', $userId)->with('items.product')->first();
        }

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $cartItems = $cart->items;
        $cartTotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

        $defaultAddress = collect($addresses)->firstWhere('is_default', true);

        return view('checkout.index', compact('cartItems', 'cartTotal', 'addresses', 'defaultAddress', 'user'));
    }

    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * Ví dụ mẫu:
     *
     *  <samp>
     *  $data = [
     *       'RequestId'    => 'BK156438AF4AE2A2757',
     *       'RequestTime'  => '2023-04-14 08:41:30',
     *       'PartnerCode'  => 'BAOKIM',
     *       'AccNo'        => '008281087664887309',
     *       'ClientIdNo'   => null,
     *       'TransId'      => 'BK6438AF4ADCC96QHZIG',
     *       'TransAmount'  => '50000',
     *       'TransTime'    => '2023-04-14 08:41:30',
     *       'BefTransDebt' => '50000',
     *       'AffTransDebt' => 0,
     *       'AccountType'  => 2,
     *       'OrderId'      => 'trans1681436471',
     *  ];
     *  </samp>
     * @throws SignFailedException
     */
    public function resultTransfer(Request $request)
    {
        $rawData = $request->getContent();
        if (app()->environment('production')) {
            try {
                $vaClient = new VA();
                $vaClient->checkValidData($rawData);
            } catch (InvalidSignatureException $e) {
                Log::error($e);
                return response()->json([
                    'message' => 'Chữ ký không hợp lệ',
                ], 401);
            }
        }

        $data = json_decode($rawData, true);

        $accNo      = $data['AccNo'];
        $money      = $data['TransAmount'];
        $transferId = $data['TransId'];

        $order = Order::query()->whereJsonContains('addition_information->order_id', $accNo)->first();
        if ($order && $order->status == PaymentStatus::INIT && $money >= (int) $order->total_price) {
            $order->update([
                'status'               => PaymentStatus::SUCCESS,
                'addition_information' => [
                    'order_id'       => $accNo,
                    'money'          => $money,
                    'transaction_id' => $transferId,
                ],
            ]);
            $dataReturn = [
                'ResponseCode'    => 200,
                'ResponseMessage' => 'Success',
                'AccNo'           => $accNo,
                'ReferenceId'     => config('baokim-payment.virtual_account.production.partner_code').md5($order->id),
                'AffTransDebt'    => $data['AffTransDebt'],
            ];

            NotificationPayment::dispatch($order);
        } else {
            $dataReturn = [
                'ResponseCode'    => 200,
                'ResponseMessage' => 'Transaction processed successfully',
                'AccNo'           => $accNo,
            ];
        }
        $vaClient = new VA();
        $response = $vaClient->makeResponse($dataReturn);
        return response()->json($response);
    }

    /**
     * Xử lý thanh toán
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function processCheckout(Request $request)
    {
        $user = Auth::guard('customer')->user();

        $request->validate([
            'customer_name'    => 'required|string',
            'customer_phone'   => 'required|string',
            'customer_address' => 'required|string',
            'payment_method'   => [
                'required',
                Rule::enum(PaymentType::class),
            ],
        ]);

        $paymentMethod = PaymentType::tryFrom($request->payment_method);

        if (!$user) {
            $userId   = session()->get('guest_id');
            $notLogin = true;
        } else {
            $userId   = $user->id;
            $notLogin = false;
        }

        try {
            DB::beginTransaction();
            $cart = Cart::query()
                ->with(['items'])
                ->where($notLogin ? 'guest_id' : 'user_id', $userId)
                ->where('processed', false)
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn hiện đang trống.');
            }

            // Tạo đơn hàng
            $order = $cart->order()->create([
                'total_price'      => $cart->items->sum('price'),
                'status'           => PaymentType::COD == $paymentMethod ? PaymentStatus::PROCESSING : PaymentStatus::INIT,
                'shipping_address' => $request->get('customer_address'),
                'customer_name'    => $request->get('customer_name'),
                'customer_email'   => $request->get('customer_email'),
                'customer_phone'   => $request->get('customer_phone'),
                'type'             => $paymentMethod,
            ]);

            // Giảm số lượng của sản phẩm trong kho
            foreach ($cart->items as $cartItem) {
                $product = Product::query()->find($cartItem->product_id);
                if ($product) {
                    $product->decrement('stock', $cartItem->quantity);
                }
            }

            // Update trạng thái đã xử lý giỏ hàng
            $cart->update([
                'processed' => true,
            ]);

            if ($paymentMethod == PaymentType::ONLINE) {
//                $dataRequest = Momo::request(
//                    transactionId: $order->id,
//                    amount       : $order->total_price,
//                    referer      : 'https://123docz.com/trang-chu.htm',
//                    userPhone    : $order->customer_phone
//                );

                try {
                    $vaClient = new VA();
                    $response = $vaClient->registerVirtualAccount(
                        accName   : 'CONG THANH TOAN',
                        orderId   : 'create'.rand(1, 99).time(),
                        amountMin : $order->total_price,
                        amountMax : $order->total_price,
                        expireDate: Carbon::now()->addDay()->format('Y-m-d H:i:s')
                    );

                    $dataRequest = [
                        'acc_no'          => $response['AccountInfo']['BANK']['AccNo'],
                        'acc_name'        => $response['AccountInfo']['BANK']['AccName'],
                        'bank_short_name' => $response['AccountInfo']['BANK']['BankShortName'],
                        'bank_name'       => $response['AccountInfo']['BANK']['BankName'],
                        'bank_branch'     => $response['AccountInfo']['BANK']['BankBranch'],
                        'collect_min'     => $response['CollectAmountMin'],
                        'collect_max'     => $response['CollectAmountMax'],
                        'expire_date'     => $response['ExpireDate'],
                        'qr_string'       => $response['AccountInfo']['BANK']['QrPath'],
                    ];
                } catch (GuzzleException|CollectionRequestException|SignFailedException) {
                    $dataRequest = [];
                }

                if (!empty($dataRequest)) {
                    $orderId = Arr::get($dataRequest, 'acc_no');

                    $order->update([
                        'addition_information' => [
                            'order_id' => $orderId,
                        ]
                    ]);
                    DB::commit();
                    return to_route('checkout.transfer', [
                        'd' => Crypt::encryptString(json_encode($dataRequest, JSON_UNESCAPED_UNICODE)),
                    ]);
                }
                return redirect()->back()->with([
                    'error' => 'Lỗi khởi tạo giao dịch',
                ]);
            } else {
                return redirect()->route('order.confirmation', ['orderId' => $order->id])
                    ->with('success', 'Đặt hàng thành công. Bạn sẽ nhận được email xác nhận.');
            }
        } catch (\Exception|\Throwable $e) {
            DB::rollBack();
            Log::error($e);
        }

        return redirect()->route('cart.index')->with('error', 'Có lỗi xảy ra trong quá trình thanh toán.');
    }

    /**
     * Màn thông tin chuyển khoản
     *
     * @param  Request  $request
     *
     * @return Factory|View|Application|RedirectResponse|\Illuminate\View\View
     */
    public function transferInformation(Request $request)
    {
        $dataTransfer = json_decode(Crypt::decryptString($request->get('d')), true);

        // Kiểm tra đơn hàng đã được thanh toán chưa?
        $order = Order::query()->whereJsonContains('addition_information->order_id', $dataTransfer['acc_no'])->first();
        if ($order && $order->status == PaymentStatus::SUCCESS) {
            return redirect()->route('order.confirmation', ['orderId' => $order->id]);
        }
        return view('checkout.transfer', compact('dataTransfer'));
    }

    /**
     * Màn xác nhận đặt hàng thành công
     *
     * @param $orderId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function confirmation($orderId)
    {
        // TODO: Cần phải check xem đơn hàng này có phải của user hiện tại hay không?
        $order = Order::with('cart.items.product')->find($orderId);

        if (!$order) {
            return redirect()->route('cart.index')->with('error', 'Không tìm thấy đơn hàng.');
        }

        return view('checkout.confirmation', compact('order'));
    }

    public function updateDefaultAddress(Request $request)
    {
        try {
            $user = Auth::guard('customer')->user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để cập nhật địa chỉ mặc định.']);
            }

            $addressId = $request->input('address_id');

            // Lấy danh sách địa chỉ, kiểm tra kiểu dữ liệu
            $addresses = is_string($user->addresses) ? json_decode($user->addresses, true) : $user->addresses;
            $addresses = $addresses ?? [];

            // Nếu không có địa chỉ nào, trả về thông báo
            if (empty($addresses)) {
                return response()->json(['success' => false, 'message' => 'Bạn chưa có địa chỉ nào để chọn làm mặc định.']);
            }

            // Cập nhật địa chỉ mặc định
            foreach ($addresses as &$address) {
                $address['is_default'] = $address['id'] === $addressId;
            }

            // Cập nhật cơ sở dữ liệu
            DB::table('customers')
                ->where('id', $user->id)
                ->update(['addresses' => json_encode($addresses)]);

            // Lấy lại địa chỉ mặc định
            $defaultAddress = collect($addresses)->firstWhere('is_default', true);

            return response()->json([
                'success'        => true,
                'message'        => 'Cập nhật địa chỉ mặc định thành công!',
                'defaultAddress' => $defaultAddress, // Trả về thông tin địa chỉ mặc định
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating default address: '.$e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật địa chỉ mặc định.']);
        }
    }

    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function addAddress(Request $request)
    {
        try {
            $user = Auth::guard('customer')->user();


            $request->validate([
                'name'    => 'required|string|max:255',
                'phone'   => 'required|string|max:15|min:10',
                'address' => 'required|string|max:500',
                'email'   => 'required|email',
            ]);

            if (!$user) {
                session([
                    'address' => [
                        'name'       => $request->name,
                        'email'      => $request->email,
                        'phone'      => $request->phone,
                        'address'    => $request->address,
                        'is_default' => true,
                    ]
                ]);

                $addresses      = session()->get('address');
                $defaultAddress = true;
            } else {
                $addresses = $user->addresses ?: [];

                $isDefault = empty($addresses) || $request->has('is_default') && $request->is_default == 'true';

                $newAddress = [
                    'id'         => Str::uuid()->toString(),
                    'name'       => $request->name,
                    'email'      => $request->email,
                    'phone'      => $request->phone,
                    'address'    => $request->address,
                    'note'       => $request->note ?? null,
                    'is_default' => $isDefault,
                ];

            if ($newAddress['is_default']) {
                foreach ($addresses as &$address) {
                    $address['is_default'] = false;
                }
                if ($newAddress['is_default']) {
                    foreach ($addresses as &$address) {
                        $address['is_default'] = false;
                    }
                }

                $addresses[] = $newAddress;

                DB::table('customers')
                    ->where('id', $user->id)
                    ->update(['addresses' => $addresses]);

                $defaultAddress = collect($addresses)->firstWhere('is_default', true);
            }
            return redirect()->back()->with([
                'success'        => true,
                'message'        => 'Thêm địa chỉ mới thành công.',
                'addresses'      => $addresses,
                'defaultAddress' => $defaultAddress,
            ]);
        } catch (\Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            Log::error('Error adding address: '.$e->getMessage());
            return redirect()->back()->with([
                'success' => false, 'message' => 'Có lỗi xảy ra trong quá trình thêm địa chỉ.'
            ]);
        }
    }
}
