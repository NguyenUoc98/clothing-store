@extends('layouts.frontend.app')

@section('title', 'Thông tin thanh toán')

@section('content')
    <div class="mx-auto py-10 font-[Arial] max-w-4xl">
        <div class="rounded-lg border border-gray-200 p-4 shadow-md lg:p-10">
            <h1 class="mb-4 text-center text-4xl font-bold">Thông tin thanh toán</h1>

            <div class="w-full flex gap-4 justify-center">
                <img class="border border-neutral-300 p-4 rounded-lg shadow w-64" src="{{ $dataTransfer['qr_string'] }}"/>
                <div class="rounded-lg overflow-hidden border border-neutral-300 flex">
                    <table>
                        <tr>
                            <td class="border-b border-r border-neutral-300 p-2 font-bold whitespace-nowrap">Ngân hàng</td>
                            <td class="border-b border-neutral-300 p-2">({{ $dataTransfer['bank_short_name'] }}) {{ $dataTransfer['bank_name'] }}</td>
                        </tr>
                        <tr>
                            <td class="border-b border-r border-neutral-300 p-2 font-bold whitespace-nowrap">STK nhận</td>
                            <td class="border-b border-neutral-300 p-2">{{ $dataTransfer['acc_no'] }}</td>
                        </tr>
                        <tr>
                            <td class="border-b border-r border-neutral-300 p-2 font-bold whitespace-nowrap">Tên tài khoản</td>
                            <td class="border-b border-neutral-300 p-2">CONG THANH TOAN</td>
                        </tr>
                        <tr>
                            <td class="border-b border-r border-neutral-300 p-2 font-bold whitespace-nowrap">Chi nhánh</td>
                            <td class="border-b border-neutral-300 p-2">{{ $dataTransfer['bank_branch'] }}</td>
                        </tr>
                        <tr>
                            <td class="border-r border-neutral-300 p-2 font-bold whitespace-nowrap">Số tiền</td>
                            <td class="text-red-600 font-bold p-2">{{ number_format($dataTransfer['collect_min'], 0, ',', '.') }} đ</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
