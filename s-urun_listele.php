<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ürün Listesi</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/d0c556b316.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a class="don" href="index21.html"><img src="assets/images.png" alt="Logo"></a>
        </div>
        <div class="menu-right">
            <div  class="cta-button">
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
            <a href="gecmis.html">Giriş Yap / Üye Ol</a>
            <a href="cart.html">Sepetim</a>
        </div>
    </nav>
    <div id="mobileMenu" class="mobile-menu">
        <a href="#" class="closebtn" onclick="toggleMobileMenu()">&times;</a>
        <a href="index.html">Home</a>
        <a href="#">Services</a>
        <a href="#">About</a>
    </div>
    <div class="altnavbar">
        <div class="altic">
            <ul>
                <li><a href="#">Kadın Giyim</a></li>
                <li><a href="#">Erkek Giyim</a></li>
                <li><a href="#">Çocuk Giyim</a></li>
                <li><a href="#">Aksesuar/Takı</a></li>
                <li><a href="#">Kozmetik</a></li>
                <li><a href="#">Bilgisayar</a></li>
                <li><a href="#">Telefon</a></li>
                <li><a href="#">Kitap/Oyun</a></li>
            </ul>
        </div>
    </div>

    <div class="urunler">
        <div class="baslik">
            <h1>KATEGORİDEKİ ÜRÜNLER</h1>
        </div>
        <div class="cards">
            <?php
            $baglan = new mysqli("localhost", "root", "1234", "musteri");
            if ($baglan->connect_error) {
                die("Bağlantı hatası: " . $baglan->connect_error);
            }
            $baglan->set_charset("utf8");

            $sorgu = $baglan->query("SELECT * FROM urun WHERE kategori='Erkek Giyim' ORDER BY id ASC");

            while ($satir = $sorgu->fetch_object()) {
                echo "<div class='card' data-id='$satir->id' data-name='$satir->urun_adi' data-price='$satir->urun_fiyati' data-image='assets/{$satir->urun_resim}'>
                        <div class='card-top'>
                            <img src='assets/{$satir->urun_resim}' alt=''>
                        </div>
                        <div class='card-main'>
                            <p class='urun-adi'>{$satir->urun_adi}</p>
                            <p class='urun-fiyati'>{$satir->urun_fiyati} TL</p>
                        </div>
                        <div class='card-bottom'>
                            <a href='urun.php?id=$satir->id'>Düzenle</a> - <a href='urun_sil.php?id=$satir->id'>Sil</a>
                            <button class='add-to-cart'>SEPETE EKLE</button>
                        </div>
                    </div>";
            }

            $sorgu->free_result();
            $baglan->close();
            ?>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Hakkımızda</h3>
                <p>Bizim hakkımızda kısa bir bilgi.</p>
            </div>
            <div class="footer-column">
                <h3>Hizmetlerimiz</h3>
                <ul>
                    <li><a href="#">Hizmet 1</a></li>
                    <li><a href="#">Hizmet 2</a></li>
                    <li><a href="#">Hizmet 3</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>İletişim</h3>
                <ul>
                    <li><a href="#">İletişim 1</a></li>
                    <li><a href="#">İletişim 2</a></li>
                    <li><a href="#">İletişim 3</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 Şirket Adı. Tüm hakları saklıdır.</p>
        </div>
    </footer>
</body>
</html>
