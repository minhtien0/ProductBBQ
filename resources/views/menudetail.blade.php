<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LUA BE HOY</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
          },
          fontFamily: {
            mont: ['Montserrat', 'sans-serif'],
          }
        },
      },
    };
  </script>
</head>
@include('layouts.user.header')

<body class="font-mont bg-gray-light">
  <div class="relative w-full">

    <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
    <img src="{{ asset('img/banner1.jpg') }}" alt="Menu Detail" class="w-full h-[260px] md:h-[360px] object-cover">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
    <!-- Content -->
    <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
      <h1 class="text-white font-extrabold text-4xl md:text-5xl mb-4">Chi Tiết Thực Đơn</h1>
      <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
        <i class="fa fa-home text-white"></i>
        <a href="{{ route('views.index') }}"><span class="text-white">Trang Chủ</span></a>
        <span class="text-white">–</span>
        <span class="text-[#ff8000]">Chi Tiết Món </span>
      </div>
    </div>
  </div>
  <!-- PHẦN 1: BBQ Menu Detail -->
  <div class="bg-gray-light from-red-100 via-red to-white min-h-[220px] py-8 px-4 ">
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg p-8 -mt-4 relative z-10">
      <div class="flex flex-col md:flex-row gap-8">
        <!-- Ảnh lớn và thumbnail -->
        <div class="md:w-1/3 flex flex-col">
          <img id="main-img" src="{{ asset('img/' . $foods->image) }}"
            class="rounded-lg w-full h-[220px] object-cover mb-4 border-2 border-orange-400" />
          <div class="flex gap-2">
            @foreach ($detailImages as $detailImage)
        <img onclick="document.getElementById('main-img').src=this.src"
          src="{{ asset('img/details/food/' . $detailImage->img) }}"
          class="w-14 h-14 rounded-lg object-cover border-2 border-orange-200 cursor-pointer hover:border-orange-500 transition" />
      @endforeach
          </div>
        </div>
        <!-- Chi tiết món ăn -->
        <div class="md:w-2/3">
          <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $foods->name }} ({{ $foods->quantity }})</h2>
          <div class="flex items-center gap-3 mb-2">
            <span class="text-xl font-bold text-orange-600">
              {{ number_format($foods->price, 0, ',', '.') }}đ
            </span>
            <span
              class="text-xs bg-orange-100 text-orange-500 rounded px-2 py-0.5 font-semibold">{{ $foods->menus->name }}
            </span>
            <div class="flex items-center">
              <span class="text-yellow-400 font-semibold text-lg">
                {{ number_format($averageRate, 1) }}
              </span>
              <i class="fa-solid fa-star text-yellow-400 ml-1"></i>
            </div>
          </div>
          <p class="text-gray-600 mb-4">{!!  $foods->description !!}</p>
          <!-- Quantity & Button -->
          <div class="flex items-center gap-3 mb-3">
            <label class="font-semibold text-gray-700">Số Lượng:</label>
            <input type="number" min="1" max="{{ $foods->quantity }}" value="1" class="w-16 border rounded px-2 py-1 text-center"
              id="food-quantity">
            <span class="text-lg font-bold text-orange-700" id="total-price">
              {{ number_format($foods->price, 0, ',', '.') }}đ
            </span>
          </div>
          <div class="flex gap-3 mt-4">
            <button type="button"
              class="add-to-cart bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg font-bold shadow"
              data-food-id="{{ $foods->id }}" data-food-price="{{ $foods->price }}">Thêm
              Vào
              Giỏ</button>


            <button type="button"
              class="bg-orange-100 text-orange-700 px-5 py-2 rounded-lg font-bold border border-orange-400 favorite-btn-current icon-btn {{ in_array($foods->id, $favIds) ? 'text-red-500' : 'text-gray-500' }}"
              data-food-id="{{ $foods->id }}">
              <i class="{{ in_array($foods->id, $favIds) ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"></i> Yêu
              Thích</button>

          </div>
        </div>
      </div>
      <!-- Tab mô tả / review -->
      <div class="mt-8 bg-white rounded shadow p-4">
        <!-- Tabs -->
        <div class="flex border-b">
          <button id="descTabBtn"
            class="px-4 py-2 text-sm border-b-2 border-orange-500 text-orange-600 font-bold focus:outline-none">Ghi
            Chú</button>
          <button id="reviewTabBtn"
            class="px-4 py-2 text-sm text-gray-600 border-b-2 border-transparent focus:outline-none">Đánh Giá</button>
        </div>
        <div class="pt-4">
          <!-- Description Tab Content -->
          <div id="descTabContent" class="w-full h-auto">
            <p class="text-gray-700 mb-3">
              {!!$foods->note !!}
            </p>
          </div>
          <!-- Reviews Tab Content -->
          <div id="reviewTabContent" class="hidden flex flex-col md:flex-row gap-4">
            <!-- Danh sách đánh giá (trái) -->
            <div class="flex-1">
              <div class="font-semibold mb-2 text-gray-800 text-sm">{{  $countRates }} Đánh Giá</div>
              <div id="reviewList" class="space-y-3">
                @foreach($rates as $rate)
              <div class="review-row flex gap-3 items-start bg-[#f8f8f8] rounded-lg p-3">
                <!-- Avatar người đánh giá -->
                <img src="{{ asset('img/' . $rate->user->avatar) }}"
                class="w-12 h-12 rounded-full object-cover border border-gray-200" />
                <div>
                <!-- Tên và thời gian -->
                <div class="flex gap-2 items-center mb-1">
                  <span class="font-bold text-sm text-gray-800">{{ $rate->user->fullname }}</span>
                  <span class="text-xs text-gray-400">
                  {{ \Carbon\Carbon::parse($rate->time)->format('d/m/Y H:i') }}
                  </span>
                </div>
                <!-- Sao đánh giá -->
                <div class="flex gap-1 text-xs mb-1">
                  @for ($i = 1; $i <= 5; $i++)
              <i
              class="fa-star {{ $i <= $rate->rate ? 'fa-solid text-yellow-400' : 'fa-regular text-gray-400' }}"></i>
            @endfor
                  <span class="ml-1 text-gray-500">({{ $rate->rate }}/5)</span>
                </div>
                <!-- Ảnh kèm theo (nếu có) -->
                @if($rate->images->isNotEmpty())
              <div class="flex gap-2 flex-wrap mb-2">
                @foreach($rate->images as $img)
              <img src="{{ asset('img/rate/' . $img->img) }}"
              class="w-16 h-16 object-cover rounded cursor-pointer border" />
            @endforeach
              </div>
            @endif
                <!-- Nội dung bình luận -->
                <div class="text-xs text-gray-600">{{ $rate->content }}</div>
                </div>
              </div>
        @endforeach
              </div>

              <!-- Pagination -->
              <div class="flex justify-center items-center gap-1 mt-4">
                <button id="prevPageBtn"
                  class="w-8 h-8 rounded-full border border-gray-300 text-gray-600 bg-white hover:bg-orange-50">&lt;</button>
                <div id="paginationBtns" class="flex gap-1"></div>
                <button id="nextPageBtn"
                  class="w-8 h-8 rounded-full border border-gray-300 text-gray-600 bg-white hover:bg-orange-50">&gt;</button>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- FontAwesome for icons (bắt buộc) -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    </div>
  </div>

  <!-- Popup overlay -->
  <div id="custom-popup-overlay"
    class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50 hidden p-4">
    <!-- Container chính -->
    <div id="custom-popup"
      class="bg-white w-full max-w-md rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
      <!-- Header -->
      <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-2">
            <i class="fa-solid fa-info-circle text-white"></i>
            <span class="text-white font-semibold text-lg">Thông báo</span>
          </div>
          <button id="popup-close-btn"
            class="text-white/80 hover:text-white hover:bg-white/20 rounded-full p-1 transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Nội dung -->
      <div class="px-6 py-8 text-center">
        <div
          class="w-16 h-16 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <i class="fa-solid fa-info text-blue-600 text-2xl"></i>
        </div>
        <div id="custom-popup-message" class="text-gray-800 text-base font-semibold mb-6">
          <!-- Nội dung message sẽ được show ở đây -->
        </div>
        <button id="popup-ok-btn"
          class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
          Đóng
        </button>
      </div>
    </div>
  </div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    // --- Tổng tiền khi đổi số lượng ---
    const price = Number(document.querySelector('.add-to-cart').dataset.foodPrice);
    const quantityInput = document.getElementById('food-quantity');
    const totalPriceSpan = document.getElementById('total-price');
    const maxStock = Number(quantityInput.getAttribute('max'));

    function updateTotalPrice() {
      const qty = Number(quantityInput.value) || 1;
      totalPriceSpan.textContent = (price * qty).toLocaleString('vi-VN') + ' VNĐ';
    }

    function handleQtyChange() {
      // Lấy giá trị hiện tại, ép thành số nguyên
      let val = Math.floor(Number(quantityInput.value)) || 1;

      // Kiểm tra vượt quá 20
      if (val > 20) {
        val = 20;
        showPopup('Bạn chỉ có thể mua tối đa 20 phần/lần.');
      }
      // Kiểm tra vượt quá số lượng tồn kho
      if (val > maxStock) {
        val = maxStock;
        showPopup('Không được thêm quá số lượng hiện có.');
      }
      // Giá trị thấp nhất là 1
      if (val < 1) {
        val = 1;
      }

      // Gán lại và cập nhật giá
      quantityInput.value = val;
      updateTotalPrice();
    }

    // Lắng nghe cả input và change (cho spinner và gõ tay)
    quantityInput.addEventListener('input', handleQtyChange);
    quantityInput.addEventListener('change', handleQtyChange);

    // Gọi khởi tạo
    updateTotalPrice();

    // --- Thêm vào giỏ hàng với số lượng thực tế ---
    document.querySelector('.add-to-cart').addEventListener('click', async function () {
      const foodId = this.dataset.foodId;
      const quantity = Number(quantityInput.value) || 1;
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      try {
        const res = await fetch("{{ route('cart.add') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
          body: JSON.stringify({ food_id: foodId, quantity: quantity })
        });
        const data = await res.json();
        if (res.ok && data.success) {
          showPopup(data.message || "Đã thêm vào giỏ hàng!");
        } else {
          showPopup(data.message || data.error || "Có lỗi xảy ra");
        }
      } catch (err) {
        showPopup("Lỗi kết nối");
      }
    });

    // --- Yêu thích: Toggle đúng trạng thái cho sản phẩm hiện tại ---
    document.querySelector('.favorite-btn-current').addEventListener('click', async function () {
      const foodId = this.dataset.foodId;
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      try {
        const res = await fetch("{{ route('favorite.toggle') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
          },
          body: JSON.stringify({ food_id: foodId })
        });
        const data = await res.json();
        if (res.ok && data.success) {
            // chỉ update đúng nút vừa click
            if (data.favorited) {
              // thêm class đỏ và icon solid
              this.classList.add('text-red-500');
              this.classList.remove('text-gray-500');
              this.querySelector('i').classList.replace('fa-regular', 'fa-solid');
            } else {
              // quay về xám và icon regular
              this.classList.remove('text-red-500');
              this.classList.add('text-gray-500');
              this.querySelector('i').classList.replace('fa-solid', 'fa-regular');
            }
          showPopup(data.message || "Cập nhật yêu thích thành công");
        } else {
          showPopup(data.message || "Có lỗi xảy ra");
        }
      } catch (err) {
        showPopup("Lỗi kết nối");
      }
    });

    // Popup close handlers
    const overlay = document.getElementById('custom-popup-overlay');
    document.getElementById('popup-ok-btn').onclick = () => overlay.classList.add('hidden');
    document.getElementById('popup-close-btn').onclick = () => overlay.classList.add('hidden');
    overlay.onclick = function (e) {
      if (e.target === overlay) overlay.classList.add('hidden');
    };
  });

  // Hàm hiển thị popup
  function showPopup(message) {
    document.getElementById('custom-popup-message').textContent = message;
    document.getElementById('custom-popup-overlay').classList.remove('hidden');
  }
</script>

  <!-- PHẦN 2: Related BBQ Items -->
  <div class="bg-dark-light max-w-6xl mx-auto py-8">
    <h3 class="text-xl font-bold mb-4 text-gray-800"> <i class="fa-solid fa-table-list fa-lg"></i> Món Ngon Gợi Ý</h3>
    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
      @forelse($suggestFoods as $item)
      <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <a href="{{ route('views.menudetail', [$item->id, $item->slug]) }}"> <img
        src="{{ asset('img/' . $item->image) }}" class="rounded-lg w-full h-32 object-cover mb-3" />
        <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">{{ $item->name }}</span>
        </div>
      </a>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">
        @php
      $avg = $item->rates_avg_rate;
    @endphp

    @for($i = 1; $i <= 5; $i++)
      @if($avg >= $i)
        {{-- đầy đủ sao --}}
        <i class="fa-solid fa-star text-yellow-400"></i>
      @elseif($avg >= $i - 0.5)
        {{-- nửa sao --}}
        <i class="fa-solid fa-star-half-stroke text-yellow-400"></i>
      @else
        {{-- sao rỗng --}}
        <i class="fa-regular fa-star text-gray-300"></i>
      @endif
    @endfor

    <span class="ml-1 font-semibold">{{ number_format($avg, 1) }}</span>
      </div>
      <div class="text-sm font-bold text-orange-600 mb-2">
        {{ number_format($item->price, 0, ',', '.') }}đ
      </div>
      <div class="flex gap-2">
        <button type="button"
        class="add-to-cart bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600 "
        data-food-id="{{ $item->id }}" aria-label="Thêm vào giỏ hàng">
        <i class="fa fa-cart-plus"></i> Thêm Giỏ Hàng</button>

        <button data-food-id="{{ $item->id }}"
        class=" favorite-btn icon-btn {{ in_array($item->id, $favIds) ? 'text-red-500' : 'text-gray-500' }} w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center  hover:text-red-500 transition-colors">
        <i class="{{ in_array($item->id, $favIds) ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }} text-lg"></i>
        </button>
        
        <button class="icon-btn"><a href="{{ route('views.menudetail', [$item->id, $item->slug]) }}"><i
          class="fa-regular fa-eye"></i></a></button>
      </div>
      </div>
    @empty
      <div class="col-span-4 text-center text-gray-500 py-8">Không có món gợi ý!</div>
    @endforelse
    </div>
  </div>
  <script>
    // Chỉ giữ JS chuyển tab, bỏ toàn bộ phần renderReview bằng JS

    document.addEventListener("DOMContentLoaded", function () {
      document.getElementById('descTabBtn').onclick = function () {
        this.classList.add("border-orange-500", "text-orange-600", "font-bold");
        document.getElementById('reviewTabBtn').classList.remove("border-orange-500", "text-orange-600", "font-bold");
        document.getElementById('descTabContent').classList.remove("hidden");
        document.getElementById('reviewTabContent').classList.add("hidden");
      };
      document.getElementById('reviewTabBtn').onclick = function () {
        this.classList.add("border-orange-500", "text-orange-600", "font-bold");
        document.getElementById('descTabBtn').classList.remove("border-orange-500", "text-orange-600", "font-bold");
        document.getElementById('descTabContent').classList.add("hidden");
        document.getElementById('reviewTabContent').classList.remove("hidden");
      };
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const reviews = Array.from(document.querySelectorAll('#reviewList .review-row'));
      const perPage = 2;
      let currentPage = 1;
      const paginationBtns = document.getElementById('paginationBtns');
      const prevPageBtn = document.getElementById('prevPageBtn');
      const nextPageBtn = document.getElementById('nextPageBtn');

      function showReviewPage(page) {
        const start = (page - 1) * perPage;
        const end = start + perPage;
        reviews.forEach((r, i) => r.style.display = (i >= start && i < end) ? '' : 'none');
        renderReviewPagination(page);
        currentPage = page;
      }

      function renderReviewPagination(active) {
        const totalPages = Math.ceil(reviews.length / perPage);
        paginationBtns.innerHTML = '';
        if (totalPages <= 1) {
          prevPageBtn.style.display = 'none';
          nextPageBtn.style.display = 'none';
          return;
        }
        prevPageBtn.style.display = '';
        nextPageBtn.style.display = '';

        prevPageBtn.disabled = active === 1;
        nextPageBtn.disabled = active === totalPages;

        for (let i = 1; i <= totalPages; i++) {
          const btn = document.createElement('button');
          btn.textContent = i;
          btn.className = "w-8 h-8 flex items-center justify-center rounded-full border " +
            (i === active
              ? "border-orange-500 text-orange-500 bg-orange-50 font-bold"
              : "border-gray-300 text-gray-500 hover:bg-orange-100");
          btn.onclick = () => showReviewPage(i);
          paginationBtns.appendChild(btn);
        }
      }

      prevPageBtn.onclick = () => {
        if (currentPage > 1) showReviewPage(currentPage - 1);
      };
      nextPageBtn.onclick = () => {
        const totalPages = Math.ceil(reviews.length / perPage);
        if (currentPage < totalPages) showReviewPage(currentPage + 1);
      };

      // Init trang đầu tiên
      if (reviews.length > 0) showReviewPage(1);
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Add to cart
      document.querySelectorAll('.add-to-cart').forEach(btn => {
        btn.addEventListener('click', async function () {
          const foodId = this.dataset.foodId;
          try {
            const res = await fetch("{{ route('cart.add') }}", {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
              },
              body: JSON.stringify({ food_id: foodId, quantity: 1 })
            });
            const data = await res.json();
            if (res.ok && data.success) {
              showPopup(data.message);
            } else {
              showPopup(data.message || data.error || 'Có lỗi xảy ra');
            }
          } catch (err) {
            showPopup('Lỗi kết nối');
          }
        });
      });

      // Favorite toggle
      document.querySelectorAll('.favorite-btn').forEach(btn => {
        btn.addEventListener('click', async function () {
          const foodId = this.dataset.foodId;
          try {
            const res = await fetch("{{ route('favorite.toggle') }}", {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
              },
              body: JSON.stringify({ food_id: foodId })
            });
            const data = await res.json();
            if (res.ok && data.success) {
              // Cập nhật icon & màu
              if (data.favorited) {
                this.innerHTML = '<i class="fa-solid fa-heart"></i>';
                this.classList.add('text-red-500');
                this.classList.remove('text-gray-500');
              } else {
                this.innerHTML = '<i class="fa-regular fa-heart"></i>';
                this.classList.remove('text-red-500');
                this.classList.add('text-gray-500');
              }
              showPopup(data.message);
            } else {
              showPopup(data.message || 'Có lỗi xảy ra');
            }
          } catch (err) {
            showPopup('Lỗi kết nối');
          }
        });
      });

      // Popup script
      const overlay = document.getElementById('custom-popup-overlay');
      document.getElementById('popup-ok-btn').onclick = () => overlay.classList.add('hidden');
      document.getElementById('popup-close-btn').onclick = () => overlay.classList.add('hidden');
      overlay.onclick = function (e) {
        if (e.target === overlay) overlay.classList.add('hidden');
      };
    });

    // Global showPopup function
    function showPopup(message) {
      document.getElementById('custom-popup-message').textContent = message;
      document.getElementById('custom-popup-overlay').classList.remove('hidden');
    }
  </script>

</body>
@include('layouts.user.footer')

</html>