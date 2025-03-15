@extends('layouts.app')

@section('content')
    <h1>Sửa sản phẩm</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="form-group">
    <label for="product_code">Mã sản phẩm</label>
    <input type="text" class="form-control" name="product_code" value="{{ $product->product_code }}">
    </div>

        <div class="form-group">
    <label for="category">Danh mục</label>
    <select name="category_id" id="category" class="form-control">
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="size">Size</label>
    <input type="text" class="form-control" name="size" value="{{ $product->size }}">
    </div>

<div class="form-group">
    <label for="color">Color</label>
    <input type="text" class="form-control" name="color" value="{{ $product->color }}">
    </div>

<div class="form-group">
            <label for="price">Giá</label>
            <input type="number" class="form-control" name="price" step="0.01" value="{{ $product->price }}" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" name="description" required>{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="file" class="form-control" name="image">
            <img src="{{ asset('storage/' . $product->image) }}" width="100">
        </div>

        <div class="form-group">
            <label for="stock">Số lượng trong kho</label>
            <input type="number" class="form-control" name="stock" value="{{ $product->stock }}" required>
        </div>


        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
    </form>
@endsection
