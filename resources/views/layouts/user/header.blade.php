<div class="w-full sticky top-0 z-50">
  <!-- Top Bar -->
  <div class="bg-[#e60012] flex items-center justify-between h-[52px] md:h-[58px]">
    <!-- Email & Phone -->
    <div class="hidden md:flex flex-1 items-center justify-start">
      <div class="flex bg-[#262465] px-10 py-2 rounded-br-3xl rounded-bl-[60px] items-center gap-7">
        <span class="flex items-center text-white text-base gap-2">
          <i class="fa-solid fa-envelope text-lg"></i>
          examplemail@gmail.com
        </span>
        <span class="flex items-center text-white text-base gap-2">
          <i class="fa-solid fa-phone text-lg"></i>
          +96487452145214
        </span>
      </div>
    </div>
    <!-- Mobile Email & Phone -->
    <div class="flex md:hidden items-center px-3 gap-4">
      <span class="flex items-center text-white text-sm gap-1">
        <i class="fa-solid fa-envelope text-base"></i>
      </span>
      <span class="flex items-center text-white text-sm gap-1">
        <i class="fa-solid fa-phone text-base"></i>
      </span>
    </div>
    <!-- Social Icons -->
    <div class="flex items-center gap-2 md:gap-3 px-3 md:px-8">
      <a href="#"
        class="bg-[#e60012] w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center text-white text-lg md:text-xl hover:bg-white hover:text-[#ff8000] transition"><i
          class="fab fa-facebook-f"></i></a>
      <a href="#"
        class="bg-[#e60012] w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center text-white text-lg md:text-xl hover:bg-white hover:text-[#ff8000] transition"><i
          class="fab fa-twitter"></i></a>
      <a href="#"
        class="bg-[#e60012] w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center text-white text-lg md:text-xl hover:bg-white hover:text-[#ff8000] transition"><i
          class="fab fa-linkedin-in"></i></a>
      <a href="#"
        class="bg-[#e60012] w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center text-white text-lg md:text-xl hover:bg-white hover:text-[#ff8000] transition"><i
          class="fab fa-behance"></i></a>
    </div>
  </div>
  <!-- Main Header -->
  <div class="bg-white flex items-center justify-between px-3 md:px-10 py-0 ">
    <!-- Logo -->
    <div class="flex items-center gap-2">
      <a href="{{ route('views.index') }}">
        <img class="w-50 h-20 object-contain" src="{{ asset('img/test1.png') }}" alt="Logo">
      </a>
      <!-- <span class="text-[#e60012] text-3xl md:text-4xl"><i class="fa-solid fa-utensils"></i></span> -->
      <a href="{{ route('views.index') }}"><span
          class="text-1xl md:text-2xl text-[#262248] font-family:Quicksand,sans-serif">LUA <br> BE HOY</span>
    </div></a>
    <!-- Hamburger Mobile -->
    <button id="openMenu" class="md:hidden p-2 text-[#e60012] text-2xl" aria-label="Open Menu">
      <i class="fa-solid fa-bars"></i>
    </button>
    <!-- Navigation -->
    @php
  $currentRoute = Route::currentRouteName();
@endphp

<nav class="hidden md:flex flex-1 justify-center">
  <ul class="flex items-center gap-3 md:gap-8 font-semibold text-base md:text-lg">
    <li>
      <a href="{{ route('views.index') }}"
         class="transition {{ $currentRoute == 'views.index' ? 'text-[#e60012] font-bold underline underline-offset-8' : 'text-[#262248]' }} hover:text-[#e60012]">
        Trang Chủ
      </a>
    </li>
    <li>
      <a href="{{ route('views.index') }}#booking"
         class="transition {{ url()->current() == url(route('views.index')) && request()->getRequestUri() == '/#booking' ? 'text-[#e60012] font-bold underline underline-offset-8' : 'text-[#262248]' }} hover:text-[#e60012]">
        Đặt Bàn
      </a>
    </li>
    <li>
      <a href="{{ route('views.about') }}"
         class="transition {{ $currentRoute == 'views.about' ? 'text-[#e60012] font-bold underline underline-offset-8' : 'text-[#262248]' }} hover:text-[#e60012]">
        Thông Tin
      </a>
    </li>
    <li>
      <a href="{{ route('views.menu') }}"
         class="transition {{ $currentRoute == 'views.menu' ? 'text-[#e60012] font-bold underline underline-offset-8' : 'text-[#262248]' }} hover:text-[#e60012]">
        Thực Đơn
      </a>
    </li>
    <li>
      <a href="{{ route('views.blog') }}"
         class="transition {{ $currentRoute == 'views.blog' ? 'text-[#e60012] font-bold underline underline-offset-8' : 'text-[#262248]' }} hover:text-[#e60012]">
        Tin Tức
      </a>
    </li>
    <li>
      <a href="{{ route('views.contact') }}"
         class="transition {{ $currentRoute == 'views.contact' ? 'text-[#e60012] font-bold underline underline-offset-8' : 'text-[#262248]' }} hover:text-[#e60012]">
        Liên Hệ
      </a>
    </li>
  </ul>
</nav>

    <!-- Right Icons -->
    <div class="flex items-center gap-2 md:gap-5">
      <!-- Biểu tượng Giỏ hàng -->
      <div class="relative">
        @if (!session()->has('user_logged_in'))
        <span
        class="bg-[#fff2e1] rounded-full w-10 h-10 md:w-14 md:h-14 flex items-center justify-center text-xl md:text-2xl text-[#262248] hover:bg-[#f7e4d0] transition duration-150 ease-in-out">
        <a href="{{ route('login') }}"><i class="fa-solid fa-basket-shopping"></i></a>
      </span>
      <span
        class="absolute -top-2 -right-1 bg-[#ff8000] text-white text-xs font-bold rounded-full px-1.5 py-0.5 md:px-2 md:py-1 leading-none">05</span>
        @else
      <span
        class="bg-[#fff2e1] rounded-full w-10 h-10 md:w-14 md:h-14 flex items-center justify-center text-xl md:text-2xl text-[#262248] hover:bg-[#f7e4d0] transition duration-150 ease-in-out">
        <a href="{{ route('views.cart') }}"><i class="fa-solid fa-basket-shopping"></i></a>
      </span>
      <span
        class="absolute -top-2 -right-1 bg-[#ff8000] text-white text-xs font-bold rounded-full px-1.5 py-0.5 md:px-2 md:py-1 leading-none">05</span>
    @endif
      </div>
      <!-- Biểu tượng Người dùng -->
      <div class="relative">
        {{-- Nếu chưa có session staff và user thì show link đến login --}}
        @if (!session()->has('user_logged_in'))
      <a href="{{ route('login') }}">
        <span
        class="bg-[#fff2e1] rounded-full w-10 h-10 md:w-14 md:h-14 flex items-center justify-center text-xl md:text-2xl text-[#262248] cursor-pointer hover:bg-[#f7e4d0] transition duration-150 ease-in-out">
        <i class="fa-solid fa-user"></i>
        </span>
      </a>
    @else
      {{-- Nếu đã login (staff hoặc user) thì show dropdown toggle --}}
      <span id="userIconToggle"
        class="bg-[#fff2e1] rounded-full w-10 h-10 md:w-14 md:h-14 flex items-center justify-center text-xl md:text-2xl text-[#262248] cursor-pointer hover:bg-[#f7e4d0] transition duration-150 ease-in-out">
        <i class="fa-solid fa-user"></i>
      </span>
    @endif

        <!-- Dropdown -->
        <div id="userDropdown"
          class="absolute right-0 mt-2 w-64 bg-[#fff2e1] rounded-md shadow-lg transform scale-y-0 opacity-0 transition-all duration-300 origin-top z-50">
          <div class="p-3">
            {{-- Tên & email --}}
            <div class="mb-3">
              <p class="text-sm font-semibold text-black">
                {{ session('user_name') }}
              </p>
              <p class="text-xs text-gray-500">
                {{ session('user_email') }}
              </p>
            </div>

            <div class="space-y-2">
              <a href="{{ route('views.userdetail') }}"
                class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                <i class="fa-solid fa-user text-red-500 w-4"></i>
                <span>Thông tin cá nhân</span>
              </a>

              {{-- Đăng xuất --}}
              <a href="{{ route('logout') }}"
                class="flex items-center space-x-2 px-2 py-1 text-sm text-gray-700 hover:bg-gray-100 rounded">
                <i class="fa-solid fa-sign-out-alt text-red-500 w-4"></i>
                <span>Đăng xuất</span>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- Mobile Popup Menu -->
  <div id="mobileMenu" class="fixed inset-0 bg-black/60 z-50 hidden">
    <div class="absolute top-0 right-0 w-4/5 max-w-xs bg-white h-full shadow-lg flex flex-col">
      <button id="closeMenu" class="self-end p-4 text-2xl text-[#262248]" aria-label="Đóng Menu">
        <i class="fa-solid fa-times"></i>
      </button>
      <ul class="flex flex-col gap-2 mt-2 px-6 font-bold text-lg text-[#262248]">
        <li><a href="{{ route('views.index') }}" class="py-2 block">Trang Chủ</a></li>
        <li><a href="{{ route('views.about') }}" class="py-2 block">Thông Tin</a></li>
        <li><a href="{{ route('views.menu') }}" class="py-2 block">Thực Đơn</a></li>
        <li><a href="{{ route('views.blog') }}" class="py-2 block">Tin Tức</a></li>
        <li><a href="{{ route('views.contact') }}" class="py-2 block">Liên Hệ</a></li>
      </ul>
      <div class="flex gap-3 px-6 mt-6">
        <a href="#"
          class="bg-[#ff8000] w-9 h-9 rounded-full flex items-center justify-center text-white text-lg hover:bg-white hover:text-[#ff8000] transition"><i
            class="fab fa-facebook-f"></i></a>
        <a href="#"
          class="bg-[#ff8000] w-9 h-9 rounded-full flex items-center justify-center text-white text-lg hover:bg-white hover:text-[#ff8000] transition"><i
            class="fab fa-twitter"></i></a>
        <a href="#"
          class="bg-[#ff8000] w-9 h-9 rounded-full flex items-center justify-center text-white text-lg hover:bg-white hover:text-[#ff8000] transition"><i
            class="fab fa-linkedin-in"></i></a>
        <a href="#"
          class="bg-[#ff8000] w-9 h-9 rounded-full flex items-center justify-center text-white text-lg hover:bg-white hover:text-[#ff8000] transition"><i
            class="fab fa-behance"></i></a>
      </div>
      <div class="mt-auto px-6 pb-8 pt-8 text-sm text-[#262248]">
        <span class="flex items-center gap-2 mb-2">
          <i class="fa-solid fa-envelope"></i>
          examplemail@gmail.com
        </span>
        <span class="flex items-center gap-2">
          <i class="fa-solid fa-phone"></i>
          +96487452145214
        </span>
      </div>
    </div>
  </div>
</div>
<script>
  // Mobile menu open/close
  document.getElementById('openMenu').onclick = function () {
    document.getElementById('mobileMenu').classList.remove('hidden');
  }
  document.getElementById('closeMenu').onclick = function () {
    document.getElementById('mobileMenu').classList.add('hidden');
  }
  // Đóng menu khi click ra ngoài
  document.getElementById('mobileMenu').addEventListener('click', function (e) {
    if (e.target === this) this.classList.add('hidden');
  });
</script>
<script>
  const userIconToggle = document.getElementById('userIconToggle');
  const userDropdown = document.getElementById('userDropdown');

  // Hàm toggle dropdown
  const toggleDropdown = () => {
    if (userDropdown.classList.contains('hidden')) {
      userDropdown.classList.remove('hidden', 'scale-y-0', 'opacity-0');
      userDropdown.classList.add('scale-y-100', 'opacity-100');
    } else {
      userDropdown.classList.remove('scale-y-100', 'opacity-100');
      userDropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
    }
  };

  // Thêm sự kiện click cho biểu tượng người dùng
  userIconToggle.addEventListener('click', (e) => {
    e.preventDefault(); // Ngăn chặn hành vi mặc định nếu có
    toggleDropdown();
  });

  // Đóng dropdown khi click bên ngoài
  document.addEventListener('click', (e) => {
    if (!userIconToggle.contains(e.target) && !userDropdown.contains(e.target)) {
      userDropdown.classList.remove('scale-y-100', 'opacity-100');
      userDropdown.classList.add('hidden', 'scale-y-0', 'opacity-0');
    }
  });
</script>