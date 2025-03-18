<!-- resources/views/reports/products.blade.php -->
@extends('layouts.admin.app')
@section('content')
    <h1>Báo cáo sản phẩm bán chạy</h1>
    <table class="table table-bordered mt-4">
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng bán</th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ number_format($item->price, 2) }} VND</td>
                <td>{{ $item->sales_count }}</td>
            </tr>
        @endforeach

    </table>
@endsection
