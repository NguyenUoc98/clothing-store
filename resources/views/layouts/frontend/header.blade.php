<nav class="bg-white sticky top-0 w-full z-10 shadow">
    <div class="menu flex max-w-7xl !mx-auto items-center !justify-between">
        <div class="search !w-fit">
            <input type="text" id="search-box" placeholder="Search products..." autocomplete="off">
            <ul id="suggestions" class="suggestions-list"></ul>
            <div class="iconsearch">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <ul class="!ml-14">
            <li><a href="{{ route('product.index') }}">Product</a></li>
            <li><a href="{{ route('blog') }}">Blog</a></li>
            <li><a href="{{ route('home') }}" class="!m-0 !px-6"><img src="{{ asset('asset/img/logo.png') }}" alt="Logo" class="anh"></a></li>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
        <div class="icon !m-0" id="menuIcon">
            <div class="icon1">
                <div class="iconsearch1">
                    @guest('customer')
                        <i class="fa-solid fa-user">
                            <ul class="submenu">
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('create-account') }}">Sign up</a></li>
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
            </div>
            <div class="cart-icon">
                <a href="{{ route('cart.index') }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </div>
    </div>
</nav>