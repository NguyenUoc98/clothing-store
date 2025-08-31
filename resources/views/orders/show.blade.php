@extends('layouts.admin.app')

@section('title', "Chi tiết đơn hàng #{$order->id}")

@section('content')
    @php
        $status = false;
    @endphp
    <div class="flex w-full gap-6">
        <div class="w-3/5">
            <p class="mb-3 text-xl">Danh sách sản phẩm</p>
            <div class="card">
                <div class="card !p-0 border border-neutral-300">
                    <table>
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                            @if($order->status == \App\Enum\PaymentStatus::INIT)
                                <th>Trạng thái</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->cart->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-right font-semibold text-red-600">{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="text-right font-semibold text-red-600">{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                                @if($order->status == \App\Enum\PaymentStatus::INIT)
                                    <td class="text-center">
                                        @if($item->quantity > $item->product->stock)
                                            @php
                                                $status = true;
                                            @endphp
                                            <span class="text-red-600">Đã hết hàng</span>
                                        @else
                                            <span class="text-green-600">Sẵn hàng</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @php
            if ($status) {
                $case = [\App\Enum\PaymentStatus::INIT, \App\Enum\PaymentStatus::CANCEL];
            } else {
                $case = \App\Enum\PaymentStatus::cases();
            }
        @endphp

        <div class="grow">
            <p class="mb-3 text-xl">Thông tin</p>
            <form method="POST" class="card !p-0" action="{{ route('orders.update', ['order' => $order->id]) }}">
                <div class="p-6 space-y-3">
                    <p class="flex gap-2">
                        <b class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" class="shrink-0 size-5">
                                <path fill="currentColor" d="M5 7h2v10H5zm9 0h1v10h-1zm-4 0h3v10h-3zM8 7h1v10H8zm8 0h3v10h-3z"/>
                                <path fill="currentColor" d="M4 5h4V3H4c-1.103 0-2 .897-2 2v4h2V5zm0 16h4v-2H4v-4H2v4c0 1.103.897 2 2 2zM20 3h-4v2h4v4h2V5c0-1.103-.897-2-2-2zm0 16h-4v2h4c1.103 0 2-.897 2-2v-4h-2v4z"/>
                            </svg>
                            Mã đơn hàng:
                        </b>
                        <span>{{ "#{$order->id} - ".md5($order->id)  }}</span>
                    </p>
                    <p class="flex gap-2">
                        <b class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" class="shrink-0 size-5">
                                <g fill="none">
                                    <path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/>
                                    <path fill="currentColor" d="M12 13c2.396 0 4.575.694 6.178 1.671c.8.49 1.484 1.065 1.978 1.69c.486.616.844 1.352.844 2.139c0 .845-.411 1.511-1.003 1.986c-.56.45-1.299.748-2.084.956c-1.578.417-3.684.558-5.913.558s-4.335-.14-5.913-.558c-.785-.208-1.524-.506-2.084-.956C3.41 20.01 3 19.345 3 18.5c0-.787.358-1.523.844-2.139c.494-.625 1.177-1.2 1.978-1.69C7.425 13.694 9.605 13 12 13Zm0-11a5 5 0 1 1 0 10a5 5 0 0 1 0-10Z"/>
                                </g>
                            </svg>
                            Người dùng:
                        </b>
                        <span>{{ $order->cart->user ? "[{$order->cart->user_id}] {$order->cart->user->name}" : "[{$order->cart->guest_id}] {$order->customer_name}" }}</span>
                    </p>
                    <b class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                        </svg>
                        Địa chỉ giao hàng
                    </b>
                    <div class="ml-6 w-fit rounded-lg border border-neutral-300 px-4 py-2 shadow">
                        <p class="text-lg font-bold" id="selected-name">{{ $order->customer_name }}</p>
                        <p>{{ $order->customer_email }}</p>
                        <p>{{ $order->customer_phone }}</p>
                        <p>{{ $order->shipping_address }}</p>
                    </div>
                    <p class="flex gap-2">
                        <b class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 26 26" class="shrink-0 size-5">
                                <path fill="currentColor"
                                      d="M18 .188c-4.315 0-7.813 1.929-7.813 4.312S13.686 8.813 18 8.813c4.315 0 7.813-1.93 7.813-4.313S22.314.187 18 .187zm7.813 5.593c-.002 2.383-3.498 4.313-7.813 4.313c-4.303 0-7.793-1.909-7.813-4.281V7.5c0 1.018.652 1.95 1.72 2.688c1.08.294 2.042.702 2.843 1.218c.993.252 2.085.406 3.25.406c4.315 0 7.813-1.929 7.813-4.312V5.781zm0 3c0 2.383-3.498 4.313-7.813 4.313c-.525 0-1.035-.039-1.531-.094a4.35 4.35 0 0 1 .781 1.781c.249.014.495.031.75.031c4.315 0 7.813-1.929 7.813-4.312V8.781zM8 11.187c-4.315 0-7.813 1.93-7.813 4.313S3.686 19.813 8 19.813c4.315 0 7.813-1.93 7.813-4.313S12.314 11.187 8 11.187zm17.813.594c-.002 2.383-3.498 4.313-7.813 4.313c-.251 0-.505-.018-.75-.032c-.011.075-.017.175-.031.25c.05.151.093.3.093.47v1c.227.011.455.03.688.03c4.315 0 7.813-1.929 7.813-4.312v-1.719zm0 3c-.002 2.383-3.498 4.313-7.813 4.313c-.251 0-.505-.018-.75-.032c-.011.075-.017.175-.031.25c.05.15.093.3.093.47v1c.227.011.455.03.688.03c4.315 0 7.813-1.929 7.813-4.312v-1.719zm-10 2c-.002 2.383-3.498 4.313-7.813 4.313c-4.303 0-7.793-1.909-7.813-4.282V18.5c0 2.383 3.497 4.313 7.813 4.313s7.813-1.93 7.813-4.313v-1.719zm0 3c-.002 2.383-3.498 4.313-7.813 4.313c-4.303 0-7.793-1.909-7.813-4.282V21.5c0 2.383 3.497 4.313 7.813 4.313s7.813-1.93 7.813-4.313v-1.719z"/>
                            </svg>
                            Tổng tiền:
                        </b>
                        <span class="font-semibold text-red-600">{{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </p>
                    @csrf
                    @if($order->type == \App\Enum\PaymentType::COD)
                        <div class="flex gap-2">
                            <label class="flex items-center gap-1 font-bold" for="status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" class="shrink-0 size-5">
                                    <path fill="currentColor" d="M13.82 3a.5.5 0 0 0-.847-.36l-1.778 1.71a35.551 35.551 0 0 0-6.63 8.715a.5.5 0 0 0 .435.746h4.31V21a.5.5 0 0 0 .837.37l.795-.725a35.498 35.498 0 0 0 7.001-8.78l.492-.87a.5.5 0 0 0-.435-.747h-4.18V3Z"/>
                                </svg>
                                Trạng thái:
                            </label>
                            <select name="status" id="status" class="cursor-pointer">
                                @foreach($case as $status)
                                    <option value="{{ $status->value }}" @selected($status == $order->status)>{{ $status->description() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="flex items-center gap-1 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 16 16" class="shrink-0 size-5">
                                <path fill="currentColor" fill-rule="evenodd" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16ZM9 5a1 1 0 1 1-2 0a1 1 0 0 1 2 0ZM7 7a.75.75 0 0 0 0 1.5h.25v2h-1a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-1V7H7Z" clip-rule="evenodd"/>
                            </svg>
                            Thông tin thêm:
                        </p>
                        <div class="mt-2 ml-6 space-y-2">
                            <div class="flex items-center gap-2">
                                <label for="shipping-unit" class="w-32">Đơn vị chuyển <span class="text-red-400">*</span></label>
                                <input type="text" @class(['grow', '!border-red-300' => $errors->has('shipping_unit')]) name="shipping_unit" id="shipping-unit" value="{{$order->addition_information['shipping_unit'] ?? ''}}"/>
                            </div>
                            <div class="flex items-center gap-2">
                                <label for="shipping-code" class="w-32">Mã vận đơn <span class="text-red-400">*</span></label>
                                <input type="text" @class(['grow', '!border-red-300' => $errors->has('shipping_code')]) name="shipping_code" id="shipping-code" value="{{$order->addition_information['shipping_code'] ?? ''}}"/>
                            </div>
                        </div>
                    @else
                        <div class="flex gap-2">
                            <label class="flex items-center gap-1 font-bold" for="status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" class="shrink-0 size-5">
                                    <path fill="currentColor" d="M13.82 3a.5.5 0 0 0-.847-.36l-1.778 1.71a35.551 35.551 0 0 0-6.63 8.715a.5.5 0 0 0 .435.746h4.31V21a.5.5 0 0 0 .837.37l.795-.725a35.498 35.498 0 0 0 7.001-8.78l.492-.87a.5.5 0 0 0-.435-.747h-4.18V3Z"/>
                                </svg>
                                Trạng thái:
                            </label>
                            <select name="status" id="status" class="cursor-pointer">
                                @foreach($case as $status)
                                    <option value="{{ $status->value }}" @selected($status == $order->status)>{{ $status->description() }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <label class="flex items-center gap-1 font-bold" for="note">
                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 16 16" class="shrink-0 size-5">
                            <path fill="currentColor" d="M10 5.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0Zm-4-2a.5.5 0 0 0-1 0V5H3.5a.5.5 0 0 0 0 1H5v1.5a.5.5 0 0 0 1 0V6h1.5a.5.5 0 0 0 0-1H6V3.5ZM5.5 11a5.5 5.5 0 0 0 4.9-8h2.1A2.5 2.5 0 0 1 15 5.5V9h-3a3 3 0 0 0-3 3v3H5.5A2.5 2.5 0 0 1 3 12.5v-2.1c.75.384 1.6.6 2.5.6Zm4.5 3.985a1.5 1.5 0 0 0 .846-.424l3.715-3.715a1.5 1.5 0 0 0 .424-.846H12a2 2 0 0 0-2 2v2.985Z"/>
                        </svg>
                        Ghi chú:
                    </label>
                    <textarea id="note" name="note" rows="3" class="w-full" value="{{$order->addition_information['note'] ?? ''}}"></textarea>
                </div>

                <div class="p-6 bg-gray-100 flex justify-end">
                    <button type="submit" class="bg-white border border-neutral-200 text-gray-700 button hover:inset-shadow-md hover:bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" class="shrink-0 size-5">
                            <g fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8 12.5l3 3l5-6"/>
                                <circle cx="12" cy="12" r="10"/>
                            </g>
                        </svg>
                        Lưu lại
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
