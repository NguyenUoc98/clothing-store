<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF Token -->
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="asset/css/cart.css">
</head>

<body>
    <div class="container">
        <h1 class="cart-title">Giỏ Hàng Của Bạn</h1>

        <!-- Kiểm tra nếu giỏ hàng trống -->
        @if(count($cartItems) == 0)
        <div id="empty-cart-message" class="empty-cart-message">
            <p>Giỏ hàng của bạn hiện tại chưa có sản phẩm.</p>
            <a href="/" class="shop-now-btn">Mua sắm ngay</a>
        </div>
        @else

        <!-- Giỏ hàng có sản phẩm -->
        <div id="cart-table" class="cart-table">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Kích cỡ</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="product-details">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
                        </td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->product->color ?? 'Chưa chọn' }}</td>
                        <td>{{ $item->product->size ?? 'Chưa chọn' }}</td>
                        <td>
                            <!-- Form để cập nhật số lượng -->
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="cart-item-form" data-id="{{ $item->id }}">
                                @csrf
                                <div class="quantity-control">
                                    <!-- Nút giảm số lượng -->
                                    <button type="button" data-action="decrease" class="quantity-btn"
                                        {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>

                                    <!-- Input để người dùng nhập số lượng -->
                                    <input type="number" id="quantity-input-{{ $item->id }}" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" required>

                                    <!-- Nút tăng số lượng -->
                                    <button type="button" data-action="increase" class="quantity-btn"
                                        {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>+</button>
                                </div>
                            </form>
                        </td>
                        <td>{{ number_format($item->product->price) }} VND</td>
                        <td id="item-price-{{ $item->id }}">{{ number_format($item->quantity * $item->product->price) }} VND</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn">Xóa</button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <div id="cart-total-wrapper">
                <p>Tổng tiền: <span id="cart-total">{{ number_format($cartTotal) }} VND</span></p>
            </div>


            <!-- Tiến hành thanh toán -->
            <div class="checkout">
                <a href="{{ route('checkout.index') }}" class="checkout-btn">Tiến hành thanh toán</a>
            </div>

        </div>
        @endif
    </div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.quantity-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Lấy đúng form chứa nút
                var form = this.closest('form');
                console.log('Form:', form); // Kiểm tra phần tử form
                console.log('Form Action:', form.action); // Kiểm tra action của form

                // Kiểm tra nếu form không hợp lệ
                if (!form || !form.action) {
                    console.error('Không tìm thấy form hoặc form không có action');
                    return;
                }

                var input = form.querySelector('input[name="quantity"]');
                var currentQuantity = parseInt(input.value);
                var maxQuantity = parseInt(input.getAttribute('max'));
                var minQuantity = parseInt(input.getAttribute('min'));

                // Xác định hành động (+ hoặc -) từ data-action
                if (this.getAttribute('data-action') === 'increase' && currentQuantity < maxQuantity) {
                    currentQuantity++;
                } else if (this.getAttribute('data-action') === 'decrease' && currentQuantity > minQuantity) {
                    currentQuantity--;
                }

                input.value = currentQuantity;

                // Cập nhật trạng thái nút
                updateButtonState(form, currentQuantity, minQuantity, maxQuantity);

                // Lấy giá trị size và color từ form
                var selectedSize = form.querySelector('input[name="size"]:checked')?.value;
                var selectedColor = form.querySelector('input[name="color"]:checked')?.value;

                // Kiểm tra nếu size và color chưa được chọn
                if (!selectedSize || !selectedColor) {
                    alert('Vui lòng chọn kích cỡ và màu sắc!');
                    return;
                }

                // Gửi yêu cầu AJAX
                updateCart(form, currentQuantity, selectedSize, selectedColor);
            });
        });

        function updateButtonState(form, quantity, min, max) {
            form.querySelector('.quantity-btn[data-action="decrease"]').disabled = quantity <= min;
            form.querySelector('.quantity-btn[data-action="increase"]').disabled = quantity >= max;
        }

        function updateCart(form, quantity, size, color) {
            const formData = new FormData(form);
            formData.set('quantity', quantity); // Cập nhật số lượng
            formData.set('size', size); // Gửi thông tin size
            formData.set('color', color); // Gửi thông tin color

            // Kiểm tra lại giá trị form.action
            if (!form.action || form.action === '') {
                console.error('Form action không hợp lệ');
                return;
            }

            fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật giá tiền sản phẩm
                        var itemId = form.dataset.id;
                        document.getElementById(`item-price-${itemId}`).textContent = `${data.totalPrice.toLocaleString()} VND`;

                        // Cập nhật tổng tiền giỏ hàng nếu có
                        if (data.cartTotal) {
                            document.getElementById('cart-total').textContent = `${data.cartTotal.toLocaleString()} VND`;
                        }
                    } else {
                        alert(data.message || 'Có lỗi xảy ra!');
                    }
                })
                .catch(error => {
                    alert('Không thể cập nhật giỏ hàng. Vui lòng thử lại sau.');
                    console.error('Lỗi cập nhật giỏ hàng:', error);
                });
        }
    });
</script>




</html>