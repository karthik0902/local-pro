 <?php
session_start();
include "../config/db.php"; // Your DB connection

// Check if form submitted
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $password = trim($_POST['password']);

    // Fetch user from database
    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
            if ($row['role'] === 'admin') {
                header("Location: ../admin/dashboard.php");
            } elseif ($row['role'] === 'shop_owner') {
                header("Location: ../shop_owner/dashboard.php");
            } else {
                header("Location: ../user/dashboard.php");
            }
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Email not found!";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">

    <div class="card p-4 form-card">
        <h2 class="text-center mb-3 text-white fw-bold">Login</h2>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label text-white">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-white">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="login" class="btn btn-light w-100 fw-bold mt-2">
                Login
            </button>

            <p class="mt-3 text-center text-white">
                Don’t have an account? 
                <a href="register.php" class="text-light fw-bold">Register</a>
            </p>

            <!-- <p class="text-center">
                <a href="forgot-password.php" class="text-light small">Forgot Password?</a>
            </p> -->

        </form>
    </div>
</div>

</body>
</html>
