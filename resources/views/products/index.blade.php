@extends('layouts.admin.app')

@section('title', 'Danh sách sản phẩm')

@section('command-bar')
    <a class="button bg-blue-500 hover:bg-blue-700 text-white" href="{{ route('products.create') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        Thêm sản phẩm mới
    </a>
@endsection

@section('search')
    <div class="w-full rounded-xl bg-white shadow p-6 mb-10">
        <form action="{{ route('products.index') }}" method="get" class="flex items-end gap-10">
            <div class="space-y-2 flex flex-col">
                <label for="search" class="text-gray-700 font-medium">Tên sản phẩm</label>
                <input class="p-2 border rounded-lg w-96" name="q" id="search" value="{{ $search }}"/>
            </div>

            <div class="space-y-2 flex flex-col">
                <label for="category" class="text-gray-700 font-medium">Danh mục</label>
                <select class="p-2 border rounded-lg w-56" name="c" id="category">
                    <option value="-1">Tất cả</option>
                    @foreach(App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" @selected($c == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="button bg-[#1c1b22] hover:bg-gray-700 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                </svg>
                Tìm kiếm
            </button>
        </form>
    </div>
@endsection

@section('content')
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

    <div class="shadow rounded-lg overflow-x-auto bg-white border border-neutral-300">
        <table class="table">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Loại</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Số lượng trong kho</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($products as $product)
                <tr>
                    <td class="min-w-[350px]">
                        <div class="flex gap-4">
                            <div class="shrink-0">
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-auto mb-2"/>
                                <p class="text-gray-500"># {{ $product->product_code }}</p>
                            </div>
                            <div>
                                <p>{{ $product->name }}</p>
                                <p class="text-sm text-gray-500"><b class="text-black">Size: </b>{{ $product->size }}</p>
                                <p class="text-sm text-gray-500"><b class="text-black">Màu: </b>{{ $product->color }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap !text-nowrap text-center">{{ $product->category->name }}</td>
                    <td class="max-w-[500px]"><p class="line-clamp-4">{{ $product->description ?: 'Chưa có mô tả' }}</p></td>
                    <td class="whitespace-nowrap !text-nowrap font-bold text-red-600 text-right"><span>{{ number_format($product->price, 0, ',', '.') }} VND</span></td>
                    <td class="text-center">{{ $product->stock }}</td>
                    <td>
                        {{-- Hành động: Sửa, Xóa --}}
                        <div class="flex gap-2 justify-center">
                            <a href="{{ route('products.edit', $product->id) }}" class="button bg-blue-500 hover:bg-blue-700 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                </svg>
                                Sửa
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button bg-red-500 hover:bg-red-700 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                    </svg>
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="!p-0">
                        <p class="py-10 bg-white text-center">Không có dữ liệu</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="py-2 px-4">{{ $products->links() }}</div>
    </div>

@endsection