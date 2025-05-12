<div class="container !block pt-16">
    @section('title', 'Giỏ hàng')

    <h1 class="text-2xl text-center mx-auto font-medium mb-10">Giỏ Hàng Của Bạn</h1>

    @if(!$cart?->items->isNotEmpty())
        <div class="bg-indigo-100 p-5 rounded-lg text-center text-indigo-700 border border-indigo-700 w-fit mx-auto">
            <p class="mb-5">Giỏ hàng của bạn hiện tại chưa có sản phẩm.</p>
            <a href="/" class="cursor-pointer py-2 px-4 text-white bg-black rounded">Mua sắm ngay</a>
        </div>
    @else
        <table class="mb-4 table w-full font-[Times]">
            <thead>
            <tr class="bg-black text-white">
                <th class="border border-gray-200 p-2">Sản phẩm</th>
                <th class="border border-gray-200 p-2">Số lượng</th>
                <th class="border border-gray-200 p-2">Đơn giá</th>
                <th class="border border-gray-200 p-2">Thành tiền</th>
                <th class="border border-gray-200 p-2">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cart->items as $item)
                <tr>
                    <td class="border border-gray-200 p-2">
                        <div class="flex gap-3">
                            <img src="{{ $item->product->image }}" alt="" class="w-24 h-24 shadow object-cover shrink-0">
                            <div class="space-y-1">
                                <p class="text-lg">{{ $item->product->name }}</p>
                                <div class="text-gray-500">
                                    <p>
                                        Màu sắc: {{ $item->color }}
                                    </p>
                                    <p>
                                        Kích thước: {{ $item->size }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="border border-gray-200 p-2 text-center">
                        <div class="flex gap-2 items-center justify-center">
                            <i @if($item->quantity > 1) wire:click="updateQuantity({{ $item->id }}, false)" class="cursor-pointer" @else class="text-gray-400 cursor-not-allowed" @endif>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </i>
                            <p class="h-10 w-10 text-center border leading-9 select-none">{{ $item->quantity }}</p>
                            <i @if($item->quantity < $item->product->stock) wire:click="updateQuantity({{ $item->id }}, true)" class="cursor-pointer" @else class="text-gray-400 cursor-not-allowed" @endif>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </i>
                        </div>
                    </td>
                    <td class="border border-gray-200 p-2 text-right font-bold">{{ number_format($item->product->price, 0, ',', '.') }} VND</td>
                    <td class="border border-gray-200 p-2 text-right font-bold">{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }} VND</td>
                    <td class="border border-gray-200 p-2 text-center">
                        <button class="cursor-pointer py-1 px-4 text-white bg-red-500 rounded text-center" wire:click="removeItem({{ $item->id }})">
                            <i class="fas fa-trash"></i>
                            Xóa
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p class="font-bold font-[Times] mb-5">Tổng giỏ hàng: <span class="text-red-400">{{ number_format($cartTotal, 0, ',', '.') }} VND</span></p>

        <a href="{{ route('checkout.index') }}" class="py-2 px-4 bg-black text-white mx-auto block w-fit">Tiến hành thanh toán</a>
    @endif
</div>
