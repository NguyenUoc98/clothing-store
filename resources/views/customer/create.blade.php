@extends('layouts.app')

@section('content')
 
    <div class="bg-w p-5 ">
                @if (session('status'))
                <h5 class='alert alert-success'>{{ session('status') }}</h5>
                @endif
                <h1 >Create Customer</h1>
                <a href="{{ route('customer.index') }}" class ='btn btn-danger float-end'>Back to List</a>  
                <div class="mb-3"></div>

            <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group mb-3">
                    <label for="">Name :</label>
                    <input type="text" name="name" id="" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <label for="">Email :</label>
                    <input type="text" name="email" id="" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <label for="">Phone number :</label>
                    <input type="text" name="phone" id="" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <label for="">Address :</label>
                    <input type="text" name="address" id="" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
@endsection