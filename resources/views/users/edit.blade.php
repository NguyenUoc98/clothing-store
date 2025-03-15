@extends('layouts.app')

@section('content')
<h1>Sửa Người Dùng</h1>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">Tên:</label>
        <input type="text" name="name" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $user->email }}" required>
    </div>
    <div class="form-group">
    <label for="role">Vai Trò:</label>
    <select name="role" required>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
    </select>
    </div>
    <button type="submit" class="btn btn-success">Cập Nhật</button>
</form>
@endsection