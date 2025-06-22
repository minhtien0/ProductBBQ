<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý bàn BBQ</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'red-primary': '#e60012',
            'red-hover': '#cc0010',
            'gray-dark': '#333',
            'gray-darker': '#444',
            'gray-light': '#ccc',
            'bg-main': '#191a2b'
          },
          fontFamily: {
            mont: ['Montserrat', 'sans-serif'],
          }
        },
      },
    }
  </script>
  <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
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
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .sidebar-collapsed {
            width: 60px;
        }
        .sidebar-expanded {
            width: 280px;
        }
        .order-status-waiting { color: #fbbf24; }
        .order-status-cooking { color: #f59e0b; }
        .order-status-ready { color: #10b981; }
        .order-status-served { color: #06b6d4; }
    </style>
</head>
@include('layouts.admin.header')
<body class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 min-h-screen">
    <!-- Header -->
    <header class="bg-slate-800/50 backdrop-blur-lg border-b border-slate-700/50 px-4 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button id="sidebar-toggle" class="lg:hidden text-white hover:text-blue-400 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
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
                    <p class="text-white text-sm font-medium">Nhân viên: Admin</p>
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
        <div id="sidebar" class="sidebar-expanded bg-slate-800/30 backdrop-blur-lg border-r border-slate-700/50 transition-all duration-300 flex flex-col">
            <div class="p-4 border-b border-slate-700/50">
                <h2 class="text-white font-semibold text-sm mb-3 flex items-center gap-2">
                    <i class="fas fa-chair"></i>
                    <span id="sidebar-title">Danh sách bàn</span>
                </h2>
                <div class="relative">
                    <input type="text" placeholder="Tìm bàn..." 
                           class="w-full bg-slate-700/50 text-white placeholder-slate-400 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                </div>
            </div>
            <div id="table-list" class="flex-1 overflow-y-auto p-3 space-y-2"></div>
            <div class="p-4 border-t border-slate-700/50">
                <div class="text-xs text-slate-400 space-y-1">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        <span>Trống</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <span>Đang phục vụ</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <span>Cần thanh toán</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Menu Section -->
            <div class="flex-1 p-4 overflow-hidden">
                <div class="bg-slate-800/30 backdrop-blur-lg rounded-xl border border-slate-700/50 h-full flex flex-col">
                    <!-- Search và Category -->
                    <div class="p-4 border-b border-slate-700/50">
                        <div class="flex flex-col lg:flex-row gap-4">
                            <div class="flex-1 relative">
                                <input type="text" id="search-menu" placeholder="Tìm kiếm món ăn..." 
                                       class="w-full bg-slate-700/50 text-white placeholder-slate-400 rounded-lg px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                            </div>
                            <div class="flex gap-2 overflow-x-auto">
                                <button class="category-btn category-active px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap transition-all" data-category="all">
                                    Tất cả
                                </button>
                                <button class="category-btn bg-slate-700/50 text-white px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-slate-600/50 transition-all" data-category="grilled">
                                    Nướng
                                </button>
                                <button class="category-btn bg-slate-700/50 text-white px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-slate-600/50 transition-all" data-category="hotpot">
                                    Lẩu
                                </button>
                                <button class="category-btn bg-slate-700/50 text-white px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-slate-600/50 transition-all" data-category="soup">
                                    Súp
                                </button>
                                <button class="category-btn bg-slate-700/50 text-white px-4 py-2 rounded-lg text-sm font-medium whitespace-nowrap hover:bg-slate-600/50 transition-all" data-category="salad">
                                    Salad
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Menu Grid -->
                    <div class="flex-1 overflow-y-auto p-4">
                        <div id="menu-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"></div>
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
                            <p class="text-slate-300 text-sm">Bàn: <span id="current-table-name" class="font-bold text-blue-400">1</span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-slate-300 text-xs">Mã HĐ: #<span id="bill-id">001</span></p>
                        <p class="text-slate-300 text-xs" id="bill-time"></p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="flex-1 overflow-y-auto">
                <div id="order-items" class="divide-y divide-slate-700/50"></div>
                <div id="empty-order" class="flex flex-col items-center justify-center h-full text-slate-400">
                    <i class="fas fa-shopping-cart text-4xl mb-3 opacity-50"></i>
                    <p class="text-center">Chưa có món nào được chọn</p>
                    <p class="text-center text-sm mt-1">Hãy chọn món từ menu bên trái</p>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="border-t border-slate-700/50 p-4">
                <div class="bg-slate-700/30 rounded-lg p-3 mb-4">
                    <div class="flex justify-between items-center text-white">
                        <span class="font-medium">Tổng tiền:</span>
                        <span id="total-amount" class="text-xl font-bold text-green-400">$0</span>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-2 mb-3">
                    <button class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-lock mr-1"></i>
                        Khóa màn
                    </button>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-exchange-alt mr-1"></i>
                        Chuyển bàn
                    </button>
                    <button class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-cut mr-1"></i>
                        Tách bàn
                    </button>
                    <button class="bg-cyan-600 hover:bg-cyan-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-bell mr-1"></i>
                        Thông báo
                    </button>
                </div>

                <button class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white py-3 rounded-lg font-bold text-sm transition-all transform hover:scale-105">
                    <i class="fas fa-credit-card mr-2"></i>
                    THANH TOÁN
                </button>
            </div>
        </div>
    </div>

    <script>
        // Dữ liệu mẫu
        const tables = [
            { id: 1, name: "Bàn 1", status: "empty", seats: 4 },
            { id: 2, name: "Bàn 2", status: "occupied", seats: 6 },
            { id: 3, name: "Bàn 3", status: "reserved", seats: 2 },
            { id: 4, name: "Bàn 4", status: "empty", seats: 8 },
            { id: 5, name: "Bàn 5", status: "occupied", seats: 4 },
            { id: 6, name: "Bàn 6", status: "empty", seats: 6 },
            { id: 7, name: "Bàn 7", status: "occupied", seats: 2 },
            { id: 8, name: "Bàn 8", status: "empty", seats: 4 },
        ];

        const menu = [
            { id: 1, name: "Dê nướng", price: 300, category: "grilled", img: "https://images.unsplash.com/photo-1544025162-d76694265947?w=300&h=200&fit=crop" },
            { id: 2, name: "Bò nướng", price: 300, category: "grilled", img: "https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=300&h=200&fit=crop" },
            { id: 3, name: "Bò cuộn kim chi", price: 250, category: "grilled", img: "https://images.unsplash.com/photo-1504973960431-1c467e159aa4?w=300&h=200&fit=crop" },
            { id: 4, name: "Tôm nướng", price: 150, category: "grilled", img: "https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=300&h=200&fit=crop" },
            { id: 5, name: "Lẩu thái", price: 200, category: "hotpot", img: "https://images.unsplash.com/photo-1504544750208-dc0358e63f7f?w=300&h=200&fit=crop" },
            { id: 6, name: "Lẩu bò", price: 280, category: "hotpot", img: "https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=300&h=200&fit=crop" },
            { id: 7, name: "Súp hải sản", price: 120, category: "soup", img: "https://images.unsplash.com/photo-1547592166-23ac45744acd?w=300&h=200&fit=crop" },
            { id: 8, name: "Salad trộn", price: 80, category: "salad", img: "https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=300&h=200&fit=crop" },
        ];

        // State management
        let orders = {};
        tables.forEach(table => orders[table.id] = []);
        let currentTable = tables[0].id;
        let currentCategory = 'all';

        // Utility functions
        function formatPrice(price) {
            return `$${price.toLocaleString()}`;
        }

        function getTableStatus(status) {
            const statusMap = {
                'empty': { color: 'bg-green-500', text: 'Trống' },
                'occupied': { color: 'bg-yellow-500', text: 'Đang phục vụ' },
                'reserved': { color: 'bg-red-500', text: 'Cần thanh toán' }
            };
            return statusMap[status] || statusMap.empty;
        }

        // Render functions
        function renderTables() {
            const tableList = document.getElementById('table-list');
            tableList.innerHTML = '';
            
            tables.forEach(table => {
                const status = getTableStatus(table.status);
                const isActive = currentTable === table.id;
                
                const tableElement = document.createElement('div');
                tableElement.className = `table-item cursor-pointer rounded-lg p-3 transition-all ${isActive ? 'table-active' : 'bg-slate-700/30 hover:bg-slate-600/50'}`;
                tableElement.innerHTML = `
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-white font-medium">${table.name}</h3>
                        <div class="w-3 h-3 ${status.color} rounded-full"></div>
                    </div>
                    <div class="flex items-center gap-2 text-slate-300 text-sm">
                        <i class="fas fa-users"></i>
                        <span>${table.seats} chỗ</span>
                    </div>
                    <div class="text-xs text-slate-400 mt-1">${status.text}</div>
                `;
                
                tableElement.addEventListener('click', () => selectTable(table.id));
                tableList.appendChild(tableElement);
            });
        }

        function renderMenu() {
            const menuGrid = document.getElementById('menu-grid');
            menuGrid.innerHTML = '';
            
            const filteredMenu = currentCategory === 'all' 
                ? menu 
                : menu.filter(item => item.category === currentCategory);
            
            filteredMenu.forEach(item => {
                const menuElement = document.createElement('div');
                menuElement.className = 'menu-item-hover bg-slate-700/30 rounded-xl overflow-hidden cursor-pointer transition-all fade-in';
                menuElement.innerHTML = `
                    <div class="relative">
                        <img src="${item.img}" alt="${item.name}" class="w-full h-32 object-cover">
                        <div class="absolute top-2 right-2 bg-black/50 text-white px-2 py-1 rounded-full text-xs">
                            ${formatPrice(item.price)}
                        </div>
                    </div>
                    <div class="p-3">
                        <h3 class="text-white font-medium mb-2 text-sm">${item.name}</h3>
                        <button class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-2 rounded-lg text-sm font-medium transition-all transform hover:scale-105">
                            <i class="fas fa-plus mr-1"></i>
                            Thêm món
                        </button>
                    </div>
                `;
                
                menuElement.querySelector('button').addEventListener('click', () => addToOrder(item.id));
                menuGrid.appendChild(menuElement);
            });
        }

        function renderOrder() {
            const orderItems = document.getElementById('order-items');
            const emptyOrder = document.getElementById('empty-order');
            const currentOrder = orders[currentTable];
            
            if (currentOrder.length === 0) {
                orderItems.style.display = 'none';
                emptyOrder.style.display = 'flex';
                document.getElementById('total-amount').textContent = '$0';
                return;
            }
            
            orderItems.style.display = 'block';
            emptyOrder.style.display = 'none';
            orderItems.innerHTML = '';
            
            let total = 0;
            currentOrder.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                
                const orderItem = document.createElement('div');
                orderItem.className = 'p-4 hover:bg-slate-700/20 transition-colors';
                orderItem.innerHTML = `
                    <div class="flex items-start gap-3">
                        <img src="${item.img}" alt="${item.name}" class="w-12 h-12 object-cover rounded-lg">
                        <div class="flex-1">
                            <h4 class="text-white font-medium text-sm mb-1">${item.name}</h4>
                            <p class="text-slate-300 text-xs mb-2">${formatPrice(item.price)} x ${item.quantity}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <button class="w-6 h-6 bg-slate-600 hover:bg-slate-500 rounded-full flex items-center justify-center text-white text-xs transition-colors" onclick="changeQuantity(${index}, -1)">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <span class="text-white font-medium w-8 text-center">${item.quantity}</span>
                                    <button class="w-6 h-6 bg-slate-600 hover:bg-slate-500 rounded-full flex items-center justify-center text-white text-xs transition-colors" onclick="changeQuantity(${index}, 1)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-green-400 font-medium text-sm">${formatPrice(itemTotal)}</span>
                                    <button class="text-red-400 hover:text-red-300 transition-colors" onclick="removeItem(${index})">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                orderItems.appendChild(orderItem);
            });
            
            document.getElementById('total-amount').textContent = formatPrice(total);
        }

        // Event handlers
        function selectTable(tableId) {
            currentTable = tableId;
            document.getElementById('current-table-name').textContent = tableId;
            renderTables();
            renderOrder();
        }

        function addToOrder(menuId) {
            const menuItem = menu.find(item => item.id === menuId);
            const currentOrder = orders[currentTable];
            const existingItem = currentOrder.find(item => item.id === menuId);
            
            if (existingItem) {
                existingItem.quantity++;
            } else {
                currentOrder.push({
                    ...menuItem,
                    quantity: 1
                });
            }
            
            renderOrder();
        }

        function changeQuantity(index, delta) {
            const currentOrder = orders[currentTable];
            currentOrder[index].quantity += delta;
            
            if (currentOrder[index].quantity <= 0) {
                currentOrder.splice(index, 1);
            }
            
            renderOrder();
        }

        function removeItem(index) {
            orders[currentTable].splice(index, 1);
            renderOrder();
        }

        // Category filter
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('category-btn')) {
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('category-active');
                    btn.classList.add('bg-slate-700/50', 'text-white');
                });
                
                e.target.classList.add('category-active');
                e.target.classList.remove('bg-slate-700/50', 'text-white');
                
                currentCategory = e.target.dataset.category;
                renderMenu();
            }
        });

        // Search functionality
        document.getElementById('search-menu').addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const menuItems = document.querySelectorAll('.menu-item-hover');
            
            menuItems.forEach(item => {
                const itemName = item.querySelector('h3').textContent.toLowerCase();
                if (itemName.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Sidebar toggle
        document.getElementById('sidebar-toggle').addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('sidebar-collapsed');
            sidebar.classList.toggle('sidebar-expanded');
        });

        // Update time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('vi-VN');
            const dateString = now.toLocaleDateString('vi-VN');
            
            document.getElementById('current-time').textContent = `${timeString} - ${dateString}`;
            document.getElementById('bill-time').textContent = timeString;
        }

        // Initialize
        function init() {
            renderTables();
            renderMenu();
            renderOrder();
            updateTime();
            setInterval(updateTime, 1000);
        }

        // Start application
        init();
    </script>
</body>
</html>
