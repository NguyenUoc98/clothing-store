@extends('layouts.admin.app')

@section('title', 'Thêm khách hàng mới')

@section('content')
    <div class="shadow-sm card md:max-w-1/2">
        <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-4 gap-3">
                <label for="name" class="leading-9">Name<span class="text-red-600">*</span></label>
                <input type="text" name="name" id="name" class="col-span-3" required>
                <label for="email" class="leading-9">Email<span class="text-red-600">*</span></label>
                <input type="text" name="email" id="email" class="col-span-3" required>
                <label for="phone" class="leading-9">Phone number<span class="text-red-600">*</span></label>
                <input type="text" name="phone" id="phone" class="col-span-3" required>
                <label for="address" class="leading-9">Address<span class="text-red-600">*</span></label>
                <input type="text" name="address" id="address" class="col-span-3" required>
                <div class="col-span-4 flex justify-end gap-2">
                    <a href="{{ route('customer.index') }}" class="button !px-8 border border-neutral-300 hover:bg-gray-100">Hủy</a>
                    <button type="submit" class="button !px-8 bg-blue-500 hover:bg-blue-700 text-white">Thêm khách hàng</button>
                </div>
            </div>
        </form>
    </div>
@endsection