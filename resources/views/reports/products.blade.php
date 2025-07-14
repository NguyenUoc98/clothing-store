<!-- resources/views/reports/products.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Báo cáo sản phẩm bán chạy')
@section('icon')
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
</svg>
@endsection

@section('content')
    <div class="shadow rounded-lg overflow-x-auto bg-white border border-neutral-300">
        <table class="table">
            <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Loại</th>
                <th>Số lượng bán</th>
                <th>Tổng doanh thu</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($statistics as $index => $statistic)
                <tr>
                    <td class="text-center">{{ ($statistics->currentPage() - 1) * $statistics->perPage() + $index + 1 }}</td>
                    <td class="min-w-[350px]">
                        <div class="flex gap-4">
                            <div class="shrink-0">
                                <img src="{{ asset('storage/' . $statistic->product->image) }}" class="w-20 h-auto mb-2"/>
                                <p class="text-gray-500"># {{ $statistic->product->product_code }}</p>
                            </div>
                            <div>
                                <p>{{ $statistic->product->name }}</p>
                                <p class="text-sm text-gray-500"><b class="text-black">Size: </b>{{ $statistic->product->size }}</p>
                                <p class="text-sm text-gray-500"><b class="text-black">Màu: </b>{{ $statistic->product->color }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap !text-nowrap text-center">{{ $statistic->product->category->name }}</td>
                    <td class="text-center">{{ $statistic->count }}</td>
                    <td class="whitespace-nowrap !text-nowrap font-bold text-red-600 text-right"><span>{{ number_format($statistic->money, 0, ',', '.') }} VND</span></td>
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
        <div class="py-2 px-4">{{ $statistics->links() }}</div>
    </div>
@endsection
