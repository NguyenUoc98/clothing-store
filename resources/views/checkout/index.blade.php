@extends('layouts.frontend.app')

@section('title', 'Thanh toán')

@section('content')
    <div class="mx-auto py-10 md:container md:px-36">
        <div class="rounded-lg border border-gray-200 p-4 shadow-md lg:p-10">
            <h1 class="mb-4 text-center text-4xl font-bold">Thanh toán</h1>

            <!-- Giỏ hàng -->
            <div class="font-[Arial]">
                <h3 class="mb-2 text-lg font-bold">Thông tin giỏ hàng</h3>
                <table class="mb-10 table w-full">
                    <thead>
                    <tr class="bg-black text-white">
                        <th class="border border-gray-200 p-2">Sản phẩm</th>
                        <th class="border border-gray-200 p-2">Số lượng</th>
                        <th class="border border-gray-200 p-2">Giá</th>
                        <th class="border border-gray-200 p-2">Tổng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td class="border border-gray-200 p-2">{{ $item->product->name }}</td>
                            <td class="border border-gray-200 p-2 text-center">{{ $item->quantity }}</td>
                            <td class="border border-gray-200 p-2 text-right font-bold">{{ number_format($item->product->price, 0, ',', '.') }} VND</td>
                            <td class="border border-gray-200 p-2 text-right font-bold">{{ number_format($item->quantity * $item->product->price, 0, ',', '.') }} VND</td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-100">
                        <td colspan="3" class="border border-gray-200 p-2 text-center font-bold">Tổng giỏ hàng</td>
                        <td class="border border-gray-200 p-2 text-right font-bold text-red-400">{{ number_format($cartTotal, 0, ',', '.') }} VND</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- Địa chỉ giao hàng -->

            <div class="font-[Arial] space-y-4">
                <h3 class="text-lg font-bold">Thông tin thanh toán</h3>
                <div class="grid grid-cols-2 gap-10">
                    <!-- Hiển thị địa chỉ -->
                    <div class="form-group">
                        <label class="flex items-end gap-1 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                            </svg>
                            Địa chỉ giao hàng
                        </label>

                        @if ($defaultAddress)
                            <div id="default-address">
                                <div class="my-2 ml-6 rounded-lg border border-neutral-300 px-4 py-2 shadow">
                                    <p class="text-lg font-bold" id="selected-name">{{ $defaultAddress['name'] }}</p>
                                    <p>{{ $defaultAddress['phone'] }}</p>
                                    <p>{{ $defaultAddress['address'] }}</p>
                                </div>
                                <button type="button" onclick="toggleFormAddress()" class="float-right cursor-pointer rounded-md bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700">
                                    Thay đổi
                                </button>
                            </div>
                        @else
                            <small class="ml-6 italic text-red-400">Bạn chưa có địa chỉ giao hàng. Vui lòng thêm địa chỉ mới.</small>
                        @endif

                        <!-- Thêm địa chỉ mới -->
                        <form action="{{ route('checkout.add-address') }}" method="POST" id="new-address-form"
                                @class([
                                  'hidden' => $defaultAddress,
                                  'border border-neutral-300 ml-6 mt-4 p-4 rounded-lg',
                                ]) >
                            @csrf
                            <p class="flex items-end gap-1 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 24 24" class="size-6">
                                    <path fill="currentColor" d="M12 12q.825 0 1.413-.588T14 10q0-.825-.588-1.413T12 8q-.825 0-1.413.588T10 10q0 .825.588 1.413T12 12Zm0 10q-4.025-3.425-6.012-6.362T4 10.2q0-3.75 2.413-5.975T12 2q.5 0 1 .063t1 .187V6h3v3h2.925q.05.275.063.588T20 10.2q0 2.5-1.988 5.438T12 22Zm6-14V5h-3V3h3V0h2v3h3v2h-3v3h-2Z"/>
                                </svg>
                                <b>Nhập địa chỉ mới</b>
                            </p>
                            <div class="mt-1 ml-10 grid w-2/3 grid-cols-3 gap-2">
                                <label for="name" class="font-bold leading-10">
                                    Tên người nhận <span class="text-red-400">*</span>
                                </label>
                                <input class="col-span-2 rounded-md border border-gray-200 px-4 py-2 focus:outline-none"
                                       type="text" name="name" placeholder="Nhập tên người nhận"
                                       value="{{ $user->name }}"
                                >

                                <label for="phone" class="font-bold leading-10">
                                    Số điện thoại <span class="text-red-400">*</span>
                                </label>
                                <input class="col-span-2 rounded-md border border-gray-200 px-4 py-2 focus:outline-none"
                                       type="text" name="phone" placeholder="Nhập số điện thoại"
                                       value="{{ $user->phone }}"
                                >

                                <label for="address" class="font-bold leading-10">
                                    Địa chỉ chi tiết <span class="text-red-400">*</span>
                                </label>
                                <input class="col-span-2 rounded-md border border-gray-200 px-4 py-2 focus:outline-none"
                                       type="text" name="address" placeholder="Nhập địa chỉ chi tiết"
                                       value="{{ $user->address }}"
                                >
                                <div class="col-span-2 col-start-2">
                                    <button type="submit" id="save-new-address" class="cursor-pointer rounded-md bg-black px-4 py-2 font-bold text-white hover:bg-gray-700">
                                        Lưu địa chỉ
                                    </button>
                                    <button type="button" onclick="toggleFormAddress()" class="cursor-pointer rounded-md bg-red-600 px-4 py-2 font-bold text-white hover:bg-red-500">
                                        Hủy
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <p class="flex items-end gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 16 16" class="size-6">
                                    <path fill="currentColor" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2.5 1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h2a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-2zm0 3a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm3 0a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                                </svg>
                                <b>Phương thức thanh toán</b>
                            </p>

                            <select id="payment_method" name="payment_method" required class="ml-6 my-2 rounded-lg border border-neutral-300 px-4 py-2" style="width: calc(100% - 1.5rem);">
                                <option value="{{ \App\Enum\PaymentType::CASH }}" {{ old('payment_method', '1') == \App\Enum\PaymentType::CASH ? 'selected' : '' }}>Thanh toán khi nhận hàng (COD)</option>
                                <option value="{{ \App\Enum\PaymentType::ONLINE }}" {{ old('payment_method', '1') == \App\Enum\PaymentType::ONLINE ? 'selected' : '' }}>Thanh toán online</option>
                            </select>
                        </div>
                        <button type="submit" class="float-right cursor-pointer rounded-md bg-black px-4 py-2 font-bold text-white hover:bg-gray-700" id="paymentButton">
                            Thanh toán
                        </button>

                        <div id="thankYouMessage" style="display: none;">
                            <h2>Cảm ơn bạn đã mua hàng!</h2>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function toggleFormAddress() {
            $('#new-address-form').toggleClass('hidden');
            $('#default-address').toggleClass('hidden');
        }
    </script>
@endpush

{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        // Hiển thị form thêm địa chỉ khi bấm vào nút "Thay đổi"--}}
{{--        $('#change-address').click(function () {--}}
{{--            $('#new-address-form').show();--}}
{{--        });--}}

{{--        // Lưu địa chỉ mới--}}
{{--        $('#save-new-address').click(function () {--}}
{{--            alert('Địa chỉ mới đã được lưu!');--}}
{{--            $('#new-address-form').hide();--}}
{{--        });--}}

{{--        // Sự kiện click vào nút thanh toán--}}
{{--        $('#paymentButton').click(function (e) {--}}
{{--            e.preventDefault(); // Ngăn chặn form gửi ngay lập tức--}}

{{--            const paymentMethod = $('#payment_method').val();--}}

{{--            // Kiểm tra phương thức thanh toán--}}
{{--            if (paymentMethod === 'cod') {--}}
{{--                // Hiển thị thông báo cảm ơn--}}
{{--                $('#thankYouMessage').show();--}}

{{--                // Ẩn nút thanh toán--}}
{{--                $('#paymentButton').hide();--}}

{{--                // Sau 3 giây, chuyển hướng về trang chủ--}}
{{--                setTimeout(function () {--}}
{{--                    window.location.href = '/'; // Địa chỉ trang chủ của bạn--}}
{{--                }, 3000); // Chờ 3 giây--}}
{{--            } else {--}}
{{--                alert('Vui lòng chọn phương thức thanh toán');--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
