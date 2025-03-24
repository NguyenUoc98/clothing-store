<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class CartController extends Controller
{
    public function index()
    {
        $user = Auth::guard('customer')->user();

        if ($user) {
            $cart = Cart::where('user_id', $user->id)
                ->where('processed', false)
                ->with('items.product')->first();
        } else {
            $guestId = session()->get('guest_id');
            $cart    = Cart::where('guest_id', $guestId)
                ->where('processed', false)
                ->with('items.product')
                ->first();
        }

        if (!$cart || $cart->items->isEmpty()) {
            return view('cart.index', [
                'cartItems' => [],
                'cartTotal' => 0,
            ]);
        }

        $cartItems = $cart->items;

        $cartTotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'cartTotal'));
    }


    public function add(Request $request)
    {
        Log::info('Dữ liệu nhận được từ client trong add:', $request->all());

        try {
            // Tìm sản phẩm
            $product = Product::find($request->product_id);

            // Kiểm tra sản phẩm tồn tại
            if (!$product) {
                return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
            }

            // Kiểm tra số lượng sản phẩm trong kho
            if ($request->quantity > $product->stock) {
                return response()->json(['message' => 'Sản phẩm đã hết hàng'], 400);
            }

            // Lấy hoặc tạo giỏ hàng
            if (Auth::guard('customer')->check()) {
                // Nếu khách hàng đã đăng nhập
                $cart = Cart::query()->firstOrCreate(
                    [
                        'user_id'   => Auth::guard('customer')->id(),
                        'processed' => false
                    ]
                );
            } else {
                // Nếu khách hàng chưa đăng nhập
                $guestId = session()->get('guest_id', Str::uuid());
                session()->put('guest_id', $guestId);
                $cart = Cart::firstOrCreate([
                    'guest_id'  => $guestId,
                    'processed' => false
                ]);
            }

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            $cartItem = $cart->items()->where('product_id', $product->id)->first();

            if ($cartItem) {
                // Nếu đã có, cập nhật số lượng
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                // Nếu chưa có, thêm mới sản phẩm vào giỏ
                $cart->items()->create([
                    'product_id' => $product->id,
                    'quantity'   => $request->quantity,
                    'price'      => $product->price,
                    'size'       => $request->size,  // Lưu thông tin size
                    'color'      => $request->color // Lưu thông tin color
                ]);
            }

            // Trả về thông báo thành công
            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ']);
        } catch (\Exception $e) {
            Log::error('Error adding to cart: '.$e->getMessage());
            return response()->json(['message' => 'Có lỗi xảy ra: '.$e->getMessage()], 500);
        }
    }


    public function update(Request $request, $id)
    {
        Log::info('Request data:', $request->all());
        Log::info('Route ID:', ['id' => $id]);
        // Validate số lượng
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::guard('customer')->user();
        $cart = $user
            ? Cart::where('user_id', $user->id)->first()
            : Cart::where('guest_id', session()->get('guest_id'))->first();

        // Kiểm tra giỏ hàng
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Giỏ hàng không tồn tại.'], 404);
        }

        // Tìm item trong giỏ hàng
        $cartItem = $cart->items()->find($id);

        if (!$cartItem) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không có trong giỏ hàng.'], 404);
        }

        // Lấy sản phẩm từ cơ sở dữ liệu
        $product = Product::find($cartItem->product_id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại.'], 404);
        }

        // Kiểm tra số lượng trong kho
        $availableStock = $product->stock;

        // Xác định số lượng mới
        $newQuantity = $request->quantity;
        if ($newQuantity > $availableStock) {
            return response()->json([
                'success' => false,
                'message' => 'Không đủ hàng trong kho.',
            ], 400);
        }

        // Cập nhật số lượng
        $cartItem->update(['quantity' => $newQuantity]);

        // Tính toán lại tổng giá sản phẩm
        $totalPrice = $newQuantity * $product->price;

        // Tính toán tổng giá trị giỏ hàng
        $cartTotal = $cart->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return response()->json([
            'success'    => true,
            'message'    => 'Số lượng sản phẩm đã được cập nhật.',
            'totalPrice' => number_format($totalPrice, 0, ',', '.'), // Định dạng giá
            'cartTotal'  => number_format($cartTotal, 0, ',', '.'),  // Định dạng giá
        ]);
    }


    public function remove($id)
    {
        $cartItem = CartItem::find($id);
        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    public function showCart()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        $user = Auth::guard('customer')->user();

        // Nếu người dùng đã đăng nhập, lấy giỏ hàng của người dùng đó
        if ($user) {
            // Lấy giỏ hàng từ cơ sở dữ liệu theo user_id
            $cart = Cart::where('user_id', $user->id)->first();
            // Nếu không tìm thấy giỏ hàng, tạo mới một giỏ hàng trống
            if (!$cart) {
                $cart = Cart::create(['user_id' => $user->id]);
            }
        } else {
            // Nếu khách chưa đăng nhập, lấy giỏ hàng từ session (giả sử sử dụng guest_id)
            $guestId = session()->get('guest_id');
            $cart    = Cart::where('guest_id', $guestId)->first();

            // Nếu không tìm thấy giỏ hàng, tạo mới một giỏ hàng trống cho khách
            if (!$cart) {
                $guestId = Str::uuid();  // Tạo UUID cho khách hàng
                $cart    = Cart::create(['guest_id' => $guestId]);
                session()->put('guest_id', $guestId);  // Lưu guest_id vào session
            }
        }

        // Lấy tất cả các sản phẩm trong giỏ hàng
        $cartItems = $cart->items;  // Mối quan hệ đã được định nghĩa trong model Cart

        // Nếu $cartItems là mảng, chuyển thành Collection
        $cartItems = collect($cartItems);

        // Trả về view giỏ hàng với các mục trong giỏ
        return view('cart.index', compact('cartItems'));
    }

    public function handlePayment(Request $request)
    {
        // Xử lý thanh toán ở đây

        // Sau khi thanh toán thành công, xóa sản phẩm trong giỏ hàng
        session()->forget('cart'); // Xóa toàn bộ giỏ hàng khỏi session

        // Redirect về trang chủ hoặc trang cảm ơn
        return redirect('/')->with('success', 'Cảm ơn bạn đã mua hàng!');
    }

}
