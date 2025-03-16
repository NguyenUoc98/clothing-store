<?php

namespace App\Http\Controllers;

use App\Enum\PaymentStatus;
use App\Enum\PaymentType;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để tiếp tục.');
        }

        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $cartItems = $cart->items;
        $cartTotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

        $addresses = $user->addresses;

        $defaultAddress = collect($addresses)->firstWhere('is_default', true);

        return view('checkout.index', compact('cartItems', 'cartTotal', 'addresses', 'defaultAddress', 'user'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::guard('customer')->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

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

        try {
            DB::beginTransaction();
            $cart = Cart::query()
                ->with(['items'])
                ->where('user_id', $user->id)
                ->where('processed', false)
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn hiện đang trống.');
            }

            // Tạo đơn hàng
            $order = $cart->order()->create([
                'total_price'      => $cart->items->sum('price'),
                'status'           => PaymentType::CASH->value == $paymentMethod->value ? PaymentStatus::PROCESSING : PaymentStatus::INIT,
                'shipping_address' => $request->get('customer_address'),
                'customer_name'    => $request->get('customer_name'),
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

            DB::commit();

            // TODO: nếu thanh toán online phải chuyển hướng sang màn thanh toán của provider
            return redirect()->route('order.confirmation', ['orderId' => $order->id])
                ->with('success', 'Đặt hàng thành công. Bạn sẽ nhận được email xác nhận.');
        } catch (\Exception|\Throwable $e) {
            DB::rollBack();
            Log::error($e);
        }

        return redirect()->route('cart.index')->with('error', 'Có lỗi xảy ra trong quá trình thanh toán.');
    }

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


    public function addAddress(Request $request)
    {
        try {
            $user = Auth::guard('customer')->user();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Bạn cần đăng nhập để thêm địa chỉ mới.']);
            }

            $request->validate([
                'name'    => 'required|string|max:255',
                'phone'   => 'required|string|max:15|min:10',
                'address' => 'required|string|max:500',
            ]);

            $addresses = $user->addresses ?: [];

            $isDefault = empty($addresses) || $request->has('is_default') && $request->is_default == 'true';

            $newAddress = [
                'id'         => Str::uuid()->toString(),
                'name'       => $request->name,
                'phone'      => $request->phone,
                'address'    => $request->address,
                'note'       => $request->note ?? null,
                'is_default' => $isDefault,
            ];

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

            return redirect()->back()->with([
                'success'        => true,
                'message'        => 'Thêm địa chỉ mới thành công.',
                'addresses'      => $addresses,
                'defaultAddress' => $defaultAddress,
            ]);
        } catch (\Exception $e) {
            Log::error('Error adding address: '.$e->getMessage());
            return redirect()->back()->with([
                'success' => false, 'message' => 'Có lỗi xảy ra trong quá trình thêm địa chỉ.'
            ]);
        }
    }
}
