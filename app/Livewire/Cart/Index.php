<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public ?Cart $cart;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart(): void
    {
        $this->cart = Cart::query()
            ->where('processed', false)
            ->with('items.product')
            ->when(Auth::guard('customer')->user(), function ($query, $user) {
                return $query->where('user_id', $user->id);
            }, function ($query) {
                return session()->has('guest_id') ? $query->where('guest_id', session('guest_id')) : $query;
            })
            ->first();
    }

    #[Computed]
    public function cartTotal()
    {
        return $this->cart?->items->sum(function ($item) {
            return $item->quantity * ($item->product->price ?? 0);
        }) ?: 0;
    }

    public function updateQuantity(int $itemId, int|bool $increase): void
    {
        $item = $this->cart->items->firstWhere('id', $itemId);

        if ($item) {
            if(is_int($increase)) {
                $newQuantity = $increase;
            } else {
                $newQuantity = $increase ? $item->quantity + 1 : $item->quantity - 1;
            }
            if ($newQuantity > 0 && $newQuantity <= $item->product->stock) {
                $item->update(['quantity' => $newQuantity]);
                $this->loadCart();
            } else {
                $this->js('alert("Số lượng không hợp lệ")');
            }
        }
    }

    public function removeItem(int $itemId): void
    {
        $item = CartItem::find($itemId);
        $item?->delete();
        $item?->product->increment('stock', $item->quantity);
        $this->loadCart();
    }

    public function render()
    {
        return view('livewire.cart.index');
    }
}
