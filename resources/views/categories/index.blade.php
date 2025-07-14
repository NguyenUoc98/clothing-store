@extends('layouts.admin.app')

@section('title', 'Danh sách danh mục')
@section('icon')
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
    </svg>
@endsection

@section('command-bar')
    <a class="bg-blue-500 text-white button hover:bg-blue-700" href="{{ route('categories.create') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        Thêm danh mục
    </a>
@endsection

@section('search')
    <div class="w-full rounded-xl bg-white shadow p-6 mb-10">
        <form action="{{ route('categories.index') }}" method="get" class="flex items-end gap-10">
            <div class="space-y-2 flex flex-col">
                <label for="search" class="text-gray-700 font-medium">Tên danh mục</label>
                <input class="p-2 border rounded-lg w-96" name="q" id="search" value="{{ $search }}"/>
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
    <div class="overflow-x-auto rounded-lg border border-neutral-300 bg-white shadow">
        <table class="table">
            <thead>
            <tr>
                <th>Số thứ tự</th>
                <th>Tên danh mục</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td class="text-center">{{ $category->display_order }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="100">
                    </td>
                    <td>
                        <div class="flex gap-2 justify-center">
                            <a href="{{ route('categories.edit', $category->id) }}" class="button bg-blue-500 hover:bg-blue-700 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                </svg>
                                Sửa
                            </a>
                            <form
                                    action="{{ route('categories.destroy', $category->id) }}"
                                    method="POST" style="display:inline;"
                            >
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
                    <td colspan="4" class="!p-0">
                        <p class="py-10 bg-white text-center">Không có dữ liệu</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="py-2 px-4">{{ $categories->links() }}</div>
@endsection
