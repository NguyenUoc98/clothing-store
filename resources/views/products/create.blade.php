@extends('layouts.admin.app')

@section('title', 'Thêm sản phẩm mới')

@section('content')
    <div class="shadow-sm card md:max-w-1/2">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-4 gap-3">
                <label for="name" class="leading-9">Tên sản phẩm<span class="text-red-600">*</span></label>
                <input type="text" class="col-span-3" name="name" required>
                <label for="product_code" class="leading-9">Mã sản phẩm<span class="text-red-600">*</span></label>
                <input type="text" class="col-span-3" id="product_code" name="product_code" required>
                <label for="size" class="leading-9">Danh mục<span class="text-red-600">*</span></label>
                <select class="col-span-3" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <label for="size" class="leading-9">Size</label>
                <input type="text" class="col-span-3" id="size" name="size">
                <label for="color" class="leading-9">Màu</label>
                <input type="text" class="col-span-3" id="color" name="color">
                <label for="price" class="leading-9">Giá<span class="text-red-600">*</span></label>
                <input type="number" class="col-span-3" name="price" step="0.01" required>
                <label for="description" class="leading-9">Mô tả<span class="text-red-600">*</span></label>
                <textarea class="col-span-3" name="description" required rows="5"></textarea>
                <label for="image" class="leading-9">Hình ảnh</label>
                <input type="file" class="col-span-3" name="image">
                <label for="stock" class="leading-9">Số lượng trong kho<span class="text-red-600">*</span></label>
                <input type="number" class="col-span-3" name="stock" required>
                <div class="col-span-4 flex justify-end gap-2">
                    <a href="{{ route('products.index') }}" class="button !px-8 border border-neutral-300 hover:bg-gray-100">Hủy</a>
                    <button type="submit" class="button !px-8 bg-blue-500 hover:bg-blue-700 text-white">Thêm sản phẩm</button>
                </div>
            </div>
        </form>
    </div>
@endsection