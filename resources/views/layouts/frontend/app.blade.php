<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('asset/fontawesome-free-6.6.0-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <script src="{{ asset('asset/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('asset/js/header.js') }}"></script>
    @vite(['resources/js/app.js'])
    @stack('css')
    <style type="text/tailwindcss">
        .card {
            @apply overflow-hidden rounded-lg bg-white p-4 shadow;
        }
    </style>
</head>
<body>
@include('layouts.frontend.header')

<div class="!mt-[60px]">
    @yield('content')
</div>

<div id="popup" class="fixed top-0 left-0 z-20 flex hidden h-screen w-full items-center justify-center bg-black/80 opacity-0 transition-opacity duration-300 ease-in-out">
    <div class="relative text-center card w-md border-t-4 border-blue-500">
        <i class="absolute top-1 top-2 right-2 cursor-pointer" onclick="closePopup()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
            </svg>
        </i>
        <p class="mb-5 text-2xl font-bold text-blue-500 title">Thông báo</p>
        <p class="msg text-xl text-balance font-[Arial]">Xin chào thế giới!</p>
    </div>
</div>

@include('layouts.frontend.footer')
</body>
<script src="{{ asset('asset/js/app.js') }}"></script>

@stack('script')

<script type="text/javascript">
    function closePopup() {
        let content = document.getElementById("popup");
        content.classList.add("hidden");
        setTimeout(() => {
            content.classList.add("opacity-0");
        }, 10);
    }

    const openPopup = function (title, msg) {
        let content = document.getElementById("popup");
        content.querySelector(".title").textContent = title ? title : '';
        content.querySelector(".msg").textContent = msg ? msg : '';

        content.classList.remove("hidden");
        setTimeout(() => {
            content.classList.remove("opacity-0");
        }, 10);
    }
</script>

@if(Auth::guard('customer')->check())
    <script type="module">
        Echo.private('App.Models.Customer.{{ Auth::guard('customer')->id() }}')
            .notification((notification) => {
                openPopup(notification.title, notification.message);
            })
            .listen('NotificationPayment', function (event) {
                openPopup('Thông báo', event.message);
            });
    </script>
@endif

@if(session()->get('guest_id', Str::uuid()))
    <script type="module">
        function openPopup(title, msg) {
            const content = document.getElementById("popup");
            content.querySelector(".title").textContent = title ? title : '';
            content.querySelector(".msg").textContent = msg ? msg : '';

            content.classList.remove("hidden");
            setTimeout(() => {
                content.classList.remove("opacity-0");
            }, 10);
        }

        Echo.channel('guest_id.{{ session()->get('guest_id') }}')
            .listen('NotificationPayment', function (event) {
                openPopup('Thông báo', event.message);
            });
    </script>
@endif

</html>