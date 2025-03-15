@extends('layouts.app')

@section('content')
<h1>Quản lý tài khoản</h1>
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<a href="{{ route('users.create') }}" class="btn btn-primary">Tạo tài khoản mới</a> <br>

<table class="table">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Vai trò</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Sửa</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection