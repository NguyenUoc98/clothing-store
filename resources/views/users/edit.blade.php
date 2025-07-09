@extends('layouts.admin.app')

@section('title', 'Sửa Người Dùng')

@section('content')
    <div class="shadow-sm card md:max-w-1/2">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-4 gap-3">
                <label for="name" class="leading-9">Tên <span class="text-red-600">*</span></label>
                <input type="text" name="name" class="col-span-3" required value="{{ $user->name }}">
                <label for="email" class="leading-9">Email <span class="text-red-600">*</span></label>
                <input type="email" name="email" class="col-span-3" required value="{{ $user->email }}">
                <label for="role" class="leading-9">Vai trò <span class="text-red-600">*</span></label>
                <select name="role" class="col-span-3" required>
                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Nhân viên</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                </select>
                <div class="col-span-4 flex justify-end gap-2">
                    <a href="{{ route('users.index') }}" class="button !px-8 border border-neutral-300 hover:bg-gray-100">Hủy</a>
                    <button type="submit" class="button !px-8 bg-blue-500 hover:bg-blue-700 text-white">Lưu</button>
                </div>
            </div>
        </form>
    </div>
@endsection