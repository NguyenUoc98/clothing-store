@extends('layouts.admin.app')

@section('title', 'Thêm danh mục mới')

@section('content')
    <div class="shadow-sm card md:max-w-1/2">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-4 gap-3">
                <label for="name" class="leading-9">Tên danh mục<span class="text-red-600">*</span></label>
                <input type="text" class="col-span-3" id="name" name="name" value="{{ old('name') }}" required>
                <label for="image" class="leading-9">Hình ảnh<span class="text-red-600">*</span></label>
                <input type="file" class="col-span-3" id="image" name="image" required>
                <div class="col-span-4 flex justify-end gap-2">
                    <a href="{{ route('categories.index') }}" class="border border-neutral-300 !px-8 button hover:bg-gray-100">Hủy</a>
                    <button type="submit" class="bg-blue-500 !px-8 text-white button hover:bg-blue-700">Lưu</button>
                </div>
            </div>
        </form>
    </div>
@endsection
