@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Danh sách đơn hàng</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>
                        <a href="{{ route('orders.printInvoice', $order->id) }}" class="btn btn-warning btn-sm">In hóa đơn</a>

                        <!-- Form cập nhật trạng thái -->
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <select name="status" class="form-control form-control-sm" required>
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao hàng</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Hủy đơn</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
