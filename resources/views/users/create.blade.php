@extends('layouts.app')

@section('content')
<h1>Tạo tài khoản</h1>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Tên</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Vai trò</label>
        <select name="role" class="form-control" required>
            <option value="staff">Nhân viên</option>
            <option value="admin">Quản trị viên</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Tạo tài khoản</button>
</form>
@endsection