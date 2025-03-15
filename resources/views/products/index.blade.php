@extends('layouts.app')

@section('content')
<h1>Danh sách sản phẩm</h1>
{{-- Hiển thị thông báo thành công hoặc lỗi --}}
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif


<a href="{{ route('products.create') }}" class="btn btn-primary">Thêm sản phẩm mới</a>

<table class="table">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Mã sản phẩm</th>
            <th>Size</th>
            <th>Màu</th>
            <th>Giá</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
            <th>Số lượng trong kho</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->product_code }}</td>
            <td>{{ $product->size }}</td>
            <td>{{ $product->color }}</td>
            <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
            <td>{{ $product->description ?: 'Chưa có mô tả' }}</td>
            <td><img src="{{ asset('storage/' . $product->image) }}" width="100"></td>
            <td>{{ $product->stock }}</td>
            <td>
                {{-- Hành động: Sửa, Xóa --}}
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>

                {{-- Form thêm sản phẩm vào giỏ hàng --}}
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <label for="quantity">Số lượng:</label>
                    <input type="number" name="quantity" value="1" min="1">
                    <!-- <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button> -->
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection