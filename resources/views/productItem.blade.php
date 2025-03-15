<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProductItem</title>
    <link rel="stylesheet" href="{{ asset('asset/fontawesome-free-6.6.0-web/css/all.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('asset/css/productItem.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&family=Kalnia:wght@100..700&family=Aboreto&display=swap"
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

                        <li><a href="/"><img src="{{asset('asset/img/logo.png')}}" alt="" class="anh"></a></li>
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

        </div>
    </header>

    <section class="product-detail">
        <div class="product-container">
            <!-- Hình ảnh sản phẩm -->
            <div class="product-image">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                <hr>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="product-info">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-price">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                <p class="product-description">
                    {{ $product->description }}

                </p>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <!-- Size lựa chọn -->
                        @if($product->size && !empty($sizes) && is_array($sizes))
                        <div class="product-sizes">
                            <h3>Sizes Available:</h3>
                            <div class="size-options">
                                @foreach($sizes as $size)
                                <label class="size-option">
                                    <input type="radio" name="size" value="{{ $size }}"
                                        @if(old('size')==$size) checked @endif required>
                                    <span>{{ $size }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($product->color && !empty($colors) && is_array($colors))
                        <div class="product-colors">
                            <h3>Color:</h3>
                            <div class="color-options">
                                @foreach($colors as $color)
                                <label class="color-option">
                                    <input type="radio" name="color" value="{{ strtolower($color) }}"
                                        @if(old('color')==strtolower($color)) checked @endif required>
                                    <span class="color" style="background-color: {{ strtolower($color) }};"></span>
                                    <span>{{ ucfirst($color) }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                        @endif




                        <!-- Phần số lượng và nút thêm vào giỏ hàng -->
                        <div class="product-actions">
                            <div class="quantity-selector">
                                <button type="button" class="btn-quantity decrement">-</button>
                                <input type="number" name="quantity" value="1" min="1" class="quantity-input" required>
                                <button type="button" class="btn-quantity increment">+</button>
                            </div>
                            <!-- <i class="fa-solid fa-cart-plus add-to-cart" data-product-id="{{ $product->id }}">
                        </i> -->
                            <button type="button" class="add-to-cart" data-product-id="{{ $product->id }}">Thêm vào giỏ</button>
                        </div>
                    </form>
            </div>


    </section>

    <section class="product-details">
        <div class="details-container">
            <!-- Key Features -->
            <div class="key-features">
                <h2>KEY FEATURES:</h2>
                <ul>
                    <li><span>Material</span> 80% Cashmere, 20% Wool for luxurious softness and warmth.</li>
                    <li><span>Design</span> Single-breasted with a two-button closure for a classic, streamlined look.
                    </li>
                    <li><span>Lining</span> Fully lined with silky-smooth viscose for added comfort.</li>
                    <li><span>Pockets</span> Three outer pockets (two side and one chest) and two interior pockets.</li>
                    <li><span>Fit</span> Tailored, slim-fit design to enhance your silhouette.</li>
                    <li><span>Color Options</span> Available in charcoal grey, midnight blue, and classic black.</li>
                    <li><span>Instructions</span> Dry clean only to maintain fabric integrity and longevity.</li>
                </ul>


            </div>

            <!-- Customer Reviews -->
            <div class="customer-reviews">
                <h2>CUSTOMER REVIEWS</h2>
                <form>
                    <div class="form-group">
                        <label for="review">YOUR REVIEW</label>
                        <textarea id="review" rows="9" placeholder="Write your review..."></textarea>
                    </div>
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="name">NAME*</label>
                            <input type="text" id="name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">EMAIL*</label>
                            <input type="email" id="email" placeholder="Enter your email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="checkbox">
                            <input type="checkbox">
                            Save my name, email, and website in this browser for the next time I comment.
                        </label>
                    </div>
                    <button type="submit" class="submit-btn">Submit</button>
                </form>
            </div>
            <hr>
        </div>
    </section>

    <section class="ourteam">
        <div class="ourteamh3">
            <div class="team-title">
                <h3 class="title">Related Products</h3>
            </div>
        </div>

        <div class="ourteam1">
            <div class="container1">
                <div class="card1">
                    <div class="content1">
                        <div class="imgBx">
                            <img src="{{asset('asset/img/pr1.jpg')}}" alt="">
                        </div>
                        <div class="contentBx">
                            <h3>Cashmere Wool Blazer <br><span> 8,500,000 VND</span> <br> <span><i
                                        class="fa-solid fa-cart-plus"></i></span></h3>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1"><a href="#">
                                <bottom class="viewmore">View more</bottom>
                            </a></li>
                    </ul>
                </div>
                <div class="card1">
                    <div class="content1">
                        <div class="imgBx">

                            <img src="{{asset('asset/img/pr2.jpg')}}" alt="">
                        </div>
                        <div class="contentBx">
                            <h3>Elegant Linen Trousers<br><span>4,200,000 VND</span><br> <span><i
                                        class="fa-solid fa-cart-plus"></i></span></h3>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1"><a href="#">
                                <bottom class="viewmore">View more</bottom>
                            </a></li>
                    </ul>
                </div>
                <div class="card1">
                    <div class="content1">
                        <div class="imgBx">
                            <img src="{{asset('asset/img/pr3.jpg')}}" alt="">
                        </div>
                        <div class="contentBx">
                            <h3>Plaid box pleat mini skirt<br><span>2,800,000 VND</span><br> <span><i
                                        class="fa-solid fa-cart-plus"></i></span></h3>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1"><a href="#">
                                <bottom class="viewmore">View more</bottom>
                            </a></li>
                    </ul>
                </div>
                <div class="card1">
                    <div class="content1">
                        <div class="imgBx">
                            <img src="{{asset('asset/img/pr4.jpg')}}" alt="">
                        </div>
                        <div class="contentBx">
                            <h3>Pocketed denim jacket<br><span>6,300,000 VND</span><br> <span><i
                                        class="fa-solid fa-cart-plus"></i></span></h3>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1"><a href="#">
                                <bottom class="viewmore">View more</bottom>
                            </a></li>
                    </ul>
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
<script>
    //Them san pham vao gio hang
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            var productId = $(this).data('product-id');
            var quantity = $('#quantity').val(); // Lấy số lượng từ input

            // Nếu không có input quantity, gán mặc định là 1
            if (!quantity || quantity <= 0) {
                quantity = 1;
            }

            $.ajax({
                url: '/cart/add', // Đường dẫn đến route xử lý thêm sản phẩm
                method: 'POST',
                data: {
                    product_id: productId,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}' // Đảm bảo gửi token bảo mật
                },
                success: function(response) {
                    alert(response.message); // Hiển thị thông báo thêm sản phẩm thành công
                },
                error: function(response) {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Load saved size and color from localStorage
        const savedSize = localStorage.getItem('selectedSize');
        const savedColor = localStorage.getItem('selectedColor');

        // Check if there's a saved size and set it
        if (savedSize) {
            const sizeRadio = document.querySelector(`input[name="size"][value="${savedSize}"]`);
            if (sizeRadio) {
                sizeRadio.checked = true;
            }
        }

        // Check if there's a saved color and set it
        if (savedColor) {
            const colorRadio = document.querySelector(`input[name="color"][value="${savedColor}"]`);
            if (colorRadio) {
                colorRadio.checked = true;
            }
        }
    });

    // Save the selected size and color to localStorage when they change
    document.querySelectorAll('.size-radio').forEach(function(sizeRadio) {
        sizeRadio.addEventListener('change', function() {
            localStorage.setItem('selectedSize', this.value);
        });
    });

    document.querySelectorAll('.color-radio').forEach(function(colorRadio) {
        colorRadio.addEventListener('change', function() {
            localStorage.setItem('selectedColor', this.value);
        });
    });
</script>

</html>