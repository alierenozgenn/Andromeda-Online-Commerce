<?php
session_start(); // Start session if not already started

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
        // User found, store user details in session
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["id"]; // Example: Store user ID in session
        $_SESSION["user_email"] = $user["mail"]; // Store other relevant data in session if needed

        // Store user details in sessionStorage for use in other pages
        echo "<script>
                sessionStorage.setItem('userEmail', '{$user["mail"]}');
                sessionStorage.setItem('userPassword', '{$user["sifre"]}');
                window.location.href = 'index.html';
              </script>";
        exit();
    } else {
        // User not found or credentials invalid
        echo "Geçersiz email veya şifre.";
    }
}
?>
