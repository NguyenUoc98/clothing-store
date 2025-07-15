<div class="container !block pt-16">
    @section('title', 'Giỏ hàng')

    @if(session('error'))
        <div class="p-4 border border-red-500 rounded-md bg-red-100 text-red-600 mb-10">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-2xl text-center mx-auto font-medium mb-10">Giỏ Hàng Của Bạn</h1>

    @if ($cart && $cart->items->isNotEmpty())
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
                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="" class="w-24 h-24 shadow object-cover shrink-0">
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

                            <input type="number"
                                   inputmode="numeric"
                                   class="h-10 w-10 text-center border leading-9 select-none"
                                   value="{{ $item->quantity }}"
                                   wire:change.live="updateQuantity({{ $item->id }}, $event.target.value)"/>

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
                        <button class="cursor-pointer py-1 px-4 text-white bg-red-500 rounded text-center"
                                wire:click="removeItem({{ $item->id }})"
                                wire:confirm="Bạn có chắc muốn xóa sản phẩm này?">
                            <i class="fas fa-trash"></i>
                            Xóa
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p class="font-bold font-[Times] mb-5">Tổng giỏ hàng: <span class="text-red-400">{{ number_format($this->cartTotal, 0, ',', '.') }} VND</span></p>

        <a href="{{ route('checkout.index') }}" class="py-2 px-4 bg-black text-white mx-auto block w-fit">Tiến hành thanh toán</a>
    @else
        <div class="bg-indigo-100 p-5 rounded-lg text-center text-indigo-700 border border-indigo-700 w-fit mx-auto">
            <p class="mb-5">Giỏ hàng của bạn hiện tại chưa có sản phẩm.</p>
            <a href="/" class="cursor-pointer py-2 px-4 text-white bg-black rounded">Mua sắm ngay</a>
        </div>
    @endif

    <div class="">
        <h2 class="text-2xl font-medium my-6">Lịch sử đơn hàng</h2>
        <div class="space-y-4 font-[Arial]">
            @forelse($orders as $cartProcessed)
                <div class="rounded-lg border border-gray-200">
                    <div class="mx-4 py-4 border-b flex justify-between border-gray-200 gap-4">
                        <p class="text-gray-500"># {{ md5($cartProcessed->id) }}</p>
                        <div class="flex gap-4">
                            <p class="uppercase border-r pr-4">{{ $cartProcessed->order->type->name }}</p>
                            <p class="uppercase text-yellow-500">{{ $cartProcessed->order->status->name }}</p>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($cartProcessed->items as $item)
                            <div class="flex gap-4 my-2 mx-4 justify-between">
                                <div class="flex gap-4">
                                    <div class="shrink-0">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-20 h-auto mb-2 rounded border border-gray-200"/>
                                    </div>
                                    <div>
                                        <p>{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500"><b class="text-black">Size: </b>{{ $item->size }}</p>
                                        <p class="text-sm text-gray-500"><b class="text-black">Màu: </b>{{ $item->color }}</p>
                                        <p class="text-sm text-gray-500">x{{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <p class="text-red-400">{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VND</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t border-gray-200 p-4 flex justify-between">
                        <p class="text-sm text-gray-500">Thời gian đặt: {{ $cartProcessed->order->created_at->format('d/m/Y H:i') }}</p>
                        <p>Tổng tiền: <span class="text-red-400 text-xl font-semibold">{{ number_format($cartProcessed->order->total_price, 0, ',', '.') }} VND</span></p>
                    </div>
                </div>
            @empty
                <p>Bạn chưa có đơn hàng</p>
            @endforelse
        </div>
    </div>
</div>
