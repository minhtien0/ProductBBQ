@extends('admin.index')
@section('content')
    <div class="w-full bg-white mt-4">
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
                    <div x-show="isOpen" class="fixed left-0 top-0 bg-white shadow-lg rounded-md z-50 w-1/4 h-full max-w-xs"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95" @click.away="isOpen = false">
                        <div class="flex justify-between items-center p-3 border-b">
                            <h3 class="text-base font-medium">{{ __('messages.search') }}</h3>
                            <button @click="isOpen = false"
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
                            <!-- Department Selection -->
                            <div class="relative">
                                <select
                                    class="w-full border border-gray-300 rounded p-1.5 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                    <option value="">Chọn số sao</option>
                                    <option value="unit1">1 sao</option>
                                    <option value="unit2">2 sao</option>
                                    <option value="unit2">3 sao</option>
                                    <option value="unit2">4 sao</option>
                                    <option value="unit2">5 sao</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Area Selection -->
                            <div class="relative">
                                <select
                                    class="w-full border border-gray-300 rounded p-1.5 pr-8 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                                    <option value="">--Sản Phẩm--</option>
                                    <option value="area1">Sản Phẩm 1</option>
                                    <option value="area2">Sản Phẩm 2</option>
                                    <option value="area3">Sản Phẩm 3</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <svg class="w-3 h-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- Start Date -->
                            <input type="text" placeholder="Ngày bắt đầu"
                                class="w-full border border-gray-300 rounded p-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">

                            <!-- End Date -->
                            <input type="text" placeholder="Ngày kết thúc"
                                class="w-full border border-gray-300 rounded p-1.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                                onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}">

                            <!-- Search Button -->
                            <button
                                class="bg-blue-600 text-white rounded px-4 py-1.5 flex items-center justify-center w-full hover:bg-blue-700 transition duration-150 ease-in-out text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                {{__('messages.filter')}}
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-2">
                    <button class="border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm">
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
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border-collapse">
                    <thead class="bg-gray-500 text-white">
                        <tr>
                            <th class="w-12 py-1 px-2 text-left">
                                <input type="checkbox" class="form-checkbox h-4 w-4">
                            </th>
                            <th class="py-1 px-2 text-left text-sm">Mục Đích</th>
                            <th class="py-1 px-2 text-left text-sm">Câu Hỏi</th>
                            <th class="py-1 px-2 text-left text-sm">Người Hỏi</th>
                            <th class="py-1 px-2 text-left text-sm">SDT</th>
                            <th class="py-1 px-2 text-left text-sm">Email</th>
                            <th class="py-1 px-2 text-left text-sm">Thời Gian</th>
                            <th class="py-1 px-2 text-left text-sm">Thực Hiện</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($helps as $help)
                            <tr class="bg-gray-50">
                                <td class="py-3 px-2 border-t border-gray-200">
                                    <input type="checkbox" class="form-checkbox h-4 w-4">
                                </td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700"><a
                                        href="{{ route('user.detail') }}">{{ $help->purpose }}</a></td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $help->question }}</td>
                                <td class="py-1 px-2 border-t border-gray-200">
                                    <span class="text-gray-600">Nguyễn Minh Tiến</span>
                                </td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $help->sdt }}</td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $help->email }}</td>
                                <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $help->time }}</td>
                                <td class="py-1 px-2 border-t border-gray-200 text-center">
                                    <a href="{{ route('help.replyForm', $help->id) }}"
                                        class="inline-flex items-center px-2 py-2 bg-green-500 text-white text-sm rounded-md hover:bg-green-600 transition">
                                        <i class="fa-solid fa-paper-plane mr-2"></i>
                                        Send
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection