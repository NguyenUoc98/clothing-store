<?php

namespace App\Livewire\Product;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Item extends Component
{
    public Product $product;
    public         $productSize  = '';
    public         $productColor = '';
    public int     $quantity     = 1;

    public function render()
    {
        $relatedProducts = Product::take(4)->get();
        return view('livewire.product.item', compact('relatedProducts'));
    }

    public function addToCard()
    {
        if (!$this->productSize) {
            session()->flash('error', 'Bạn chưa chọn kích thước');
            return;
        }

        if (!$this->productColor) {
            session()->flash('error', 'Bạn chưa chọn màu');
            return;
        }

        if (!$this->quantity || $this->quantity < 1 || $this->quantity > $this->product->stock) {
            session()->flash('error', 'Mặt hàng này không còn trong kho');
            return;
        }

        try {
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
            $cartItem = $cart->items()
                ->where([
                    ['product_id', $this->product->id],
                    ['size', $this->productSize],
                    ['color', $this->productColor],
                ])
                ->first();

            if ($cartItem) {
                // Nếu đã có, cập nhật số lượng
                $cartItem->quantity += $this->quantity;
                $this->product->decrement('stock', $this->quantity);
                $cartItem->save();
            } else {
                // Nếu chưa có, thêm mới sản phẩm vào giỏ
                $cart->items()->create([
                    'product_id' => $this->product->id,
                    'quantity'   => $this->quantity,
                    'price'      => $this->product->price,
                    'size'       => $this->productSize,
                    'color'      => $this->productColor,
                ]);
                $this->product->decrement('stock');
            }
            session()->flash('success', 'Đã thêm sản phẩm vào giỏ hàng');
        } catch (\Exception $e) {
            session()->flash('error', 'Lỗi trong quá trình thực thi');
        }
    }
}
