<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public ?Cart $cart;

    public function render()
    {
        $user = Auth::guard('customer')->user();

        if ($user) {
            $this->cart = Cart::where('user_id', $user->id)
                ->where('processed', false)
                ->with('items.product')->first();
        } else {
            $guestId    = session()->get('guest_id');
            $this->cart = Cart::where('guest_id', $guestId)
                ->where('processed', false)
                ->with('items.product')
                ->first();
        }

        $cartTotal = $this->cart?->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        }) ?: 0;
        return view('livewire.cart.index', compact('cartTotal'));
    }

    public function updateQuantity(int $itemId, bool $increase): void
    {
        $item        = $this->cart->items->where('id', $itemId)->first();
        $newQuantity = $increase ? $item->quantity + 1 : $item->quantity - 1;
        if ($newQuantity > 0 && $newQuantity <= $item->product->stock) {
            $item->update(['quantity' => $newQuantity]);
        }
    }

    public function removeItem(int $itemId): void
    {
        $item = $this->cart->items->where('id', $itemId)->first();
        $item->delete();
    }
}
