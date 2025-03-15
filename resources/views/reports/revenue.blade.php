<!-- resources/views/reports/revenue.blade.php -->

@extends('layouts.app')

@section('title', 'Báo cáo doanh thu')

@section('content')
    <h1>Báo cáo doanh thu</h1>

    <!-- Form lọc theo ngày -->
    <form method="GET" action="{{ route('reports.revenue') }}">
        <div class="form-group">
            <label for="start_date">Ngày bắt đầu</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->input('start_date', Carbon\Carbon::now()->startOfMonth()->toDateString()) }}">
        </div>
        <div class="form-group">
            <label for="end_date">Ngày kết thúc</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->input('end_date', Carbon\Carbon::now()->toDateString()) }}">
        </div>
        <button type="submit" class="btn btn-primary">Lọc</button>
    </form>

    <!-- Hiển thị bảng doanh thu -->
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Ngày</th>
                <th>Doanh thu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($revenue as $item)
                <tr>
                    <td>{{ $item->date }}</td>
                    <td>{{ number_format($item->total_revenue, 2) }} VND</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
