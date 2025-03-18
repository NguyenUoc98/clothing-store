<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản lý danh mục quần áo')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
        @custom-variant dark (&:where([data-theme=dark], [data-theme=dark] *));
        :root {
            font-size: 15px;
        }

        table {
            @apply w-full;
        }

        table > tbody > tr:nth-of-type(odd) > * {
            @apply bg-gray-100;
        }

        table > tbody > tr:nth-of-type(even) > * {
            @apply bg-white;
        }

        td, th {
            @apply p-2 border border-neutral-300 text-balance;
        }

        th {
            @apply font-bold text-center bg-[#00000020];
        }

        .button {
            @apply rounded-lg px-4 py-2 flex gap-1 items-center;
        }

        input {
            @apply rounded-md border border-gray-200 px-4 py-2 focus:outline-none;
        }
    </style>
    {{--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">--}}
</head>
<body class="bg-[#edeef0]">
<nav class="bg-light fixed top-0 h-[60px] bg-[#1c1b22] text-white shadow w-full">
    <div class="container flex items-center gap-4 justify-between h-full mx-auto">
        <span class="font-bold text-xl" href="#">Quản lý cửa hàng</span>
        <div class="flex items-center h-full gap-2">
            <a @class([
                    'px-3 py-1.5 hover:bg-[#606a7340] rounded-lg',
                    'bg-[#606a7340]' => request()->routeIs('categories.index')
                ]) href="{{ route('categories.index') }}">
                Danh mục
            </a>
            <a @class([
                    'px-3 py-1.5 hover:bg-[#606a7340] rounded-lg',
                    'bg-[#606a7340]' => request()->routeIs('products.index')
                ]) href="{{ route('products.index') }}">
                Sản phẩm
            </a>
            <a @class([
                    'px-3 py-1.5 hover:bg-[#606a7340] rounded-lg',
                    'bg-[#606a7340]' => request()->routeIs('customer.index')
                ]) href="{{ route('customer.index') }}">
                Khách hàng
            </a>
            <a @class([
                    'px-3 py-1.5 hover:bg-[#606a7340] rounded-lg',
                    'bg-[#606a7340]' => request()->routeIs('users.index')
                ]) href="{{ route('users.index') }}">
                Người dùng
            </a>
            <a @class([
                    'px-3 py-1.5 hover:bg-[#606a7340] rounded-lg',
                    'bg-[#606a7340]' => request()->routeIs('orders.index')
                ]) href="{{ route('orders.index') }}">
                Quản lý đơn hàng
            </a>
            <a @class([
                    'px-3 py-1.5 hover:bg-[#606a7340] rounded-lg',
                    'bg-[#606a7340]' => request()->routeIs('reports.index')
                ]) href="{{ route('reports.revenue') }}">
                Báo cáo doanh thu
            </a>
            <a @class([
                    'px-3 py-1.5 hover:bg-[#606a7340] rounded-lg',
                    'bg-[#606a7340]' => request()->routeIs('reports.index')
                ]) href="{{ route('reports.products') }}">
                Báo cáo sản phẩm bán chạy
            </a>
        </div>
    </div>
</nav>

<div class="container mt-[80px] mb-10 mx-auto">
    <div class="w-full rounded-xl bg-white shadow flex items-center justify-between p-6 mb-10">
        <h1 class="text-2xl">@yield('title')</h1>
        <div class="flex items-center gap-2 justify-end">
            @yield('command-bar')
        </div>
    </div>
    @yield('content')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
