<form method="POST" action="{{ route('cart.update') }}">
    @csrf
    @foreach ($cartItems as $item)
        <div class="cart-item">
            <div>
                <h3>{{ $item['product']->name }}</h3>
                <p>{{ $item['product']->price }} VND</p>
            </div>
            
            <!-- Trường input để người dùng thay đổi số lượng -->
            <input type="number" name="cart[{{ $item['product']->id }}]" value="{{ $item['quantity'] }}" min="1" class="quantity-input">
            
            <!-- Hiển thị tổng tiền của sản phẩm -->
            <p class="item-total">
                Tổng: {{ $item['price'] * $item['quantity'] }} VND
            </p>
        </div>
    @endforeach
    
    <!-- Hiển thị tổng tiền của giỏ hàng -->
    <div class="cart-total">
        <p id="total-price">Tổng cộng: {{ $totalPrice }} VND</p>
    </div>
    
    <button type="submit">Cập nhật giỏ hàng</button>
    <button type="submit" formaction="{{ route('checkout.process') }}">Thanh toán</button>
</form>

<script>
    // Cập nhật tổng tiền khi thay đổi số lượng
    const quantityInputs = document.querySelectorAll('.quantity-input');
    
    quantityInputs.forEach(input => {
        input.addEventListener('input', updateTotal);
    });

    function updateTotal() {
        let total = 0;
        const cartItems = document.querySelectorAll('.cart-item');

        cartItems.forEach(item => {
            const price = parseFloat(item.querySelector('p').textContent.replace(' VND', ''));
            const quantity = parseInt(item.querySelector('.quantity-input').value);
            const itemTotal = price * quantity;

            item.querySelector('.item-total').textContent = 'Tổng: ' + itemTotal + ' VND';
            total += itemTotal;
        });

        document.querySelector('#total-price').textContent = 'Tổng cộng: ' + total + ' VND';
    }
</script>
