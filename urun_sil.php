<?php
$baglan = new mysqli("localhost", "root", "1234", "musteri");

if ($baglan->connect_error) {
    die("Bağlantı hatası: " . $baglan->connect_error);
}

$id = (int)$_GET['id'];

$sorgu = $baglan->query("DELETE FROM urun WHERE id=$id");

if ($sorgu) {
    header("Location: index.html");
} else {
    echo "Silme hatası: " . $baglan->error;
}

$baglan->close();
?>
