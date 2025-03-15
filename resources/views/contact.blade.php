<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="asset/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="asset/css/contact.css">
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
            <div class="slide" style="background-image: url('asset/img/contact2.jpg')" ;>
                <div class="fashion-overlay"></div>
                <div class="text">
                    CONTACT
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="contact-section">
            <h1>FEEL FREE TO CONTACT US</h1>
            <p>Elementum nisi quis eleifend quam adipiscing vitae proin sagittis nisl.</p>
            <form action="#" method="POST" class="form-wrapper">
                <div class="form-row">
                    <div class="field-container">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="field-container">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>
                <div class="field-container">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Send</button>
            </form>
        </div>
        <div class="column map-section">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.998874706762!2d-74.00397452415491!3d40.72500517206925!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259af18b67b4d%3A0xefe2c682f8eafe9b!2s3%20Wakehurst%20St%2C%20New%20York%2C%20NY%2010002!5e0!3m2!1sen!2sus!4v1697032822654!5m2!1sen!2sus"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>
    <section>
        <div class="service">
            <div class="service1">
                <img src="asset/img/contact3.jpg" alt="">
            </div>
            <div class="service1">
                <img src="asset/img/contact5.jpg" alt="">
            </div>
            <div class="service1 service2">
                <!-- <img src="assets/img/new4.jpg" alt=""> -->
                <h2>Folow our <br> Instagram</h2>

            </div>
            <div class="service1">
                <img src="asset/img/contact7.jpg" alt="" >

            </div>
            <div class="service1">
                <img src="asset/img/contact8.jpg" alt="">

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