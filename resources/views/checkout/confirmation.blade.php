<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link rel="stylesheet" href="{{ asset('asset/css/confirmation.css') }}">
</head>
<body>
    <div class="container">
        <h1 class="title">Xác nhận đơn hàng</h1>

        <!-- Thông tin đơn hàng -->
        <div class="order-summary">
            <h3>Thông tin đơn hàng</h3>
            <p><strong>Mã đơn hàng:</strong> {{ $order->order_number }}</p>
            <p><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản ngân hàng' }}</p>

            <h4>Chi tiết sản phẩm</h4>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->product->price, 0, ',', '.') }} VND</td>
                            <td>{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="total">Tổng tiền: {{ number_format($order->total_price, 0, ',', '.') }} VND</h4>
        </div>

        <!-- Thông tin giao hàng -->
        <div class="shipping-info">
            <h3>Địa chỉ giao hàng</h3>
            <p>{{ $order->shipping_address }}</p>
        </div>

        <!-- Xác nhận -->
        <div class="confirmation">
            <p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi! Đơn hàng của bạn đã được xác nhận và sẽ được xử lý trong thời gian sớm nhất.</p>
            <p><strong>Trạng thái đơn hàng:</strong> Đang xử lý</p>
            <a href="{{ route('home') }}" class="btn">Quay lại trang chủ</a>
        </div>
    </div>
</body>
</html>
