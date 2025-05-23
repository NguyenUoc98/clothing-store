<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account
    </title>
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('asset/fontawesome-free-6.6.0-web/css/all.min.css') }}">

    <!-- Preconnect for Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('asset/css/login.css') }}">

    <!-- Google Fonts -->
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
                        <li><a href="index.html">Home</a>

                        </li>
                        <li><a href="about.html">About</a>

                        </li>

                        <li><a href="index.html"><img src="{{asset('asset/img/logo.png')}}" alt="" class="anh"></a></li>
                        <li><a href="product.html">Product</a></li>
                        <li><a href="blog.html">Blog</a>

                        </li>
                        <li><a href="contact.html">Contact</a>

                        </li>
                    </ul>
                </div>

                <div class="icon" id="menuIcon">
                    <div class="icon1">
                        <div class="iconsearch1">
                            <i class="fa-solid fa-user">
                                <ul class="submenu">
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="createaccount.html">Sign up</a></li>
                                </ul>
                            </i>
                        </div>
                        <div class="iconsearch1">
                            <i class="fa-solid fa-cart-shopping"></i>
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
                    Create Account
                </div>
            </div>

        </div>
    </header>
    <section>
        <div class="contact-section" style="background-image: url('asset/img/login.jpg');">
            <form action="{{ route('password.update') }}" method="POST" class="form-wrapper">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-row">
                    <div class="field-container">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="field-container">
                        <label for="password">New Password*</label>
                        <label class="show" for="show" id="togglePassword" style="cursor: pointer;"><i class="fa-regular fa-eye"></i></label>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="field-container">
                        <label for="password_confirmation">Confirm Password*</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="login">
                    <button type="submit" class="submit-btn">Reset Password</button>
                </div>
            </form>
        </div>

    </section>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            if (type === 'password') {
                togglePassword.innerHTML = '<i class="fa-regular fa-eye"></i>';
            } else {
                togglePassword.innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
            }
        });
    </script>

</body>


</html>