<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            'main-red': '#ff7c09',
            'main-red':'#e60012',
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
        <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
        <img src="img/banner1.jpg" alt="Cart" class="w-full h-[260px] md:h-[360px] object-cover">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
        <!-- Content -->
        <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
            <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">Cart</h1>
            <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
                <i class="fa fa-home text-white"></i>
                <a href="{{ route('views.index') }}"><span class="text-white">Home</span></a>
                <span class="text-white">–</span>
                <span class="text-[#ff8000]">Cart</span>
            </div>
        </div>
    </div>
  <!-- Cart Table -->
  <div class="max-w-6xl mx-auto mt-6 px-2">
    <div class="overflow-x-auto bg-white rounded shadow">
      <table class="min-w-full text-sm" id="cart-table">
        <thead>
          <tr class="bg-orange-500 text-white">
            <th class="px-3 py-2 text-left">Image</th>
            <th class="px-3 py-2 text-left">Details</th>
            <th class="px-3 py-2 text-right">Price</th>
            <th class="px-3 py-2 text-center">Quantity</th>
            <th class="px-3 py-2 text-right">Total</th>
            <th class="px-3 py-2 text-center">Remove</th>
          </tr>
        </thead>
        <tbody id="cart-items">
          <!-- Example item 1 -->
          <tr data-id="1" class="border-b hover:bg-orange-50">
            <td class="px-3 py-2">
              <img src="img/danhmuc1/suonxe.jpg" alt="Hyderabad Biryani"
                   class="w-16 h-16 object-cover rounded"/>
            </td>
            <td class="px-3 py-2">
              <div class="font-bold text-gray-800">Hyderabad Biryani</div>
              <div class="text-xs text-gray-600">Medium</div>
              <div class="text-xs text-gray-400">Coca-Cola, 7up</div>
            </td>
            <td class="px-3 py-2 text-right font-semibold price">180.00</td>
            <td class="px-3 py-2">
              <div class="flex items-center justify-center gap-2">
                <button class="btn-dec w-7 h-7 bg-orange-500 text-white rounded-full flex items-center justify-center">-</button>
                <span class="min-w-[18px] text-center qty">1</span>
                <button class="btn-inc w-7 h-7 bg-orange-500 text-white rounded-full flex items-center justify-center">+</button>
              </div>
            </td>
            <td class="px-3 py-2 text-right font-semibold item-total">180.00</td>
            <td class="px-3 py-2 text-center">
              <button class="btn-remove text-xl text-orange-500 hover:text-red-600"><i class="fa fa-times"></i></button>
            </td>
          </tr>
          <!-- Example item 2 -->
          <tr data-id="2" class="border-b hover:bg-orange-50">
            <td class="px-3 py-2">
              <img src="img/danhmuc1/burger.jpg" alt="Chicken Masala"
                   class="w-16 h-16 object-cover rounded"/>
            </td>
            <td class="px-3 py-2">
              <div class="font-bold text-gray-800">Chicken Masala</div>
              <div class="text-xs text-gray-600">Small</div>
            </td>
            <td class="px-3 py-2 text-right font-semibold price">140.00</td>
            <td class="px-3 py-2">
              <div class="flex items-center justify-center gap-2">
                <button class="btn-dec w-7 h-7 bg-orange-500 text-white rounded-full flex items-center justify-center">-</button>
                <span class="min-w-[18px] text-center qty">1</span>
                <button class="btn-inc w-7 h-7 bg-orange-500 text-white rounded-full flex items-center justify-center">+</button>
              </div>
            </td>
            <td class="px-3 py-2 text-right font-semibold item-total">140.00</td>
            <td class="px-3 py-2 text-center">
              <button class="btn-remove text-xl text-orange-500 hover:text-red-600"><i class="fa fa-times"></i></button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Cart summary & image -->
  <div class="max-w-6xl mx-auto mt-6 px-2 flex flex-col lg:flex-row gap-6">
    <!-- Cart image -->
    <div class="w-full lg:w-2/3">
      <img src="img/bannerfood2.jpg"
           class="w-full h-48 md:h-60 object-cover rounded shadow"
           alt="Cart Food"/>
    </div>
    <!-- Summary box -->
    <div class="w-full lg:w-1/3">
      <div class="bg-orange-50 rounded shadow px-5 py-4">
        <div class="font-bold text-gray-700 mb-3">Total Cart (<span id="cart-count">2</span>)</div>
        <div class="flex justify-between text-sm mb-1"><span>Subtotal:</span> <span id="subtotal">$320.00</span></div>
        <div class="flex justify-between text-sm mb-1"><span>Delivery:</span> <span id="delivery">$10.00</span></div>
        <div class="flex justify-between text-sm mb-1"><span>Discount:</span> <span id="discount">$10.00</span></div>
        <div class="flex justify-between text-base font-bold mb-3"><span>Total:</span> <span id="total">$320.00</span></div>
        <div class="flex mb-3">
          <input type="text" placeholder="Coupon Code"
                 class="flex-1 border rounded-l px-3 py-2 focus:outline-none text-sm"/>
          <button class="bg-orange-500 text-white rounded-r px-5 py-2 font-semibold">Apply</button>
        </div>
        <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded">Checkout</button>
      </div>
    </div>
  </div>
</div>

<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

<script>
document.addEventListener('DOMContentLoaded', function () {
  function updateTotals() {
    let subtotal = 0;
    let count = 0;
    document.querySelectorAll('#cart-items tr').forEach(row => {
      const price = parseFloat(row.querySelector('.price').innerText);
      const qty = parseInt(row.querySelector('.qty').innerText);
      const itemTotal = row.querySelector('.item-total');
      itemTotal.innerText = (price * qty).toFixed(2);
      subtotal += price * qty;
      count += qty;
    });
    document.getElementById('subtotal').innerText = `$${subtotal.toFixed(2)}`;
    document.getElementById('cart-count').innerText = count;
    // Cập nhật total có delivery, discount
    let delivery = 10, discount = 10;
    let total = subtotal + delivery - discount;
    if (subtotal === 0) total = 0;
    document.getElementById('delivery').innerText = `$${delivery.toFixed(2)}`;
    document.getElementById('discount').innerText = `$${discount.toFixed(2)}`;
    document.getElementById('total').innerText = `$${total.toFixed(2)}`;
  }

  document.querySelectorAll('.btn-inc').forEach(btn => {
    btn.addEventListener('click', function () {
      const qtySpan = this.parentElement.querySelector('.qty');
      qtySpan.innerText = parseInt(qtySpan.innerText) + 1;
      updateTotals();
    });
  });
  document.querySelectorAll('.btn-dec').forEach(btn => {
    btn.addEventListener('click', function () {
      const qtySpan = this.parentElement.querySelector('.qty');
      let current = parseInt(qtySpan.innerText);
      if (current > 1) qtySpan.innerText = current - 1;
      updateTotals();
    });
  });
  document.querySelectorAll('.btn-remove').forEach(btn => {
    btn.addEventListener('click', function () {
      this.closest('tr').remove();
      updateTotals();
    });
  });
  // Cập nhật lần đầu khi tải trang
  updateTotals();
});
</script>
@include('layouts.user.footer')
</body>
</html>