<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản lý bàn BBQ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .menu-item-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .table-active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scale(1.05);
        }

        .category-active {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .sidebar-collapsed {
            width: 60px;
        }

        .sidebar-expanded {
            width: 280px;
        }
    </style>
</head>
@include('layouts.admin.header')

<body class="bg-gradient-to-br from-slate-900 via-gray-500 to-slate-900 min-h-screen">
    <!-- Header -->
    <header class="bg-slate-800/50 backdrop-blur-lg border-b border-slate-700/50 px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button id="sidebar-toggle" class="lg:hidden text-white hover:text-blue-400 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-utensils text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-lg">TopCode Restaurant</h1>
                        <p class="text-slate-300 text-sm">Hệ thống quản lý bán hàng</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-white text-sm font-medium">Nhân viên: {{ session('staff_name') }}</p>
                    <p class="text-slate-300 text-xs" id="current-time"></p>
                </div>
                <div class="w-10 h-10 bg-slate-700 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white"></i>
                </div>
            </div>
        </div>
    </header>

    <div class="flex h-screen">
        <!-- Sidebar - Danh sách bàn -->
        <div id="sidebar"
            class="sidebar-expanded bg-slate-800/30 backdrop-blur-lg border-r border-slate-700/50 transition-all duration-300 flex flex-col">
            <div class="p-4 border-b border-slate-700/50">
                <h2 class="text-white font-semibold text-sm flex items-center gap-2">
                    <i class="fas fa-chair"></i>
                    <span id="sidebar-title">Danh sách bàn</span>
                </h2>
            </div>
            <div id="table-list" class="flex-1 overflow-y-auto p-3 space-y-2">
                @foreach($tables as $table)
                    <div class="table-item cursor-pointer rounded-lg p-3 transition-all bg-slate-700/30 hover:bg-slate-600/50"
                        data-id="{{ $table->id }}">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-white font-medium">{{ $table->number }}</h3>
                            <div class="w-3 h-3 
                                        {{ $table->status == 'Đã Mở' ? 'bg-yellow-500' : ($table->status == 'Cần thanh toán' ? 'bg-red-500' : 'bg-green-500') }} 
                                                                                            rounded-full"></div>
                        </div>
                        <div class="flex items-center gap-2 text-slate-300 text-sm">
                            <i class="fas fa-users"></i>
                            <span>{{ $table->quantity ?? '-' }} chỗ</span>
                        </div>
                        <div class="text-xs text-slate-400 mt-1">
                            {{ $table->status }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="p-4 border-t border-slate-700/50">
                <div class="text-xs text-slate-400 space-y-1">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div><span>Trống</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div><span>Đang phục vụ</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div><span>Cần thanh toán</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Menu Section -->
            <div class="flex-1 p-4 overflow-hidden">
                <div
                    class="bg-slate-800/30 backdrop-blur-lg rounded-xl border border-slate-700/50 h-full flex flex-col">
                    <!-- Search và Category -->
                    <div class="p-4 border-b border-slate-700/50">
                        <div class="flex flex-col lg:flex-row gap-4">
                            <div class="flex-1 relative">
                                <input type="text" id="search-menu" placeholder="Tìm kiếm món ăn..."
                                    class="w-full bg-slate-700/50 text-white placeholder-slate-400 rounded-lg px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                            </div>
                            <div class="flex gap-2 overflow-x-auto" id="category-list">
                                <button
                                    class="category-btn px-4 py-2 rounded-lg text-white text-sm font-medium whitespace-nowrap transition-all"
                                    data-combo="1">Combo</button>
                                {{-- Các menu sẽ render JS động --}}
                            </div>
                        </div>
                    </div>
                    <!-- Menu Grid + Combo Section -->
                    <div class="flex-1 overflow-y-auto p-4">
                        <div id="menu-section">
                            <div id="menu-grid"
                                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"></div>
                            <div id="combo-section"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Panel -->
        <div class="w-full lg:w-96 bg-slate-800/30 backdrop-blur-lg border-l border-slate-700/50 flex flex-col">
            <!-- Order Header -->
            <div class="p-4 border-b border-slate-700/50">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-receipt text-white text-sm"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold">Hóa đơn</h3>
                            <p class="text-slate-300 text-sm">Bàn: <span id="current-table-name"
                                    class="font-bold text-blue-400"></span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-slate-300 text-xs">Mã HĐ: #<span id="bill-id"></span></p>
                        <p class="text-slate-300 text-xs" id="bill-time"></p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="flex-1 overflow-y-auto ">
                <div id="order-items" class="divide-y divide-slate-700/50 ">

                </div>
                <div id="empty-order" class="flex flex-col items-center justify-center h-full text-slate-400">
                    <i class="fas fa-shopping-cart text-4xl mb-3 opacity-50"></i>
                    <p class="text-center">Chưa có món nào được chọn</p>
                    <p class="text-center text-sm mt-1">Hãy chọn món từ menu bên trái</p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="border-t border-slate-700/50 p-4">
                <!-- Tổng tiền -->
                <div class="bg-slate-700/30 rounded-lg p-3 mb-4">
                    <div class="flex justify-between items-center text-white">
                        <span class="font-medium">Tổng tiền:</span>
                        <span id="total-amount" class="text-xl font-bold text-green-400">0 VNĐ</span>
                    </div>
                </div>

                <!-- ĐỔI BÀN + ĐÓNG BÀN nằm song song -->
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <button id="btn-change-table"
                        class="w-full bg-gradient-to-r from-blue-500 to-blue-500 hover:from-purple-600 hover:to-purple-600 text-white py-3 rounded-lg font-bold text-sm transition-all transform hover:scale-105">
                        <i class="fas fa-exchange-alt mr-2"></i>ĐỔI BÀN
                    </button>


                    <button id="btn-close-table"
                        class="w-full bg-red-500 to-blue-500 hover:from-purple-600 hover:to-purple-600 text-white py-3 rounded-lg font-bold text-sm transition-all transform hover:scale-105">
                        <i class="fa-solid fa-door-closed mr-2"></i>ĐÓNG BÀN
                    </button>
                </div>

                <!-- Nút THANH TOÁN (nằm dưới, chiếm full chiều ngang) -->
                <button onclick="openReviewPopup()"
                    class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-3 rounded-lg font-bold text-sm transition-all transform hover:scale-105">
                    <i class="fas fa-credit-card mr-2"></i>THANH TOÁN
                </button>
            </div>
        </div>
    </div>
    <!-- Popup Đổi Bàn -->
    <div id="change-table-popup"
        class="fixed inset-0 bg-black/60 backdrop-blur z-50 hidden items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl max-w-xs w-full p-6 relative">
            <button onclick="closeChangeTablePopup()"
                class="absolute top-2 right-4 text-2xl text-slate-500 hover:text-red-500">&times;</button>
            <h2 class="text-lg font-bold text-center mb-4 text-slate-800">Chọn bàn để chuyển</h2>
            <div class="mb-4">
                <select id="select-new-table" class="w-full px-3 py-2 border rounded-lg">
                    <option value="">-- Chọn bàn --</option>
                    <!-- Render động -->
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button onclick="closeChangeTablePopup()"
                    class="px-4 py-2 rounded bg-slate-300 hover:bg-slate-400 text-slate-800 font-medium">Hủy</button>
                <button onclick="confirmChangeTable()"
                    class="px-4 py-2 rounded bg-gradient-to-r from-blue-500 to-purple-500 text-white font-bold">Xác
                    nhận</button>
            </div>
        </div>
    </div>

    <!-- Popup Xác nhận thanh toán hóa đơn -->
    <div id="review-popup" class="fixed inset-0 bg-black/60 backdrop-blur z-50 hidden items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl max-w-lg w-full p-6 relative">
            <button onclick="closeReviewPopup()"
                class="absolute top-2 right-4 text-2xl text-slate-500 hover:text-red-500">&times;</button>
            <h2 class="text-lg font-bold text-center mb-4 text-slate-800">Xác nhận thanh toán hóa đơn</h2>
            <div id="review-bill-info" class="mb-4"></div>
            <div>
                <table class="w-full text-left text-xs border-collapse mb-4">
                    <thead>
                        <tr class="text-slate-600 border-b">
                            <th class="py-1">Món</th>
                            <th class="py-1 text-center">SL</th>
                            <th class="py-1 text-right">Đơn giá</th>
                            <th class="py-1 text-right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody id="review-bill-items"></tbody>
                </table>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-base text-slate-700 font-semibold">Tổng cộng:</span>
                    <span id="review-total" class="text-xl text-green-600 font-bold"></span>
                </div>
            </div>
            <div class="mb-3 flex gap-6 justify-center items-center">
                <label><input type="radio" name="payment-type" value="1" checked> Tiền mặt</label>
                <label><input type="radio" name="payment-type" value="2"> VNPAY (QR)</label>
            </div>
            <div id="vnpay-qr-section" class="my-3 text-center hidden">
                <h3 class="font-semibold mb-2 text-slate-800">Quét mã QR để thanh toán VNPAY</h3>
                <canvas class="mx-auto" id="vnpay-qr"></canvas>
                <div class="mt-2">
                    <a id="vnpay-link" href="#" class="text-blue-600 underline" target="_blank">Mở trang thanh toán</a>
                </div>
                <div class="mt-1 text-xs text-gray-500">Hãy dùng app ngân hàng quét mã QR để thanh toán. Khi quét, hệ
                    thống mới tạo đơn và chuyển sang trang VNPAY.</div>
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button onclick="closeReviewPopup()"
                    class="px-4 py-2 rounded bg-slate-300 hover:bg-slate-400 text-slate-800 font-medium">Hủy</button>
                <button id="btn-confirm-pay" onclick="submitPayment()"
                    class="px-4 py-2 rounded bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold">Xác
                    nhận thanh toán</button>
            </div>
        </div>
    </div>

    <script>
        function openReviewPopup() {
            // Lấy thông tin hóa đơn
            const tableName = document.getElementById('current-table-name').textContent || "";
            const staffName = document.querySelector('.text-white.text-sm.font-medium').textContent.replace('Nhân viên: ', '');
            const billId = document.getElementById('bill-id').textContent || '';
            const billTime = document.getElementById('bill-time').textContent || '';
            const total = document.getElementById('total-amount').textContent || '0₫';
            let items = orderItemsData || [];
            const completed = items.filter(it => it.status === "Hoàn Thành");

  // 2. Gom lại theo tên (hoặc product_id nếu có) và cộng dồn quantity
  const grouped = completed.reduce((acc, it) => {
    const key = it.product_name; // hoặc it.product_id
    if (!acc[key]) {
      acc[key] = { ...it };
    } else {
      acc[key].quantity += it.quantity;
    }
    return acc;
  }, {});
  const aggItems = Object.values(grouped);

  // 3. Render bảng từ aggItems
  document.getElementById('review-bill-items').innerHTML = aggItems.map(item => {
    const lineTotal = item.price * item.quantity;
    return `
      <tr>
        <td class="py-1">${item.product_name}</td>
        <td class="py-1 text-center">${item.quantity}</td>
        <td class="py-1 text-right">${Number(item.price).toLocaleString('vi-VN')} VNĐ</td>
        <td class="py-1 text-right">${Number(lineTotal).toLocaleString('vi-VN')} VNĐ</td>
      </tr>
    `;
  }).join('');

  // 4. Tính lại tổng
  const totalHoanThanh = aggItems.reduce((s, it) => s + it.price * it.quantity, 0);
  document.getElementById('review-total').textContent = Number(totalHoanThanh).toLocaleString('vi-VN') + ' VNĐ';


            // Reset
            document.getElementById('vnpay-qr-section').classList.add('hidden');
            document.querySelector('input[name="payment-type"][value="1"]').checked = true;

            // Show popup
            document.getElementById('review-popup').classList.remove('hidden');
            document.getElementById('review-popup').classList.add('flex');

            // Xóa event radio cũ
            document.querySelectorAll('input[name="payment-type"]').forEach(el => el.onchange = null);

            // Gắn lại sự kiện radio
            document.querySelectorAll('input[name="payment-type"]').forEach(el => {
                el.onchange = function () {
                    if (this.value === "2") {
                        // Khi chọn QR, tạo đơn QR, show mã QR mới
                        handleShowQrPayment(items, total, tableName, staffName, billId, billTime);
                    } else {
                        document.getElementById('vnpay-qr-section').classList.add('hidden');
                    }
                }
            });
        }

        document.getElementById('btn-change-table').onclick = openChangeTablePopup;
        document.getElementById('btn-close-table').onclick = handleCloseTable;
        //Đổi bàn
        function openChangeTablePopup() {
            fetch('/admin/deskmanage/get-closed-tables')
                .then(res => res.json())
                .then(data => {
                    const select = document.getElementById('select-new-table');
                    select.innerHTML = '<option value="">-- Chọn bàn --</option>';
                    // Lọc bàn Đã Đóng, không hiện bàn hiện tại
                    (data.tables || []).forEach(table => {
                        if (table.status === "Đã Đóng" && table.id != currentTableId) {
                            select.innerHTML += `<option value="${table.id}">${table.number}</option>`;
                        }
                    });
                    document.getElementById('change-table-popup').classList.remove('hidden');
                    document.getElementById('change-table-popup').classList.add('flex');
                })
                .catch(err => {
                    alert('Không lấy được danh sách bàn!');
                });
        }

        function closeChangeTablePopup() {
            document.getElementById('change-table-popup').classList.remove('flex');
            document.getElementById('change-table-popup').classList.add('hidden');
        }
        function resetOrderPanel() {
            document.getElementById('bill-id').textContent = '';
            document.getElementById('current-table-name').textContent = '';
            document.getElementById('order-items').innerHTML = '';
            document.getElementById('total-amount').textContent = '0 VNĐ';
            document.getElementById('empty-order').style.display = 'flex';
        }

        function confirmChangeTable() {
            const newTableId = document.getElementById('select-new-table').value;
            if (!newTableId) return alert('Vui lòng chọn bàn để chuyển!');

            if (!confirm('Bạn chắc chắn muốn chuyển sang bàn này?')) return;

            fetch('/admin/deskmanage/change-table', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    from_table_id: currentTableId,
                    to_table_id: newTableId
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Đổi bàn thành công!');
                        closeChangeTablePopup();
                        resetOrderPanel();
                        // Cập nhật lại view với bàn mới:
                        currentTableId = newTableId;
                        loadTableMenu(currentTableId);
                        reloadTableList();
                    } else {
                        alert(data.message || 'Đổi bàn thất bại!');
                    }
                })
                .catch(err => {
                    alert('Lỗi khi đổi bàn!');
                    console.error(err);
                });
        }
        function reloadTableList() {
            fetch('/admin/deskmanage/get-tables') // API trả về toàn bộ bàn mới nhất
                .then(res => res.json())
                .then(data => {
                    const tableList = document.getElementById('table-list');
                    tableList.innerHTML = (data.tables || []).map(table => `
            <div class="table-item cursor-pointer rounded-lg p-3 transition-all bg-slate-700/30 hover:bg-slate-600/50"
                data-id="${table.id}">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-white font-medium">${table.number}</h3>
                    <div class="w-3 h-3 
                        ${table.status === 'Đã Mở' ? 'bg-yellow-500' : (table.status === 'Cần thanh toán' ? 'bg-red-500' : 'bg-green-500')} 
                        rounded-full"></div>
                </div>
                <div class="flex items-center gap-2 text-slate-300 text-sm">
                    <i class="fas fa-users"></i>
                    <span>${table.quantity ?? '-'} chỗ</span>
                </div>
                <div class="text-xs text-slate-400 mt-1">
                    ${table.status}
                </div>
            </div>
        `).join('');
                    // Gán lại event click cho từng bàn
                    document.querySelectorAll('.table-item').forEach(function (item) {
                        item.addEventListener('click', function () {
                            document.querySelectorAll('.table-item').forEach(i => i.classList.remove('table-active'));
                            this.classList.add('table-active');
                            currentTableId = this.getAttribute('data-id');
                            document.getElementById('current-table-name').textContent = this.querySelector('h3').textContent;
                            loadTableMenu(currentTableId);
                        });
                    });
                    // Đánh dấu active bàn hiện tại
                    let curActive = document.querySelector('.table-item[data-id="' + currentTableId + '"]');
                    if (curActive) curActive.classList.add('table-active');
                });
        }

        async function handleCloseTable() {
            // Gọi API lấy thông tin order hiện tại
            let res = await fetch(`/admin/deskmanage/get-table-data/${currentTableId}`);
            let data = await res.json();

            if (!data || data.items.length === 0) {
                alert("Không có đơn hàng nào để đóng bàn!");
                return;
            }

            // Kiểm tra trạng thái đơn hàng
            if (!data.statusorder || data.statusorder !== 'Hoàn Thành') {
                alert("Bạn phải hoàn thành đơn hàng trước khi đóng bàn!");
                return;
            }

            if (!confirm("Xác nhận đóng bàn?")) return;

            // Gọi API đổi trạng thái bàn
            fetch('/admin/deskmanage/close-table', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    table_id: currentTableId
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert("Đã đóng bàn thành công!");
                        loadTableMenu(currentTableId); // Refresh lại dữ liệu bàn
                    } else {
                        alert(data.message || "Đóng bàn thất bại!");
                    }
                })
                .catch(err => {
                    alert('Có lỗi khi đóng bàn!');
                    console.error(err);
                });
        }



        async function handleShowQrPayment(items, total, tableName, staffName, billId, billTime) {
            const totalNumber = parseInt(total.replace(/[^\d]/g, ''));
            let products = items.map(item => ({
                id: item.id,
                quantity: item.quantity
            }));

            let payload = {
                table_id: currentTableId,
                totalbill: totalNumber,
                typepayment: 2, // luôn là 2 (QR)
                products: products,
                note: "",
                staff: staffName,
                table_name: tableName
            };

            try {
                const res = await fetch('/admin/deskmanage/create-qr-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify(payload)
                });
                const data = await res.json();
                if (data.success && data.qr_url) {
                    document.getElementById('vnpay-qr-section').classList.remove('hidden');
                    new QRious({
                        element: document.getElementById('vnpay-qr'),
                        value: data.qr_url,
                        size: 220
                    });
                    document.getElementById('vnpay-link').href = data.qr_url;
                    document.getElementById('vnpay-link').innerText = "Mở trang xác nhận thanh toán";
                    // KHÔNG mở tab ở đây! (QR chỉ để quét, không phải click)
                } else {
                    console.log("Debug 422:", data.errors || data.message);
                    alert(data.message || 'Không tạo được mã QR!');
                }
            } catch (err) {
                alert('Lỗi khi tạo mã QR!');
                console.error(err);
            }
        }


        function submitPayment() {
            const paymentType = document.querySelector('input[name="payment-type"]:checked').value;
            const total = document.getElementById('total-amount').textContent.replace(/[^\d]/g, '') || '0';
            let items = orderItemsData || [];
            if (!items || items.length === 0) {
                alert("Chưa có món nào trên hóa đơn này!");
                return;
            }
            let products = items.map(item => ({
                id: item.id,
                quantity: item.quantity
            }));

            // Nếu là QR thì KHÔNG gọi API nữa!
            if (paymentType === "2") {
                alert('Vui lòng dùng app ngân hàng quét mã QR để thanh toán!');
                return;
            }

            // Tiền mặt
            fetch('/admin/deskmanage/store-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    table_id: currentTableId,
                    totalbill: parseInt(total),
                    typepayment: paymentType,
                    products: products
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Thanh toán thành công!');
                        closeReviewPopup();
                        loadTableMenu(currentTableId);
                    } else {
                        alert(data.message || 'Thanh toán thất bại!');
                    }
                })
                .catch(err => {
                    alert('Có lỗi khi thanh toán!');
                    console.error(err);
                });
        }


        function closeReviewPopup() {
            document.getElementById('review-popup').classList.remove('flex');
            document.getElementById('review-popup').classList.add('hidden');
            document.getElementById('vnpay-qr-section').classList.add('hidden');
        }

    </script>

    <!-- Popup chọn combo -->
    <div id="combo-popup" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-slate-800 w-96 rounded-xl p-6 shadow-lg relative">
            <button onclick="closeComboPopup()" class="absolute top-2 right-3 text-white text-lg hover:text-red-400">
                &times;
            </button>
            <h2 class="text-white text-lg font-bold mb-4">Chọn Combo</h2>
            <select id="combo-select" class="w-full bg-slate-700 text-white rounded-lg px-4 py-2 mb-4">
                <option value="">-- Chọn combo --</option>
            </select>
            <button onclick="submitCombo()"
                class="w-full bg-gradient-to-r from-green-500 to-teal-500 text-white font-bold py-2 rounded-lg hover:scale-105 transition">
                <i class="fas fa-check mr-2"></i>Thêm vào hóa đơn
            </button>
        </div>
    </div>


    <script>
        let orderData = {};
        let currentTableId = null;
        let menuList = [];
        let comboList = [];
        let menuMap = {}; // {menuName: [foods]}
        let activeMenu = '';
        let isCombo = false;

        document.addEventListener("DOMContentLoaded", function () {
            const firstTable = document.querySelector('.table-item');
            if (firstTable) {
                firstTable.classList.add('table-active');
                currentTableId = firstTable.getAttribute('data-id');
                document.getElementById('current-table-name').textContent = firstTable.querySelector('h3')
                    .textContent;
                loadTableMenu(currentTableId);
            }
            document.querySelectorAll('.table-item').forEach(function (item) {
                item.addEventListener('click', function () {
                    document.querySelectorAll('.table-item').forEach(i => i.classList.remove(
                        'table-active'));
                    this.classList.add('table-active');
                    currentTableId = this.getAttribute('data-id');
                    document.getElementById('current-table-name').textContent = this.querySelector(
                        'h3').textContent;
                    loadTableMenu(currentTableId);

                });
            });
        });

        function loadTableMenu(tableId, keepTabState = false, prevIsCombo = false, prevActiveMenu = '') {
            fetch(`/admin/deskmanage/get-table-data/${tableId}`)
                .then(res => res.json())
                .then(data => {
                    console.log('Table data:', data);
                    menuList = data.menus || [];
                    comboList = data.combos || [];
                    menuMap = {};
                    menuList.forEach(menu => {
                        menuMap[menu.name] = menu.foods || [];
                    });
                    document.getElementById('bill-id').textContent = data.ma_hoa_don ?? '---';

                    // Giữ trạng thái tab
                    if (keepTabState) {
                        isCombo = prevIsCombo;
                        activeMenu = prevActiveMenu;
                    } else {
                        // Mặc định
                        isCombo = false;
                        activeMenu = menuList[0] ? menuList[0].name : '';
                    }
                    console.log('Table data:', data);
                    if ((data.table && data.table.status === "Đã Đóng") || data.status === "Đã Đóng" || data.error) {
                        showOpenTableButton(tableId);
                        return;
                    }

                    renderCategoryButtons();

                    // Sau khi set trạng thái, render đúng tab
                    if (isCombo) {
                        renderCombos();
                    } else {
                        renderMenus(activeMenu || (menuList[0] && menuList[0].name));
                    }
                    renderOrderItems(data.items || []);
                    renderOrder();
                });
        }


        function showOpenTableButton(tableId) {
            document.getElementById('total-amount').textContent = '0 VNĐ';
            document.getElementById('bill-id').textContent = '';
            document.getElementById('order-items').innerHTML = '';
            document.getElementById('empty-order').style.display = 'none';
            const orderItems = document.getElementById('order-items');
            const emptyOrder = document.getElementById('empty-order');
            orderItems.innerHTML = `
        <div class="flex flex-col items-center justify-center h-full text-slate-400 py-8">
            <button onclick="confirmOpenTable('${tableId}')" 
                class="bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white px-8 py-4 rounded-xl font-bold text-lg mb-4 shadow-lg transition-all">
                <i class="fas fa-door-open mr-2"></i>Mở bàn này
            </button>
            <p class="text-center text-sm mt-1">Bàn đang đóng. Nhấn để mở bàn và bắt đầu order.</p>
        </div>
    `;
            orderItems.style.display = 'block';
            emptyOrder.style.display = 'none';
        }

        window.confirmOpenTable = function (tableId) {
            if (!confirm("Bạn có chắc chắn muốn mở bàn này không?")) return;
            fetch(`/admin/deskmanage/open-table/${tableId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.Laravel ? window.Laravel.csrfToken : document.querySelector(
                        'meta[name=csrf-token]').content
                }
            })
                .then(res => res.json())
                .then(data => {

                    if (data.success) {
                        alert("Đã mở bàn thành công!");
                        const prevIsCombo = isCombo;
                        const prevActiveMenu = activeMenu;
                        loadTableMenu(tableId, true, prevIsCombo, prevActiveMenu);
                        // Nếu muốn, có thể reload lại danh sách bàn ở sidebar
                    } else {
                        alert(data.message || "Mở bàn thất bại!");
                    }
                });
        }


        function renderCategoryButtons() {
            const list = document.getElementById('category-list');
            list.innerHTML = `
        <button class="category-btn px-4 py-2 rounded-lg text-white text-sm font-medium whitespace-nowrap transition-all" data-combo="1">Combo </button>
        ${menuList.map(menu =>
                `<button class="category-btn px-4 py-2 rounded-lg text-white text-sm font-medium whitespace-nowrap transition-all" data-menu="${menu.name}">${menu.name}</button>`
            ).join('')}
    `;
            setCategoryEvents();

            // Tab mặc định
            const menuBtns = document.querySelectorAll('.category-btn[data-menu]');
            const comboBtn = document.querySelector('.category-btn[data-combo]');
            // Check lại logic chọn tab mặc định
            if (isCombo) {
                comboBtn.classList.add('category-active');
                renderCombos();
            } else if (activeMenu && menuMap[activeMenu]) {
                menuBtns.forEach(btn => {
                    btn.classList.toggle('category-active', btn.textContent === activeMenu);
                });
                renderMenus(activeMenu);
            } else if (menuBtns.length > 0) {
                // Nếu không có combo thì mặc định chọn tab menu đầu tiên
                menuBtns[0].classList.add('category-active');
                activeMenu = menuBtns[0].textContent;
                renderMenus(activeMenu);
            } else {
                // Không có menu nào thì mới hiện combo
                comboBtn.classList.add('category-active');
                isCombo = true;
                renderCombos();
            }
        }


        function setCategoryEvents() {
            document.querySelectorAll('.category-btn[data-menu]').forEach(btn => {
                btn.onclick = function () {
                    document.querySelectorAll('.category-btn').forEach(b => b.classList.remove(
                        'category-active'));
                    btn.classList.add('category-active');
                    activeMenu = btn.textContent;
                    isCombo = false;
                    renderMenus(activeMenu);
                    document.getElementById('search-menu').value = '';
                }
            });
            // Sự kiện chọn Combo
            document.querySelector('.category-btn[data-combo]').onclick = function () {
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('category-active'));
                this.classList.add('category-active');
                isCombo = true;
                renderCombos();
                document.getElementById('search-menu').value = '';
            };
        }

        function renderMenus(menuName) {
            document.getElementById('combo-section').innerHTML = '';
            const grid = document.getElementById('menu-grid');
            let items = menuMap[menuName] || [];
            grid.innerHTML = items.map(menu => `
        <div class="menu-item-hover bg-slate-700/30 rounded-xl overflow-hidden cursor-pointer transition-all fade-in max-h-[244px]">
            <div class="relative">
                <img src="${menu.image ? (menu.image.startsWith('http') ? menu.image : '/img/' + menu.image) : '/img/default-food.jpg'}" alt="${menu.name}" class="w-full h-32 object-cover">
                <div class="absolute top-2 right-2 bg-black/50 text-white px-3 py-1 rounded-full text-sm font-semibold"> ${menu.price ? Number(menu.price).toLocaleString('vi-VN') + ' VNĐ' : ''}</div>
            </div>
            <div class="p-3 flex flex-col justify-between gap-2 h-[120px]"> <!-- Thêm justify-between và chiều cao -->
    <h3 class="text-white font-medium text-sm">${menu.name}</h3>

    <button class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-2 rounded-lg text-sm font-medium transition-all transform hover:scale-105 add-to-order-btn"
        data-id="${menu.id}" data-name="${menu.name}" data-price="${menu.price}" data-image="${menu.image}">
        <i class="fas fa-plus mr-1"></i>Thêm món
    </button>
</div>
        </div>
    `).join('');
            grid.querySelectorAll('.add-to-order-btn').forEach(btn => {
                btn.onclick = function () {
                    addToOrder({
                        id: this.getAttribute('data-id'),
                        name: this.getAttribute('data-name'),
                        price: parseInt(this.getAttribute('data-price')) || 0,
                        image: this.getAttribute('data-image')
                    });
                }
            });
            grid.querySelectorAll('.add-to-order-btn').forEach(btn => {
                btn.onclick = function () {
                    let productId = this.getAttribute('data-id');
                    let tableId = currentTableId;
                    addOrderItemAjax(tableId, productId); // Gọi AJAX ở đây
                }
            });
        }

        function renderCombos() {
            document.getElementById('menu-grid').innerHTML = '';
            const comboDiv = document.getElementById('combo-section');
            if (!comboList || comboList.length === 0) {
                comboDiv.innerHTML = `
           <div class="flex flex-col items-center justify-center text-slate-400 py-12">
        <i class="fas fa-box-open text-3xl mb-3 opacity-40"></i>
        <p class="text-center text-sm mb-2">Chưa có combo nào cho bàn này.<br>Hãy chọn combo nếu muốn.</p>
        <button onclick="openComboPopup()"
            class="bg-gradient-to-r from-green-500 to-blue-500 hover:from-green-600 hover:to-blue-600 text-white px-6 py-2 rounded-xl font-bold text-sm shadow-lg transition-all">
            <i class="fas fa-plus mr-1"></i>Thêm Combo
        </button>
    </div>

    <!-- Popup -->
    <div id="combo-popup" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl w-full max-w-xl p-6 shadow-xl relative">
            <button onclick="closeComboPopup()" class="absolute top-2 right-2 text-slate-600 hover:text-red-600">
                <i class="fas fa-times text-xl"></i>
            </button>
            <h2 class="text-xl font-bold mb-4 text-slate-800">Chọn combo để thêm</h2>
            <div id="popup-combo-list" class="grid grid-cols-2 gap-4 max-h-[400px] overflow-y-auto">
                <!-- Combo item render ở đây -->
            </div>
        </div>
    </div>
        `;
                return;
            }
            comboDiv.innerHTML = comboList.map(combo => `
        <div class="mb-6">
            <h4 class="font-bold text-lg text-white mb-3">${combo.name}</h4>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                ${combo.foods.map(food => `
                    <div class="menu-item-hover bg-slate-700/30 rounded-xl overflow-hidden cursor-pointer transition-all fade-in max-h-[244px]">
                        <div class="relative">
                            <img src="${food.image ? (food.image.startsWith('http') ? food.image : '/img/' + food.image) : '/img/default-food.jpg'}"
                                alt="${food.name}" class="w-full h-32 object-cover">
                            <div class="absolute top-2 right-2 bg-black/50 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                ${food.price ? food.price + '₫' : ''}
                            </div>
                        </div>
                        <div class="p-3 flex flex-col justify-between gap-2 h-[120px]">
                            <h3 class="text-white font-medium text-sm">${food.name}</h3>
                            <button class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-2 rounded-lg text-sm font-medium transition-all transform hover:scale-105 add-to-order-btn"
                                data-id="${food.id}" data-name="${food.name}" data-price="${food.price}" data-image="${food.image}">
                                <i class="fas fa-plus mr-1"></i>Thêm món
                            </button>
                        </div>
                    </div>
                `).join('')}
            </div>
        </div>
    `).join('');
            comboDiv.querySelectorAll('.add-to-order-btn').forEach(btn => {
                btn.onclick = function () {
                    addToOrder({
                        id: this.getAttribute('data-id'),
                        name: this.getAttribute('data-name'),
                        price: parseInt(this.getAttribute('data-price')) || 0,
                        image: this.getAttribute('data-image')
                    });
                }
            });
            grid.querySelectorAll('.add-to-order-btn').forEach(btn => {
                btn.onclick = function () {
                    let productId = this.getAttribute('data-id');
                    let tableId = currentTableId;
                    addOrderItemAjax(tableId, productId); // Gọi AJAX ở đây
                }
            });
        }


        function addToOrder(food) {
            if (!orderData[currentTableId]) orderData[currentTableId] = [];
            let orderArr = orderData[currentTableId];
            let idx = orderArr.findIndex(item => item.id == food.id);
            if (idx > -1) orderArr[idx].quantity += 1;
            else orderArr.push({
                ...food,
                quantity: 1
            });
            renderOrder();
        }

        function renderOrderItems(items) {
            orderItemsData = items;
            const orderItems = document.getElementById('order-items');
            const emptyOrder = document.getElementById('empty-order');
            if (!items || items.length === 0) {
                orderItems.style.display = 'none';
                emptyOrder.style.display = 'flex';
                document.getElementById('total-amount').textContent = '0₫';
                return;
            }
            orderItems.style.display = 'block';
            emptyOrder.style.display = 'none';
            let total = 0;
            orderItems.innerHTML = items 
            .filter(item => item.status != "Chờ Thực Hiện")
            .map(item => {
                let itemTotal = item.price * item.quantity;
                if (item.status === "Hoàn Thành") total += itemTotal;
                return `
    <div class="p-4 border-b border-slate-600">
  <div class="flex items-start gap-3">
    <!-- Ảnh món ăn -->
    <img src="${item.image}" class="w-14 h-14 object-cover rounded shadow" alt="${item.product_name}" />

    <!-- Nội dung -->
    <div class="flex-1">
      <!-- Tên món + giá tổng -->
      <div class="flex justify-between items-center mb-1">
        <h4 class="text-white font-medium text-sm truncate">${item.product_name}</h4>
        <span class="text-green-400 font-semibold text-sm">${itemTotal ? Number(itemTotal).toLocaleString('vi-VN') : ''}</span>
      </div>

      <!-- Giá x số lượng -->
      <div class="text-slate-300 text-xs mb-2">
        ${item.price ? Number(item.price).toLocaleString('vi-VN') + ' VNĐ' : ''} x ${item.quantity}
      </div>
      <div class="text-blue-500 text-xs mb-2">
        ${item.status}
      </div>

      <!-- Dòng 1: tăng/giảm + nút xóa -->
      <div class="flex items-center gap-2 mb-2">
        <button onclick="updateQuantity('${item.id}', -1)" class="w-7 h-7 bg-slate-600 hover:bg-slate-500 rounded-full flex items-center justify-center text-white text-xs">
          <i class="fas fa-minus"></i>
        </button>

        <span class="w-8 text-center text-white text-sm">${item.quantity}</span>

        <button onclick="updateQuantity('${item.id}', 1)" class="w-7 h-7 bg-slate-600 hover:bg-slate-500 rounded-full flex items-center justify-center text-white text-xs">
          <i class="fas fa-plus"></i>
        </button>

        <button onclick="deleteOrderItem('${item.id}')" class="w-7 h-7 bg-red-600 hover:bg-red-400 rounded-full flex items-center justify-center text-white text-xs ml-2">
          <i class="fas fa-trash"></i>
        </button>
      </div>

      <!-- Dòng 2: chế biến / xác nhận / huỷ -->
      <div class="flex items-center gap-2">
    <button onclick="updateOrderItemStatus('${item.id}', 'Đang Chế Biến')" class="w-7 h-7 bg-blue-600 hover:bg-blue-400 rounded-full flex items-center justify-center text-white text-xs" title="Chế biến">
      <i class="fa-solid fa-utensils"></i>
    </button>
    <button onclick="updateOrderItemStatus('${item.id}', 'Hoàn Thành')" class="w-7 h-7 bg-green-600 hover:bg-green-400 rounded-full flex items-center justify-center text-white text-xs" title="Hoàn thành">
      <i class="fa-solid fa-circle-check"></i>
    </button>
    <button onclick="updateOrderItemStatus('${item.id}', 'Hủy Món')" class="w-7 h-7 bg-orange-600 hover:bg-orange-400 rounded-full flex items-center justify-center text-white text-xs" title="Hủy món">
      <i class="fa-solid fa-rectangle-xmark"></i>
    </button>
</div>
    </div>
  </div>
</div>

`;

            }).join('');
            document.getElementById('total-amount').textContent = Number(total).toLocaleString('vi-VN') + ' VNĐ';
        }
        window.changeQuantity = function (index, delta) {
            let arr = orderData[currentTableId];
            arr[index].quantity += delta;
            if (arr[index].quantity <= 0) arr.splice(index, 1);
            renderOrder();
        }
        window.removeItem = function (index) {
            let arr = orderData[currentTableId];
            arr.splice(index, 1);
            renderOrder();
        }

        window.updateOrderItemStatus = function (orderItemId, status) {
            const prevIsCombo = isCombo;
            const prevActiveMenu = activeMenu;
            fetch('/admin/deskmanage/update-order-item-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    order_item_id: orderItemId,
                    status: status // Gọi Món | Đang Chế Biến | Hoàn Thành | Hủy Món
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadTableMenu(currentTableId, true, prevIsCombo, prevActiveMenu);
                    } else {
                        alert(data.message || 'Cập nhật trạng thái thất bại!');
                    }
                })
                .catch((err) => {
                    alert('Có lỗi khi cập nhật trạng thái!');
                    console.error(err);
                });
        }


        // Tìm kiếm đúng trên phần đang hiển thị
        document.getElementById('search-menu').addEventListener('input', function (e) {
            let val = e.target.value.toLowerCase();
            if (isCombo) {
                let comboDivs = document.querySelectorAll('#combo-section > .mb-4');
                comboList.forEach((combo, idx) => {
                    let comboDiv = comboDivs[idx];
                    if (!comboDiv) return;
                    combo.foods.forEach((food, foodIdx) => {
                        let foodDiv = comboDiv.querySelectorAll('.p-2')[foodIdx];
                        if (!foodDiv) return;
                        let name = food.name.toLowerCase();
                        foodDiv.style.display = name.includes(val) ? '' : 'none';
                    });
                });
            } else {
                let grid = document.getElementById('menu-grid');
                grid.querySelectorAll('.menu-item-hover').forEach(item => {
                    let name = item.querySelector('h3').textContent.toLowerCase();
                    item.style.display = name.includes(val) ? 'block' : 'none';
                });
            }
        });

        // Hàm tăng/giảm số lượng sản phẩm trên hóa đơn thực tế của bàn (dữ liệu lấy từ API, không phải orderData local)
        window.updateQuantity = function (itemId, delta) {
            // Gọi API backend để tăng/giảm, hoặc xử lý phía client nếu muốn (dưới là demo client)
            // Giả sử bạn đã có biến orderItemsData là danh sách items hiện tại (hoặc truyền items vào)
            let items = document.getElementById('order-items').dataset.items ?
                JSON.parse(document.getElementById('order-items').dataset.items) :
                [];
            let found = items.find(i => i.id == itemId);
            if (found) {
                found.quantity += delta;
                if (found.quantity < 1) found.quantity = 1;
                renderOrderItems(items);
            }
            // Nếu bạn muốn lưu lên server thì gọi fetch() POST ở đây với itemId, delta
        }

        // Hàm xóa món khỏi hóa đơn thực tế
        window.deleteOrderItem = function (itemId) {
            // Giả sử bạn đã có biến orderItemsData là danh sách items hiện tại (hoặc truyền items vào)
            let items = document.getElementById('order-items').dataset.items ?
                JSON.parse(document.getElementById('order-items').dataset.items) :
                [];
            let newItems = items.filter(i => i.id != itemId);
            renderOrderItems(newItems);
            // Nếu muốn xóa trên server thì gọi API xóa ở đây
        }


        // Sidebar toggle/time update giữ nguyên
        document.getElementById('sidebar-toggle').addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-expanded');
        });

        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('vi-VN');
            const dateString = now.toLocaleDateString('vi-VN');
            document.getElementById('current-time').textContent = `${timeString} - ${dateString}`;
            document.getElementById('bill-time').textContent = timeString;
        }

        function reloadOrderPanel(tableId) {
            fetch(`/admin/deskmanage/get-order-items/${tableId}`)
                .then(res => res.json())
                .then(data => {
                    renderOrderItems(data.items || []);
                });
        }

        function openComboPopup() {
            fetch('/admin/deskmanage/get-all-combos')
                .then(res => res.json())
                .then(data => {
                    if (data.success && data.combos) {
                        const list = document.getElementById('popup-combo-list');
                        list.innerHTML = data.combos.map(combo => `
                    <div class="bg-slate-100 p-3 rounded-lg shadow flex flex-col">
                        <h3 class="font-semibold mb-2 text-sm text-slate-700">${combo.name}</h3>
                        <p class="text-xs text-slate-600 mb-2">${combo.foods.length} món</p>
                        <button onclick="addComboToOrder(${combo.id})"
                            class="mt-auto bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-1 px-3 rounded-lg text-xs font-medium">
                            <i class="fas fa-plus mr-1"></i>Thêm combo
                        </button>
                    </div>
                `).join('');
                        document.getElementById('combo-popup').classList.remove('hidden');
                    } else {
                        alert(data.message || 'Không lấy được danh sách combo!');
                    }
                });
        }

        function closeComboPopup() {
            document.getElementById('combo-popup').classList.add('hidden');
        }

        function addComboToOrder(comboId) {
            fetch('/admin/deskmanage/add-combo-to-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    combo_id: comboId,
                    table_id: currentTableId
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        closeComboPopup();
                        loadTableMenu(currentTableId);
                        alert('Thêm combo thành công!');
                    } else {

                        console.log()
                        alert(data.message || 'Thêm combo thất bại!');
                    }
                })
                .catch(err => {
                    alert('Lỗi khi thêm combo!');
                    console.error(err);
                });
        }


        function submitCombo() {
            const comboId = document.getElementById('combo-select').value;
            if (!comboId) return alert('Vui lòng chọn combo!');
            fetch('/admin/deskmanage/add-combo-to-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    table_id: currentTableId,
                    combo_id: comboId
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        closeComboPopup();
                        loadTableMenu(currentTableId);
                    } else {
                        alert(data.message || 'Thêm combo thất bại!');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Lỗi khi thêm combo!');
                });
        }



        //Thêm món
        function addOrderItemAjax(tableId, productId) {
            const prevIsCombo = isCombo;
            const prevActiveMenu = activeMenu;
            fetch('/admin/deskmanage/add-order-item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    table_id: tableId,
                    product_id: productId
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadTableMenu(tableId, true, prevIsCombo, prevActiveMenu); // Sửa ở đây
                    } else {
                        alert(data.message || 'Thêm món thất bại!');
                    }
                })
                .catch((err) => {
                    console.error('Ajax error:', err);
                    alert(err.message || 'Có lỗi xảy ra khi thêm món!');
                });
        }


        // Tăng/giảm số lượng
        window.updateQuantity = function (orderItemId, delta) {
            const prevIsCombo = isCombo;
            const prevActiveMenu = activeMenu;
            fetch('/admin/deskmanage/update-order-item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    order_item_id: orderItemId,
                    delta: delta
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadTableMenu(currentTableId, true, prevIsCombo, prevActiveMenu); // Sửa ở đây
                    } else {
                        alert(data.message || 'Cập nhật số lượng thất bại!');
                    }
                })
                .catch((err) => {
                    alert('Có lỗi khi cập nhật số lượng!');
                    console.error(err);
                });
        }


        // Xóa món
        window.deleteOrderItem = function (orderItemId) {
            if (!confirm('Bạn chắc chắn muốn xóa món này?')) return;
            const prevIsCombo = isCombo;
            const prevActiveMenu = activeMenu;
            fetch('/admin/deskmanage/delete-order-item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({
                    order_item_id: orderItemId
                })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        loadTableMenu(currentTableId, true, prevIsCombo, prevActiveMenu); // Sửa ở đây
                    } else {
                        alert(data.message || 'Xóa món thất bại!');
                    }
                })
                .catch((err) => {
                    alert('Có lỗi khi xóa món!');
                    console.error(err);
                });
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>

</html>