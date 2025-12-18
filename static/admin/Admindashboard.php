<?php
session_start();
include "../config/db.php"; // Database connection

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Only admin can add shops
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied! Only admin can add shops.");
}

// Handle form submission
if (isset($_POST['submit'])) {
    $user_id = mysqli_real_escape_string($conn, trim($_POST['user_id']));
    $shop_name = mysqli_real_escape_string($conn, trim($_POST['shop_name']));
    $location = mysqli_real_escape_string($conn, trim($_POST['location']));
    $contact_number = mysqli_real_escape_string($conn, trim($_POST['contact_number']));

    // Check if shop already exists for this owner
    $check = mysqli_query($conn, "SELECT id FROM shops WHERE user_id='$user_id' AND shop_name='$shop_name'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('This shop already exists for this user.');</script>";
    } else {
        $query = "INSERT INTO shops (user_id, shop_name, location, contact_number) 
                  VALUES ('$user_id', '$shop_name', '$location', '$contact_number')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Shop added successfully!'); window.location='admin-shops.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to add shop');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap FIRST -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- YOUR CSS LAST -->
<link rel="stylesheet" href="../index.css">

<title>Sticky Navbar & Footer</title>




</head>

<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar">
    <div class="nav-container">
        <a href="#" class="logo">Local Services</a>

        <div class="menu-toggle" onclick="toggleMenu()">☰</div>

        <div class="nav-links" id="navLinks">
            <a href="#">Home</a>
            <a href="#">Services</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">Login</a>
        </div>
    </div>
</nav>

<!-- ================= CONTENT ================= -->
 <main>
    <section>
    
<div class="container" style="margin-top:50px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading"><h3 class="panel-title text-center">Add Shop</h3></div>
                <div class="panel-body">
                    <form method="POST">
                        <div class="form-group">
                            <label>User ID (Shop Owner)</label>
                            <input type="number" name="user_id" class="form-control" placeholder="Enter Shop Owner User ID" required>
                        </div>

                        <div class="form-group">
                            <label>Shop Name</label>
                            <input type="text" name="shop_name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary btn-block">Add Shop</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
    
 </main>

<!-- ================= FOOTER ================= -->
<footer class="footer">
    <div class="footer-container">
        <div>
            <h3>About</h3>
            <p>Professional local services platform providing quality solutions.</p>
        </div>

        <div>
            <h3>Quick Links</h3>
            <a href="#">Home</a>
            <a href="#">Services</a>
            <a href="#">Pricing</a>
            <a href="#">Contact</a>
        </div>

        <div>
            <h3>Support</h3>
            <a href="#">Help Center</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
        </div>
    </div>

    <div class="footer-bottom">
        © 2025 MyWebsite. All rights reserved.
    </div>
</footer>

<script>
function toggleMenu() {
    document.getElementById("navLinks").classList.toggle("active");
}
</script>

</body>
</html>
