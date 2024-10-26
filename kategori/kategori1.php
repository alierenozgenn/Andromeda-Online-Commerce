<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Ürün Listesi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/d0c556b316.js" crossorigin="anonymous"></script>
    <style>
        .card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .card-top {
            width: 100%;
            height: 200px; /* İhtiyacınıza göre yüksekliği ayarlayın */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            flex: 1 1 calc(33.333% - 32px);
            max-width: calc(33.333% - 32px);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card-main {
            padding: 16px;
        }

        .card-bottom {
            padding: 16px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a class="don" href="../index.html"><img src="../assets/imagess.png" alt="Logo"></a>
        </div>
        <div class="menu-right">
            <div class="cta-button">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="q" aria-label="Search for inspiration"/>
            </div>
            <div class="hamburger" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="menu-left">
            <a href="../gecmis.html">Geçmiş Siparişlerim</a>
            <a href="../cart.html">Sepetim</a>
        </div>
    </nav>
    <div id="mobileMenu" class="mobile-menu">
        <a href="#" class="closebtn" onclick="toggleMobileMenu()">&times;</a>
        <a href="#">Home</a>
        <a href="#">Services</a>
        <a href="#">About</a>
    </div>
    <div class="altnavbar">
        <div class="altic">
            <ul>
                <li><a href="kategori1.php">Kadın Giyim</a></li>
                <li><a href="kategori2.php">Erkek Giyim</a></li>
                <li><a href="kategori3.php">Çocuk Giyim</a></li>
                <li><a href="kategori4.php">Aksesuar/Takı</a></li>
                <li><a href="kategori5.php">Kozmetik</a></li>
                <li><a href="kategori6.php">Bilgisayar</a></li>
                <li><a href="kategori7.php">Telefon</a></li>
                <li><a href="kategori8.php">Kitap/Oyun</a></li>
            </ul>
        </div>
    </div>

    <div class="urunler">
        <div class="baslik">
            <h1>Kadın Giyim Kategorisindeki Ürünler</h1>
        </div>
        <div class="cards">
            <?php
            $baglan = new mysqli("localhost", "root", "1234", "musteri");
            if ($baglan->connect_error) {
                die("Bağlantı hatası: " . $baglan->connect_error);
            }
            $baglan->set_charset("utf8");

            $sorgu = $baglan->query("SELECT * FROM urun WHERE kategori='Kadın Giyim' ORDER BY id ASC");

            while ($satir = $sorgu->fetch_object()) {
                echo "<div class='card' data-id='$satir->id' data-name='$satir->urun_adi' data-price='$satir->urun_fiyati' data-image='../uploads/{$satir->urun_resim}'>
                        <div class='card-top'>
                            <img src='../uploads/{$satir->urun_resim}' alt=''>
                        </div>
                        <div class='card-main'>
                            <p class='urun-adi'>{$satir->urun_adi}</p>
                            <p class='urun-fiyati'>{$satir->urun_fiyati} TL</p>
                        </div>
                        <div class='card-bottom'>
                            <a href='../urun.php?id=$satir->id'>Düzenle</a> - <a href='../urun_sil.php?id=$satir->id'>Sil</a>
                            <button class='add-to-cart'>SEPETE EKLE</button>
                        </div>
                    </div>";
            }

            $sorgu->free_result();
            $baglan->close();
            ?>
        </div>
    </div>

    <div class="iletisim-bg">
        <div class="iletisim">
            <div class="ust">
                <div class="iletisim-sol">
                    <h3 class="kalin">Andromeda</h3>
                    <p class="infoTxt">Cumhuriyet Mah. 32. Sok No.3 D.24 Atakum / SAMSUN</p>
                    <p class="infoTxt">+902243841356</p>
                    <p class="infoTxt">info@andromeda.com</p>
                </div>
                <div class="iletisim-sol">
                    <img src="../assets/imagess.png" alt="">
                </div>
                <div class="iletisim-sol">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d529.566714109879!2d36.26744738467887!3d41.337533964331804!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1str!2str!4v1717421720489!5m2!1str!2str" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="alt">
                <ul>
                    <li><a href="https://www.instagram.com/alierenozgen/">instagram/andromeda</a></li>
                    <li><a href="https://facebook.com/alierenozgen">facebook/andromeda</a></li>
                    <li><a href="https://www.instagram.com/tarik.ayvaz/">instagram/andromeda</a></li>
                    <li><a href="https://x.com/tarikayvz">x/andromeda</a></li>
                </ul>
            </div>
        </div>
    </div>
    <script>
        function toggleMobileMenu() {
            var mobileMenu = document.getElementById("mobileMenu");
            mobileMenu.classList.toggle("open");
        }

        document.addEventListener('DOMContentLoaded', function() {
            var addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var card = this.closest('.card');
                    var id = card.getAttribute('data-id');
                    var name = card.getAttribute('data-name');
                    var price = card.getAttribute('data-price');
                    var image = card.getAttribute('data-image');

                    var cartItem = {
                        id: id,
                        name: name,
                        price: price,
                        image: image,
                        quantity: 1
                    };

                    var cart = localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : [];
                    var existingItemIndex = cart.findIndex(item => item.id === id);

                    if (existingItemIndex !== -1) {
                        cart[existingItemIndex].quantity += 1;
                    } else {
                        cart.push(cartItem);
                    }

                    localStorage.setItem('cart', JSON.stringify(cart));
                    alert('Ürününüz sepete eklendi!');
                });
            });
        });
    </script>
</body>
</html>
