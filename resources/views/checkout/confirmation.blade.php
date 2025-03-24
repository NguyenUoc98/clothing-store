@extends('layouts.frontend.app')

@section('title', 'Xác nhận đơn hàng')

@section('content')
    <div class="mx-auto py-10 font-[Arial] md:container md:px-36">
        <div class="rounded-lg border border-gray-200 p-4 shadow-md lg:p-10">
            <h1 class="mb-4 text-center text-4xl font-bold">Xác nhận đơn hàng</h1>

            <h3 class="mb-2 text-lg font-bold">Thông tin đơn hàng</h3>
            <p><b>Mã đơn hàng:</b> {{ $order->order_number }}</p>
            <p><b>Ngày đặt hàng:</b> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><b>Phương thức thanh toán:</b> {{ $order->type == \App\Enum\PaymentType::COD->value ? 'Thanh toán khi nhận hàng (COD)' : 'Thanh toán online' }}</p>
            <p>
                <b>Trạng thái đơn hàng:</b>
                @switch($order->status) 
                    @case(\App\Enum\PaymentStatus::INIT)
                    <b class="rounded-full bg-blue-500 px-3 py-1 text-white text-xs">Khởi tạo</b>
                    @break 
                    @case(\App\Enum\PaymentStatus::PROCESSING)
                    <b class="rounded-full bg-yellow-400 px-3 py-1 text-white text-xs">Đang xử lý</b>
                    @break 
                    @case(\App\Enum\PaymentStatus::SUCCESS)
                    <b class="rounded-full bg-green-600 px-3 py-1 text-white text-xs">Thành công</b>
                    @break 
                    @case(\App\Enum\PaymentStatus::ERROR)
                    <b class="rounded-full bg-red-600 px-3 py-1 text-white text-xs">Lỗi</b>
                    @break
                @endswitch
            </p>

            <!-- Giỏ hàng -->
            <div class="my-6">
                <h3 class="mb-2 text-lg font-bold">Chi tiết sản phẩm</h3>
                <table class="table w-full">
                    <thead>
                    <tr class="bg-black text-white">
                        <th class="border border-gray-200 p-2">Sản phẩm</th>
                        <th class="border border-gray-200 p-2">Số lượng</th>
                        <th class="border border-gray-200 p-2">Giá</th>
                        <th class="border border-gray-200 p-2">Tổng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($order->cart->items as $item)
                        <tr>
                            <td class="border border-gray-200 p-2">{{ $item->product->name }}</td>
                            <td class="border border-gray-200 p-2 text-center">{{ $item->quantity }}</td>
                            <td class="border border-gray-200 p-2 text-right font-bold">{{ number_format($item->product->price, 0, ',', '.') }} VND</td>
                            <td class="border border-gray-200 p-2 text-right font-bold">{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-gray-200 p-2 text-center font-bold">Tổng giỏ hàng</td>
                        <td class="border border-gray-200 p-2 text-right font-bold text-red-400">{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Địa chỉ giao hàng -->
            <label class="flex items-end gap-1 font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                </svg>
                Địa chỉ giao hàng
            </label>
            <div class="my-2 ml-6 w-fit rounded-lg border border-neutral-300 px-4 py-2 shadow">
                <p class="text-lg font-bold" id="selected-name">{{ $order->customer_name }}</p>
                <p>{{ $order->customer_email }}</p>
                <p>{{ $order->customer_phone }}</p>
                <p>{{ $order->shipping_address }}</p>
            </div>

            <div class="text-center mt-10">
                <p class="italic mb-3 text-green-600">Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi! Đơn hàng của bạn đã được xác nhận và sẽ được xử lý trong thời gian sớm nhất.</p>
                <a href="{{ route('home') }}" class="bg-black text-white hover:bg-gray-800 px-4 py-2 cursor-pointer rounded-lg flex items-end w-fit mx-auto gap-1 leading-none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                        <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                    </svg>

                    Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>
@endsection
