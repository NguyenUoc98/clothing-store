@extends('layouts.admin.app')

@section('content')
    <h1>Thêm sản phẩm mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label for="product_code">Mã sản phẩm</label>
            <input type="text" class="form-control" id="product_code" name="product_code" required>
        </div>

        <select class="form-control" name="category_id" required>
            <option value="">Chọn danh mục</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>


        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" class="form-control" id="size" name="size">
        </div>

        <div class="form-group">
            <label for="color">Màu</label>
            <input type="text" class="form-control" id="color" name="color">
        </div>

        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" class="form-control" name="price" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" class="form-control" name="image">
        </div>

        <div class="form-group">
            <label for="stock">Số lượng trong kho</label>
            <input type="number" class="form-control" name="stock" required>
        </div>


        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
@endsection