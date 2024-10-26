<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ürün Listesi - Veritabanı Uygulaması</title>
</head>
<body>
    <div style="text-align:center;">
        <a href="index21.html">ANA SAYFA</a> - <a href="liste.php">KAYIT LİSTESİ</a> - <a href="urunler.php">ÜRÜN LİSTESİ</a> - <a href="urun.php">YENİ ÜRÜN</a>
        <br><hr><br><br>
    </div>
    <?php
        $baglan = new mysqli("localhost","root","1234","musteri");
        $baglan->set_charset("utf8");

        $sorgu = $baglan->query("SELECT * FROM urunler ORDER BY id ASC");

        echo "<table width='100%' border='1'>
        <tr align='center'>
        <th>S. No</th>
        <th>Ürün Adı</th>
        <th>Fiyat</th>
        <th>Açıklama</th>
        <th>İşlemler</th>
        </tr>";
        
        while ($satir = $sorgu->fetch_object()) {
            echo "<tr align='center'>
            <td> $satir->id </td>
            <td> $satir->urun_adi </td>
            <td> $satir->fiyat </td>
            <td> $satir->aciklama </td>
            <td> <a href='urun.php?id=$satir->id'>dz</a> - <a href='urun_sil.php?id=$satir->id'>sl</a> </td>
            </tr>";
        }

        echo "</table>";

        $toplam = $sorgu->num_rows;

        $sorgu->free_result();

        $baglan->close();

        echo "<br><br>Toplam $toplam Ürün Bulundu.";
    ?>
</body>
</html>
