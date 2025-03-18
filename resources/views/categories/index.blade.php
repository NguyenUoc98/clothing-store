@extends('layouts.admin.app')

@section('content')
    <h1 class="my-4">Danh sách danh mục</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Thêm danh mục</a>
    <table class="table table-bordered">
        {{-- Hiển thị thông báo lỗi nếu có --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Hiển thị thông báo thành công nếu có --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <thead class="thead-dark">
        <tr>
            <th>Số thứ tự</th> <!-- Đưa cột số thứ tự lên đầu -->
            <th>Tên danh mục</th>
            <th>Hình ảnh</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->display_order }}</td> <!-- Hiển thị số thứ tự -->
                <td>{{ $category->name }}</td>
                <td>
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100">
                </td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
