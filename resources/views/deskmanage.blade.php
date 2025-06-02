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
</head>
<body class="bg-white min-h-screen font-mont">
@include('layouts.admin.header')
  <div class="max-w-[1300px] mx-auto flex flex-col md:flex-row gap-3 px-2 py-4">
    <!-- Khung bàn (trắng) -->
    <div class="bg-[#191a2b] flex-1 max-h-[410px] md:max-w-[200px] rounded-lg p-2 shadow-md flex flex-col mb-3 md:mb-0">
      <div class="mb-1 font-semibold text-[white] text-sm">Thông tin phòng / bàn:</div>
      <div id="table-list" class="grid grid-cols-3 gap-1 overflow-y-auto flex-1"></div>
    </div>
    <!-- Danh sách món ăn -->
    <div class="bg-[#191a2b] flex-[2] rounded-xl p-3 shadow-md mx-0 md:mx-2 flex flex-col">
      <div class="flex items-center gap-2 mb-3">
        <input type="text" class="rounded px-3 py-2 text-sm bg-white border flex-1" placeholder="Tìm món..."/>
      </div>
      <div class="flex mb-3">
        <button class="flex-1 text-white font-semibold border-b-2 border-[#fff] py-1">Nướng</button>
        <button class="flex-1 text-white font-semibold border-b-2 border-transparent py-1">Lẩu</button>
        <button class="flex-1 text-white font-semibold border-b-2 border-transparent py-1">Súp</button>
        <button class="flex-1 text-white font-semibold border-b-2 border-transparent py-1">Salad</button>
      </div>
      <div id="menu-list" class="grid grid-cols-2 md:grid-cols-3 gap-3"></div>
    </div>
    <!-- Hóa đơn -->
    <div class="bg-[#191a2b] flex-1 md:max-w-[340px] rounded-xl p-3 shadow-md flex flex-col">
      <div class="flex items-center justify-between mb-2">
        <div class="text-white text-sm">Bàn: <span class="font-bold bill-table-num">1</span></div>
        <img src="https://topcode.vn/Content/images/logo.png" class="w-20"/>
      </div>
      <div class="text-xs text-gray-300 mb-2">Mã hóa đơn: <span class="font-bold">40</span></div>
      <div class="overflow-y-auto flex-1">
        <table class="w-full text-xs text-white mb-2">
          <thead>
            <tr class="text-[#ff7c09] text-left border-b border-[#363655]">
              <th class="p-1">Tên món</th>
              <th class="p-1 text-center">Số lượng</th>
              <th class="p-1 text-right">Đơn giá</th>
              <th class="p-1 text-right">Thành tiền</th>
              <th class="p-1"></th>
            </tr>
          </thead>
          <tbody id="bill-body"></tbody>
        </table>
      </div>
      <div class="bg-[#232344] text-white rounded p-2 flex justify-between items-center text-base font-semibold mt-2 mb-1">
        <span>Tổng tiền:</span>
        <span id="total-bill">$0</span>
      </div>
      <div class="flex flex-wrap gap-2 mt-2">
        <button class="bg-[#5ad861] text-[#161326] font-semibold rounded px-2 py-1 text-xs">Khóa màn</button>
        <button class="bg-[#333366] text-white rounded px-2 py-1 text-xs">Tách bàn</button>
        <button class="bg-[#0095ff] text-white rounded px-2 py-1 text-xs">Chuyển / gộp bàn</button>
        <button class="bg-[#ffe660] text-[#241c3c] rounded px-2 py-1 text-xs">Thanh toán</button>
        <button class="bg-[#5bb5f8] text-[#232344] rounded px-2 py-1 text-xs">Thông báo</button>
        <button class="bg-[#00c0b6] text-white rounded px-2 py-1 text-xs">Đã mang lên</button>
      </div>
      <div class="flex flex-wrap gap-3 mt-3 items-center text-xs">
        <span class="flex items-center gap-1 text-red-400"><i class="fa fa-times-circle"></i> Xóa món</span>
        <span class="flex items-center gap-1 text-[#ffe660]"><i class="fa fa-circle"></i> Đang chờ nấu</span>
        <span class="flex items-center gap-1 text-green-400"><i class="fa fa-check-circle"></i> Đã xong / chờ lên</span>
        <span class="flex items-center gap-1 text-[#00c0b6]"><i class="fa fa-arrow-up"></i> Đã mang lên</span>
      </div>
    </div>
  </div>
  @include('layouts.admin.footer')
  <!-- JS xử lý -->
  <script>
    // Danh sách bàn và món ăn mẫu
    const tables = [
      { id: 1, name: "Bàn 1" }, { id: 2, name: "Bàn 2" }, { id: 3, name: "Bàn 3" },
      { id: 4, name: "Bàn 4" }, { id: 5, name: "Bàn 5" }, { id: 6, name: "Bàn 6" }
    ];
    const menu = [
      { id: 1, name: "Dê nướng", price: 300, img: "img/danhmuc1/suon.jpg" },
      { id: 2, name: "Bò nướng", price: 300, img: "img/danhmuc1/suon.jpg" },
      { id: 3, name: "Bò cuộn kim chi", price: 250, img: "img/danhmuc1/suon.jpg" },
      { id: 4, name: "Tôm nướng", price: 150, img: "img/danhmuc1/suon.jpg" },
      { id: 5, name: "Cá nướng", price: 200, img: "img/danhmuc1/suon.jpg" },
      { id: 6, name: "Gà nướng nguyên con", price: 250, img: "img/danhmuc1/suon.jpg" },
      { id: 7, name: "Thịt xiên nướng", price: 150, img: "img/danhmuc1/suon.jpg" },
      { id: 8, name: "Dê nướng cay", price: 320, img: "img/danhmuc1/suon.jpg" },
      { id: 9, name: "Bò nướng tiêu", price: 350, img: "img/danhmuc1/suon.jpg" },
    ];

    // Hóa đơn mỗi bàn
    let orders = {};
    tables.forEach(tb => orders[tb.id] = []);
    let currentTable = tables[0].id;

    // Render danh sách bàn
    function renderTables() {
      const tableList = document.getElementById('table-list');
      tableList.innerHTML = '';
      tables.forEach(tb => {
        const btn = document.createElement('button');
        btn.className = `table-btn bg-[#f6f6f6] border border-[#d6d6d6] rounded flex flex-col items-center justify-center p-2 shadow hover:bg-[#ffe3b6] transition ${currentTable === tb.id ? 'ring-2 ring-[#0095ff]' : ''}`;
        btn.dataset.id = tb.id;
        btn.innerHTML = `<i class="fa fa-chair text-lg text-[#241c3c]"></i>
          <span class="text-[10px] mt-0.5 text-[#241c3c]">${tb.name}</span>`;
        btn.onclick = () => {
          currentTable = tb.id;
          renderTables();
          renderOrder();
        };
        tableList.appendChild(btn);
      });
    }

    // Render danh sách món ăn
    function renderMenu() {
      const menuList = document.getElementById('menu-list');
      menuList.innerHTML = '';
      menu.forEach(item => {
        const card = document.createElement('div');
        card.className = 'menu-card bg-[#232344] rounded-lg p-2 flex flex-col items-center';
        card.innerHTML = `
          <img src="${item.img}" class="w-full h-24 object-cover rounded-md" />
          <div class="text-white mt-2 font-semibold text-sm">${item.name}</div>
          <div class="text-white text-xs mb-1">$${item.price.toFixed(2)}</div>
          <button class="add-menu-btn mt-1 px-3 py-1 rounded bg-[#ff7c09] text-white text-xs font-bold hover:bg-[#d76b0c]">Thêm</button>
        `;
        card.querySelector('.add-menu-btn').onclick = () => addToOrder(item.id);
        menuList.appendChild(card);
      });
    }

    // Render hóa đơn
    function renderOrder() {
      document.querySelectorAll('.bill-table-num').forEach(el => el.textContent = currentTable);
      const tbody = document.getElementById('bill-body');
      tbody.innerHTML = '';
      let total = 0;
      orders[currentTable].forEach((item, idx) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td class="p-1">${item.name}</td>
          <td class="p-1 text-center flex items-center justify-center gap-1">
            <button onclick="changeQty(${idx}, -1)" class="w-6 h-6 rounded-full bg-gray-700 text-white flex items-center justify-center hover:bg-gray-600">-</button>
            <span class="mx-1">${item.qty}</span>
            <button onclick="changeQty(${idx}, 1)" class="w-6 h-6 rounded-full bg-gray-700 text-white flex items-center justify-center hover:bg-gray-600">+</button>
          </td>
          <td class="p-1 text-right">$${item.price.toFixed(2)}</td>
          <td class="p-1 text-right">$${(item.price*item.qty).toFixed(2)}</td>
          <td class="p-1 text-center">
            <button onclick="removeItem(${idx})" class="text-red-400 hover:text-red-600"><i class="fa fa-times"></i></button>
          </td>
        `;
        tbody.appendChild(tr);
        total += item.price * item.qty;
      });
      document.getElementById('total-bill').textContent = `$${total.toLocaleString()}`;
    }

    // Thêm món vào bàn
    function addToOrder(menuId) {
      const menuItem = menu.find(m => m.id === menuId);
      let order = orders[currentTable];
      let found = order.find(i => i.id === menuId);
      if (found) {
        found.qty += 1;
      } else {
        order.push({ ...menuItem, qty: 1 });
      }
      renderOrder();
    }

    // Thay đổi số lượng món
    window.changeQty = function(idx, delta) {
      let order = orders[currentTable];
      if (!order[idx]) return;
      order[idx].qty += delta;
      if (order[idx].qty <= 0) order.splice(idx,1);
      renderOrder();
    }

    // Xóa món khỏi hóa đơn
    window.removeItem = function(idx) {
      let order = orders[currentTable];
      order.splice(idx,1);
      renderOrder();
    }

    // Khởi tạo
    renderTables();
    renderMenu();
    renderOrder();
  </script>
</body>
</html>
