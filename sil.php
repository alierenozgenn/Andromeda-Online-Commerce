<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kayıt Silme - Veritabanı Uygulaması</title>
</head>
<body>
    <div style="text-align:center;">
        <a href="index21.html">ANA SAYFA</a> - <a href="liste.php">KAYIT LİSTESİ</a> - <a href="yeni.php">YENİ KAYIT</a>
        <br><hr><br><br>
    </div>
    <?php
        $baglan = new mysqli("localhost","root","1234","musteri");
        $baglan->set_charset("utf8");

        $kayitno = $_GET["id"];

        $sorgu= $baglan->query("delete from kayit where id=$kayitno");

        if ($sorgu) {
            echo "<script>
            alert('Kayıt Silindi!');
            window.location.href = 'liste.php';
            </script>";
        } else {
            echo "Kayıt Silinemedi.";
        }
    ?>
</body>
</html>