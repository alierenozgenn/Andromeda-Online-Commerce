<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$baglan = new mysqli("localhost", "root", "1234", "musteri");

if ($baglan->connect_error) {
    die("Bağlantı hatası: " . $baglan->connect_error);
}
$baglan->set_charset("utf8");

if (!isset($_POST["id"]) || empty($_POST["urun_adi"]) || empty($_POST["fiyat"]) || empty($_POST["aciklama"])) {
    die("Gerekli veriler eksik veya boş.");
}

$kayitno = $_POST["id"];
$urun_adi = $_POST["urun_adi"];
$fiyat = $_POST["fiyat"];
$aciklama = $_POST["aciklama"];

if ($kayitno > 0) {
    $sorgu = $baglan->query("UPDATE urunler SET urun_adi='$urun_adi', fiyat='$fiyat', aciklama='$aciklama' WHERE id=$kayitno");

    if (!$sorgu) {
        die("Güncelleme hatası: " . $baglan->error);
    }

    $toplam = $baglan->affected_rows;

    if ($toplam > 0) {
        header("Location:urun.php");
    } else {
        echo "Düzenleme Yapılamadı.";
    }
} else {
    $sorgu = $baglan->prepare("INSERT INTO urunler (urun_adi, fiyat, aciklama) VALUES (?, ?, ?)");

    if (!$sorgu) {
        die("Hazırlama hatası: " . $baglan->error);
    }

    $sorgu->bind_param("ssd", $urun_adi, $fiyat, $aciklama);

    if (!$sorgu->execute()) {
        die("Ekleme hatası: " . $sorgu->error);
    }

    $toplam = $baglan->affected_rows;

    $sorgu->close();
    $baglan->close();

    if ($toplam > 0) {
        header("Location:urun.php");
    } else {
        echo "Ürün Eklenemedi.";
    }
}
?>
