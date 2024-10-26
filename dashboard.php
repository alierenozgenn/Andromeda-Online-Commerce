<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: yeni.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch user details from session or database as needed
$user_id = $_SESSION["user_id"];
$user_email = $_SESSION["user_email"];

// Display dashboard content
echo "Hoş geldiniz, " . $user_email . "!"; // Example greeting
?>
