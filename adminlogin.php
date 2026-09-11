<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login&signup.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form action="adminlogin.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        
        <!-- Display error message if login fails -->
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>


<?php
session_start();
include 'loginconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_email = 'prathameshdhyanipc@gmail.com';
    $admin_password = 'jaishreeram'; // This should be hashed in production!

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Admin login check
    if ($email === $admin_email && $password === $admin_password) {
        // Set admin session and redirect to admin page
        $_SESSION['user'] = 'admin';
        $_SESSION['email'] = $email;
        header("Location: admin.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

