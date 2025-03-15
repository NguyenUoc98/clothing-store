@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <form action="{{ route('promotions.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tên khuyến mãi:</label>
            <input type="text" name="name" class="form-control" required>
            <div class="invalid-feedback">
                Vui lòng nhập tên khuyến mãi.
            </div>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Loại khuyến mãi:</label>
            <select name="type" class="form-select" required>
                <option value="product">Giảm giá theo sản phẩm</option>
                <option value="order">Giảm giá toàn bộ đơn hàng</option>
            </select>
            <div class="invalid-feedback">
                Vui lòng chọn loại khuyến mãi.
            </div>
        </div>

        <div class="mb-3">
            <label for="discount_amount" class="form-label">Giảm giá cố định:</label>
            <input type="number" name="discount_amount" class="form-control" step="0.01">
        </div>

        <div class="mb-3">
            <label for="discount_percent" class="form-label">Giảm giá %:</label>
            <input type="number" name="discount_percent" class="form-control" step="0.01" min="0" max="100">
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Ngày bắt đầu:</label>
            <input type="date" name="start_date" class="form-control" required>
            <div class="invalid-feedback">
                Vui lòng chọn ngày bắt đầu.
            </div>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Ngày kết thúc:</label>
            <input type="date" name="end_date" class="form-control" required>
            <div class="invalid-feedback">
                Vui lòng chọn ngày kết thúc.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Tạo khuyến mãi</button>
    </form>
</div>

<script>
    // JavaScript cho form validation của Bootstrap
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection
