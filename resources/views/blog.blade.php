<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="asset/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="asset/css/blog.css">
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
                        <li><a href="blog.html">Blog</a>

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
            <div class="slide">
                <div class="text">
                    BLOG
                </div>
            </div>

        </div>
    </header>
    <section>
        <div class="container">
            <aside class="sidebar">
                <div class="container12">
                    <!-- Search Bar Section -->
                    <section class="search-bar12">
                        <input type="text" placeholder="Search...">
                        <button type="submit">Search</button>
                    </section>

                    <!-- Categories Section -->
                    <section class="categories12">
                        <h2>Categories</h2>
                        <ul>
                            <li>women clothing</li>
                            <li>News</li>
                            <li>Fashion trend</li>
                        </ul>
                    </section>

                    <!-- Popular Posts Section -->
                    <section class="popular-posts12">
                        <h2>Popular Posts</h2>

                        <div class="post12">
                            <img src="asset/img/blog1.jpg" alt="Enjoy the Pool">
                            <div class="post-details12">
                                <p>July 5, 2024</p>
                                <h3>Fashion Forward</h3>
                                <p>By Leslie Parker</p>
                            </div>
                        </div>

                        <div class="post12">
                            <img src="asset/img/blog2.jpg" alt="Crown by Nature">
                            <div class="post-details12">
                                <p>July 5, 2024</p>
                                <h3>Unveiling Elegance</h3>
                                <p>By Leslie Parker</p>
                            </div>
                        </div>

                        <div class="post12">
                            <img src="asset/img/blog3.jpg" alt="Facial Massage">
                            <div class="post-details12">
                                <p>July 5, 2024</p>
                                <h3>A Guide to Timeless</h3>
                                <p>By Leslie Parker</p>
                            </div>
                        </div>

                        <div class="post12">
                            <img src="asset/img/blog4.jpg" alt="Facial Massage">
                            <div class="post-details12">
                                <p>July 5, 2024</p>
                                <h3>Tailored Tales</h3>
                                <p>By Leslie Parker</p>
                            </div>
                        </div>
                    </section>

                    <!-- Subscribe Section -->
                    <section class="subscribe12">
                        <h2>Subscribe</h2>
                        <p>Be informed about new posts!</p>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Your e-mail" required>
                            <button type="submit">
                                <span>&#10148;</span>
                            </button>
                        </form>
                    </section>

                    <!-- Tags Section -->
                    <section class="tags12">
                        <h2>Tags</h2>
                        <p>
                            New <br>
                            Women clothing <br>
                            Faction Treand

                        </p>
                    </section>

                    <!-- Instagram Section -->
                    <section class="instagram12">
                        <h2>Instagram</h2>
                        <button>Follow on Instagram</button>
                    </section>

                    <!-- Social Share Section -->
                    <section class="social-share12">
                        <h2>Social Share</h2>
                        <ul>
                            <li>FB</li>
                            <li>Ln</li>
                            <li>Em</li>
                        </ul>
                    </section>
                </div>
            </aside>


            <div class="main-content">
                <div class="blog-container">
                    <div class="article-card">
                        <div class="article-thumbnail">
                            <img src="asset/img/blog5.jpg" alt="Thumbnail 1">
                        </div>
                        <div class="article-content">
                            <span class="article-tags">NEWS | WOMEN CLOTHING</span>
                            <span class="article-meta">ADMIN — DECEMBER 1, 2024</span>
                            <p class="article-summary">
                                MODEL FOR A DAY—VOGUE’S RESIDENT STREET STYLE PHOTOGRAPHER STEPS IN FRONT OF THE CAMERA
                                FOR UGG AND TELLS US ALL ABOUT IT
                            </p>
                        </div>
                    </div>

                    <div class="article-card">
                        <div class="article-thumbnail">
                            <img src="asset/img/blog6.jpg" alt="Thumbnail 2">
                        </div>
                        <div class="article-content">
                            <span class="article-tags">NEWS | WOMEN CLOTHING</span>
                            <span class="article-meta">ADMIN — DECEMBER 2, 2024</span>
                            <p class="article-summary">
                                THIS BAG TREND WILL BE A FAVORITE OF FRENCH WOMEN THIS FALLTHIS BAG TREND WILL BE A
                                FAVORITE OF FRENCH WOMEN THIS FALL
                            </p>
                        </div>
                    </div>
                </div>

                <div class="main-content1 mgt-5">
                    <div class="post-image">
                        <img src="asset/img/blog7.jpg" alt="Lovely Candle">
                    </div>
                    <div class="post-details">
                        <p class="date">June 29, 2021 / Health, Spa</p>
                        <h1 class="title">A Guide to Timeless</h1>
                        <p class="description">
                            The spring 2025 shows are done and dusted, save for a Giorgio Armani spectacular scheduled
                            for mid-October in New York. reminded of the Presidential head-to-head during New York
                            Fashion Week
                        </p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                </div>

                <div class="blog-container mgt-5 ">
                    <div class="article-card">
                        <div class="article-thumbnail">
                            <img src="asset/img/blog8.jpg" alt="Thumbnail 1">
                        </div>
                        <div class="article-content">
                            <span class="article-tags">NEWS | WOMEN CLOTHING</span>
                            <span class="article-meta">ADMIN — DECEMBER 1, 2024</span>
                            <p class="article-summary">
                                These Are the Top Fall Trends Vogue Editors Will Be Wearing Next Season
                            </p>
                        </div>
                    </div>

                    <div class="article-card">
                        <div class="article-thumbnail">
                            <img src="asset/img/blog9.jpg" alt="Thumbnail 2">
                        </div>
                        <div class="article-content">
                            <span class="article-tags">NEWS | WOMEN CLOTHING</span>
                            <span class="article-meta">ADMIN — DECEMBER 2, 2024</span>
                            <p class="article-summary">
                                The Top Trends of Resort 2025: Denim for Days, Goddess Dresses, and the Return of the Bubble Skirt
                            </p>
                        </div>
                    </div>
                </div>
                <div class="main-content1 mgt-5">
                    <div class="icon-title-container">
                        <div class="icon-element"><i class="fa-solid fa-paperclip"></i></div>
                        <div class="title-text">Relax Your Soul at Our Spa</div>
                    </div>
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