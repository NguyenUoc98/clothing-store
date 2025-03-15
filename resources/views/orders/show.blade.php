@extends('layouts.app')

@section('content')
    <div class="container mt-4">
<h1>Chi tiết đơn hàng #{{ $order->id }}</h1>
<p>Người dùng: {{ $order->user_id }}</p>
<p>Tổng tiền: {{ number_format($order->total_price, 0, ',', '.') }} VND</p>
<p>Trạng thái: {{ $order->status }}</p>

<h2>Danh sách sản phẩm</h2>
<table>
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
            <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VND</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
