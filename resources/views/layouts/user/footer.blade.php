<style>
       :root {
            --primary: #e60012;
            --deep: #262465;
        }

        .footer-section {
            background: linear-gradient(rgba(34, 20, 50, 0.79), rgba(34, 20, 50, 0.79)), url('{{ asset('img/banner1.jpg') }}') center/cover no-repeat;
            padding: 38px 0 0 0;
        }

        .footer-wrap {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            gap: 42px;
            align-items: flex-start;
            flex-wrap: wrap;
            color: #fff;
        }

        .footer-col {
            flex: 1 1 185px;
            min-width: 170px;
            margin-bottom: 30px;
        }

        .footer-col h3 {
            color: var(--primary);
            font-size: 1.17rem;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: .5px;
        }

        .footer-logo {
            font-size: 1.43rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .footer-logo i {
            font-size: 2.2rem;
            color: var(--primary);
        }

        .footer-desc {
            font-size: 1rem;
            color: #e9e9e9;
            margin-bottom: 16px;
            line-height: 1.5;
        }

        .footer-social {
            display: flex;
            gap: 9px;
            margin-bottom: 8px;
        }

        .footer-social a {
            color: #fff;
            background: var(--primary);
            border-radius: 50%;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.13rem;
            transition: background 0.18s, color 0.18s;
            text-decoration: none;
        }

        .footer-social a:hover {
            background: #fff;
            color: var(--primary);
        }

        .footer-link-list,
        .footer-help-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-link-list li,
        .footer-help-list li {
            margin-bottom: 11px;
        }

        .footer-link-list a,
        .footer-help-list a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            transition: color .17s;
        }

        .footer-link-list a:hover,
        .footer-help-list a:hover {
            color: var(--primary);
        }

        .footer-contact {
            color: #fff;
            font-size: 1rem;
            margin-bottom: 10px;
            line-height: 1.7;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .footer-contact i {
            color: var(--primary);
            margin-right: 8px;
            font-size: 1.13em;
            min-width: 19px;
            text-align: center;
        }

        .footer-bottom {
            background: var(--primary);
            color: #fff;
            text-align: center;
            padding: 12px 0 10px 0;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 0;
            position: relative;
            z-index: 2;
            letter-spacing: .4px;
        }

        .footer-scrolltop {
            position: absolute;
            right: 18px;
            bottom: 16px;
            background: #fff;
            color: var(--primary);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 5px #2222;
            font-size: 1.2em;
            cursor: pointer;
            border: 2px solid var(--primary);
            transition: background 0.15s, color 0.15s;
        }

        .footer-scrolltop:hover {
            background: var(--primary);
            color: #fff;
        }

        @media (max-width: 970px) {
            .footer-wrap {
                flex-wrap: wrap;
                gap: 26px;
            }

            .footer-col {
                min-width: 45vw;
            }
        }

        @media (max-width: 640px) {
            .footer-wrap {
                flex-direction: column;
                align-items: flex-start;
                gap: 0;
            }

            .footer-col {
                min-width: 100%;
                margin-bottom: 22px;
            }

            .footer-section {
                padding: 22px 0 0 0;
            }

            .footer-bottom {
                font-size: .96em;
            }
        }
</style>
<section>
   <div class="scroll_btn hidden fixed bottom-4 right-4 bg-red-600 text-white p-3 md:p-4 rounded-full text-xl md:text-2xl shadow-lg cursor-pointer hover:bg-red-700 z-50 w-12 h-12">
  <i class="fas fa-hand-pointer flex items-center justify-center" aria-hidden="true"></i>
</div>
<footer>
        <div class="footer-section overflow-x-hidden">
            <div class="footer-wrap w-full max-w-[1300px] mx-auto px-6 flex flex-wrap justify-between gap-6 md:gap-10 overflow-hidden">
                <!-- Logo & Social -->
                <div class="footer-col flex-1">
                    <div class="footer-logo">
                        <i class="fa-solid fa-utensils"></i> LUA BE HOY
                    </div>
                    <div class="footer-desc">
                   Lua Be Hoy là điểm đến lý tưởng dành cho những tín đồ yêu thích món nướng. Với không gian hiện đại, ấm cúng và phong cách phục vụ chuyên nghiệp.
                    </div>
                    <div class="footer-social">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <!-- Short Link -->
                <div class="footer-col flex-1 flex flex-col items-center">
                    <h3 class="text-center mb-2">Liên Kết</h3>
                    <ul class="footer-link-list text-center">
                        <li><a href="{{ route('views.index') }}">Trang Chủ</a></li>
                        <li><a href="{{ route('views.about') }}">Giới Thiệu</a></li>
                        <li><a href="{{ route('views.contact') }}">Liên Hệ</a></li>
                        <li><a href="{{ route('views.blog') }}">Tin Tức</a></li>
                    </ul>
                </div>
                <!-- Contact -->
                <div class="footer-col flex-1">
                    <h3>Liên hệ với chúng tôi</h3>
                    <div class="footer-contact">
                        <div><i class="fa fa-phone"></i>{{ $infos->sdt }}</div>
                        <div><i class="fa fa-envelope"></i> {{ $infos->email }}</div>
                        <div><i class="fa fa-location-dot"></i>{{ $infos->address }}</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </section>
    <script>
  document.addEventListener("DOMContentLoaded", () => {
    const scrollBtn = document.querySelector('.scroll_btn');

    // Hiện/ẩn nút khi cuộn
    window.addEventListener('scroll', () => {
      if (window.scrollY > 300) {
        scrollBtn.classList.remove('hidden');
      } else {
        scrollBtn.classList.add('hidden');
      }
    });

    // Cuộn mượt lên đầu khi bấm
    scrollBtn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  });
</script>