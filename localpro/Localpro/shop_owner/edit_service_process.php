<?php
require_once '../config/db.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST['service_id'];
    $name = $_POST['service_name'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $desc = $_POST['description'];

    // Check if a new image is uploaded
    if (!empty($_FILES['service_image']['name'])) {
        $img_dir = "uploads/services/";
        
        // Ensure directory exists
        if (!is_dir($img_dir)) mkdir($img_dir, 0777, true);

        $img_path = $img_dir . time() . "_" . basename($_FILES['service_image']['name']);
        move_uploaded_file($_FILES['service_image']['tmp_name'], $img_path);
        
        // REMOVED comma after service_image=?
        $sql = "UPDATE services SET service_name=?, starting_price=?, duration=?, short_description=?, service_image=? WHERE service_id=?";
        $params = [$name, $price, $duration, $desc, $img_path, $service_id];
    } else {
        // REMOVED comma after short_description=?
        $sql = "UPDATE services SET service_name=?, starting_price=?, duration=?, short_description=? WHERE service_id=?";
        $params = [$name, $price, $duration, $desc, $service_id];
    }
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute($params)) {
        header("Location: Services_Pricing.php?msg=updated");
    } else {
        echo "Update failed.";
    }
}