@extends('admin.index')
@section('content')
    <div class="w-full bg-white">
        <div class="px-5 py-3">
            <!-- Action buttons -->
            <div class="flex justify-between mb-4">
                <!-- Nút Tìm Kiếm -->
                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = true"
                        class="border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm hover:bg-gray-100 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        {{__('messages.filter')}}
                    </button>

                    <!-- Overlay -->
                    <div x-show="isOpen" @click="isOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-40"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

                    <!-- Filter Popup -->
                    <!-- Filter Popup -->
                    <form method="GET" action="{{ route('admin.voucher') }}" x-show="isOpen"
                        class="fixed left-0 top-0 bg-white shadow-lg rounded-md z-50 w-1/4 h-full max-w-xs"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" @click.away="isOpen = false">
                        <div class="flex justify-between items-center p-3 border-b">
                            <h3 class="text-base font-medium">{{ __('messages.search') }}</h3>
                            <button type="button" @click="isOpen = false"
                                class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div class="p-3 space-y-3 text-sm">
                            <!-- Status -->
                            <div class="relative">
                                <select name="status"
                                    class="w-full border border-gray-300 rounded p-1.5 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                    <option value="">Trạng Thái</option>
                                    <option value="Còn" {{ request('status') == 'Còn' ? 'selected' : '' }}>Còn</option>
                                    <option value="Hết" {{ request('status') == 'Hết' ? 'selected' : '' }}>Hết</option>
                                </select>
                            </div>
                            <!-- Mã voucher -->
                            <div class="relative">
                                <input type="text" name="code" placeholder="Mã Voucher" value="{{ request('code') }}"
                                    class="w-full border border-gray-300 rounded p-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                            </div>
                            <!-- Ngày bắt đầu -->
                            <input type="date" name="start" value="{{ request('start') }}"
                                class="w-full border border-gray-300 rounded p-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                            <!-- Ngày kết thúc -->
                            <input type="date" name="end" value="{{ request('end') }}"
                                class="w-full border border-gray-300 rounded p-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">

                            <!-- Search Button -->
                            <button type="submit"
                                class="bg-gray-600 text-white rounded px-4 py-1.5 flex items-center justify-center w-full hover:bg-blue-700 transition duration-150 ease-in-out text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                {{__('messages.filter')}}
                            </button>
                        </div>
                    </form>

                </div>

                <div class="flex space-x-2">
                    <a href="{{ route('admin.voucher.create') }}"><button
                            class="border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Thêm Mới
                        </button>
                    </a>
                    <button type="submit" form="deleteForm"
                     class="border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Xóa
                    </button>
                </div>
            </div>

            <!-- Table -->
            <form id="deleteForm" action="{{ route('admin.voucher.delete') }}" method="POST" class="mb-4">
                @csrf
                @method('DELETE')
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border-collapse">
                        <thead class="bg-gray-500 text-white">
                            <tr>
                                <th class="w-12 py-1 px-2 text-left">
                                    <input id="selectAll" type="checkbox" class="form-checkbox h-4 w-4">
                                </th>
                                <th class="py-1 px-2 text-left text-sm">Mã Voucher</th>
                                <th class="py-1 px-2 text-left text-sm">Giá Trị</th>
                                <th class="py-1 px-2 text-left text-sm">Ngày Bắt Đầu</th>
                                <th class="py-1 px-2 text-left text-sm">Ngày Kết Thúc</th>
                                <th class="py-1 px-2 text-left text-sm">Số Lượng</th>
                                <th class="py-1 px-2 text-left text-sm">Trạng Thái</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vouchers as $voucher)
                                <tr class="bg-gray-50">
                                    <td class="py-3 px-2 border-t border-gray-200">
                                        <input name="ids[]" value="{{ $voucher->id }}" type="checkbox" 
                                            class="rowCheckbox form-checkbox h-4 w-4">
                                    </td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-gray-700"><a
                                            href="{{ route('admin.voucher.edit',['id' => $voucher->id]) }}">{{ $voucher->code }}</a></td>
                                    <td class="py-1 px-2 border-t border-gray-200">
                                        <span class="text-gray-600">{{ $voucher->value }}<sup>đ</sup></span>
                                    </td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $voucher->time_start }}</td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $voucher->time_end }}</td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $voucher->quantity }}</td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $voucher->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <x-notification-popup />
    <script src="{{ asset('js/notification.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.rowCheckbox');

            selectAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>
@endsection