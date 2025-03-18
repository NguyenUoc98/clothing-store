@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <h2>Danh Sách Chương Trình Khuyến Mãi</h2>

        <!-- Hiển thị thông báo thành công hoặc lỗi nếu có -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Nút thêm mới chương trình khuyến mãi -->
        <a href="{{ route('promotions.create') }}" class="btn btn-primary mb-3">Thêm Khuyến Mãi Mới</a>

        <!-- Bảng danh sách khuyến mãi -->
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên Khuyến Mãi</th>
                <th>Loại Khuyến Mãi</th>
                <th>Giảm Giá Cố Định</th>
                <th>Giảm Giá %</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Kết Thúc</th>
                <th>Hành Động</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($promotions as $promotion)
                <tr>
                    <td>{{ $promotion->id }}</td>
                    <td>{{ $promotion->name }}</td>
                    <td>
                        @if ($promotion->type == 'product')
                            Giảm giá theo sản phẩm
                        @else
                            Giảm giá toàn bộ đơn hàng
                        @endif
                    </td>
                    <td>{{ $promotion->discount_amount ? number_format($promotion->discount_amount, 0) . ' VNĐ' : '-' }}</td>
                    <td>{{ $promotion->discount_percent ? $promotion->discount_percent . '%' : '-' }}</td>
                    <td>{{ $promotion->start_date }}</td>
                    <td>{{ $promotion->end_date }}</td>
                    <td>
                        <!-- Nút chỉnh sửa -->
                        <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-sm btn-warning">Chỉnh Sửa</a>

                        <!-- Nút xóa -->
                        <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Không có chương trình khuyến mãi nào.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
