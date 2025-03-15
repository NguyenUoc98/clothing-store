@extends('layouts.frontend.app')

@section('content')
    <div>
        <div class="slide active" style="background-image: url({{ asset('asset/img/banner1.webp') }});">
        </div>
        <div class="slide" style="background-image: url({{ asset('asset/img/bannner5.webp') }});">
        </div>
        <div class="slide active" style="background-image: url({{ asset('asset/img/banner6.jpg') }});">
        </div>
        <div class="slide" style="background-image: url({{ asset('asset/img/banner7.jpeg') }});">
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
    </div>

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
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            <div class="overlay-text">
                                <p>
                                    <span>{{ number_format($product->price, 0, ',', '.') }} VND</span><br>
                                    {{ $product->name }} <br>
                                    <br>
                                    <i class="fa-solid fa-cart-plus add-to-cart" data-product-id="{{ $product->id }}" style="color:#ffff;"></i>
                                </p>
                            </div>
                        </div>
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
                <img src="{{ asset('asset/img/index5.jpg') }}" alt="Model in denim outfit" class="image-bottom">
                <img src="{{ asset('asset/img/index6.jpg') }}" alt="Model posing in denim" class="image-top">
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

            <div class="img-deco" style="background-image: url({{ asset('asset/img/index7.png') }});">
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
                            <li style="--i:1">
                                <a href="{{ route('productItem', $product->id) }}">
                                    <bottom class="viewmore">View more</bottom>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('script')
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
        $(document).ready(function () {
            $('.add-to-cart').click(function () {
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
                    success: function (response) {
                        alert(response.message); // Hiển thị thông báo thêm sản phẩm thành công
                    },
                    error: function (response) {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            });
        });
    </script>
@endpush
