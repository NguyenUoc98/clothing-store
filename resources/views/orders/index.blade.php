@extends('layouts.admin.app')

@section('title', 'Danh sách đơn hàng')


@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg border border-neutral-300 bg-white shadow">
        <table class="table">
            <thead>
            <tr>
                <th>Mã</th>
                <th>Khách hàng</th>
                <th>Tổng giá</th>
                <th>Trạng thái</th>
                <th>Loại</th>
                <th>Ghi chú</th>
                <th>Thời gian</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="text-center font-bold">{{ $order->id }}</td>
                    <td class="space-y-1">
                        <p class="text-lg font-bold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" class="size-5 shrink-0">
                                <g fill="none">
                                    <path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/>
                                    <path fill="currentColor" d="M12 13c2.396 0 4.575.694 6.178 1.671c.8.49 1.484 1.065 1.978 1.69c.486.616.844 1.352.844 2.139c0 .845-.411 1.511-1.003 1.986c-.56.45-1.299.748-2.084.956c-1.578.417-3.684.558-5.913.558s-4.335-.14-5.913-.558c-.785-.208-1.524-.506-2.084-.956C3.41 20.01 3 19.345 3 18.5c0-.787.358-1.523.844-2.139c.494-.625 1.177-1.2 1.978-1.69C7.425 13.694 9.605 13 12 13Zm0-11a5 5 0 1 1 0 10a5 5 0 0 1 0-10Z"/>
                                </g>
                            </svg>
                            {{ $order->customer_name }}
                        </p>
                        <p class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 16 16" class="size-5 shrink-0">
                                <path fill="currentColor" d="M11 10c-1 1-1 2-2 2s-2-1-3-2s-2-2-2-3s1-1 2-2s-2-4-3-4s-3 3-3 3c0 2 2.055 6.055 4 8s6 4 8 4c0 0 3-2 3-3s-3-4-4-3z"/>
                            </svg>
                            {{ $order->customer_phone }}
                        </p>
                        <p class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 shrink-0">
                                <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                            </svg>
                            {{ $order->shipping_address }}
                        </p>
                    </td>
                    <td class="whitespace-nowrap !text-nowrap text-right font-semibold text-red-600"><span>{{ number_format($order->total_price, 0, ',', '.') }}</span></td>
                    <td class="text-center">{{ $order->status->name }}</td>
                    <td class="text-center">{{ $order->type->name }}</td>
                    <td class="max-w-md">
                        <ul class="ml-4 list-inside list-disc">
                            @foreach($order->addition_information ?: [] as $key => $value)
                                <li><b>{{ $key }}:</b> {{ $value }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <p><b>Tạo: </b>{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p><b>Cập nhật: </b>{{ $order->updated_at->format('d/m/Y H:i') }}</p>
                    </td>

                    <td>
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="shrink-0 bg-blue-500 text-white button hover:bg-blue-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                </svg>
                                Sửa
                            </a>
                            <a href="{{ route('orders.printInvoice', $order->id) }}" class="shrink-0 bg-black text-white button hover:bg-gray-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                </svg>
                                In hóa đơn
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="px-4 py-2">{{ $orders->links() }}</div>
    </div>
@endsection
