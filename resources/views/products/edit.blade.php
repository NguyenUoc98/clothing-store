@extends('layouts.admin.app')

@section('title', 'Sửa sản phẩm')

@section('content')
    <div class="shadow-sm card md:max-w-1/2">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-4 gap-3">
                <label for="name" class="leading-9">Tên sản phẩm<span class="text-red-600">*</span></label>
                <input type="text" class="col-span-3" name="name" value="{{ $product->name }}" required>
                <label for="product_code" class="leading-9">Mã sản phẩm</label>
                <input type="text" class="col-span-3" name="product_code" value="{{ $product->product_code }}">
                <label for="category" class="leading-9">Danh mục</label>
                <select name="category_id" id="category" class="col-span-3">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <label for="size" class="leading-9">Size</label>
                <input type="text" class="col-span-3" name="size" value="{{ $product->size }}">
                <label for="color" class="leading-9">Color</label>
                <input type="text" class="col-span-3" name="color" value="{{ $product->color }}">
                <label for="price" class="leading-9">Giá<span class="text-red-600">*</span></label>
                <input type="number" class="col-span-3" name="price" step="0.01" value="{{ $product->price }}" required>
                <label for="description" class="leading-9">Mô tả<span class="text-red-600">*</span></label>
                <textarea class="col-span-3" name="description" required>{{ $product->description }}</textarea>
                <label for="image" class="leading-9">Hình ảnh</label>
                <div class="col-span-3">
                    <input type="file"  name="image" class="w-full">
                    <img src="{{ asset('storage/' . $product->image) }}" width="100">
                </div>

                <label for="stock" class="leading-9">Số lượng trong kho<span class="text-red-600">*</span></label>
                <input type="number" class="col-span-3" name="stock" value="{{ $product->stock }}" required>

                <div class="col-span-4 flex justify-end gap-2">
                    <a href="{{ route('products.index') }}" class="button !px-8 border border-neutral-300 hover:bg-gray-100">Hủy</a>
                    <button type="submit" class="button !px-8 bg-blue-500 hover:bg-blue-700 text-white">Cập nhật sản phẩm</button>
                </div>
            </div>
        </form>
    </div>
@endsection
