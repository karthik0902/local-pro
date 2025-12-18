<?php
require_once '../config/db.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_id = $_SESSION['user_id'];
    
    // 1. Sanitize Shop Inputs
    $shop_name = filter_var($_POST['shop_name'], FILTER_SANITIZE_STRING);
    $category = $_POST['category'];
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
    $radius = (int)$_POST['radius'];
    $website = filter_var($_POST['website'], FILTER_SANITIZE_URL);
    $phone = $_POST['phone'];
    $whatsapp = $_POST['whatsapp'];
    $email = $_POST['email'];
    $contact_methods = isset($_POST['contact_method']) ? implode(", ", $_POST['contact_method']) : "";
    $years_exp = (int)$_POST['years_experience'];
    $licensed = ($_POST['licensed'] == 'yes') ? 1 : 0;
    $organic = ($_POST['organic'] == 'yes') ? 1 : 0;
    $days = $_POST['working_days'];
    $open = $_POST['open_time'];
    $close = $_POST['close_time'];

    // 2. Handle Shop Logo Upload
    $logo_path = "";
    if (!empty($_FILES['logo']['name'])) {
        $logo_path = "uploads/logos/" . time() . "_" . $_FILES['logo']['name'];
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path);
    }

    try {
        $pdo->beginTransaction();

        // 3. Insert into SHOPS table
        $sql_shop = "INSERT INTO shops (owner_id, shop_name, category, full_address, city, service_radius, shop_logo, social_link, primary_phone, whatsapp_number, business_email, contact_methods, years_experience, is_licensed, uses_organic, working_days, open_time, close_time) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt_shop = $pdo->prepare($sql_shop);
        $stmt_shop->execute([$owner_id, $shop_name, $category, $address, $city, $radius, $logo_path, $website, $phone, $whatsapp, $email, $contact_methods, $years_exp, $licensed, $organic, $days, $open, $close]);
        
        $new_shop_id = $pdo->lastInsertId();

        // 4. Handle Services (Loop through the 3 service slots)
        for ($i = 1; $i <= 3; $i++) {
            $s_name = $_POST["service{$i}_name"];
            if (!empty($s_name)) {
                $s_desc = $_POST["service{$i}_desc"];
                $s_price = $_POST["service{$i}_price"];
                $s_dur = $_POST["service{$i}_duration"];
                
                // Service Image Upload
                $s_img_path = "";
                if (!empty($_FILES["service{$i}_image"]['name'])) {
                    $s_img_path = "uploads/services/" . time() . "_s{$i}_" . $_FILES["service{$i}_image"]['name'];
                    move_uploaded_file($_FILES["service{$i}_image"]['tmp_name'], $s_img_path);
                }

                $sql_service = "INSERT INTO services (shop_id, service_name, short_description, starting_price, duration, service_image) 
                                VALUES (?, ?, ?, ?, ?, ?)";
                $stmt_svc = $pdo->prepare($sql_service);
                $stmt_svc->execute([$new_shop_id, $s_name, $s_desc, $s_price, $s_dur, $s_img_path]);
            }
        }

        $pdo->commit();
        header("Location: owner_dashboard.php?success=1");
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}
?>