<?php
$servername = "localhost";
$username = "root"; // Veritabanı kullanıcı adı
$password = "1234"; // Veritabanı şifresi
$dbname = "musteri"; // Veritabanı adı

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
