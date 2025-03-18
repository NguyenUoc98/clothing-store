<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="asset/css/about.css">
    
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
                        @guest
                            <i class="fa-solid fa-user">
                                <ul class="submenu">
                                    <li><a href="/login">Login</a></li>
                                    <li><a href="{{ route('create-account') }}">Sign up</a></li>
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
            <div class="slide" style="background-image: url('asset/img/aboutbanner1.jpg')" ;>
                <div class="text">
                    ABOUT US
                </div>
            </div>
        </div>
    </header>
    

    <section class="about3" id="about">
        <div class="row3">
            <div class="img4">
                <img class="img4" src="asset/img/about1.jpg" alt="">
            </div>
            <div class="content3">
                <div class="vertical-text">
                    exceptional
                </div>
                <div class="content4">
                    <h3>PERSONALIZED STYLING
                    </h3>
                    <h3>CONSULTATIONS</h3> <br>
                    <p>Need help finding the perfect outfit? Our professional stylists are here to assist you! Whether
                        it's for a special event or a wardrobe refresh, we offer one-on-one styling sessions to ensure
                        you look and feel your best.</p> <br>
                    <a href="" class="btn4">Learn more</a>
                </div>
            </div>
        </div>
    </section>

    <section class="service-container">
        <div class="service-box">
            <img src="asset/img/home1img1.png" alt="" width="150" height="250">
            <h3> Custom Tailoring</h3>
            <p>For the perfect fit, we offer custom tailoring services for select pieces in our collection.</p>
            <button class="read-more">Read more</button>
        </div>

        <div class="service-box">
            <img src="asset/img/home1img2.png" alt="" width="150" height="250">
            <h3> VIP Membership Program</h3>
            <p>Join our exclusive VIP membership program and enjoy benefits such as early access to new collections,
                members-only sales, personalized lookbooks, and special discounts.</p>
            <button class="read-more">Read more</button>
        </div>

        <div class="service-box">
            <img src="asset/img/home2img3.png" alt="" width="150" height="250">
            <h3>Virtual Try-On</h3>
            <p>Experience our latest collections from the comfort of your home with our virtual try-on feature. Using
                advanced technology, you can see how our pieces look on you before making a purchase.</p>
            <button class="read-more">Read more</button>
        </div>
    </section>

    <section class="team-container">
        <div class="team-left">
            <div class="image-box large" style="background-image: url('asset/img/about6.jpg');">
            </div> <!-- Ảnh 1 -->
            <div class="image-box medium" style="background-image: url('asset/img/about8.jpg');">

            </div> <!-- Ảnh 2 -->
        </div>
        <div class="team-middle">
            <div class="image-box small" style="background-image: url('asset/img/about7.jpg');"></div> <!-- Ảnh 3 -->
        </div>
        <div class="team-right">
            <h2>OUR PROFESSIONAL TEAM</h2>
            <p>
                Our team is a dedicated group of experts, bringing together years of experience across various
                industries.
                With a focus on innovation, quality, and client satisfaction, we strive to deliver outstanding results
                in every project.
            </p>
            <p>
                At the core of our success is a shared passion for continuous learning and growth. Each team member is
                committed
                to staying at the forefront of their respective fields, ensuring that we utilize the latest technologies
                and best practices
                in all our work. Our collaborative approach fosters creativity and innovation, allowing us to tackle
                complex challenges
                and deliver custom solutions that meet the unique needs of our clients. Together, we build not just
                projects,
                but lasting partnerships founded on trust, transparency, and mutual success.
            </p>
        </div>
    </section>
    <section class="wrapper">

        <div class="item-card">
            <img src="asset/img/about3.jpg" alt="Summer Collections" class="item-image">
            <div class="item-details">
                <p class="item-date">December 1, 2024</p>
                <h3 class="item-title">Summer Collections</h3>
                <p class="item-description">
                    Summer is just around the corner, which means it’s time to update your wardrobes with the latest
                    fashion trends...
                </p>
                <a href="#" class="item-link">Read More ⟶</a>
            </div>
        </div>
        <div class="item-card">
            <img src="asset/img/about4.jpg" alt="New Trends in Clothes" class="item-image">
            <div class="item-details">
                <p class="item-date">December 1, 2024</p>
                <h3 class="item-title">New Trends in Clothes</h3>
                <p class="item-description">
                    The fashion industry is always evolving, and 2023 is no exception. As we move further into the new
                    year...
                </p>
                <a href="#" class="item-link">Read More ⟶</a>
            </div>
        </div>
        <div class="item-card">
            <img src="asset/img/about5.jpg" alt="Best Gifts for Holidays" class="item-image">
            <div class="item-details">
                <p class="item-date">December 1, 2024</p>
                <h3 class="item-title">Best Gifts for Holidays</h3>
                <p class="item-description">
                    The holiday season is a time for joy, celebration, and giving. Finding the perfect gift for your
                    loved ones...
                </p>
                <a href="#" class="item-link">Read More ⟶</a>
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