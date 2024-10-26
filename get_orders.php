<?php
header("Content-Type: application/json");
include 'config.php';

// PHP hata ayıklama
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $orders = [];
    while($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    echo json_encode(["orders" => $orders]);
} else {
    echo json_encode(["error" => "No orders found"]);
}

$conn->close();
?>
