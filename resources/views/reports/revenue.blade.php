<!-- resources/views/reports/revenue.blade.php -->

@extends('layouts.admin.app')

@section('icon')
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z"/>
        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z"/>
    </svg>
@endsection
@section('title', 'Báo cáo doanh thu')

@section('search')
    <div class="w-full rounded-xl bg-white shadow p-6 mb-10">
        <form action="{{ route('reports.revenue') }}" method="get" class="flex items-end gap-6">
            <div class="space-y-2 flex flex-col">
                <label for="start_date" class="text-gray-700 font-medium">Ngày bắt đầu</label>
                <input type="date" name="start_date" id="start_date" class="p-2 border rounded-lg" value="{{ request()->input('start_date', Carbon\Carbon::now()->startOfMonth()->toDateString()) }}">
            </div>
            <div class="space-y-2 flex flex-col">
                <label for="end_date" class="text-gray-700 font-medium">Ngày kết thúc</label>
                <input type="date" name="end_date" id="end_date" class="p-2 border rounded-lg" value="{{ request()->input('end_date', Carbon\Carbon::now()->toDateString()) }}">
            </div>

            <div class="space-y-2 flex flex-col">
                <label for="date_group" class="text-gray-700 font-medium">Nhóm</label>
                <select name="date_group" id="date_group" class="p-2 border rounded-lg">
                    <option value="date" @selected(request()->input('date_group', 'date') == 'date')>Ngày</option>
                    <option value="week" @selected(request()->input('date_group', 'date') == 'week')>Tuần</option>
                    <option value="month" @selected(request()->input('date_group', 'date') == 'month')>Tháng</option>
                    <option value="year" @selected(request()->input('date_group', 'date') == 'year')>Năm</option>
                </select>
            </div>

            <button class="button bg-[#1c1b22] hover:bg-gray-700 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z"/>
                </svg>
                Lọc
            </button>
        </form>
    </div>
@endsection

@section('content')
    <div class="shadow rounded-lg overflow-x-auto bg-white border border-neutral-300">
        <table class="table">
            <thead>
            <tr>
                <th>Ngày</th>
                <th>Tổng doanh thu</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($result as $dateString => $_res)
                <tr>
                    <td class="text-center">{{ $dateString }}</td>
                    <td class="whitespace-nowrap !text-nowrap font-bold text-red-600 text-center"><span>{{ number_format($_res, 0, ',', '.') }} VND</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="!p-0">
                        <p class="py-10 bg-white text-center">Không có dữ liệu</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
