<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Database connection
    $baglan = new mysqli("localhost", "root", "1234", "musteri");
    
    if ($baglan->connect_error) {
        die("Bağlantı hatası: " . $baglan->connect_error);
    }
    $baglan->set_charset("utf8");
    
    // Check if the form is submitted for login
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
    
        // Validate input (you can add more validation as per your requirements)
        if (empty($email) || empty($password)) {
            die("Lütfen email ve şifre giriniz.");
        }
    
        // Prepare and execute the query to fetch user by email and password
        $query = "SELECT * FROM kayit WHERE mail=? AND sifre=?";
        $stmt = $baglan->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows == 1) {
            // User found, redirect to the dashboard or another page
            header("Location: dashboard.php");
            exit();
        } else {
            // User not found or credentials invalid
            echo "Geçersiz email veya şifre.";
        }
    }



    $kayitno = isset($_GET["id"]) ? (int) $_GET["id"] : 0;

    $ad = "";
    $mail = "";
    $tel = "";
    $sifre = "";

    if ($kayitno > 0) {
        $baglan = new mysqli("localhost", "root", "1234", "musteri");
        $baglan->set_charset("utf8");

        $sorgu = $baglan->query("SELECT * FROM kayit WHERE id = $kayitno");
        $satir = $sorgu->fetch_object();

        if ($satir) {
            $ad = $satir->ad;
            $mail = $satir->mail;
            $tel = $satir->tel;
            $sifre = $satir->sifre;
        }

        $sorgu->free_result();
        $baglan->close();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginpage.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="login-reg-panel">
        <div class="login-info-box">
            <h2>Zaten bir hesabınız var mı?</h2>
            <p>Giriş yapmak için altıma tıkla!</p>
            <label id="label-register" for="log-reg-show">GİRİŞ YAP</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>

        <div class="register-info-box">
            <h2>Hesabınız yok mu?</h2>
            <p>Hesap oluşturmak için altıma tıkla!</p>
            <label id="label-login" for="log-login-show">KAYDOL</label>
            <input type="radio" name="active-log-panel" id="log-login-show">
        </div>

        <div class="white-panel">
            <div class="login-show">
                <h2>Giriş Yap!</h2>
                <form action="login.php" method="post">
                    <input type="text" placeholder="Email" name="email" required>
                    <input type="password" placeholder="Şifre" name="password" required>
                    <input type="submit" value="Giriş">
                </form>
            </div>
            <div class="register-show">
                <h2>Hesap Oluştur</h2>
                <form action="ekle.php" method="post" style="text-align:center;">
                    <input type="text" placeholder="İsim Soyisim" name="ad" value="<?php echo htmlspecialchars($ad); ?>" size="30" required>
                    <input type="text" placeholder="E-Mail" name="mail" value="<?php echo htmlspecialchars($mail); ?>" size="30" required>
                    <input type="text" placeholder="Telefon Numarası" name="tel" value="<?php echo htmlspecialchars($tel); ?>" size="30" required>
                    <input type="password" placeholder="Şifre" name="sifre" value="<?php echo htmlspecialchars($sifre); ?>" size="30" required>
                    <input type="hidden" name="id" value="<?php echo $kayitno; ?>">
                    <input type="submit" value="Kaydet">
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('.login-info-box').fadeOut();
            $('.login-show').addClass('show-log-panel');
        });

        $('.login-reg-panel input[type="radio"]').on('change', function() {
            if($('#log-login-show').is(':checked')) {
                $('.register-info-box').fadeOut(); 
                $('.login-info-box').fadeIn();

                $('.white-panel').addClass('right-log');
                $('.register-show').addClass('show-log-panel');
                $('.login-show').removeClass('show-log-panel');

            } else if($('#log-reg-show').is(':checked')) {
                $('.register-info-box').fadeIn();
                $('.login-info-box').fadeOut();

                $('.white-panel').removeClass('right-log');

                $('.login-show').addClass('show-log-panel');
                $('.register-show').removeClass('show-log-panel');
            }
        });
    </script>
</body>
</html>
