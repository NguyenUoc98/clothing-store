@extends('layouts.frontend.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/product.css') }}">
@endpush
@section('content')
    <div class="img-decorate !p-0 !m-0">
        <div class="img-deco !bg-top" style="background-image: url({{ asset('asset/img/productbanner.jpg') }});">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-7xl">
                <h3>PRODUCTS</h3>
            </div>
        </div>
    </div>

    <section class="ourteam">
        <div class="ourteamh3">
            <div class="team-title">
                <h3 class="title">TREND FOR THE SEASON</h3>
            </div>
        </div>

        <div class="container1 !grid !grid-cols-4 !container !mx-auto !gap-10 !max-w-7xl">
            @foreach($products_39_42 as $product)
                <div class="card1">
                    <div class="content1">
                        <div class="aspect-square imgBx !h-fit">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="contentBx">
                            <h3>{{ $product->name }}</h3>
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
        <div class="container1 !grid !grid-cols-4 !container !mx-auto !gap-10 !max-w-7xl">
            @foreach($products_43_46 as $product)
                <div class="card1">
                    <div class="content1">
                        <div class="aspect-square imgBx !h-fit">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="contentBx">
                            <h3>{{ $product->name }}</h3>
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
    <section>
        <div class="img-decorate">
            <div class="img-deco" style="background-image: url({{ asset('asset/img/pr9.jpg') }});">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-white text-7xl">
                    <h3>NEW ARRIVALS</h3>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container1 !container !mx-auto !max-w-7xl">
            <div class="!grid !grid-cols-4 !gap-4">
                @foreach($products as $product)
                    <div class="card1 !block h-full">
                        <div class="content1 h-full !justify-between">
                            <div class="aspect-square imgBx !h-fit">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="contentBx !relative !bottom-0 w-full p-4">
                                <a href="{{ route('product.detail', $product->id) }}">
                                    <h3 class="!leading-7">{{ $product->name }}</h3>
                                    <p class="!text-lg">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="w-full">
                {!! $products->links() !!}
            </div>
        </div>

    </section>
    <section class="announcement-section max-w-7xl mx-auto !p-0 !px-4">
        <div class="announcement-container !m-0">
            <!-- Phần bên trái -->
            <div class="announcement-left">
                <div class="date">
                    <img src="asset/img/pr17.jpg" alt="">
                </div>
                <h2>The Devil's Nest Fashion Shop</h2>
                <h3>Announces Exclusive Collaboration </h3>
                <h3>With Blackpink's Jennie!</h3>
                <p class="description">
                    The new collection, titled "Angel & Demon: The Jennie Edit", promises to blend Jennie's signature
                    chic, edgy aesthetic with the Devil's Nest's rebellious spirit. This partnership is expected to
                    bring a fresh take on streetwear, combining dark, mysterious tones with elegant, futuristic touches.
                </p>
                <div class="countdown">
                    <div class="countdown-item">
                        <h3>20</h3>
                        <p>DAY</p>
                    </div>
                    <div class="countdown-item">
                        <h3>12</h3>
                        <p>HOURS</p>
                    </div>
                    <div class="countdown-item">
                        <h3>06</h3>
                        <p>MINUTES</p>
                    </div>
                </div>
            </div>

            <!-- Phần bên phải -->
            <div class="announcement-right">
                <img src="asset/img/pr18.jpg" alt="Jennie Collaboration">
                <div class="overlay">
                    <h1>GN <span>X</span> <span>JENNIE</span></h1>
                    <p>COMING SOON</p>
                </div>
            </div>
        </div>
    </section>
@endsection
