<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kayıt Listesi - Veritabanı Uygulaması</title>
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
            max-width: 1000px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #f4f4f4;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #f1f1f1;
        }

        .total-records {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index21.html">ANA SAYFA</a> - <a href="liste.php">KAYIT LİSTESİ</a> - <a href="urun.php">ÜRÜN EKLE</a> - <a href="yeni.php">YENİ KAYIT</a>
        <br><hr><br><br>
        <?php
            $baglan = new mysqli("localhost","root","1234","musteri");
            $baglan->set_charset("utf8");

            $sorgu = $baglan->query("select * from kayit order by id asc");

            echo "<table>
            <tr>
            <th>S. No</th>
            <th>Adı Soyadı</th>
            <th>Mail</th>
            <th>Telefon No</th>
            <th>Şifre</th>
            <th>İşlemler</th>
            </tr>";
            
            while ($satir = $sorgu->fetch_object()) {
                echo "<tr>
                <td> $satir->id </td>
                <td> $satir->ad </td>
                <td> $satir->mail </td>
                <td> $satir->tel </td>
                <td> $satir->sifre </td>
                <td> <a href='yeni.php?id=$satir->id'>dz</a> - <a href='sil.php?id=$satir->id'>sl</a> </td>
                </tr>";
            }

            echo "</table>";

            $toplam = $sorgu->num_rows;

            $sorgu->free_result();

            $baglan->close();

            echo "<div class='total-records'>Toplam $toplam Kayıt Bulundu.</div>";
        ?>
    </div>
</body>
</html>
