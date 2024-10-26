<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$baglan = new mysqli("localhost", "root", "1234", "musteri");

if ($baglan->connect_error) {
    die("Bağlantı hatası: " . $baglan->connect_error);
}
$baglan->set_charset("utf8");

$urunno = isset($_GET["id"]) ? (int) $_GET["id"] : 0;
$urun_adi = "";
$urun_fiyati = "";
$urun_resim = "";
$urun_kategori = "";

if ($urunno > 0) {
    $sorgu = $baglan->query("SELECT * FROM urun WHERE id = $urunno");
    $satir = $sorgu->fetch_object();

    if ($satir) {
        $urun_adi = $satir->urun_adi;
        $urun_fiyati = $satir->urun_fiyati;
        $urun_resim = $satir->urun_resim;
        $urun_kategori = $satir->kategori;
    }

    $sorgu->free_result();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $urunno = $_POST["id"];
    $urun_adi = $_POST["urun_adi"];
    $urun_fiyati = $_POST["urun_fiyati"];
    $urun_kategori = $_POST["urun_kategori"];
    $redirect_page = $_POST["redirect_page"];
    $urun_resim = $urun_resim;

    if (!empty($_FILES["urun_resim"]["name"])) {
        $urun_resim = basename($_FILES["urun_resim"]["name"]);
        $target_dir = "../uploads/";
        $target_file = $target_dir . $urun_resim;
        move_uploaded_file($_FILES["urun_resim"]["tmp_name"], $target_file);
    }

    if ($urunno > 0) {
        $sorgu = $baglan->query("UPDATE urun SET urun_adi='$urun_adi', urun_fiyati='$urun_fiyati', urun_resim='$urun_resim', kategori='$urun_kategori' WHERE id=$urunno");

        if (!$sorgu) {
            die("Güncelleme hatası: " . $baglan->error);
        }
    } else {
        $sorgu = $baglan->prepare("INSERT INTO urun (urun_adi, urun_fiyati, urun_resim, kategori) VALUES (?, ?, ?, ?)");

        if (!$sorgu) {
            die("Hazırlama hatası: " . $baglan->error);
        }

        $sorgu->bind_param("ssss", $urun_adi, $urun_fiyati, $urun_resim, $urun_kategori);

        if (!$sorgu->execute()) {
            die("Ekleme hatası: " . $sorgu->error);
        }

        $sorgu->close();
    }

    $baglan->close();
    header("Location: $redirect_page");
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Ürün Ekle/Düzenle</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: #f3f3f3;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        .container a {
            margin: 0 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        .container a:hover {
            text-decoration: underline;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"], input[type="file"], select {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        input[type="submit"] {
            width: 40%;
            padding: 10px;
            margin: 20px 0;
            border: none;
            border-radius: 5px;
            background: #3b3f5c;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #2a2c4b;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index21.html">ANA SAYFA</a> - <a href="liste.php">KAYIT LİSTESİ</a> - <a href="urun.php">ÜRÜN EKLE</a> - <a href="yeni.php">YENİ KAYIT</a>
        <br><hr><br><br>
        <form method="post" action="urun.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $urunno; ?>">
            Ürün Adı: <input type="text" name="urun_adi" value="<?php echo $urun_adi; ?>"><br><br>
            Ürün Fiyatı: <input type="text" name="urun_fiyati" value="<?php echo $urun_fiyati; ?>"><br><br>
            Ürün Resmi: <input type="file" name="urun_resim"><br><br>
            Kategori:
            <select name="urun_kategori">
                <option value="Kadın Giyim" <?php if($urun_kategori == "Kadın Giyim") echo "selected"; ?>>Kadın Giyim</option>
                <option value="Erkek Giyim" <?php if($urun_kategori == "Erkek Giyim") echo "selected"; ?>>Erkek Giyim</option>
                <option value="Çocuk Giyim" <?php if($urun_kategori == "Çocuk Giyim") echo "selected"; ?>>Çocuk Giyim</option>
                <option value="Aksesuar/Takı" <?php if($urun_kategori == "Aksesuar/Takı") echo "selected"; ?>>Aksesuar/Takı</option>
                <option value="Kozmetik" <?php if($urun_kategori == "Kozmetik") echo "selected"; ?>>Kozmetik</option>
                <option value="Bilgisayar" <?php if($urun_kategori == "Bilgisayar") echo "selected"; ?>>Bilgisayar</option>
                <option value="Telefon" <?php if($urun_kategori == "Telefon") echo "selected"; ?>>Telefon</option>
                <option value="Kitap/Oyun" <?php if($urun_kategori == "Kitap/Oyun") echo "selected"; ?>>Kitap/Oyun</option>
            </select><br><br>
            Yönlendirme Sayfası:
            <select name="redirect_page">
                <option value="kategori/kategori1.php">Kategori 1</option>
                <option value="kategori/kategori2.php">Kategori 2</option>
                <option value="kategori/kategori3.php">Kategori 3</option>
                <option value="kategori/kategori4.php">Kategori 4</option>
                <option value="kategori/kategori5.php">Kategori 5</option>
                <option value="kategori/kategori6.php">Kategori 6</option>
                <option value="kategori/kategori7.php">Kategori 7</option>
                <option value="kategori/kategori8.php">Kategori 8</option>
            </select><br><br>
            <input type="submit" value="Kaydet">
        </form>
    </div>
</body>
</html>
