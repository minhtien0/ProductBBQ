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
  <x-notification-popup />
  <script src="{{ asset('js/notification.js') }}"></script>
</head>

<body class="font-mont" @if(session('success')) data-success="{{ session('success') }}" @elseif(session('error'))
  data-error="{{ session('error') }}" @endif>
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

  <form action="{{ route('order.store') }}" method="POST" id="orderForm">
    @csrf

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
          <tr data-id="{{ $cart->id_cart }}" data-product-id="{{ $cart->food_id ?? $cart->combo_id }}"
            data-combo-id="{{ $cart->combo_id }}" class="cart-row"
            data-food-price="{{ $cart->food_price ?? $cart->combo_price }}" class="border-b hover:bg-orange-50">
            <td class="px-3 py-2 text-center">
            <input type="checkbox" class="cart-checkbox form-checkbox h-4 w-4 text-orange-500"
              data-id="{{ $cart->id_cart }}" @if(isset($cart->food_status) && $cart->food_status == 'Hết Hàng')
          disabled @endif>
            </td>
            @if (empty($cart->combo_id))
          <td class="px-3 py-2">

          <img src="{{ asset('img/' . $cart->food_image) }}" alt="{{ $cart->food_name }}"
          class="w-16 h-16 object-cover rounded @if($cart->food_status == 'Hết Hàng') opacity-60 grayscale @endif" />
          </td>
          <td class="px-3 py-2">
          <div class="font-bold text-gray-800">{{ $cart->food_name }}</div>
          <div class="text-xs text-gray-600">{{ $cart->type_menu }}</div>
          </td>
          <td class="px-3 py-2 text-left font-semibold price">
          {{ number_format($cart->food_price) }} VNĐ
          </td>
        @else
          <td class="px-3 py-2">

          <img src="{{ asset('img/combo/' . $cart->combo_image) }}" alt="{{ $cart->combo_name }}"
          class="w-16 h-16 object-cover rounded" />
          </td>
          <td class="px-3 py-2">
          <div class="font-bold text-gray-800">{{ $cart->combo_name }}</div>
          <div class="text-xs text-gray-600">{{ $cart->combo_code }}</div>
          </td>
          <td class="px-3 py-2 text-left font-semibold price">
          {{ number_format($cart->combo_price) }} VNĐ
          </td>
        @endif
            <td class="px-3 py-2">
            <div class="flex items-center justify-center gap-2">
              <button type="button"
              class="btn-dec w-5 h-5 flex items-center justify-center bg-orange-500 text-white rounded-full hover:bg-orange-600 focus:outline-none"
              title="Giảm số lượng">
              <i class="fa fa-minus text-lg"></i>
              </button>
              <span class="qty mx-2 font-semibold">{{ $cart->quantity_cart }}</span>
              <button type="button"
              class="btn-inc w-5 h-5 flex items-center justify-center bg-orange-500 text-white rounded-full hover:bg-orange-600 focus:outline-none"
              title="Tăng số lượng">
              <i class="fa fa-plus text-lg"></i>
              </button>
            </div>
            </td>
            @if (empty($cart->combo_id))
          <td class="item-total text-left font-semibold total-price">
          {{ number_format($cart->quantity_cart * $cart->food_price) }} VNĐ
          </td>
        @else
          <td class="item-total text-left font-semibold total-price">
          {{ number_format($cart->quantity_cart * $cart->combo_price) }} VNĐ
          </td>
        @endif
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
    <!-- gioi han mon dat -->


    <!-- Cart summary & form -->
    <div class="max-w-6xl mx-auto mt-6 px-2 flex flex-col lg:flex-row gap-6">
      <div class="w-full lg:w-1/2">
        <img src="{{ asset('img/giphy.webp') }}" alt="Cart Food"
          class="w-full h-48 md:h-60 object-cover rounded shadow" />
        <img src="{{ asset('img/penguin-pudgy.gif') }}" alt="Cart Food"
          class="w-full h-48 md:h-60 object-cover rounded shadow" />
      </div>

      <div class="w-full lg:w-2/3">
        <div class="bg-orange-50 rounded shadow px-5 py-4">
          <!-- Danh sách sản phẩm đã chọn -->
          <div id="selected-products-detail" class="mb-2 max-h-48 overflow-y-auto"></div>
          <!-- Hidden inputs để gửi danh sách sản phẩm -->
          <div id="selected-products-hidden" class="mb-2"></div>
          <hr>
          <div class="flex justify-between text-base font-bold mb-3 mt-2">
            <span>Tổng Tiền Món Ăn:</span> <span id="total"></span>
            <input type="hidden" id="totalprice" name="totalprice" value="0">
          </div>
          <hr>
          <div class="font-bold  text-orange-500 mb-3">
            Chi Tiết Thanh Toán
          </div>
          <div class="flex justify-between text-sm mb-2">
            <span>Khuyến Mãi:</span>
            <span id="discount"></span>
          </div>
          <hr>
          <div class="flex justify-between text-sm mb-2 mt-2">
            <span>Phí Vẫn Chuyển:</span> <span id="delivery">30.000 VNĐ</span>
          </div>
          <hr>
          <div class="flex justify-between text-base font-bold mb-3 mt-2">
            <span>Tổng Tiền Hóa Đơn:</span> <span id="totalbill"></span>
            <input type="hidden" id="totalbillinput" name="totalbill" value="0">
          </div>
          <!-- … phần trên giữ nguyên … -->

          <div class="flex flex-col text-sm mb-2">
            <label for="voucher">Khuyến Mãi:</label><span class="text-red-500">(Lưu ý: Bill Cao Voucher Xịn <i
                class="fa-solid fa-face-kiss-wink-heart"></i>)</span>
            <select name="voucher_id" id="voucher" class="border rounded p-1">
              <option value="" data-value="0">-- Chọn Voucher --</option>
              @foreach ($vouchers as $voucher)
          <option value="{{ $voucher->id }}" data-value="{{ $voucher->value }}" class="voucher-option">
          {{ $voucher->code }} – {{ number_format($voucher->value, 0, ',', '.') }} VNĐ
          (Hết hạn ngày {{ \Carbon\Carbon::parse($voucher->time_end)->format('d/m/Y') }})
          </option>
        @endforeach
            </select>
          </div>

          <!-- … phần dưới giữ nguyên … -->

          <hr>
          <div class="flex flex-col text-sm mb-2 mt-2">
            <label for="address">Địa Chỉ:</label>
            <select name="address_id" id="address" class="border rounded p-1" required>
              @if($addressUsers->count())
            @foreach ($addressUsers as $addressUser)
          <option value="{{ $addressUser->id }}">
          {{ $addressUser->house_number }}, {{ $addressUser->ward }},
          {{ $addressUser->district }}, {{ $addressUser->city }}
          </option>
        @endforeach
        @else
          <option value="">Vui lòng thêm địa chỉ ở Profile!</option>
        @endif
            </select>
          </div>
          <hr>

          <div class="flex flex-col text-sm mb-4 mt-2">
            <label class="mb-2 font-medium">Thanh Toán:</label>
            <label class="inline-flex items-center mb-1">
              <input type="radio" name="typepayment" value="1" class="form-checkbox text-orange-500 mr-2" required>
              Tiền mặt
            </label>
            <label class="inline-flex items-center">
              <input type="radio" name="typepayment" value="2" class="form-checkbox text-orange-500 mr-2" required>
              Chuyển khoản
            </label>
          </div>

          <div class="flex flex-col text-sm mb-4 mt-2">
            <label class="mb-2 font-medium">Ghi Chú:</label>
            <textarea name="note" id="note" class="border rounded p-1"></textarea>
          </div>

          <!-- Nút Thanh Toán: chuyển sang type="button" để mở popup -->
          <button type="button" onclick="openPopupComfirm('Bạn muốn thanh toán ngay bây giờ?')"
            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded">
            Thanh Toán
          </button>

          <!-- Popup -->
          <!-- Popup xác nhận -->
          <div id="PopupComfirm"
            class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50 hidden p-4">
            <div
              class="bg-white w-full max-w-md min-w-[340px] rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
              <!-- Header -->
              <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                      <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-white">Thông báo</h2>
                  </div>
                  <button type="button" onclick="closePopupComfirm()"
                    class="text-white/80 hover:text-white hover:bg-white/20 rounded-full p-1 transition-colors duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                      </path>
                    </svg>
                  </button>
                </div>
              </div>
              <!-- Content -->
              <div class="px-6 py-8 text-center">
                <div
                  class="w-16 h-16 bg-gradient-to-br from-yellow-100 to-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                  <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <div id="PopupComfirmBody" class="text-gray-700 text-base leading-relaxed mb-8"></div>
                <div class="flex justify-between space-x-4">
                  <button type="button" onclick="submitOrderForm()"
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-teal-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Xác nhận
                  </button>
                  <button type="button" onclick="closePopupComfirm()"
                    class="flex-1 px-6 py-3 bg-gradient-to-r from-gray-300 to-gray-400 text-gray-800 font-semibold rounded-lg hover:from-gray-400 hover:to-gray-500 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Đóng
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- End Popup -->
          <!-- Popup thông báo -->
          <div id="PopupMessage"
  class="fixed inset-0 z-[10000] flex items-center justify-center bg-black/40 backdrop-blur-sm hidden p-4">
  <div class="w-full max-w-md rounded-2xl shadow-2xl border border-white/80 overflow-hidden bg-white" style="min-width:340px;">
    <div id="PopupMessageHeader"
      class="bg-gradient-to-r from-[#2196f3] to-[#9C27B0] px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div id="PopupMessageIcon" class="w-7 h-7 bg-white/20 rounded-full flex items-center justify-center"></div>
        <h2 id="PopupMessageTitle" class="text-lg font-semibold text-white">Thông báo</h2>
      </div>
      <button type="button" onclick="closePopupMessage()"
        class="text-white/90 hover:bg-white/10 rounded-full p-1 transition duration-150">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <div class="px-8 py-7 text-center">
      <div class="flex justify-center mb-5" id="PopupMessageMainIcon"></div>
      <div id="PopupMessageBody" class="mb-8 text-lg font-medium text-gray-800"></div>
      <div class="flex justify-center">
        <button type="button" onclick="closePopupMessage()"
          class="w-1/2 py-3 rounded-lg font-bold text-white shadow-md transition bg-gradient-to-r from-[#2196f3] to-[#009688] hover:from-[#1565c0] hover:to-[#43a047]">
          Đóng
        </button>
      </div>
    </div>
  </div>
</div>

        </div>
      </div>
    </div>
  </form>
  <script>
    function openPopupComfirm(message) {
      document.getElementById('PopupComfirmBody').textContent = message;
      document.getElementById('PopupComfirm').classList.remove('hidden');
    }
    function closePopupComfirm() {
      document.getElementById('PopupComfirm').classList.add('hidden');
    }


function showPopupMessage(type, message, reload = false) {
  // Chuẩn bị biến UI
  let headerClass = "bg-gradient-to-r from-[#2196f3] to-[#9C27B0] px-6 py-4 flex items-center justify-between";
  let iconHtml = `<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16v-4m0-4h.01"></path>
  </svg>`;
  let mainIcon = `<div class="w-14 h-14 bg-gradient-to-br from-[#e0f7fa] to-[#f3e5f5] rounded-full flex items-center justify-center shadow mx-auto">
    <svg class="w-8 h-8 text-[#2196f3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 16v-4m0-4h.01"></path>
    </svg>
  </div>`;
  let title = 'Thông báo';

  if (type === 'success') {
    headerClass = "bg-gradient-to-r from-[#43e97b] to-[#38f9d7] px-6 py-4 flex items-center justify-between";
    iconHtml = `<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"></circle><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path></svg>`;
    mainIcon = `<div class="w-14 h-14 bg-gradient-to-br from-[#e0ffe8] to-[#c8fff4] rounded-full flex items-center justify-center shadow mx-auto">
      <svg class="w-8 h-8 text-[#43e97b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
      </svg>
    </div>`;
    title = 'Thành công';
  }
  if (type === 'error') {
    headerClass = "bg-gradient-to-r from-[#ef5350] to-[#9C27B0] px-6 py-4 flex items-center justify-between";
    iconHtml = `<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"></circle><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6M9 9l6 6"></path></svg>`;
    mainIcon = `<div class="w-14 h-14 bg-gradient-to-br from-[#ffebee] to-[#ede7f6] rounded-full flex items-center justify-center shadow mx-auto">
      <svg class="w-8 h-8 text-[#ef5350]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9l-6 6M9 9l6 6"></path>
      </svg>
    </div>`;
    title = 'Lỗi';
  }
  // Đặt lại UI
  document.getElementById('PopupMessageHeader').className = headerClass;
  document.getElementById('PopupMessageIcon').innerHTML = iconHtml;
  document.getElementById('PopupMessageTitle').textContent = title;
  document.getElementById('PopupMessageMainIcon').innerHTML = mainIcon;
  document.getElementById('PopupMessageBody').innerHTML = message;
  document.getElementById('PopupMessage').classList.remove('hidden');

  // Đóng và reload nếu cần
  if (reload) {
    document.querySelectorAll('#PopupMessage button, #PopupMessage [onclick="closePopupMessage()"]').forEach(btn => {
      btn.onclick = function () {
        closePopupMessage();
        location.reload();
      }
    });
  } else {
    document.querySelectorAll('#PopupMessage button, #PopupMessage [onclick="closePopupMessage()"]').forEach(btn => {
      btn.onclick = function () {
        closePopupMessage();
      }
    });
  }
}
function closePopupMessage() {
  document.getElementById('PopupMessage').classList.add('hidden');
}

    async function submitOrderForm() {
  const form = document.getElementById('orderForm');
  const url  = form.action;
  const fd   = new FormData(form);
  const btn  = document.querySelector('#PopupComfirm button[onclick="submitOrderForm()"]');
  btn.disabled = true;

  try {
    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      },
      body: fd,
      credentials: 'same-origin'
    });
    const data = await res.json();
    if (!res.ok) throw data;

    if (data.redirect) {
      window.location.href = data.redirect;
      return;
    }
    closePopupComfirm();
    showPopupMessage('success', data.message || 'Đặt hàng thành công!', true);
  } catch (err) {
    let msg = '';
    if (err.errors) {
      for (let f in err.errors) {
        msg = err.errors[f][0];
        break;
      }
    }
    if (err.message && !msg) msg = err.message;
    if (!msg) msg = 'Có lỗi xảy ra, vui lòng thử lại!';
    closePopupComfirm();
    showPopupMessage('error', msg);
  } finally {
    btn.disabled = false;
  }
}
  </script>

  <script>

    document.addEventListener('DOMContentLoaded', () => {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
      const fmt = n => new Intl.NumberFormat('vi-VN').format(n) + ' VNĐ';
      const tbody = document.getElementById('cart-items');
      const base = "{{ url('cart') }}";
      const discountEl = document.getElementById('discount');
      const deliveryEl = document.getElementById('delivery');
      const voucherSelect = document.getElementById('voucher');
      const allVoucherOptions = Array.from(voucherSelect.options)
        .filter(opt => opt.value !== "");
      const voucherDefaultOption = voucherSelect.querySelector('option[value=""]').outerHTML;
      const totalEl = document.getElementById('total');
      const totalBillEl = document.getElementById('totalbill');
      const totalPriceInput = document.getElementById('totalprice');
      const totalBillInput = document.getElementById('totalbillinput');
      const hiddenDiv = document.getElementById('selected-products-hidden');
      let selectedDiscount = 0;
      let delivery = parseInt(deliveryEl.textContent.replace(/\D/g, '')) || 0;

      // Sự kiện tăng giảm/xóa sản phẩm
      tbody.addEventListener('click', async e => {
        const incBtn = e.target.closest('.btn-inc');
        const decBtn = e.target.closest('.btn-dec');
        const rmBtn = e.target.closest('.btn-remove');
        if (!incBtn && !decBtn && !rmBtn) return;
        e.preventDefault();

        const tr = e.target.closest('tr[data-id]');
        const qtySpan = tr.querySelector('.qty');
        let currentQty = parseInt(qtySpan.textContent);

        // Giới hạn số lượng tăng/giảm
        if (incBtn && currentQty >= 20) {
          showPopup("Bạn chỉ có thể đặt tối đa 20 món cho mỗi sản phẩm!");
          return;
        }
        if (decBtn && currentQty <= 1) {
          showPopup("Số lượng tối thiểu là 1.");
          return;
        }

        const id = tr.dataset.id;
        const url = rmBtn
          ? `${base}/${id}`
          : `{{ url('cart') }}/${id}`;
        try {
          const res = await fetch(url, {
            method: rmBtn ? 'DELETE' : 'PATCH',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: rmBtn ? null : JSON.stringify({ action: incBtn ? 'increment' : 'decrement' })
          });
          const data = await res.json();
          if (!data.success) throw new Error(data.message);

          if (rmBtn || data.removed) {
            tr.remove();
          } else {
            qtySpan.textContent = data.quantity;
            tr.querySelector('.item-total').textContent = fmt(data.itemTotal);
            const btnInc = tr.querySelector('.btn-inc');
            const btnDec = tr.querySelector('.btn-dec');
            btnInc.disabled = data.quantity >= 20;
            btnDec.disabled = data.quantity <= 1;
          }
          setTimeout(updateSelectedDetail, 100);
        } catch (err) {
          console.error(err);
          alert(err.message);
        }
      });



      // Checkbox chọn sản phẩm
      const checkAll = document.getElementById('check-all');
      const summary = document.getElementById('selected-products-detail');

      // Ẩn/hiện nút tăng/giảm số lượng ở tất cả dòng khi trang vừa load
      tbody.querySelectorAll('tr[data-id]').forEach(tr => {
        const qty = parseInt(tr.querySelector('.qty').textContent);
        const btnInc = tr.querySelector('.btn-inc');
        const btnDec = tr.querySelector('.btn-dec');
        btnInc.disabled = qty >= 20;
        btnDec.disabled = qty <= 1;
      });


      function parseCartRow(tr) {
        return {
          id: tr.dataset.id,
          product_id: tr.getAttribute('data-product-id'),
          is_combo: !!tr.getAttribute('data-combo-id'),
          combo_id: tr.getAttribute('data-combo-id'),
          name: tr.querySelector('td:nth-child(3) .font-bold').textContent,
          price: parseInt(tr.querySelector('td.price').textContent.replace(/\D/g, '')),
          quantity: parseInt(tr.querySelector('.qty').textContent),
          total: parseInt(tr.querySelector('.item-total').textContent.replace(/\D/g, '')),
        };
      }

      function updateSelectedDetail() {
        let prevVoucherValue = voucherSelect.value;
        const checkedRows = Array.from(document.querySelectorAll('.cart-checkbox:checked'))
          .map(cb => cb.closest('tr[data-id]'))
          .filter(Boolean);

        let html = '';
        let total = 0;
        hiddenDiv.innerHTML = '';

        if (checkedRows.length === 0) {
          html = '<div class="text-gray-400 italic text-sm">Chưa chọn sản phẩm nào.</div>';
        } else {
          html += '<div class="font-bold mb-2 text-orange-500">Sản phẩm Đã Chọn:</div>';
          html += '<div class="divide-y">';
          checkedRows.forEach(tr => {
            const cart = parseCartRow(tr);
            total += cart.total;
            console.log(cart);
            // Ẩn input để gửi product_id & quantity
            hiddenDiv.innerHTML += `
  <input type="hidden" name="products[${cart.is_combo ? 'combo_' + cart.combo_id : 'food_' + cart.product_id}][id]" value="${cart.is_combo ? cart.combo_id : cart.product_id}">
  <input type="hidden" name="products[${cart.is_combo ? 'combo_' + cart.combo_id : 'food_' + cart.product_id}][quantity]" value="${cart.quantity}">
  <input type="hidden" name="products[${cart.is_combo ? 'combo_' + cart.combo_id : 'food_' + cart.product_id}][type]" value="${cart.is_combo ? 'combo' : 'food'}">
`;
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
        totalPriceInput.value = total; // hidden input cho tổng tiền món

        const maxVoucherValue = Math.floor(total * 0.1);

        let hasValidVoucher = false;
        voucherSelect.innerHTML = voucherDefaultOption + allVoucherOptions.map(opt => {
          const value = parseInt(opt.getAttribute('data-value')) || 0;
          if (value <= maxVoucherValue && total > 0) {
            // Còn hợp lệ mới giữ lại
            if (voucherSelect.value == opt.value) hasValidVoucher = true;
            return opt.outerHTML;
          }
          return '';
        }).join('');
                if (prevVoucherValue && voucherSelect.querySelector('option[value="' + prevVoucherValue + '"]')) {
    voucherSelect.value = prevVoucherValue;
    selectedDiscount = parseInt(voucherSelect.selectedOptions[0].getAttribute('data-value')) || 0;
    discountEl.textContent = selectedDiscount.toLocaleString() + ' VNĐ';
  } else {
    voucherSelect.value = '';
    selectedDiscount = 0;
    discountEl.textContent = "0 VNĐ";
  }
        // Tính lại totalbill
        const bill = Math.max(total - selectedDiscount + delivery, 0);
        totalBillEl.textContent = bill.toLocaleString() + ' VNĐ';
        totalBillInput.value = bill;
      }

      // Gắn sự kiện change cho từng checkbox (delegation)
      tbody.addEventListener('change', function (e) {
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
      checkAll.addEventListener('change', function () {
        document.querySelectorAll('.cart-checkbox:not(:disabled)').forEach(cb => {
          cb.checked = checkAll.checked;
        });
        updateSelectedDetail();
      });

      // Số lượng/cộng/trừ/xóa thì update luôn chi tiết
      tbody.addEventListener('click', function (e) {
        setTimeout(updateSelectedDetail, 200);
      });

      // Xử lý voucher select
      voucherSelect.addEventListener('change', function () {
        const selectedOption = voucherSelect.options[voucherSelect.selectedIndex];
        selectedDiscount = parseInt(selectedOption.getAttribute('data-value')) || 0;
        discountEl.textContent = selectedDiscount.toLocaleString() + ' VNĐ';
        updateSelectedDetail();
      });

      // Gọi cập nhật lần đầu
      discountEl.textContent = "0 VNĐ";
      updateSelectedDetail();

      // Đảm bảo checkall đúng trạng thái nếu load lại có tick trước đó
      if (document.querySelectorAll('.cart-checkbox:checked').length === document.querySelectorAll('.cart-checkbox').length && document.querySelectorAll('.cart-checkbox').length !== 0) {
        checkAll.checked = true;
      }
    });
  </script>
  @include('layouts.user.footer')

</body>

</html>