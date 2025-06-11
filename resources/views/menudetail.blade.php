<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LUA BE HOY</title>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
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
    <h1 class="text-white font-extrabold text-4xl md:text-5xl mb-4">Chi Tiết Sản Phẩm</h1>
    <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
      <i class="fa fa-home text-white"></i>
      <a href="{{ route('views.index') }}"><span class="text-white">Trang Chủ</span></a>
      <span class="text-white">–</span>
      <span class="text-[#ff8000]">BBQ Menu Detail</span>
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
          <img onclick="document.getElementById('main-img').src=this.src" src="{{ asset('img/'.$detailImage->img) }}"
            class="w-14 h-14 rounded-lg object-cover border-2 border-orange-200 cursor-pointer hover:border-orange-500 transition" />
          @endforeach
        </div>
      </div>
      <!-- Chi tiết món ăn -->
      <div class="md:w-2/3">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $foods->name }}</h2>
        <div class="flex items-center gap-3 mb-2">
          <span class="text-xl font-bold text-orange-600">{{ $foods->price }} VNĐ</span>
          <span class="text-xs bg-orange-100 text-orange-500 rounded px-2 py-0.5 font-semibold">{{ $foods->menus->name }}</span>
        </div>
        <p class="text-gray-600 mb-4">{!!  $foods->description !!}</p>

        <!-- Lựa chọn size -->
        <div class="mb-3">
          <label class="block font-semibold mb-1 text-gray-700">Chọn Phần:</label>
          <div class="flex gap-4">
            <label class="flex items-center gap-1">
              <input type="radio" name="size" class="accent-orange-500" checked> Nhỏ
            </label>
            <label class="flex items-center gap-1">
              <input type="radio" name="size" class="accent-orange-500"> Vừa
            </label>
            <label class="flex items-center gap-1">
              <input type="radio" name="size" class="accent-orange-500"> Lớn
            </label>
          </div>
        </div>
        <!-- Lựa chọn thêm -->
        <div class="mb-3">
          <label class="block font-semibold mb-1 text-gray-700">Chọn Thêm:</label>
          <div class="flex gap-4 flex-wrap">
            <label class="flex items-center gap-1">
              <input type="checkbox" class="accent-orange-500"> Phô Mai Nướng
            </label>
            <label class="flex items-center gap-1">
              <input type="checkbox" class="accent-orange-500"> Xúc Xích Nướng
            </label>
            <label class="flex items-center gap-1">
              <input type="checkbox" class="accent-orange-500"> Thêm Rau Củ
            </label>
          </div>
        </div>
        <!-- Quantity & Button -->
        <div class="flex items-center gap-3 mb-3">
          <label class="font-semibold text-gray-700">Số Lượng:</label>
          <input type="number" min="1" value="1" class="w-16 border rounded px-2 py-1 text-center">
          <span class="text-lg font-bold text-orange-700">$250.000</span>
        </div>
        <div class="flex gap-3 mt-4">
          <button class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg font-bold shadow">Thêm Vào
            Giỏ</button>
          <button class="bg-orange-100 text-orange-700 px-5 py-2 rounded-lg font-bold border border-orange-400">Yêu
            Thích</button>
        </div>
      </div>
    </div>
    <!-- Tab mô tả / review -->
    <div class="mt-8 bg-white rounded shadow p-4">
      <!-- Tabs -->
      <div class="flex border-b">
        <button id="descTabBtn"
          class="px-4 py-2 text-sm border-b-2 border-orange-500 text-orange-600 font-bold focus:outline-none">Ghi Chú</button>
        <button id="reviewTabBtn"
          class="px-4 py-2 text-sm text-gray-600 border-b-2 border-transparent focus:outline-none">Đánh Giá</button>
      </div>
      <div class="pt-4">
        <!-- Description Tab Content -->
        <div id="descTabContent">
          <p class="text-gray-700 mb-3">
            {!!$foods->note !!}
          </p>
        </div>
        <!-- Reviews Tab Content -->
        <div id="reviewTabContent" class="hidden flex flex-col md:flex-row gap-4">
          <!-- Danh sách đánh giá (trái) -->
          <div class="flex-1">
            <div class="font-semibold mb-2 text-gray-800 text-sm">04 Đánh Giá</div>
            <div id="reviewList" class="space-y-3"></div>
            <!-- Pagination -->
            <div class="flex justify-center items-center gap-1 mt-4">
              <button id="prevPageBtn"
                class="w-8 h-8 rounded-full border border-gray-300 text-gray-600 bg-white hover:bg-orange-50">&lt;</button>
              <div id="paginationBtns" class="flex gap-1"></div>
              <button id="nextPageBtn"
                class="w-8 h-8 rounded-full border border-gray-300 text-gray-600 bg-white hover:bg-orange-50">&gt;</button>
            </div>
          </div>
          <!-- Form gửi đánh giá (phải) -->
          <div class="w-full md:w-[320px] bg-[#f6fbf7] rounded-lg p-4">
            <div class="font-semibold mb-2 text-gray-800">Write A Review</div>
            <form id="reviewForm" class="space-y-2">
              <label class="block text-sm">Select Your Rating:
                <span id="ratingStars" class="ml-2">
                  <!-- Star icons ở đây -->
                </span>
              </label>
              <input type="text" id="reviewName" class="w-full border px-2 py-1 rounded text-sm" placeholder="Name"
                required>
              <input type="email" id="reviewEmail" class="w-full border px-2 py-1 rounded text-sm" placeholder="Email"
                required>
              <textarea id="reviewText" class="w-full border px-2 py-1 rounded text-sm" placeholder="Write your review"
                rows="3" required></textarea>
              <button type="submit"
                class="w-full bg-orange-500 text-white font-bold py-2 rounded hover:bg-orange-600 transition">Submit
                Review</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- FontAwesome for icons (bắt buộc) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  </div>
</div>

<!-- PHẦN 2: Related BBQ Items -->
<div class="bg-dark-light max-w-6xl mx-auto py-8  ">
  <h3 class="text-xl font-bold mb-4 text-gray-800">Món Nướng Gợi Ý</h3>
  <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-4">
    <!-- Card 1 -->
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/danhmuc1/combogiadinh.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Sườn Nướng Mật Ong</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Hot</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$180.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm
          Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/combo/3.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Gà Xiên Que Nướng</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">-10%</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐☆</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$90.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm
          Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/combo/1.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Ba Chỉ Bò Mỹ Nướng</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Best Seller</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$220.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm
          Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <!-- Card 4 -->
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/combo/4.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Combo Nướng Đặc Biệt</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Combo</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$450.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm
          Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/danhmuc1/combogiadinh.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Sườn Nướng Mật Ong</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Hot</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$180.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm
          Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/danhmuc1/combogiadinh.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Sườn Nướng Mật Ong</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Hot</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$180.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm
          Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/danhmuc1/combogiadinh.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Sườn Nướng Mật Ong</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Hot</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$180.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm
          Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>
    <div class="bg-white rounded-xl shadow p-4 flex flex-col">
      <img src="img/danhmuc1/combogiadinh.jpg" class="rounded-lg w-full h-32 object-cover mb-3" />
      <div class="flex items-center justify-between mb-1">
        <span class="font-bold text-gray-800">Sườn Nướng Mật Ong</span>
        <span class="bg-orange-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">Hot</span>
      </div>
      <div class="text-xs text-gray-500 mb-1 flex items-center gap-1">⭐⭐⭐⭐⭐</div>
      <div class="text-sm font-bold text-orange-600 mb-2">$180.000</div>
      <div class="flex gap-2">
        <button class="bg-orange-500 text-white px-3 py-1 rounded font-bold text-sm hover:bg-orange-600">Thêm
          Giỏ</button>
        <button class="border border-orange-500 text-orange-600 px-2 py-1 rounded font-bold text-sm">❤</button>
      </div>
    </div>

  </div>
</div>
</body>
<script>
  const reviews = [
    {
      avatar: "https://randomuser.me/api/portraits/women/1.jpg",
      name: "Michel Holder",
      date: "26 Oct 2023",
      rating: 4,
      text: "Sure there isn't anything embarrassing hidden in the middle of text. All generators on the Internet tend to repeat predefined chunks."
    },
    {
      avatar: "https://randomuser.me/api/portraits/men/32.jpg",
      name: "Salina Khan",
      date: "23 Oct 2023",
      rating: 5,
      text: "All generators on the Internet tend to repeat predefined chunks."
    },
    {
      avatar: "https://randomuser.me/api/portraits/women/65.jpg",
      name: "Mouna Sthesia",
      date: "20 Oct 2023",
      rating: 4,
      text: "Sure there isn't anything embarrassing hidden in the middle of text."
    },
    {
      avatar: "https://randomuser.me/api/portraits/men/76.jpg",
      name: "Marjan Janifar",
      date: "19 Oct 2023",
      rating: 4,
      text: "Sure there isn't anything embarrassing hidden in the middle of text."
    }
    // Thêm review tùy ý...
  ];

  let currentPage = 1;
  const perPage = 1;

  function renderStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; ++i)
      stars += `<i class="fa-star ${i <= rating ? 'fa-solid text-yellow-400' : 'fa-regular text-gray-400'}"></i>`;
    return stars;
  }

  function renderReviews() {
    const start = (currentPage - 1) * perPage;
    const current = reviews.slice(start, start + perPage);
    document.getElementById('reviewList').innerHTML = current.map(r =>
      `
      @foreach($rates as $rate)
      <div class="flex gap-3 items-start bg-[#f8f8f8] rounded-lg p-3">
      <img src="{{ asset('img/'.$rate->avatar) }}" class="w-12 h-12 rounded-full object-cover border border-gray-200" />
      <div>
        <div class="flex gap-2 items-center mb-1">
          <span class="font-bold text-sm text-gray-800">{{$rate->fullname }}</span>
          <span class="text-xs text-gray-400">{{$rate->time }}</span>
        </div>
        <div class="flex gap-1 text-xs mb-1">${renderStars({{$rate->rate }})}
          <span class="ml-1 text-gray-500">({{$rate->rate }}/5)</span>
        </div>
        <div class="text-xs text-gray-600">{{$rate->content }}</div>
      </div>
    </div>
    @endforeach
    `
    ).join('');
    // Pagination
    const pageCount = Math.ceil(reviews.length / perPage);
    let pagBtns = '';
    for (let i = 1; i <= pageCount; ++i)
      pagBtns += `<button class="w-8 h-8 rounded-full ${i === currentPage ? 'bg-orange-500 text-white' : 'border border-gray-300 text-gray-600 bg-white hover:bg-orange-50'}" onclick="goToPage(${i})">${i}</button>`;
    document.getElementById('paginationBtns').innerHTML = pagBtns;
    document.getElementById('prevPageBtn').disabled = currentPage === 1;
    document.getElementById('nextPageBtn').disabled = currentPage === pageCount;
  }
  window.goToPage = function (i) { currentPage = i; renderReviews(); };

  document.getElementById('prevPageBtn').onclick = () => { if (currentPage > 1) { currentPage--; renderReviews(); } };
  document.getElementById('nextPageBtn').onclick = () => { const pageCount = Math.ceil(reviews.length / perPage); if (currentPage < pageCount) { currentPage++; renderReviews(); } };

  // Tab switch
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
    renderReviews();
  };

  // Đánh giá: chọn sao
  let formRating = 5;
  function renderFormStars() {
    let stars = '';
    for (let i = 1; i <= 5; ++i) {
      stars += `<i class="fa-star ${i <= formRating ? 'fa-solid text-yellow-400' : 'fa-regular text-gray-400'} cursor-pointer" onclick="selectFormStar(${i})"></i>`;
    }
    document.getElementById('ratingStars').innerHTML = stars;
  }
  window.selectFormStar = function (i) { formRating = i; renderFormStars(); }
  renderFormStars();

  // Submit review
  document.getElementById('reviewForm').onsubmit = function (e) {
    e.preventDefault();
    // Đơn giản: random avatar
    const avatars = [
      "https://randomuser.me/api/portraits/men/31.jpg", "https://randomuser.me/api/portraits/women/67.jpg",
      "https://randomuser.me/api/portraits/men/11.jpg", "https://randomuser.me/api/portraits/women/21.jpg"];
    reviews.unshift({
      avatar: avatars[Math.floor(Math.random() * avatars.length)],
      name: document.getElementById('reviewName').value,
      date: new Date().toLocaleDateString('en-GB'),
      rating: formRating,
      text: document.getElementById('reviewText').value
    });
    this.reset(); formRating = 5; renderFormStars();
    currentPage = 1;
    renderReviews();
    alert("Gửi đánh giá thành công!");
  };
</script>

@include('layouts.user.footer')

</html>