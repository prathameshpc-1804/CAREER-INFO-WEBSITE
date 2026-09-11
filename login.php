<?php
session_start();
include 'loginconfig.php'; // Your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify the password (assuming it's hashed)
        if (password_verify($password, $user['password'])) {
            // If password matches, set session and redirect to index page
            $_SESSION['user'] = 'user'; // Set the session variable
            $_SESSION['email'] = $email; // Set other session variables as needed
            $is_logged_in = true;
            $_SESSION['is_logged_in'] = $is_logged_in;

            header("Location: index.php"); // Redirect to index page
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "Invalid email or password.";
    }

    // Close statement
    $stmt->close();
}
?>


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
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="userregister.php">Register here</a></p>

        <!-- Display error message if login fails -->
        <?php if (isset($error_message)) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
