@extends('admin.index')
@section('content')
<style>
        .star-rating {
            color: #fbbf24;
        }
        .filter-panel {
            min-height: 400px;
        }
        .table-container {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateY(-1px);
        }
    </style>
    <body class="bg-gray-50">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Quản lý đánh giá</h1>
            <p class="text-gray-600">Quản lý và theo dõi các đánh giá từ khách hàng</p>
        </div>
        <div class="flex items-center space-x-3 mb-3">
                        <a href="{{ route('admin.rate') }}" 
                           class="group relative inline-flex items-center px-6 py-3 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('admin.order.onsite*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : 'bg-white text-gray-700 border border-gray-200 hover:bg-blue-50 hover:border-blue-200' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H3m2 0v-5a2 2 0 012-2h4a2 2 0 012 2v5"></path>
                            </svg>
                            Đánh Giá Sản Phẩm
                            
                        </a>
                        
                        <a href="{{ route('admin.rateblog') }}" 
                           class="group relative inline-flex items-center px-6 py-3 text-sm font-medium rounded-xl transition-all duration-300 {{ request()->routeIs('admin.order.bringback*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'bg-white text-gray-700 border border-gray-200 hover:bg-orange-50 hover:border-orange-200' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M8 13l-4-2m0 0l4-2m-4 2v8"></path>
                            </svg>
                            Đánh Giá Tin Tức
                        </a>
                    </div>

        <!-- Filters & Actions Bar -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6" x-data="{ 
            filterOpen: false, 
            selectedItems: [],
            selectAll: false,
            toggleSelectAll() {
                this.selectAll = !this.selectAll;
                if (this.selectAll) {
                    this.selectedItems = [1, 2, 3]; // Sample IDs
                } else {
                    this.selectedItems = [];
                }
            }
        }">
            <div class="p-4">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Left side - Filter toggle -->
                    <div class="flex items-center gap-3">
                        <button @click="filterOpen = !filterOpen"
                            class="action-btn bg-blue-50 border border-blue-200 text-blue-700 px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-100 transition-colors">
                            <i class="fas fa-filter text-sm"></i>
                            <span>Bộ lọc</span>
                            <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': filterOpen}"></i>
                        </button>
                        
                        <!-- Quick stats -->
                        <div class="hidden lg:flex items-center gap-4 text-sm text-gray-600">
                            <span class="flex items-center gap-1">
                                <span>Tổng: {{ $countRates }} đánh giá</span><i class="fa-solid fa-comment-dots ml-2 text-blue-400"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Expandable Filter Panel -->
                <div x-show="filterOpen" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                    class="mt-4 pt-4 border-t border-gray-200">
                    
                    <form method="GET" action="{{ route('admin.rateblog') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Blog Title Filter (Select2) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bài viết</label>
                            <select name="blog_id" id="selectBlog"
                                class="select2 w-[300px] h-[150px] border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Tất cả bài viết</option>
                                @foreach($blogs as $blog)
                                    <option value="{{ $blog->id }}" {{ request('blog_id') == $blog->id ? 'selected' : '' }}>
                                        {{ $blog->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    <div class="ml-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trạng Thái</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Tất cả</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Chờ xác nhận</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đã xác nhận</option>
                        </select>
                    </div>

                        <!-- Date Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Từ ngày</label>
                            <input name="from_date" type="date" value="{{ request('from_date') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Đến ngày</label>
                            <input name="to_date" type="date" value="{{ request('to_date') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Filter Actions -->
                        <div class="col-span-full flex items-center gap-3 mt-4">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                                <i class="fas fa-search text-sm"></i>
                                <span>Áp dụng lọc</span>
                            </button>
                            <a href="{{ route('admin.rateblog') }}" class="text-gray-600 hover:text-gray-800 transition-colors px-6 py-2">
                                <i class="fas fa-redo text-sm"></i>
                                <span>Đặt lại</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<script>
    $(document).ready(function() {
        $('#selectBlog').select2({
            placeholder: "Chọn bài viết",
            allowClear: true
        });
    });
</script>
        <!-- Table Container -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 table-container">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Khách hàng</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Nội dung đánh giá</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Bài viết</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Thời gian</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Trạng Thái</th>
                            <th class="p-4 text-left text-sm font-medium text-gray-700">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($listRates as $rate)
                        <tr class="hover:bg-gray-50 transition-colors">
                            
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-medium">
                                        USER
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900">{{ $rate->user->fullname }}</div>
                                        <div class="text-sm text-gray-500">{{ $rate->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="max-w-xs">
                                    <p class="text-gray-900 text-sm leading-relaxed">
                                       {{ $rate->content }}
                                    </p>
                                </div>
                            </td>
                            
                            <td class="p-4">
                                <span class="text-sm text-gray-900">{{ $rate->blog->title }}</span>
                            </td>
                            <td class="p-4">
                                <div class="text-sm text-gray-900">{{ $rate->time }}</div>
                            </td>
                            <td class="p-4">
                                <div class="flex gap-1">
                                  @if($rate->status==1) 
                                  Đã Xác Nhận
                                  @else()
                                  Chờ Xác Nhận
                                  @endif
                                </div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <button class="text-red-600 hover:text-red-800 transition-colors" title="Xóa"
                                     onclick="confirmDelete('{{ $rate->id }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                     @if($rate->status==1) 
                                 
                                  @else()
                                   <button class="text-green-600 hover:text-green-800 transition-colors" title="Xác nhận"
                                    onclick="confirmApprove('{{ $rate->id }}')">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </button>
                                  @endif
                                </div>
                            </td>
                        </tr> 
                        @endforeach                     
                    </tbody>
                </table>
            </div>
            <!-- popup xác nhận -->

            <div id="confirmPopup" class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50 hidden p-4">
                <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-semibold text-white" id="popupTitle">Thông báo</h2>
                            </div>
                            <button onclick="closeConfirmPopup()" class="text-white/80 hover:text-white hover:bg-white/20 rounded-full p-1 transition-colors duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>     
                    <!-- Content -->
                    <div class="px-6 py-8 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p id="confirmMessage" class="text-gray-700 text-base leading-relaxed mb-8"></p>
                        <div class="flex gap-3">
                            <button onclick="closeConfirmPopup()" class="w-1/2 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-all duration-200">
                                Hủy
                            </button>
                            <button id="confirmOkBtn" class="w-1/2 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                Đồng ý
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                // callback được gọi khi bấm Đồng ý
                let onConfirm = null;

                function openConfirmPopup(message, confirmCallback, title = 'Thông báo') {
                    document.getElementById('confirmMessage').textContent = message;
                    document.getElementById('popupTitle').textContent = title;
                    document.getElementById('confirmPopup').classList.remove('hidden');
                    onConfirm = confirmCallback;
                }

                function closeConfirmPopup() {
                    document.getElementById('confirmPopup').classList.add('hidden');
                    onConfirm = null;
                }

                // Khi bấm Đồng ý
                document.getElementById('confirmOkBtn').onclick = function() {
                    if (typeof onConfirm === 'function') onConfirm();
                    closeConfirmPopup();
                }
            </script>

            <script>
                function getCsrfToken() {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }

            function confirmApprove(rateId) {
                openConfirmPopup('Bạn có chắc chắn muốn XÁC NHẬN đánh giá này?', function() {
                    fetch(`/admin/rate/blog/approve/${rateId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': getCsrfToken(),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            alert('Xóa Đánh Giá Thành Công!');
                            location.reload();
                        } else {
                            alert(data.message || 'Có lỗi xảy ra!');
                        }
                    });
                });
            }

            function confirmDelete(rateId) {
                openConfirmPopup('Bạn có chắc chắn muốn XÓA đánh giá này?', function() {
                    fetch(`/admin/rate/blog/delete/${rateId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': getCsrfToken(),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            location.reload();
                        } else {
                            alert(data.message || 'Có lỗi xảy ra!');
                        }
                    });
                });
            }
            </script>
           <!-- Laravel Pagination -->
@if($listRates->hasPages())
    <div class="px-4 py-3 border-t border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Hiển thị
                <span class="font-medium">
                    {{ ($listRates->currentPage()-1)*$listRates->perPage() + 1 }}
                </span>
                đến
                <span class="font-medium">
                    {{ ($listRates->currentPage()-1)*$listRates->perPage() + $listRates->count() }}
                </span>
                trong tổng số
                <span class="font-medium">
                    {{ $listRates->total() }}
                </span> kết quả
            </div>
            <div>
                <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                    {{-- Previous Page Link --}}
                    @if ($listRates->onFirstPage())
                        <span class="px-3 py-1 border border-gray-300 rounded-l text-sm text-gray-400 bg-gray-100 cursor-not-allowed">Trước</span>
                    @else
                        <a href="{{ $listRates->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-l text-sm text-gray-700 hover:bg-blue-50 transition">Trước</a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($listRates->getUrlRange(
                        max(1, $listRates->currentPage()-2),
                        min($listRates->lastPage(), $listRates->currentPage()+2)
                    ) as $page => $url)
                        @if ($page == $listRates->currentPage())
                            <span class="px-3 py-1 bg-blue-600 text-white text-sm font-semibold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 text-sm text-gray-700 hover:bg-blue-50 transition">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($listRates->hasMorePages())
                        <a href="{{ $listRates->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-r text-sm text-gray-700 hover:bg-blue-50 transition">Sau</a>
                    @else
                        <span class="px-3 py-1 border border-gray-300 rounded-r text-sm text-gray-400 bg-gray-100 cursor-not-allowed">Sau</span>
                    @endif
                </nav>
            </div>
        </div>
    </div>
@endif

        </div>
    </div>
</body>
@endsection