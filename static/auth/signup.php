<?php
include "../config/db.php"; // DB connection
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
session_start();

if (isset($_POST['submit'])) {


    function validate_email_format($email) {
    // Define regex pattern
    $pattern = "/^[a-zA-Z0-9._%+-]+\.businesslabs@gmail\.com$/";

    if (!preg_match($pattern, $email)) {
        // Email is invalid
        echo "<script>alert('Email is not in the correct format. Example: example.bussinesslabs@gmail.com');
            window.location.href = '$redirect_url';</script>";
        return false;
    }
    return true; // valid



}

$email = mysqli_real_escape_string($conn, trim($_POST['email']));

if (!validate_email_format($email)) {
    // Stop registration or handle error
    exit();
}

    // Clean values
    $full_name = mysqli_real_escape_string($conn, trim($_POST['full_name']));
    $role      = mysqli_real_escape_string($conn, trim($_POST['role']));

    // Hash password
    $password  = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Check if email exists
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already exists! Try Login.');</script>";
    } else {

        // Insert user (FULLY CORRECT SQL)
        $query = "
            INSERT INTO users (email, password, role)
            VALUES ('$email', '$password', '$role')
        ";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registration Successful!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to Register');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card p-4 form-card">
        <h2 class="text-center mb-3 text-white fw-bold">Create Account</h2>

        <form method="POST">


         <div class="mb-3">
    <label class="form-label text-white">Email</label>
 <input type="email" name="email" id="email" class="form-control" required
                       pattern="^[a-zA-Z0-9._%+-]+\.bussinesslabs@gmail\.com$"
                       title="Email must be like example.bussinesslabs.anything@gmail.com">
</div>


            <div class="mb-3">
                <label class="form-label text-white">Password</label>
                <input type="password" name="password" class="form-control"   required
           pattern="^(?=.*[A-Z]).+$"
           title="Password must contain at least 1 capital letter">
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Role</label>
                <select name="role" class="form-control" required>
                    <option value="customer">Customer</option>
                    <option value="shop_owner">Shop Owner</option>
                    <option value="admin">Admin</option> <!-- INCLUDED because your DB ENUM requires it -->
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-light w-100 fw-bold mt-2">
                Register
            </button>

            <p class="mt-3 text-center text-white">
                Already have an account?
                <a href="login.php" class="text-light fw-bold">Login</a>
            </p>

        </form>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // Email validation live
    $("#email").on("input", function () {
        let pattern = /^[a-zA-Z0-9._%+-]+\.bussinesslabs@gmail\.com$/;
        if(pattern.test($(this).val())){
            $(this).removeClass("is-invalid").addClass("is-valid");
        } else {
            $(this).removeClass("is-valid").addClass("is-invalid");
        }
    });

    // Password validation live
    $("#password").on("input", function () {
        let pattern = /[A-Z]/; // must contain 1 uppercase
        if(pattern.test($(this).val())){
            $(this).removeClass("is-invalid").addClass("is-valid");
        } else {
            $(this).removeClass("is-valid").addClass("is-invalid");
        }
    });

    // Optional: prevent form submit if invalid
    $("#registerForm").on("submit", function(e){
        if(!this.checkValidity()){
            e.preventDefault();
            e.stopPropagation();
            alert("Please fill all fields correctly.");
        }
    });

});
</script>



</body>
</html>
