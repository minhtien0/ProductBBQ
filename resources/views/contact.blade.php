<!DOCTYPE html>
<html lang="en">
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
                    },
                },
            },
        };
    </script>
    </head>
<body class="bg-dark-bg">
@include('layouts.user.header')
  <!-- Banner -->
  <div class="relative w-full">
  <!-- Background image (thay src thành ảnh của bạn nếu cần) -->
  <img src="img/banner1.jpg" alt="Contact" class="w-full h-[260px] md:h-[360px] object-cover">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-[#231f42] opacity-70"></div>
  <!-- Content -->
  <div class="absolute inset-0 flex flex-col justify-center px-4 md:px-16">
    <h1 class="text-white font-extrabold text-4xl md:text-6xl mb-4">About Us</h1>
    <div class="flex items-center gap-3 text-lg md:text-xl font-semibold">
      <i class="fa fa-home text-white"></i>
      <a href="{{ route('views.index') }}" ><span class="text-white">Home</span> </a>
      <span class="text-white">–</span>
      <span class="text-[#ff8000]">Contact</span>
    </div>
  </div>
</div>

  <!-- Contact Section -->
  <section class="max-w-6xl mx-auto px-2 md:px-0 my-8 flex flex-col md:flex-row gap-4">
    <!-- Left: Info -->
    <div class="bg-[#f2f6fa] flex-1 rounded-lg p-6 md:p-8 shadow flex flex-col gap-6 justify-center min-w-[260px]">
      <!-- Call -->
      <div class="border-b border-[#e60012] pb-2 text-center">
        <div class="text-[#e60012] font-bold text-lg mb-1">Call</div>
        <div class="text-[13px] text-gray-700 leading-5">+1 347-430-5910<br>+96874565402</div>
      </div>
      <!-- Mail -->
      <div class="border-b border-[#e60012] pb-2 text-center">
        <div class="text-[#e60012] font-bold text-lg mb-1 mt-3">Mail</div>
        <div class="text-[13px] text-gray-700 leading-5">websolutionusa1@gmail.com<br>example@gmail.com</div>
      </div>
      <!-- Location -->
      <div class="text-center mt-3">
        <div class="text-[#e60012] font-bold text-lg mb-1">Location</div>
        <div class="text-[13px] text-gray-700 leading-5">
          7232 Broadway Suite 308, Jackson Heights, 11372, NY, United States
        </div>
      </div>
    </div>

    <!-- Right: Contact Form -->
    <div class="bg-[#f2f6fa] flex-1 rounded-lg p-6 md:p-8 shadow">
      <div class="text-lg font-semibold mb-4">Contact Us</div>
      <form class="space-y-3">
        <!-- Name -->
        <div class="flex flex-col md:flex-row gap-2">
          <div class="relative flex-1">
            <input type="text" placeholder="Name" class="pl-8 pr-2 py-2 w-full rounded border border-gray-300 focus:ring-2 focus:ring-[#e60012] outline-none text-sm" />
            <i class="fa fa-user absolute top-1/2 left-2 -translate-y-1/2 text-[#e60012]"></i>
          </div>
          <div class="flex-1 flex gap-2">
            <div class="relative flex-1">
              <input type="email" placeholder="Email" class="pl-8 pr-2 py-2 w-full rounded border border-gray-300 focus:ring-2 focus:ring-[#e60012] outline-none text-sm" />
              <i class="fa fa-envelope absolute top-1/2 left-2 -translate-y-1/2 text-[#e60012]"></i>
            </div>
            <div class="relative flex-1">
              <input type="text" placeholder="Phone" class="pl-8 pr-2 py-2 w-full rounded border border-gray-300 focus:ring-2 focus:ring-[#e60012] outline-none text-sm" />
              <i class="fa fa-phone absolute top-1/2 left-2 -translate-y-1/2 text-[#e60012]"></i>
            </div>
          </div>
        </div>
        <!-- Subject -->
        <div class="relative">
          <input type="text" placeholder="Subject" class="pl-8 pr-2 py-2 w-full rounded border border-gray-300 focus:ring-2 focus:ring-[#e60012] outline-none text-sm" />
          <i class="fa fa-tag absolute top-1/2 left-2 -translate-y-1/2 text-[#e60012]"></i>
        </div>
        <!-- Message -->
        <div class="relative">
          <textarea placeholder="Message" rows="3" class="pl-8 pr-2 py-2 w-full rounded border border-gray-300 focus:ring-2 focus:ring-[#e60012] outline-none text-sm resize-none"></textarea>
          <i class="fa fa-pencil absolute top-3 left-2 text-[#e60012]"></i>
        </div>
        <button type="submit" class="bg-[#e60012] text-white px-5 py-2 rounded font-semibold hover:bg-[#e05c00] transition">Send Message</button>
      </form>
    </div>
  </section>

  <!-- Map -->
  <div class="max-w-6xl mx-auto mb-8">
    <iframe
      class="w-full h-60 md:h-80 rounded shadow"
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233668.36608885253!2d90.27919402676908!3d23.7808874563248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8c731ece9f5%3A0x2d6e5c8a5d3e54c2!2zSG_DoG5nIE3DoWkgQ2jDrSBUaOG7jW5nIEtodQ!5e0!3m2!1svi!2s!4v1685538105322!5m2!1svi!2s"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

</body>
@include('layouts.user.footer')
</html>
