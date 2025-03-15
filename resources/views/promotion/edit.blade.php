@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chỉnh Sửa Chương Trình Khuyến Mãi</h2>

    <!-- Hiển thị thông báo thành công hoặc lỗi nếu có -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form để chỉnh sửa khuyến mãi -->
    <form action="{{ route('promotions.update', $promotion->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Laravel yêu cầu dùng PUT cho cập nhật -->

        <div class="form-group">
            <label for="name">Tên Khuyến Mãi:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $promotion->name) }}" required>
        </div>

        <div class="form-group">
            <label for="type">Loại Khuyến Mãi:</label>
            <select name="type" class="form-control" required>
                <option value="product" {{ $promotion->type == 'product' ? 'selected' : '' }}>Giảm giá theo sản phẩm</option>
                <option value="order" {{ $promotion->type == 'order' ? 'selected' : '' }}>Giảm giá toàn bộ đơn hàng</option>
            </select>
        </div>

        <div class="form-group">
            <label for="discount_amount">Giảm Giá Cố Định (VNĐ):</label>
            <input type="number" name="discount_amount" class="form-control" step="0.01" value="{{ old('discount_amount', $promotion->discount_amount) }}">
        </div>

        <div class="form-group">
            <label for="discount_percent">Giảm Giá %:</label>
            <input type="number" name="discount_percent" class="form-control" step="0.01" min="0" max="100" value="{{ old('discount_percent', $promotion->discount_percent) }}">
        </div>

        <div class="form-group">
            <label for="start_date">Ngày Bắt Đầu:</label>
            <input type="date" name="start_date" class="form-control" value="{{ old('start_date', $promotion->start_date) }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">Ngày Kết Thúc:</label>
            <input type="date" name="end_date" class="form-control" value="{{ old('end_date', $promotion->end_date) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
