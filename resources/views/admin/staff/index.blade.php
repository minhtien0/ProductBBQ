@extends('admin.index')
@section('content')
    <!-- Content -->
    <div class="w-full bg-white" @if(session('success')) data-success="{{ session('success') }}" @elseif(session('error'))
    data-error="{{ session('error') }}" @endif>
        <div class="px-5 py-3">
            <!-- Action buttons -->
            <div class="flex justify-between mb-4">
                <!-- Nút Tìm Kiếm -->
                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = true"
                        class=" hover:bg-red-400 hover:text-white border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm hover:bg-gray-100 transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Bộ lọc
                    </button>

                    <!-- Overlay -->
                    <div x-show="isOpen" @click="isOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-40"
                        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

                    <!-- Filter Popup -->
                    <div x-show="isOpen" @click.away="isOpen = false"
                        class="fixed left-0 top-0 bg-white shadow-lg rounded-md z-50 w-1/4 h-full max-w-xs"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">

                        <!-- Đặt tất cả các field và button vào trong 1 form duy nhất -->
                        <form method="GET" action="{{ route('admin.staff') }}" class="p-3 space-y-3 text-sm">
                            <!-- Loại nhân viên -->
                            <div class="relative">
                                <select name="staff_type"
                                    class="w-full border rounded p-1.5 pr-8 focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Loại Nhân Viên --</option>
                                    <option value="Full Time" @if(request('staff_type') == 'Full Time') selected @endif>
                                        Full Time
                                    </option>
                                    <option value="Part Time" @if(request('staff_type') == 'Part Time') selected @endif>
                                        Part Time
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <!-- arrow icon -->
                                </div>
                            </div>

                            <!-- Trạng thái -->
                            <div class="relative">
                                <select name="status"
                                    class="w-full border rounded p-1.5 pr-8 focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Trạng Thái --</option>
                                    <option value="Đang Làm" @if(request('status') == 'Đang Làm') selected @endif>
                                        Đang Làm
                                    </option>
                                    <option value="Thử Việc" @if(request('status') == 'Thử Việc') selected @endif>
                                        Thử Việc
                                    </option>
                                    <option value="Tạm Vắng" @if(request('status') == 'Tạm Vắng') selected @endif>
                                        Tạm Vắng
                                    </option>
                                    <option value="Ngưng Làm" @if(request('status') == 'Ngưng Làm') selected @endif>
                                        Ngưng Làm
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <!-- arrow icon -->
                                </div>
                            </div>

                            <!-- Chức vụ -->
                            <div class="relative">
                                <select name="position"
                                    class="w-full border rounded p-1.5 pr-8 focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Chức Vụ --</option>
                                    @foreach($positions as $pos)
                                        <option value="{{ $pos }}" @if(request('position') == $pos) selected @endif>
                                            {{ $pos }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                    <!-- arrow icon -->
                                </div>
                            </div>

                            <!-- Mã hoặc tên nhân viên -->
                            <input type="text" name="q" placeholder="Nhập mã hoặc tên nhân viên" value="{{ request('q') }}"
                                class="w-full border rounded p-1.5 focus:ring-2 focus:ring-blue-500">

                            <!-- Nút Tìm kiếm -->
                            <button type="submit"
                                class="w-full bg-gray-600 text-white rounded px-4 py-1.5 flex items-center justify-center hover:bg-red-400 transition duration-150 ease-in-out text-sm">
                                <i class="fa-solid fa-magnifying-glass mr-2"></i>
                                Tìm kiếm
                            </button>
                        </form>
                    </div>

                </div>

                <div class="flex space-x-2">
                    <!-- Nút kích hoạt modal -->
                    <button type="button"
                        class=" hover:bg-red-400 hover:text-white border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm"
                        data-modal-target="importModal" data-modal-toggle="importModal">
                        <i class="fa-solid fa-upload mr-2"></i> Nhập File
                    </button>

                    <!-- Modal -->
                    <div id="importModal" tabindex="-1" aria-hidden="true"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                                <!-- Modal header -->
                                <div
                                    class="flex items-start justify-between p-4 border-b rounded-t border-gray-200 dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-black dark:text-white">
                                        Nhập File Excel
                                    </h3>
                                    <button type="button"
                                        class="text-gray-500 bg-transparent hover:bg-blue-100 hover:text-blue-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-blue-600 dark:hover:text-white"
                                        data-modal-hide="importModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action="{{ route('admin.staff.importExcel') }}" method="POST"
                                    enctype="multipart/form-data" class="p-6">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="file"
                                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-dark-200">Chọn
                                            file Excel</label>
                                        <input type="file" name="file" id="file" accept=".xls,.xlsx" required
                                            class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-white focus:outline-none dark:bg-gray-700 dark:border-gray-500 dark:placeholder-gray-200">
                                    </div>
                                    <button type="submit"
                                        class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700">
                                        <i class="fa-solid fa-upload mr-2"></i> Nhập File
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <a href="{{ route('admin.staff.exportTemplateExcel') }}">
                        <button
                            class="border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm  hover:bg-red-400 hover:text-white transition-colors">
                            <i class="fa-solid fa-file-export mr-2"></i>
                            Xuất File Mẫu
                        </button>
                    </a>
                    <a href="{{ route('admin.staff.exportExcel', request()->query()) }}">
                        <button
                            class=" hover:bg-red-400 hover:text-white border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm">
                            <i class="fa-solid fa-download mr-2"></i>
                            Xuất File
                        </button>
                    </a>
                    <a href="{{ route('admin.staff.create') }}">
                        <button
                            class=" hover:bg-red-400 hover:text-white border border-gray-600 text-gray-600 px-2 py-1 rounded flex items-center text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Thêm Mới
                        </button>
                    </a>
                </div>
            </div>

            <!-- Table -->
            <form id="deleteForm" action="{{ route('admin.staff.delete') }}" method="POST" class="mb-4">
                @csrf
                @method('DELETE')
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border-collapse">
                        <thead class="bg-gray-500 text-white">
                            <tr>
                                <th class="w-12 py-1 px-2 text-left">
                                    <input id="selectAll" type="checkbox" class="form-checkbox h-4 w-4">
                                </th>
                                <th class="py-1 px-2 text-left text-sm">Mã Nhân Viên</th>
                                <th class="py-1 px-2 text-left text-sm">Tên Nhân Viên</th>
                                <th class="py-1 px-2 text-left text-sm">Email</th>
                                <th class="py-1 px-2 text-left text-sm">Loại</th>
                                <th class="py-1 px-2 text-left text-sm">Trạng Thái</th>
                                <th class="py-1 px-2 text-left text-sm">Ngày Vào Làm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr class="bg-gray-50">

                                    <td class="py-3 px-2 border-t border-gray-200">
                                        <input name="ids[]" value="{{ $list->id }}" type="checkbox"
                                            class="rowCheckbox form-checkbox h-4 w-4">
                                    </td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-red-700"><a
                                            href="{{ route('admin.staff.detail', ['id' => $list->id]) }}">{{ $list->code_nv }}</a>
                                    </td>
                                    <td class="py-1 px-2 border-t border-gray-200">
                                        <span class="text-gray-600">{{ $list->fullname }}</span>
                                    </td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $list->email }}</td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-gray-700">
                                        {{ $list->type }}
                                    </td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $list->status }}</td>
                                    <td class="py-1 px-2 border-t border-gray-200 text-gray-700">{{ $list->time_work }}</td>
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