<?php
header("Content-Type: application/json");
include 'config.php';

// PHP hata ayıklama
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Hata yakalama mekanizması ekleyin
try {
    $data = json_decode(file_get_contents("php://input"));

    if (isset($data->items) && isset($data->total) && isset($data->user_email) && isset($data->user_password)) {
        $items = json_encode($data->items);
        $total = $data->total;
        $user_email = $data->user_email;
        $user_password = $data->user_password;

        // Prepared statement kullanarak SQL enjeksiyonunu önleyin
        $stmt = $conn->prepare("INSERT INTO orders (items, total, user_email, user_password) VALUES (?, ?, ?, ?)");
        if ($stmt === false) {
            throw new Exception("Prepared statement hatası: " . $conn->error);
        }

        $stmt->bind_param("sdss", $items, $total, $user_email, $user_password);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Sipariş başarıyla kaydedildi"]);
        } else {
            throw new Exception("Sipariş kaydedilirken bir hata oluştu: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    } else {
        throw new Exception("Geçersiz veri");
    }
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
