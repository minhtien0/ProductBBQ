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
                },
            },
        };
    </script>
    </head>
    <body>
    @include('layouts.user.header')
<body>
<body>
<div class="relative w-full">
  <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
  <img src="img/banner1.jpg" alt="User Detail" class="w-full h-[260px] md:h-[360px] object-cover">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
  <!-- Content -->
  <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
    <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">User Detail</h1>
    <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
      <i class="fa fa-home text-white"></i>
      <a href="{{ route('views.index') }}"><span class="text-white">Home</span></a>
      <span class="text-white">–</span>
      <span class="text-[#ff8000]">BBQ User Detail</span>
    </div>
  </div>
</div>

  <!-- MAIN DASHBOARD -->
  <div class="max-w-6xl mx-auto px-2 md:px-4 py-8">
    <div class="bg-white rounded-xl shadow border overflow-hidden flex flex-col md:flex-row">
      <!-- SIDEBAR -->
      <div class="bg-orange-500 w-full md:w-60 flex-shrink-0 flex flex-col items-center py-6">
        <div class="relative">
          <img src="img/mtien.jpg" class="w-24 h-24 rounded-full border-4 border-white object-cover"/>
          <label class="absolute bottom-1 right-0 bg-white rounded-full p-1 shadow cursor-pointer">
            <i class="fa fa-camera text-orange-500"></i>
            <input type="file" class="hidden" />
          </label>
        </div>
        <div class="mt-3 mb-6 text-lg font-bold text-white">Nguyễn Minh Tiến</div>
        <nav class="w-full">
          <button class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none active-tab" data-tab="profile">
            <i class="fa fa-user mr-2"></i> Personal Info
          </button>
          <button class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none" data-tab="address">
            <i class="fa fa-map-marker-alt mr-2"></i> Address
          </button>
          <button class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none" data-tab="order">
            <i class="fa fa-shopping-cart mr-2"></i> Order
          </button>
          <button class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none" data-tab="wishlist">
            <i class="fa fa-heart mr-2"></i> Wishlist
          </button>
          <button class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none" data-tab="review">
            <i class="fa fa-star mr-2"></i> Reviews
          </button>
          <button class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none" data-tab="password">
            <i class="fa fa-key mr-2"></i> Change Password
          </button>
          <button class="tab-btn w-full flex items-center px-5 py-3 text-white text-base font-medium hover:bg-orange-600 focus:outline-none border-t border-orange-400" data-tab="logout">
            <i class="fa fa-sign-out-alt mr-2"></i> Logout
          </button>
        </nav>
      </div>
      <!-- CONTENT -->
      <div class="flex-1 p-6 bg-blue-50 min-h-[520px]">
        <!-- Personal Info -->
        <div class="tab-content" id="tab-profile">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Personal Information</h2>
            <button class="px-4 py-1.5 bg-orange-500 hover:bg-orange-600 text-white rounded-full text-sm font-semibold">Edit</button>
          </div>
          <div class="bg-white rounded shadow p-5">
            <div class="flex flex-col gap-3">
              <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                <span class="w-28 font-semibold text-gray-700">Name:</span>
                <span class="text-gray-800">MR.Tiến</span>
              </div>
              <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                <span class="w-28 font-semibold text-gray-700">Email:</span>
                <span class="text-gray-800">NMTien@gmail.com</span>
              </div>
              <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                <span class="w-28 font-semibold text-gray-700">Phone:</span>
                <span class="text-gray-800">023 434 54354</span>
              </div>
              <div class="flex flex-col md:flex-row md:items-center md:gap-3">
                <span class="w-28 font-semibold text-gray-700">Address:</span>
                <span class="text-gray-800">334/7LLT/TT/TP/HCM</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Address -->
        <div class="tab-content hidden" id="tab-address">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-800">Address</h2>
            <button class="px-4 py-1.5 bg-orange-500 hover:bg-orange-600 text-white rounded-full text-sm font-semibold">Add New</button>
          </div>
          <div class="grid md:grid-cols-2 gap-4">
            <!-- Address Card -->
            <div class="bg-white p-4 rounded shadow flex flex-col gap-1">
              <div class="flex justify-between items-center mb-1">
                <span class="font-bold text-orange-500"><i class="fa fa-home mr-1"></i> Home</span>
                <span>
                  <button class="text-orange-400 hover:text-orange-600"><i class="fa fa-edit"></i></button>
                  <button class="ml-2 text-orange-400 hover:text-orange-600"><i class="fa fa-trash"></i></button>
                </span>
              </div>
              <p class="text-sm text-gray-600">Blackwell Street, Dry Creek, Alaska Blackwell Street, Dry Creek, Alaska.</p>
            </div>
            <!-- Repeat Address Cards (example) -->
            <div class="bg-white p-4 rounded shadow flex flex-col gap-1">
              <div class="flex justify-between items-center mb-1">
                <span class="font-bold text-orange-500"><i class="fa fa-briefcase mr-1"></i> Office</span>
                <span>
                  <button class="text-orange-400 hover:text-orange-600"><i class="fa fa-edit"></i></button>
                  <button class="ml-2 text-orange-400 hover:text-orange-600"><i class="fa fa-trash"></i></button>
                </span>
              </div>
              <p class="text-sm text-gray-600">Blackwell Street, Dry Creek, Alaska Blackwell Street, Dry Creek, Alaska.</p>
            </div>
            <div class="bg-white p-4 rounded shadow flex flex-col gap-1">
              <div class="flex justify-between items-center mb-1">
                <span class="font-bold text-orange-500"><i class="fa fa-home mr-1"></i> Home 2</span>
                <span>
                  <button class="text-orange-400 hover:text-orange-600"><i class="fa fa-edit"></i></button>
                  <button class="ml-2 text-orange-400 hover:text-orange-600"><i class="fa fa-trash"></i></button>
                </span>
              </div>
              <p class="text-sm text-gray-600">Blackwell Street, Dry Creek, Alaska Blackwell Street, Dry Creek, Alaska.</p>
            </div>
            <div class="bg-white p-4 rounded shadow flex flex-col gap-1">
              <div class="flex justify-between items-center mb-1">
                <span class="font-bold text-orange-500"><i class="fa fa-briefcase mr-1"></i> Office 2</span>
                <span>
                  <button class="text-orange-400 hover:text-orange-600"><i class="fa fa-edit"></i></button>
                  <button class="ml-2 text-orange-400 hover:text-orange-600"><i class="fa fa-trash"></i></button>
                </span>
              </div>
              <p class="text-sm text-gray-600">Blackwell Street, Dry Creek, Alaska Blackwell Street, Dry Creek, Alaska.</p>
            </div>
          </div>
        </div>
        <!-- Order -->
        <div class="tab-content hidden" id="tab-order">
          <h2 class="text-xl font-bold text-gray-800 mb-4">Order List</h2>
          <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow overflow-hidden text-sm">
              <thead>
                <tr class="bg-orange-500 text-white">
                  <th class="px-4 py-2 text-left">Order</th>
                  <th class="px-4 py-2 text-left">Date</th>
                  <th class="px-4 py-2 text-left">Status</th>
                  <th class="px-4 py-2 text-right">Amount</th>
                  <th class="px-4 py-2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="px-4 py-2">#2545768745</td>
                  <td class="px-4 py-2">July 16, 2022</td>
                  <td class="px-4 py-2"><span class="bg-green-100 text-green-600 px-3 py-1 rounded-full">Completed</span></td>
                  <td class="px-4 py-2 text-right">$660</td>
                  <td class="px-4 py-2 text-center"><button class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs">View Details</button></td>
                </tr>
                <tr>
                  <td class="px-4 py-2">#2457945235</td>
                  <td class="px-4 py-2">Jan 21, 2021</td>
                  <td class="px-4 py-2"><span class="bg-green-100 text-green-600 px-3 py-1 rounded-full">Complete</span></td>
                  <td class="px-4 py-2 text-right">$654</td>
                  <td class="px-4 py-2 text-center"><button class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs">View Details</button></td>
                </tr>
                <tr>
                  <td class="px-4 py-2">#2468875648</td>
                  <td class="px-4 py-2">July 11, 2020</td>
                  <td class="px-4 py-2"><span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full">Active</span></td>
                  <td class="px-4 py-2 text-right">$440</td>
                  <td class="px-4 py-2 text-center"><button class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs">View Details</button></td>
                </tr>
                <!-- Add more rows as needed -->
              </tbody>
            </table>
          </div>
        </div>
        <!-- Wishlist -->
        <div class="tab-content hidden" id="tab-wishlist">
          <h2 class="text-xl font-bold text-gray-800 mb-4">Wishlist</h2>
          <div class="grid md:grid-cols-3 gap-4">
            <!-- Example product -->
            <div class="bg-white rounded shadow p-3 flex flex-col items-center">
              <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80" class="rounded w-full h-32 object-cover mb-2"/>
              <div class="text-base font-semibold text-gray-800 text-center mb-1">Hyderabadi Biryani</div>
              <div class="flex items-center text-yellow-400 mb-1 text-xs">
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i><i class="fa-regular fa-star"></i>
                <span class="ml-1 text-gray-600">(24)</span>
              </div>
              <div class="mb-2 text-orange-500 font-bold">$65.00 <span class="text-gray-400 line-through text-xs">$90.00</span></div>
              <button class="bg-orange-500 text-white px-4 py-1 rounded mt-auto">Add To Cart</button>
            </div>
            <!-- Repeat products as needed -->
          </div>
          <!-- Pagination -->
          <div class="flex justify-center items-center gap-2 mt-4">
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">&lt;</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-orange-500 text-orange-500 bg-orange-50 font-bold">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">3</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">&gt;</button>
          </div>
        </div>
        <!-- Review -->
        <div class="tab-content hidden" id="tab-review">
          <h2 class="text-xl font-bold text-gray-800 mb-4">Review</h2>
          <div class="space-y-6">
            <div class="flex gap-4 bg-white rounded shadow p-4 items-center">
              <img src="img/danhmuc1/suon.jpg" class="rounded-full w-14 h-14 object-cover"/>
              <div class="flex-1">
                <div class="font-bold text-gray-800">Sườn Chua Ngọt <span class="ml-3 text-xs text-gray-400">29 Oct 2022</span></div>
                <div class="flex items-center text-yellow-400 text-xs mb-1">
                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-alt"></i><i class="fa-regular fa-star"></i>
                  <span class="ml-1 text-gray-600">(120)</span>
                </div>
                <div class="text-sm text-gray-600">Một món ăn quá ngon, thật là chu xì, không biết đầu bếp thiên tài nào đã chế biến ngon được như thế</div>
                <div class="mt-1">
                  <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">Active</span>
                </div>
              </div>
            </div>
            <!-- More reviews ... -->
          </div>
          <!-- Pagination -->
          <div class="flex justify-center items-center gap-2 mt-4">
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">&lt;</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">1</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-orange-500 text-orange-500 bg-orange-50 font-bold">2</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">3</button>
            <button class="w-8 h-8 flex items-center justify-center rounded-full border border-gray-300 text-gray-500 hover:bg-orange-100">&gt;</button>
          </div>
        </div>
        <!-- Change Password -->
        <div class="tab-content hidden" id="tab-password">
          <h2 class="text-xl font-bold text-gray-800 mb-4">Change Password</h2>
          <form class="bg-white rounded shadow p-6 flex flex-col md:flex-row gap-4">
            <div class="flex-1">
              <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
              <input type="password" class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Current Password">
            </div>
            <div class="flex-1">
              <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
              <input type="password" class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="New Password">
            </div>
            <div class="flex-1">
              <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
              <input type="password" class="border border-gray-300 rounded px-3 py-2 w-full" placeholder="Confirm Password">
            </div>
            <div class="flex items-end">
              <button class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded mt-6 font-bold">Submit</button>
            </div>
          </form>
        </div>
        <!-- Logout (fake redirect) -->
        <div class="tab-content hidden text-center" id="tab-logout">
          <div class="text-2xl text-orange-500 font-bold mt-20 mb-4"><i class="fa fa-sign-out-alt"></i> Logout</div>
          <p class="text-gray-700">You have been logged out!</p>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    // Tab logic
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        // Remove active class from all
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active-tab'));
        // Hide all contents
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
        // Activate this
        this.classList.add('active-tab');
        document.getElementById('tab-' + this.dataset.tab).classList.remove('hidden');
      });
    });
    // Default show first tab if reload
    document.getElementById('tab-profile').classList.remove('hidden');
  </script>
</body>
</body>

@include('layouts.user.footer')
</html>
