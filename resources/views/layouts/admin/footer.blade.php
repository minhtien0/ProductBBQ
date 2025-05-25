<footer class="bg-gray-700 text-gray-300">
  <div class="container mx-auto px-6 py-10">
    <div class="flex flex-col md:flex-row justify-between">
      <!-- Logo Column -->
      <div class="mb-6 md:mb-0">
        <h2 class="text-2xl font-bold text-white mb-4">{{ trans('messages.welcome') }}</h2>
        <p>Ngôn ngữ hiện tại: {{ App::getLocale() }}</p>
        <p>Ngôn ngữ trong session: {{ Session::get('website_language', 'Chưa đặt') }}</p>
      </div>

      <!-- Get started Column -->
      <div class="mb-6 md:mb-0">
        <h3 class="text-lg font-semibold text-white mb-3">Get started</h3>
        <ul>
          <li class="mb-2"><a href="#" class="hover:text-white">Home</a></li>
          <li class="mb-2"><a href="#" class="hover:text-white">Sign up</a></li>
          <li class="mb-2"><a href="#" class="hover:text-white">Downloads</a></li>
        </ul>
      </div>

      <!-- About us Column -->
      <div class="mb-6 md:mb-0">
        <h3 class="text-lg font-semibold text-white mb-3">About us</h3>
        <ul>
          <li class="mb-2"><a href="#" class="hover:text-white">Company Information</a></li>
          <li class="mb-2"><a href="#" class="hover:text-white">Contact us</a></li>
          <li class="mb-2"><a href="#" class="hover:text-white">Reviews</a></li>
        </ul>
      </div>

      <!-- Support Column -->
      <div class="mb-6 md:mb-0">
        <h3 class="text-lg font-semibold text-white mb-3">Support</h3>
        <ul>
          <li class="mb-2"><a href="#" class="hover:text-white">FAQ</a></li>
          <li class="mb-2"><a href="#" class="hover:text-white" onclick="togglePopup()">Help desk</a></li>
          <li class="mb-2"><a href="#" class="hover:text-white">Forums</a></li>
        </ul>
      </div>

      <!-- Social Media and Contact Column -->
      <div>
        <div class="flex space-x-4 mb-4">
          <a href="#" class="text-gray-400 hover:text-white">
            <i class="fa-brands fa-twitter text-lg"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white">
            <i class="fa-brands fa-facebook text-lg"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white">
            <i class="fa-brands fa-google-plus text-lg"></i>
          </a>
        </div>
        <button class="bg-red-500 hover:bg-red-600 text-white rounded-full px-6 py-2 text-sm font-medium transition duration-300">
          Contact us
        </button>
      </div>
    </div>
  </div>
  
  <!-- Copyright Bar -->
  <div class="bg-gray-900 py-2">
    <div class="container mx-auto px-6">
      <p class="text-sm text-center">© 2025 Copyright Text</p>
    </div>
  </div>

  <!--Popup hổ trợ-->
  <div id="requestPopup" class="fixed inset-0 bg-gray-900/50 flex items-center justify-center hidden z-90">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Tạo yêu cầu mới</h2>
            <button onclick="togglePopup()" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>

        <!-- Form -->
        <div class="space-y-4">
            <!-- Tiêu chí hỗ trợ -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    <span class="text-red-500">*</span> Tiêu chí hỗ trợ
                </label>
                <div class="relative mt-1">
                    <select class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm text-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option disabled selected>Chọn tiêu chí hỗ trợ</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Nội dung hỗ trợ -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    <span class="text-red-500">*</span> Nội dung hỗ trợ
                </label>
                <div class="relative mt-1">
                    <select class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm text-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option disabled selected>Chọn nội dung hỗ trợ</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- Số điện thoại -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    <span class="text-red-500">*</span> Số điện thoại
                </label>
                <div class="relative mt-1">
                    <input type="text" maxlength="500" placeholder="Số điện thoại" class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-xs text-gray-500">0 / 500</span>
                </div>
            </div>

            <!-- Nguồn nhận yêu cầu -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Nguồn nhận yêu cầu
                </label>
                <div class="relative mt-1">
                    <select class="w-full border border-gray-300 rounded-md py-2 px-3 text-sm text-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <option disabled selected>Chọn nguồn hỗ trợ</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>

            <!-- File đính kèm -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    <span class="text-red-500">*</span> File đính kèm
                </label>
                <div class="mt-1">
                    <div class="border-2 border-dashed border-gray-300 rounded-md py-4 px-3 text-center">
                        <i class="fa-solid fa-paperclip text-gray-400 mb-2"></i>
                        <p class="text-sm text-gray-500">File đính kèm</p>
                        <p class="text-xs text-gray-400">0 / 500 Số dữ liệu</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-2 mt-6">
            <button onclick="togglePopup()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-100">
                Hủy
            </button>
            <button class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 flex items-center">
                <i class="fa-solid fa-paper-plane mr-2"></i>
                Gửi yêu cầu
            </button>
        </div>
    </div>

    <script>
        function togglePopup() {
            const popup = document.getElementById('requestPopup');
            popup.classList.toggle('hidden');
        }
    </script>
</div>
</footer>