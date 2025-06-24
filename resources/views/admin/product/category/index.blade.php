@extends('admin.index')
@section('content')
<!-- Content -->
<div class="w-full bg-white">
    <div class="px-3 py-3">
        <!-- Action buttons -->
        <div class="flex justify-between mb-4">
            <div class="flex space-x-2">
                <a href="{{ route('admin.menu.create') }}">
                <button class="border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Thêm Mới
                </button>
                </a>
                <button onclick="openPopupDelete('Bạn muốn muốn xóa menu này?')" class="border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Xóa
                </button>
                <div id="PopupDelete"
                        class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50 hidden p-4">
                        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
                            <!-- Header -->
                            <div class="bg-gradient-to-r from-yellow-500 to-teal-600 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <h2 class="text-lg font-semibold text-white">Thông báo</h2>
                                    </div>
                                    <button onclick="closePopupDelete()"
                                        class="text-white/80 hover:text-white hover:bg-white/20 rounded-full p-1 transition-colors duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="px-6 py-8 text-center">
                                <div
                                    class="w-16 h-16 bg-gradient-to-br from-yellow-100 to-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>

                                <p id="Message" class="text-gray-700 text-base leading-relaxed mb-8"></p>

                                <div class="flex justify-between space-x-4">
                                    <button type="submit" form="deleteForm"
                                        class="flex-1 px-6 py-3 bg-gradient-to-r from-yellow-600 to-teal-600 text-white font-semibold rounded-lg hover:from-yellow-700 hover:to-teal-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Xác nhận
                                    </button>
                                    <button onclick="closePopupDelete()"
                                        class="flex-1 px-6 py-3 bg-gradient-to-r from-gray-300 to-gray-400 text-gray-800 font-semibold rounded-lg hover:from-gray-400 hover:to-gray-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Đóng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <!-- Table -->
        <form id="deleteForm" action="{{ route('admin.menu.delete') }}" method="POST" class="mb-4">
                @csrf
                @method('DELETE')
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border-collapse">
                <thead class="bg-gray-500 text-white">
                    <tr>
                        <th class="w-12 py-1 px-2 text-left">
                            <input id="selectAll" type="checkbox" class="form-checkbox h-4 w-4">
                        </th>
                        <th class="py-1 px-2 text-left text-sm">Tên Loại</th>
                        <th class="py-1 px-2 text-left text-sm">Ghi Chú</th>
                        <th class="py-1 px-2 text-left text-sm">Thời Gian Tạo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category )
                    <tr class="bg-gray-50">
                        <td class="py-3 px-2 border-t border-gray-200">
                            <input name="ids[]" value="{{ $category->id }}" type="checkbox" class="rowCheckbox form-checkbox h-4 w-4">
                        </td>
                        <td class="py-1 px-2 border-t border-gray-200 text-gray-700"><a
                                href="">{{ $category->name }}</a></td>
                        <td class="py-1 px-2 border-t border-gray-200">
                            <span class="text-gray-600">{{ $category->notes }}</span>
                        </td>
                        <td class="py-1 px-2 border-t border-gray-200">
                            <span class="text-gray-600">{{ $category->created_at }}</span>
                        </td>
                    </tr>
                       @endforeach
                </tbody>
            </table>
        </div>
        </form>
    </div>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.rowCheckbox');

            selectAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        });
    </script>
</div>
@endsection