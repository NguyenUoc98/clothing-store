<div class="w-full max-w-[1200px] mx-auto px-2 py-10 space-y-10">
    @section('title', $product->name)
    @session('error')
    <div class="bg-red-100 border border-red-400 text-red-500 p-4 rounded-lg mb-4">
        {{ session('error') }}
    </div>
    @endsession

    @session('success')
    <div class="bg-green-100 border border-green-400 text-green-500 p-4 rounded-lg mb-4">
        {{ session('success') }}
    </div>
    @endsession

    <section class="md:flex md:justify-between md:gap-10">
        <!-- Hình ảnh sản phẩm -->
        <div class="w-2/5 shrink-0">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="aspect-square rounded-xl border-3 border-neutral-300 shadow w-full">
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="space-y-14">
            <h1 class="uppercase text-5xl font-light">{{ $product->name }}</h1>
            <p class="text-5xl text-gray-500 font-[Time]">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
            <p class="text-xl text-gray-700">
                {{ $product->description }}
            </p>

            <div class="space-y-4">
                <div class="flex gap-14">
                    @if(!empty(explode(',', $product->size)))
                        <div class="space-y-4">
                            <h3 class="font-bold text-xl font-[Time]">Kích thước:</h3>
                            <div class="flex gap-4">
                                @foreach(explode(',', $product->size) as $size)
                                    <p @class([
                                        "p-2 h-10 w-10 text-center border cursor-pointer",
                                        "bg-black text-white" => $size == $productSize
                                      ])
                                       wire:click="$set('productSize', '{{$size}}')">
                                        {{ $size }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(!empty(explode(',', $product->color)))
                        <div class="space-y-4">
                            <h3 class="font-bold text-xl font-[Time]">Màu sắc:</h3>
                            <div class="flex gap-4">
                                @foreach(explode(',', $product->color) as $color)
                                    <p @class([
                                        "p-2 h-10 text-center border cursor-pointer",
                                        "bg-black text-white" => $color == $productColor
                                      ])
                                       wire:click="$set('productColor', '{{$color}}')">
                                        {{ $color }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="space-y-4">
                    <h3 class="font-bold text-xl font-[Time]">Số lượng:</h3>
                    <div class="flex gap-4">
                        <div class="flex gap-3 items-center">
                            <i @if($quantity > 1) wire:click="$set('quantity', Math.max(1, $wire.quantity - 1))" class="cursor-pointer" @else class="text-gray-400 cursor-not-allowed" @endif>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </i>
                            <p class="h-10 w-10 text-center border leading-9 select-none" x-text="$wire.quantity"></p>
                            <i @if($quantity < $product->stock) wire:click="$set('quantity', Math.min({{$product->stock}}, $wire.quantity + 1))" class="cursor-pointer" @else class="text-gray-400 cursor-not-allowed" @endif>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </i>
                        </div>
                        <button class="bg-black text-white hover:bg-black/70 px-4 cursor-pointer select-none" wire:click="addToCard()">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid md:grid-cols-5 gap-10">
        <div class="md:col-span-3">
            <h2 class="text-2xl font-[Times]">THÔNG TIN SẢN PHẨM:</h2>
            <table class="w-full my-10">
                <tr>
                    <th class="text-left font-normal uppercase p-2 whitespace-nowrap">Material</th>
                    <td class="p-2">80% Cashmere, 20% Wool for luxurious softness and warmth.</td>
                </tr>
                <tr>
                    <th class="text-left font-normal uppercase p-2 whitespace-nowrap">Design</th>
                    <td class="p-2">Single-breasted with a two-button closure for a classic, streamlined look.</td>
                </tr>
                <tr>
                    <th class="text-left font-normal uppercase p-2 whitespace-nowrap">Lining</th>
                    <td class="p-2">Fully lined with silky-smooth viscose for added comfort.</td>
                </tr>
                <tr>
                    <th class="text-left font-normal uppercase p-2 whitespace-nowrap">Pockets</th>
                    <td class="p-2">Three outer pockets (two side and one chest) and two interior pockets.</td>
                </tr>
                <tr>
                    <th class="text-left font-normal uppercase p-2 whitespace-nowrap">Fit</th>
                    <td class="p-2">Tailored, slim-fit design to enhance your silhouette.</td>
                </tr>
                <tr>
                    <th class="text-left font-normal uppercase p-2 whitespace-nowrap">Color Options</th>
                    <td class="p-2"> Available in charcoal grey, midnight blue, and classic black.</td>
                </tr>
                <tr>
                    <th class="text-left font-normal uppercase p-2 whitespace-nowrap">Instructions</th>
                    <td class="p-2">Dry clean only to maintain fabric integrity and longevity.</td>
                </tr>
            </table>
        </div>

        <div class="md:col-span-2">
            <h2 class="text-2xl font-[Times]">ĐÁNH GIÁ CỦA KHÁCH HÀNG:</h2>
            <form class="mt-10 grid grid-cols-2 gap-x-10 gap-y-4">
                <textarea id="review" rows="9" placeholder="Write your review..." class="w-full border border-neutral-300 rounded p-3 col-span-2"></textarea>
                <div>
                    <label for="name" class="text-sm">NAME*</label>
                    <input class="border border-neutral-300 rounded px-2 py-1" type="text" id="name" placeholder="Enter your name" required>
                </div>
                <div>
                    <label for="email" class="text-sm">EMAIL*</label>
                    <input class="border border-neutral-300 rounded px-2 py-1" type="email" id="email" placeholder="Enter your email" required>
                </div>

                <div class="col-span-2 flex gap-4">
                    <input id="checkbox" type="checkbox">
                    <label class="text-sm" for="checkbox">
                        Save my name, email, and website in this browser for the next time I comment.
                    </label>
                </div>
                <button type="submit" class="col-span-2 bg-black text-white py-2">Submit</button>
            </form>
        </div>
    </section>

    <hr class="my-10">
    <section>
        <h3 class="text-5xl text-center">Related Products</h3>

        <div class="container1 !grid !grid-cols-4 !container !mx-auto !gap-4 !mt-10 !mb-24">
            @foreach($relatedProducts as $product)
                <div class="card1">
                    <div class="content1">
                        <div class="imgBx">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="contentBx">
                            <h3 class="!text-sm">{{ $product->name }}</h3>
                            <p class="!text-lg">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1">
                            <a href="{{ route('product.detail', $product->id) }}">
                                <bottom class="viewmore">View more</bottom>
                            </a>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </section>
</div>
