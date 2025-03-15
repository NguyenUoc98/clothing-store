<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản lý danh mục quần áo')</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Quản lý cửa hàng</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('categories.index') }}">Danh mục</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.index') }}">Khách hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Người dùng</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('promotions.index') }}">Khuyến mãi</a>
                    </li>  -->
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">Quản lý đơn hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.revenue') }}">Báo cáo doanh thu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('reports.products') }}">Báo cáo sản phẩm bán chạy</a>
                    </li>
                    <!-- Thêm mục Giỏ hàng -->
                    <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
