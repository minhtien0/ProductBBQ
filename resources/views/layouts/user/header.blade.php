<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BE BE LUA HOY</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #1a1a1a;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: Arial, sans-serif;
            position: sticky;
            top: 0;
            z-index: 1000;

        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 50px;
            margin-right: 10px;
        }

        .logo span {
            color: #fff;
            font-size: 18px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-size: 16px;
        }

        .nav-links span {
            color: #ccc;
        }

        .nav-links a:hover {
            color: #ccc;
        }

        .book-table-btn {
            background-color: #e60012;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-left: 15px;
        }

        .book-table-btn:hover {
            background-color: #cc0010;
        }

        .menu-btn {
            display: none;
            background-color: #e60012;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .menu-btn:hover {
            background-color: #cc0010;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .menu-btn {
                display: block;
            }

            .nav-links {
                display: none;
                position: absolute;
                top: 70px;
                left: 0;
                right: 0;
                background-color: #1a1a1a;
                flex-direction: column;
                align-items: flex-start;
                padding: 10px;
                z-index: 10;
            }

            .nav-links.show {
                display: flex;
            }

            .nav-links a {
                margin: 5px 0;
                font-size: 14px;
            }

            .book-table-btn {
                margin-top: 10px;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/logo2.jpg" alt="Gyu-Kaku Logo">
            <span>BE BE<br>LUA HOI</span>
        </div>
        <button class="menu-btn" onclick="toggleMenu()">Menu</button>
        <nav class="nav-links" id="nav-links">
            <?php
                $menu_items = [
                    "Home" => "#home",
                    "About" => "#about",
                    "Menu" => "#menu",
                    "Chefs" => "#chefs",
                    "Pages" => "#page",
                    "Blog" => "#blog",
                    "Contact" => "#contact"
                ];
                foreach ($menu_items as $label => $link) {
                    echo "<a href='$link'>$label</a>";
                    if ($label !== "Menu" && $label !== "Nhà hàng" && $label !== "Khuyến mãi") {
                        echo "<span> - </span>";
                    }
                }
            ?>
            <a href="#book-table" class="book-table-btn">Đặt Bàn</a>
        </nav>
    </header>
    <script>
        function toggleMenu() {
            var nav = document.getElementById('nav-links');
            nav.classList.toggle('show');
        }
        // Đóng menu khi bấm link trên mobile (trải nghiệm tốt hơn)
        document.addEventListener('DOMContentLoaded', function() {
            var links = document.querySelectorAll('#nav-links a');
            links.forEach(function(link){
                link.addEventListener('click', function(){
                    if(window.innerWidth <= 768){
                        document.getElementById('nav-links').classList.remove('show');
                    }
                });
            });
        });
    </script>
</body>
</html>
