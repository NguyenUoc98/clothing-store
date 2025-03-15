@extends('layouts.app')

@section('content')
     
         <div class="bg-w p-5 ">

                @if (session('status'))
                <h5 class='alert alert-success'>{{ session('status') }}</h5>
                @endif
                <h1>Customer List</h1>
                <a href="{{ route('customer.create') }}" class ='btn btn-primary float-end'>Add Customer</a>  
                <div class="mb-3"></div>
      
            <table class="table table-bordered"  >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($customers as $cus)
                <tr>
                    <td>{{ $cus->id }}</td>
                    <td>{{ $cus->name }}</td>
                    <td>{{ $cus->email }}</td>
                    <td>{{ $cus->phone}}</td>
                    <td>{{ $cus->address }}</td>

                    <td>
                        <a href="{{ route('customer.edit',['id' => $cus->id]) }}" class='btn btn-warning'>Edit</a>
                        <div class="mb-3"></div>
                        <form action="{{ route('customer.delete', ['id' => $cus->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </table>
        </div>
@endsection