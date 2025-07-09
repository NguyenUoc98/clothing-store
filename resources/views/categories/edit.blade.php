@extends('layouts.admin.app')

@section('title', 'Chỉnh sửa danh mục')

@section('content')
    <div class="shadow-sm card md:max-w-1/2">
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-4 gap-3">
                <label for="name" class="leading-9">Tên danh mục<span class="text-red-600">*</span></label>
                <input type="text" class="col-span-3" id="name" name="name" value="{{ $category->name }}" required>
                <label for="display_order" class="leading-9">Số thứ tự<span class="text-red-600">*</span></label>
                <input type="number" class="col-span-3" id="display_order" name="display_order" value="{{ $category->display_order }}" required>
                <label for="image" class="leading-9">Hình ảnh</label>
                <input type="file" class="col-span-3" id="image" name="image">
                <div class="col-span-4 flex justify-end gap-2">
                    <a href="{{ route('categories.index') }}" class="button !px-8 border border-neutral-300 hover:bg-gray-100">Hủy</a>
                    <button type="submit" class="button !px-8 bg-blue-500 hover:bg-blue-700 text-white">Lưu</button>
                </div>
            </div>
        </form>
    </div>
@endsection
