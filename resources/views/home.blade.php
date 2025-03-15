<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="asset/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="asset/css/style.css">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <header>


        <div class="navbar header-container">
            <div class="search">

                <input type="text" id="search-box" placeholder="Search products..." autocomplete="off">
                <ul id="suggestions" class="suggestions-list"></ul>
                <div class="iconsearch">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>


            <style>
                .search {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    width: 250px;
                    height: 35px;
                    margin: 0 10px;
                    border: 2px solid #000;
                    /* Viền chỉ có ở phần khung ngoài */
                    border-radius: 20px;
                    padding: 0 10px;
                    /* Căn chỉnh khoảng cách nội dung */
                    background: #fff;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                }

                /* Cải thiện khung tìm kiếm */
                .search-box {
                    flex: 1;
                    border: none;
                    outline: none;
                    font-size: 14px;
                    padding: 5px;
                    background: transparent;
                }

                .search-box:focus {
                    border-color: #0056b3;
                    /* Đổi màu viền khi focus */
                    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
                    /* Thêm hiệu ứng ánh sáng khi focus */
                }

                /* Danh sách gợi ý */
                .suggestions-list {
                    list-style: none;
                    padding: 0;
                    margin: 0;
                    position: absolute;
                    background: #fff;
                    border-radius: 8px;
                    /* width: 100%; */
                    z-index: 9999;
                    /* Đảm bảo danh sách nằm trên tất cả các phần tử */
                    max-height: 400px;
                    /* overflow-y: auto; */
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }

                .suggestions-list li {
                    padding: 10px 15px;
                    cursor: pointer;
                    font-size: 14px;
                    transition: background 0.3s ease, transform 0.3s ease;
                }

                .suggestions-list li:hover {
                    background: #f4f4f4;
                    transform: translateX(5px);
                }

                .suggestions-list li:active {
                    background: #e0e0e0;
                    transform: translateX(2px);
                }

                .suggestions-list li:first-child {
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                }

                .suggestions-list li:last-child {
                    border-bottom-left-radius: 8px;
                    border-bottom-right-radius: 8px;
                }

                /* Đảm bảo không bị che khuất bởi các yếu tố khác */
                .suggestions-list-wrapper {
                    position: relative;
                    /* Giữ danh sách gợi ý nằm trong vùng chứa */
                }

                /* Kiểu chung cho menu */
                .menu {
                    display: flex;
                    height: 60px;
                    align-items: center;
                    justify-content: flex-start;
                    /* Đẩy menu sang trái */
                    padding-left: 50px;
                    background-color: #fff;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

                }

                /* Căn chỉnh các mục con trong menu */
                .menu ul {
                    display: flex;
                    justify-content: center;
                    /* Căn giữa các mục trong menu */
                    align-items: center;
                    /* Căn giữa theo trục dọc */
                    list-style: none;
                    /* Loại bỏ dấu chấm ở danh sách */
                    padding: 0;
                    margin: 0;
                    gap: 20px;
                    /* Khoảng cách giữa các mục menu */
                }

                /* Kiểu cho các mục menu */
                .menu ul li {
                    margin-right: 20px;
                    position: relative;
                    /* Để hỗ trợ submenu */
                }

                .menu ul li a {
                    font-size: 14px;
                    text-decoration: none;
                    color: #000;
                    padding: 5px 10px;
                    /* Điều chỉnh khoảng cách bên trong */
                    transition: color 0.3s ease;
                    /* Hiệu ứng khi hover */
                }

                .menu ul li a:hover {
                    color: #0056b3;
                    /* Đổi màu khi hover */
                }

                /* Logo ở giữa */
                .menu ul li img.anh {
                    height: 100px;
                    /* Điều chỉnh kích thước logo */
                    object-fit: contain;
                }

                /* Biểu tượng bên phải */
                .icon {
                    margin-left: auto;
                    /* Đẩy icon sang bên phải */
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

                .icon1 {
                    display: flex;
                    align-items: center;
                    /* Đảm bảo căn giữa theo trục dọc */
                    gap: 15px;
                    /* Khoảng cách giữa các thành phần trong icon1 */
                }

                .cart-icon {
                    position: relative;
                    /* Giữ nguyên để thêm hiệu ứng nếu cần */
                    display: flex;
                    align-items: center;
                    /* Căn giữa biểu tượng giỏ hàng theo trục dọc */
                    justify-content: center;
                    /* Căn giữa biểu tượng giỏ hàng theo trục ngang */
                    font-size: 16px;
                    margin-right: 10px;
                }

                .cart-icon a {
                    text-decoration: none;
                    color: #000;
                    /* Màu sắc của biểu tượng */
                }

                .cart-icon i {
                    font-size: 18px;
                    /* Điều chỉnh kích thước biểu tượng */
                    color: #000;
                    /* Màu biểu tượng */
                    transition: color 0.3s ease;
                }

                .cart-icon i:hover {
                    color: #0056b3;
                    /* Thay đổi màu khi hover */
                }

                /* Submenu (ẩn/hiện khi hover) */
                .submenu {
                    display: none;
                    position: absolute;
                    top: 100%;
                    left: 0;
                    background-color: #fff;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    padding: 5px 0;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    z-index: 10;
                }

                .menu ul li:hover .submenu {
                    display: block;
                }

                .submenu li {
                    padding: 5px 15px;
                    white-space: nowrap;
                }

                .submenu li a {
                    color: #000;
                    font-size: 14px;
                }

                .submenu li a:hover {
                    color: #0056b3;
                }

                .user-name {
                    font-size: 5px;
                    /* Điều chỉnh kích thước chữ nhỏ hơn */
                    font-weight: normal;
                    /* Bỏ định dạng đậm (nếu có) */
                    color: #000;
                    /* Màu sắc phù hợp */
                    margin-right: 10px;
                    /* Khoảng cách với các phần tử bên cạnh */
                    white-space: nowrap;
                    /* Ngăn chữ bị xuống dòng */
                }
            </style>

            <!-- Thêm script của bạn tại đây -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    const searchBox = $('#search-box'); // Sử dụng jQuery để chọn ô tìm kiếm
                    const suggestionsList = $('.suggestions-list'); // Danh sách gợi ý
                    const suggestionsWrapper = $('.suggestions-list-wrapper'); // Vùng chứa danh sách gợi ý

                    // Khi người dùng nhập vào ô tìm kiếm, gửi yêu cầu AJAX
                    searchBox.on('keyup', function() {
                        let query = $(this).val();
                        if (query.length > 1) { // Kiểm tra độ dài của từ khóa
                            $.ajax({
                                url: '{{ route("search") }}',
                                type: 'GET',
                                data: {
                                    query: query
                                },
                                success: function(data) {
                                    suggestionsList.empty(); // Xóa danh sách gợi ý cũ
                                    data.forEach(product => {
                                        suggestionsList.append(`<li onclick="viewProduct(${product.id})">${product.name}</li>`);
                                    });
                                    suggestionsList.addClass('show'); // Hiển thị danh sách gợi ý
                                }
                            });
                        } else {
                            suggestionsList.empty(); // Nếu không có từ khóa, xóa danh sách gợi ý
                            suggestionsList.removeClass('show'); // Ẩn danh sách gợi ý
                        }
                    });

                    // Khi người dùng nhấp vào bất kỳ đâu ngoài ô tìm kiếm hoặc danh sách gợi ý, ẩn danh sách gợi ý
                    $(document).on('click', function(event) {
                        if (!suggestionsWrapper.is(event.target) && !suggestionsWrapper.has(event.target).length && !searchBox.is(event.target)) {
                            suggestionsList.removeClass('show'); // Ẩn danh sách gợi ý
                        }
                    });

                    // Ngừng ẩn danh sách gợi ý khi người dùng nhấp vào ô tìm kiếm
                    searchBox.on('click', function(event) {
                        event.stopPropagation(); // Ngừng sự kiện 'click' để không bị ẩn
                    });
                });

                // Hàm để chuyển hướng đến trang chi tiết sản phẩm
                function viewProduct(id) {
                    window.location.href = '/product/' + id; // Chuyển hướng đến trang chi tiết sản phẩm
                }

                // Hàm để chọn sản phẩm từ gợi ý
                function selectProduct(name) {
                    $('#search-box').val(name);
                    $('.suggestions-list').empty();
                    $('.suggestions-list').removeClass('show');
                }
            </script>



            <div class="menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    <li><a href="/"><img src="asset/img/logo.png" alt="Logo" class="anh"></a></li>
                    <li><a href="/product">Product</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
                <div class="icon" id="menuIcon">
                    <div class="icon1">
                        <div class="iconsearch1">
                            @guest
                            <i class="fa-solid fa-user">
                                <ul class="submenu">
                                    <li><a href="/login">Login</a></li>
                                    <li><a href="/createaccount">Sign up</a></li>
                                </ul>
                            </i>
                            @else
                            <span class="user-name">
                                @if (Auth::guard('customer')->check())
                                {{ Auth::guard('customer')->user()->name }}
                                @else
                                Khách hàng
                                @endif
                                <i class="fa-solid fa-caret-down"></i>
                            </span>

                            <ul class="submenu">
                                <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            </ul>
                            <form action="{{ route('logout') }}" method="POST" style="display: none;" id="logout-form">
                                @csrf
                            </form>
                            @endguest
                        </div>
                        <div class="cart-icon">
                            <a href="{{ route('cart.index') }}">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </div>
                    </div>
                    <div class="iconsearch1">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
            </div>

        </div>


        <div class="slide active" style="background-image: url('asset/img/banner1.webp');">
        </div>
        <div class="slide" style="background-image: url('asset/img/bannner5.webp');">
        </div>
        <div class="slide active" style="background-image: url('asset/img/banner6.jpg');">
        </div>
        <div class="slide" style="background-image: url('asset/img/banner7.jpeg');">
        </div>

        <div class="fashion-section">
            <div class="fashion-overlay"></div>
            <div class="fashion-content">
                <h1>Find The Best Fashion Style For You</h1>
                <p>
                    Fashion is an indispensable part of modern life, not just a collection of garments
                    that cover the body, but also a way to express individuality, style, and personal aesthetic.
                    From classic designs to contemporary trends, fashion is constantly evolving, reflecting
                    changes in time, culture, and society.
                </p>
                <a href="product.html" class="fashion-btn">Shop Now</a>
            </div>
        </div>
        <div class="index-images">
            <div class="index-item index-item-0 itemactive"></div>
            <div class="index-item index-item-1"></div>
            <div class="index-item index-item-2"></div>
            <div class="index-item index-item-3"></div>
        </div>

        <!-- </div> -->
    </header>
    <section>
        <div class="ourteamh3">
            <div class="team-title">
                <h3 class="title">NEW PRODUCT</h3>
            </div>
        </div>
        <div class="galler">
            <div class="gallery1">
                <div>
                    @foreach($products_35_38 as $product)
                    <span class="image-container">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="overlay-text">
                            <p>
                                <span>{{ number_format($product->price, 0, ',', '.') }} VND</span><br>
                                {{ $product->name }} <br>
                                <br>
                                <i class="fa-solid fa-cart-plus add-to-cart" data-product-id="{{ $product->id }}" style="color:#ffff;">
                                </i>
                            </p>

                        </div>

                    </span>
                    </span>
                    @endforeach
                </div>
                <div>
                    @foreach($products_35_38 as $product)
                    <span class="image-container">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="overlay-text">
                            <p>
                                <span>{{ number_format($product->price, 0, ',', '.') }} VND</span><br>
                                {{ $product->name }}
                            </p>
                        </div>
                    </span>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <section>
        <div class="container">
            <div class="text-content">
                <h1><span>Ne</span>w Collections</h1>
                <p>In a striking fashion feature captured by <u>Carmelo Donato</u>, FGR’s latest exclusive focuses
                    on denim, with models <u>Alina Enders</u> and <u>Jette</u> taking the spotlight. Stylist <u>Emma
                        Brown</u> curates a collection that remixes denim staples, from jean jackets to
                    high-waisted skirts and bustier tops.</p>
                <a href="#" class="details-btn">Details</a>
            </div>

            <div class="image-section">
                <img src="asset/img/index5.jpg" alt="Model in denim outfit" class="image-bottom">
                <img src="asset/img/index6.jpg" alt="Model posing in denim" class="image-top">
            </div>
            <div class="circle small"></div>
            <div class="circle medium"></div>
            <div class="circle large"></div>
            <div class="circle large2"></div>
            <div class="circle large1"></div>
        </div>
    </section>

    <section>
        <div class="img-decorate">

            <div class="img-deco" style="background-image: url(asset/img/index7.png);">
                <div class="img-h1">
                    <h1>The special offers</h1>
                </div>
                <div class="img-text">
                    <h3>SALE UP TO 35%</h3>
                    <button>Details</button>
                </div>
            </div>
        </div>
    </section>

    <section class="ourteam">
        <div class="ourteamh3">
            <div class="team-title">
                <h3 class="title">OUR PRODUCTS</h3>
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
                            <h3>{{ $product->name }} <br><span>{{ number_format($product->price, 0, ',', '.') }}
                                    VND</span> <br>

                                <span>
                                    <i class="fa-solid fa-cart-plus add-to-cart" data-product-id="{{ $product->id }}">
                                    </i>
                                </span>





                            </h3>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1"><a href="{{ route('productItem', $product->id) }}">
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
                            <h3>{{ $product->name }} <br><span>{{ number_format($product->price, 0, ',', '.') }}
                                    VND</span> <br>

                                <span>
                                    <i class="fa-solid fa-cart-plus add-to-cart" data-product-id="{{ $product->id }}">
                                    </i>
                                </span>




                            </h3>
                        </div>
                    </div>
                    <ul class="sci">
                        <li style="--i:1"><a href="{{ route('productItem', $product->id) }}">
                                <bottom class="viewmore">View more</bottom>
                            </a></li>
                    </ul>
                </div>
                @endforeach
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
<script src="asset/js/app.js"></script>

<script>
    //slide
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;
    const indexItems = document.querySelectorAll('.index-item');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            if (i === index) {
                slide.classList.add('active');
            }
        });

        // Cập nhật trạng thái cho index-item
        const activeItem = document.querySelector('.itemactive');
        if (activeItem) {
            activeItem.classList.remove('itemactive');
        }
        document.querySelector('.index-item-' + currentSlide).classList.add('itemactive');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides; // Quay vòng lại slide đầu tiên khi hết danh sách
        showSlide(currentSlide);
    }

    // Gán sự kiện click cho các index-item
    indexItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            currentSlide = index; // Cập nhật chỉ số slide hiện tại
            showSlide(currentSlide); // Hiển thị slide tương ứng
        });
    });

    // Bắt đầu slideshow và thay đổi ảnh mỗi 5 giây
    setInterval(nextSlide, 5000);

    // Hiển thị slide đầu tiên khi trang tải
    showSlide(currentSlide);



    let currentIndex = 0;
    const testimonials = document.querySelectorAll('.testimonial-container');
    const dots = document.querySelectorAll('.dot');

    function showTestimonial(index) {
        testimonials.forEach((testimonial, i) => {
            testimonial.classList.remove('active', 'previous', 'next');
            dots[i].classList.remove('active'); // Loại bỏ active ở tất cả các chấm
            if (i === index) {
                testimonial.classList.add('active');
                dots[i].classList.add('active'); // Đánh dấu chấm tròn active
            } else if (i < index) {
                testimonial.classList.add('previous');
            } else {
                testimonial.classList.add('next');
            }
        });
    }

    function nextTestimonial() {
        currentIndex++;
        if (currentIndex >= testimonials.length) {
            currentIndex = 0;
        }
        showTestimonial(currentIndex);
    }

    function prevTestimonial() {
        currentIndex--;
        if (currentIndex < 0) {
            currentIndex = testimonials.length - 1;
        }
        showTestimonial(currentIndex);
    }

    function currentTestimonial(index) {
        currentIndex = index;
        showTestimonial(currentIndex);
    }

    // Initialize slider
    showTestimonial(currentIndex);

    // Auto-slide every 5 seconds
    setInterval(nextTestimonial, 5000);

    //scroll
    let scrollContainer = document.querySelector(".gallery1");
    let autoScrollSpeed = 1; // Tốc độ cuộn
    let isScrolling = false;
    let scrollDirection = 0; // -1 cho trái, 1 cho phải

    // Hàm bắt đầu cuộn theo hướng
    function startScroll(direction) {
        if (!isScrolling) {
            isScrolling = true;
            scrollDirection = direction;
            requestAnimationFrame(autoScroll);
        }
    }

    // Hàm dừng cuộn
    function stopScroll() {
        isScrolling = false;
    }

    // Hàm cuộn tự động theo hướng
    function autoScroll() {
        if (isScrolling) {
            scrollContainer.scrollLeft += scrollDirection * autoScrollSpeed;
            requestAnimationFrame(autoScroll); // Lặp lại hàm này cho cuộn liên tục
        }
    }

    // Sự kiện để xác định hướng cuộn dựa trên vị trí chuột
    scrollContainer.addEventListener("mousemove", (evt) => {
        let containerWidth = scrollContainer.offsetWidth;
        let mouseX = evt.clientX - scrollContainer.getBoundingClientRect().left;

        if (mouseX < containerWidth / 2) {
            startScroll(-1); // Chuột nằm bên trái, cuộn sang trái
        } else {
            startScroll(1); // Chuột nằm bên phải, cuộn sang phải
        }
    });

    // Khi chuột rời khỏi container, dừng cuộn
    scrollContainer.addEventListener("mouseleave", stopScroll);


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
</script>

</html>