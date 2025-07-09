@extends('layouts.frontend.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('asset/css/blog.css') }}">
@endpush

@section('content')
    <div class="img-decorate !p-0 !m-0">
        <div class="img-deco !h-96 !bg-center" style="background-image: url({{ asset('asset/img/banner1.webp') }});">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-7xl">
                BLOG
            </div>
        </div>
    </div>

    <section>
        <div class="max-w-7xl mx-auto container">
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
@endsection
