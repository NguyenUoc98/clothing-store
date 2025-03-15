<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="asset/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="asset/css/product.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Kalnia:wght@100..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <div class="main">
            <div class="navbar header-container">
                <div class="search">
                    <div class="iconsearch">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <a href="">Search</a>
                </div>

                <div class="menu">
                    <ul>
                        <li><a href="/">Home</a>

                        </li>
                        <li><a href="/about">About</a>

                        </li>

                        <li><a href="/"><img src="asset/img/logo.png" alt="" class="anh"></a></li>
                        <li><a href="/product">Product</a></li>
                        <li><a href="/blog">Blog</a>

                        </li>
                        <li><a href="/contact">Contact</a>

                        </li>
                    </ul>
                </div>

                <div class="icon" id="menuIcon">
                    <div class="icon1">
                        <div class="iconsearch1">
                            <i class="fa-solid fa-user">
                                <ul class="submenu">
                                    <li><a href="/login">Login</a></li>
                                    <li><a href="/createaccount">Sign up</a></li>
                                </ul>
                            </i>
                        </div>
                        <div class="cart-icon">
                            <a href="{{ route('cart.index') }}">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </div>
                        <div class="iconsearch1">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="slide" style="background-image: url('asset/img/productbanner.jpg')" ;>
                <div class="text">
                    PRODUCTS
                </div>
            </div>
        </div>
    </header>

    <section class="ourteam">
        <div class="ourteamh3">
            <div class="team-title">
                <h3 class="title">TREND FOR THE SEASON</h3>
            </div>
        </div>

        <div class="ourteam1">
            <div class="container1">
                @foreach($products_39_42 as $product)
                <div class="card1">
                    <div class="content1">
                        <div class="imgBx">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="contentBx">
                            <h3>{{ $product->name }} <br><span>{{ number_format($product->price, 0, ',', '.') }} VND</span> <br>

                                <span><i class="fa-solid fa-cart-plus"></i></span>

                            </h3>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1"><a href="{{ route('products.show', $product->id) }}">
                                <bottom class="viewmore">View more</bottom>
                            </a></li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
        <div class="ourteam1">
            <div class="container1">
                @foreach($products_43_46 as $product)
                <div class="card1">
                    <div class="content1">
                        <div class="imgBx">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="contentBx">
                            <h3>{{ $product->name }} <br><span>{{ number_format($product->price, 0, ',', '.') }} VND</span> <br>

                                <span><i class="fa-solid fa-cart-plus"></i></span>

                            </h3>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1"><a href="{{ route('products.show', $product->id) }}">
                                <bottom class="viewmore">View more</bottom>
                            </a></li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section>
        <div class="img-decorate">
            <div class="img-deco" style="background-image: url(asset/img/pr9.jpg);">
                <div class="img-text">
                    <h3>NEW ARRIVALS</h3>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="two-columns">
            <div class="column column-20">

                <div class="container11">
                    <div class="card11">
                        <div class="content11">
                            <div class="imgBx1">
                                <img src="{{ asset('storage/' . $product_47->image) }}" alt="{{ $product_47->name }}">
                            </div>
                            <div class="contentBx1">
                                <h3>{{ $product_47->name }} <br>
                                    <span>{{ number_format($product_47->price, 0, ',', '.') }} VND</span>
                                    <br>
                                    <span><i class="fa-solid fa-cart-plus"></i></span>
                                </h3>

                            </div>
                        </div>
                        <ul class="sci1">
                            <li style="--i:1"><a href="{{ route('productItem', $product->id) }}">
                                    <bottom class="viewmore1">View more</bottom>
                                </a></li>
                        </ul>
                    </div>
                </div>


            </div>
            <div class="column column-80">
                <div class="ourteam12">
                    <div class="container12">
                        @foreach($products_48_50 as $product)
                        <div class="card12">
                            <div class="content12">
                                <div class="imgBx2">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                </div>
                                <div class="contentBx2">
                                    <h3>{{ $product->name }} <br>
                                        <span>{{ number_format($product->price, 0, ',', '.') }} VND</span>
                                        <br>
                                        <span><i class="fa-solid fa-cart-plus"></i></span>
                                    </h3>
                                </div>
                            </div>
                            <ul class="sci2">
                                <li style="--i:1">
                                    <a href="{{ route('productItem', $product->id) }}">
                                        <button class="viewmore2">View more</button>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endforeach



                    </div>
                </div>
                <div class="ourteam12">
                    <div class="container12">
                        @foreach($products_51_53 as $product)
                        <div class="card12">
                            <div class="content12">
                                <div class="imgBx2">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                </div>
                                <div class="contentBx2">
                                    <h3>{{ $product->name }} <br>
                                        <span>{{ number_format($product->price, 0, ',', '.') }} VND</span>
                                        <br>
                                        <span><i class="fa-solid fa-cart-plus"></i></span>
                                    </h3>
                                </div>
                            </div>
                            <ul class="sci2">
                                <li style="--i:1">
                                    <a href="{{ route('productItem', $product->id) }}">
                                        <button class="viewmore2">View more</button>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class="announcement-section">
        <div class="announcement-container">
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
                    <h1>GN <span>X</span> <span>JENNIE</span> </h1>
                    <p>COMING SOON</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-section logo">
            <h1>GN</h1>
            <p>The Devil Nest</p>
        </div>
        <div class="footer-section contact">
            <h3>CONTACT</h3>
            <p>+123456789</p>
            <p>thedevilnestvietnam.com</p>
            <p>88 Tran Nguyen Han, Hai Phong, Viet Nam</p>
        </div>
        <div class="footer-section openhours">
            <h3>OPENHOURS</h3>
            <p>Weekdays: 9:00 AM - 20:30 PM</p>
            <p>Monday: 9:00 AM - 19:00 PM</p>
            <p>Sunday: Closed</p>
        </div>
        <div class="footer-section subscribe">
            <h3>CONTACT</h3>
            <form action="#">
                <input type="email" placeholder="Your email" class="email-input">
                <button type="submit">→</button>
            </form>
            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
            </div>
        </div>
    </footer>

</body>

</html>