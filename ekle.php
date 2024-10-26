<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$baglan = new mysqli("localhost", "root", "1234", "musteri");

if ($baglan->connect_error) {
    die("Bağlantı hatası: " . $baglan->connect_error);
}
$baglan->set_charset("utf8");

if (!isset($_POST["id"]) || empty($_POST["ad"]) || empty($_POST["mail"]) || empty($_POST["tel"]) || empty($_POST["sifre"])) {
    die("Gerekli veriler eksik veya boş.");
}

$kayitno = $_POST["id"];
$ad = $_POST["ad"];
$mail = $_POST["mail"];
$tel = $_POST["tel"];
$sifre = $_POST["sifre"];

if ($kayitno > 0) {
    $sorgu = $baglan->query("UPDATE kayit SET ad='$ad', mail='$mail', tel='$tel', sifre='$sifre' WHERE id=$kayitno");

    if (!$sorgu) {
        die("Güncelleme hatası: " . $baglan->error);
    }

    $toplam = $baglan->affected_rows;

    if ($toplam > 0) {
        header("Location:yeni.php");
    } else {
        echo "Düzenleme Yapılamadı.";
    }
} else {
    $sorgu = $baglan->prepare("INSERT INTO kayit (ad, mail, tel, sifre) VALUES (?, ?, ?, ?)");

    if (!$sorgu) {
        die("Hazırlama hatası: " . $baglan->error);
    }

    $sorgu->bind_param("ssss", $ad, $mail, $tel, $sifre);

    if (!$sorgu->execute()) {
        die("Ekleme hatası: " . $sorgu->error);
    }

    $toplam = $baglan->affected_rows;

    $sorgu->close();
    $baglan->close();

    if ($toplam > 0) {
        header("Location:yeni.php");
    } else {
        echo "Kayıt Eklenemedi.";
    }
}
?>
