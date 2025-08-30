@extends('layouts.admin.app')

@section('title', 'Thêm sản phẩm mới')

@section('content')
    <div class="shadow-sm card md:max-w-1/2">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-4 gap-3">
                <label for="name" class="leading-9">Tên sản phẩm<span class="text-red-600">*</span></label>
                <input type="text" class="col-span-3" name="name" required>
                <label for="product_code" class="leading-9">Mã sản phẩm<span class="text-red-600">*</span></label>
                <input type="text" class="col-span-3" id="product_code" name="product_code" required>
                <label for="size" class="leading-9">Danh mục<span class="text-red-600">*</span></label>
                <select class="col-span-3" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <label for="size" class="leading-9">Size</label>
                <div class="col-span-3" x-data="selectSize">
                    <div class="relative">
                        <div class="mt-1 relative">
                            <button type="button" @click="open = !open"
                                    class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-1 pr-10 py-1 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <input type="text" class="block truncate w-full border-none cursor-pointer" readonly id="size" name="size" :value="selectedOptions.length ? selectedOptions.join(', ') : 'Chọn size'">
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                 class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                                 style="display: none;">
                                <template x-for="option in options" :key="option">
                                    <div @click="toggleOption(option)"
                                         class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-indigo-600 hover:text-white">
                                        <span x-text="option" :class="{ 'font-semibold': selectedOptions.includes(option) }"
                                              class="block truncate"></span>
                                        <span x-show="selectedOptions.includes(option)"
                                              class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 hover:text-white">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <label for="color" class="leading-9">Màu</label>
                <div class="col-span-3" x-data="selectColor">
                    <div class="relative">
                        <div class="mt-1 relative">
                            <button type="button" @click="open = !open"
                                    class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-1 pr-10 py-1 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <input type="text" class="block truncate w-full border-none cursor-pointer" readonly id="color" name="color" :value="selectedOptions.length ? selectedOptions.join(', ') : 'Chọn màu'">
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </span>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                 class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                                 style="display: none;">
                                <template x-for="option in options" :key="option">
                                    <div @click="toggleOption(option)"
                                         class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-indigo-600 hover:text-white">
                                        <span x-text="option" :class="{ 'font-semibold': selectedOptions.includes(option) }"
                                              class="block truncate"></span>
                                        <span x-show="selectedOptions.includes(option)"
                                              class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 hover:text-white">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                <label for="price" class="leading-9">Giá<span class="text-red-600">*</span></label>
                <input type="number" class="col-span-3" name="price" step="0.01" required>
                <label for="description" class="leading-9">Mô tả<span class="text-red-600">*</span></label>
                <textarea class="col-span-3" name="description" required rows="5"></textarea>
                <label for="image" class="leading-9">Hình ảnh</label>
                <input type="file" class="col-span-3" name="image">
                <label for="stock" class="leading-9">Số lượng trong kho<span class="text-red-600">*</span></label>
                <input type="number" class="col-span-3" name="stock" required>
                <div class="col-span-4 flex justify-end gap-2">
                    <a href="{{ route('products.index') }}" class="button !px-8 border border-neutral-300 hover:bg-gray-100">Hủy</a>
                    <button type="submit" class="button !px-8 bg-blue-500 hover:bg-blue-700 text-white">Thêm sản phẩm</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('selectSize', () => ({
                open: false,
                options: @json(\App\Enum\Size::cases()),
                selectedOptions: [],
                toggleOption(option) {
                    if (this.selectedOptions.includes(option)) {
                        this.selectedOptions = this.selectedOptions.filter(item => item !== option);
                    } else {
                        this.selectedOptions.push(option);
                    }
                }
            }));
            Alpine.data('selectColor', () => ({
                open: false,
                options: @json(\App\Enum\Color::cases()),
                selectedOptions: [],
                toggleOption(option) {
                    if (this.selectedOptions.includes(option)) {
                        this.selectedOptions = this.selectedOptions.filter(item => item !== option);
                    } else {
                        this.selectedOptions.push(option);
                    }
                }
            }))
        })
    </script>
@endsection