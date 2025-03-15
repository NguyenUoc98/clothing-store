<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="{{ asset('asset/css/checkout.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .cart-summary, .checkout-form {
            margin-bottom: 20px;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cart-table th, .cart-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .cart-table th {
            background-color: #f4f4f4;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #0056b3;
        }
        .add-address, .change-address {
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Thanh toán</h1>

        <!-- Giỏ hàng -->
        <div class="cart-summary">
            <h3>Thông tin giỏ hàng</h3>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->product->price, 0, ',', '.') }} VND</td>
                            <td>{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4 class="total">Tổng giỏ hàng: {{ number_format($cartTotal, 0, ',', '.') }} VND</h4>
        </div>

        <!-- Địa chỉ giao hàng -->
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="checkout-form">
                <h3>Thông tin thanh toán</h3>

                <!-- Hiển thị địa chỉ -->
<div class="form-group">
                    <label>Địa chỉ giao hàng</label>
                    @if ($defaultAddress)
                        <p id="selected-address">{{ $defaultAddress['address'] }}</p>
                        <a href="javascript:void(0);" id="change-address" class="change-address">Thay đổi</a>
                    @else
                        <p id="no-address-message">Bạn chưa có địa chỉ giao hàng. Vui lòng thêm địa chỉ mới.</p>
                    @endif
                </div>

                <!-- Thêm địa chỉ mới -->
                <div id="new-address-form" style="display:none;">
                    <h4>Nhập địa chỉ mới</h4>
                    <div class="form-group">
                        <label for="name">Tên người nhận</label>
                        <input type="text" id="name" name="name" placeholder="Nhập tên người nhận">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ chi tiết</label>
                        <input type="text" id="address" name="address" placeholder="Nhập địa chỉ chi tiết">
                    </div>
                    <button type="button" id="save-new-address" class="submit-btn">Lưu địa chỉ</button>
                </div>

                <!-- Phương thức thanh toán -->
            <div class="form-group">
    <label for="payment_method">Phương thức thanh toán</label>
    <select id="payment_method" name="payment_method" required>
        <option value="cod" {{ old('payment_method', 'cod') == 'cod' ? 'selected' : '' }}>Thanh toán khi nhận hàng (COD)</option>
    </select>
</div>

<button type="submit" class="submit-btn" id="paymentButton">Thanh toán</button>
</div>

        <div id="thankYouMessage" style="display: none;">
    <h2>Cảm ơn bạn đã mua hàng!</h2>
</div>
        </form>

    </div>

    <script>
    $(document).ready(function () {
        // Hiển thị form thêm địa chỉ khi bấm vào nút "Thay đổi"
        $('#change-address').click(function () {
            $('#new-address-form').show();
        });

        // Lưu địa chỉ mới
        $('#save-new-address').click(function () {
            alert('Địa chỉ mới đã được lưu!');
            $('#new-address-form').hide();
        });

        // Sự kiện click vào nút thanh toán
        $('#paymentButton').click(function (e) {
            e.preventDefault(); // Ngăn chặn form gửi ngay lập tức

            const paymentMethod = $('#payment_method').val();
            
            // Kiểm tra phương thức thanh toán
            if (paymentMethod === 'cod') {
                // Hiển thị thông báo cảm ơn
                $('#thankYouMessage').show();
                
                // Ẩn nút thanh toán
                $('#paymentButton').hide();
                
                // Sau 3 giây, chuyển hướng về trang chủ
                setTimeout(function () {
                    window.location.href = '/'; // Địa chỉ trang chủ của bạn
                }, 3000); // Chờ 3 giây
            } else {
                alert('Vui lòng chọn phương thức thanh toán');
            }
        });
    });
</script>

</body>
</html>