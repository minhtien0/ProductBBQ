<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>LUA BE HOY</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'dark-bg': '#1a1a1a',
            'red-primary': '#e60012',
            'red-hover': '#cc0010',
            'gray-dark': '#333',
            'gray-darker': '#444',
            'gray-light': '#ccc',
            'main-red': '#e60012',
          },
          fontFamily: {
            mont: ['Montserrat', 'sans-serif'],
          }
        },
      },
    };
  </script>
</head>

<body class="font-mont">
  @include('layouts.user.header')

  <div class="relative w-full">
    <img src="img/banner1.jpg" alt="Cart" class="w-full h-[260px] md:h-[360px] object-cover">
    <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
    <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
      <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Giỏ Hàng</h1>
      <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
        <i class="fa fa-home text-white"></i>
        <a href="{{ route('views.index') }}"><span class="text-white">Trang Chủ</span></a>
        <span class="text-white">–</span>
        <span class="text-[#ff8000]">Giỏ Hàng</span>
      </div>
    </div>
  </div>

  <!-- Cart Table -->
  <div class="max-w-6xl mx-auto mt-6 px-2">
    <div class="overflow-x-auto bg-white rounded shadow">
      <table id="cart-table" class="min-w-full text-sm">
        <thead>
          <tr class="bg-orange-500 text-white">
            <th class="px-3 py-2 text-center">
              <input type="checkbox" id="check-all" class="form-checkbox h-4 w-4 text-orange-500">
            </th>
            <th class="px-3 py-2 text-left">Image</th>
            <th class="px-3 py-2 text-left">Details</th>
            <th class="px-3 py-2 text-left">Price</th>
            <th class="px-3 py-2 text-center">Quantity</th>
            <th class="px-3 py-2 text-left">Total</th>
            <th class="px-3 py-2 text-center">Remove</th>
          </tr>
        </thead>
        <tbody id="cart-items">
          @foreach ($carts as $cart)
            <tr data-id="{{ $cart->id_cart }}" class="border-b hover:bg-orange-50">
              <td class="px-3 py-2 text-center">
                <input type="checkbox" class="cart-checkbox form-checkbox h-4 w-4 text-orange-500" data-id="{{ $cart->id_cart }}">
              </td>
              <td class="px-3 py-2">
                <img src="{{ asset('img/' . $cart->image) }}" alt="{{ $cart->name }}"
                     class="w-16 h-16 object-cover rounded" />
              </td>
              <td class="px-3 py-2">
                <div class="font-bold text-gray-800">{{ $cart->name }}</div>
                <div class="text-xs text-gray-600">{{ $cart->type_menu }}</div>
              </td>
              <td class="px-3 py-2 text-left font-semibold price">
                {{ number_format($cart->price) }} VNĐ
              </td>
              <td class="px-3 py-2">
                <div class="flex items-center justify-center gap-2">
                  <button type="button"
                          class="btn-dec w-5 h-5 flex items-center justify-center bg-orange-500 text-white rounded-full hover:bg-orange-600 focus:outline-none"
                          title="Giảm số lượng">
                    <i class="fa fa-minus text-lg"></i>
                  </button>
                  <span class="qty mx-2 font-semibold">{{ $cart->quantity }}</span>
                  <button type="button"
                          class="btn-inc w-5 h-5 flex items-center justify-center bg-orange-500 text-white rounded-full hover:bg-orange-600 focus:outline-none"
                          title="Tăng số lượng">
                    <i class="fa fa-plus text-lg"></i>
                  </button>
                </div>
              </td>
              <td class="item-total text-left font-semibold">
                {{ number_format($cart->quantity * $cart->price) }} VNĐ
              </td>
              <td class="px-3 py-2 text-center">
                <button type="button" class="btn-remove text-xl text-orange-500 hover:text-red-600"
                        title="Xóa sản phẩm">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Cart summary & image -->
  <div class="max-w-6xl mx-auto mt-6 px-2 flex flex-col lg:flex-row gap-6">
    <div class="w-full lg:w-2/3">
      <img src="img/bannerfood2.jpg" alt="Cart Food"
           class="w-full h-48 md:h-60 object-cover rounded shadow" />
    </div>

    <!-- Chi tiết thanh toán -->
    <div class="w-full lg:w-1/3">
      <div class="bg-orange-50 rounded shadow px-5 py-4">
        <div id="selected-products-detail" class="mb-2"></div>
        <div class="font-bold text-gray-700 mb-3">
          Total Cart (<span id="cart-count">{{ $carts->count() }}</span>)
        </div>
        <div class="flex justify-between text-sm mb-1">
          <span>Subtotal:</span>
          <span id="cart-total">{{ number_format($initialCartTotal) }} VNĐ</span>
        </div>
        <div class="flex justify-between text-sm mb-1">
          <span>Delivery:</span> <span id="delivery">$10.00</span>
        </div>
        <div class="flex justify-between text-sm mb-1">
          <span>Discount:</span> <span id="discount">$10.00</span>
        </div>
        <div class="flex justify-between text-base font-bold mb-3">
          <span>Total:</span> <span id="total">{{ number_format($initialCartTotal) }} VNĐ</span>
        </div>
        <div class="flex mb-3">
          <input type="text" placeholder="Coupon Code"
                 class="flex-1 border rounded-l px-3 py-2 focus:outline-none text-sm" />
          <button class="bg-orange-500 text-white rounded-r px-5 py-2 font-semibold">
            Apply
          </button>
        </div>
        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded">
          Checkout
        </button>
      </div>
    </div>
  </div>

  @include('layouts.user.footer')

<script>
document.addEventListener('DOMContentLoaded', () => {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  const fmt       = n => new Intl.NumberFormat('vi-VN').format(n) + ' VNĐ';
  const tbody     = document.getElementById('cart-items');
  const base      = "{{ url('cart') }}";  

  tbody.addEventListener('click', async e => {
    // Cộng/trừ/xóa vẫn giữ nguyên
    const incBtn = e.target.closest('.btn-inc');
    const decBtn = e.target.closest('.btn-dec');
    const rmBtn  = e.target.closest('.btn-remove');
    if (!incBtn && !decBtn && !rmBtn) return;

    e.preventDefault();

    const tr  = e.target.closest('tr[data-id]');
    const id  = tr.dataset.id;
    const url = rmBtn
      ? `${base}/${id}`                       // DELETE
      : `{{ url('cart') }}/${id}`;           // PATCH

    try {
      const res = await fetch(url, {
        method: rmBtn ? 'DELETE' : 'PATCH',
        headers: {
          'Content-Type':     'application/json',
          'Accept':           'application/json',
          'X-CSRF-TOKEN':     csrfToken,
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: rmBtn ? null : JSON.stringify({ action: incBtn ? 'increment' : 'decrement' })
      });
      const data = await res.json();
      if (!data.success) throw new Error(data.message);

      // Cập nhật DOM
      if (rmBtn || data.removed) {
        tr.remove();
      } else {
        tr.querySelector('.qty').textContent        = data.quantity;
        tr.querySelector('.item-total').textContent = fmt(data.itemTotal);
      }
      document.getElementById('cart-total').textContent = fmt(data.cartTotal);
      document.getElementById('cart-count').textContent =
        document.querySelectorAll('#cart-items tr').length;

      setTimeout(updateSelectedDetail, 100);

    } catch (err) {
      console.error(err);
      alert(err.message);
    }
  });

  // --- Selected detail logic (checkbox) ---
  const checkAll  = document.getElementById('check-all');
  const summary   = document.getElementById('selected-products-detail');
  const totalEl   = document.getElementById('total');

  function parseCartRow(tr) {
    return {
      id: tr.dataset.id,
      name: tr.querySelector('td:nth-child(3) .font-bold').textContent,
      price: parseInt(tr.querySelector('td.price').textContent.replace(/\D/g,'')),
      quantity: parseInt(tr.querySelector('.qty').textContent),
      total: parseInt(tr.querySelector('.item-total').textContent.replace(/\D/g,'')),
    };
  }

  function updateSelectedDetail() {
    const checkedRows = Array.from(document.querySelectorAll('.cart-checkbox:checked'))
      .map(cb => cb.closest('tr[data-id]'))
      .filter(Boolean);

    let html = '';
    let total = 0;
    if (checkedRows.length === 0) {
      html = '<div class="text-gray-400 italic text-sm">Chưa chọn sản phẩm nào.</div>';
    } else {
      html += '<div class="font-semibold mb-2 text-orange-500">Sản phẩm đã chọn:</div>';
      html += '<div class="divide-y">';
      checkedRows.forEach(tr => {
        const cart = parseCartRow(tr);
        total += cart.total;
        html += `
          <div class="flex items-center justify-between py-1">
            <span>${cart.name} x <b>${cart.quantity}</b></span>
            <span class="font-bold text-gray-800">${cart.total.toLocaleString()} VNĐ</span>
          </div>
        `;
      });
      html += '</div>';
    }
    summary.innerHTML = html;
    totalEl.textContent = total.toLocaleString() + ' VNĐ';
  }

  // Gắn sự kiện change cho từng checkbox (bắt buộc dùng delegation để không bị miss do DOM động)
  tbody.addEventListener('change', function(e) {
    if (e.target.classList.contains('cart-checkbox')) {
      // Nếu bỏ check một cái thì bỏ luôn checkall
      if (!e.target.checked) checkAll.checked = false;
      // Nếu tất cả đều check thì check luôn checkall
      else if (document.querySelectorAll('.cart-checkbox:checked').length === document.querySelectorAll('.cart-checkbox').length) {
        checkAll.checked = true;
      }
      updateSelectedDetail();
    }
  });

  // Check all
  checkAll.addEventListener('change', function() {
    document.querySelectorAll('.cart-checkbox').forEach(cb => {
      cb.checked = checkAll.checked;
    });
    updateSelectedDetail();
  });

  // Số lượng/cộng/trừ/xóa thì update luôn chi tiết
  tbody.addEventListener('click', function(e) {
    setTimeout(updateSelectedDetail, 200);
  });

  // Gọi cập nhật lần đầu
  updateSelectedDetail();

  // Đảm bảo checkall đúng trạng thái nếu load lại có tick trước đó
  if(document.querySelectorAll('.cart-checkbox:checked').length === document.querySelectorAll('.cart-checkbox').length && document.querySelectorAll('.cart-checkbox').length !== 0){
    checkAll.checked = true;
  }
});
</script>

</body>
</html>
