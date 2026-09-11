<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Include the database configuration file to connect to the database
include 'loginconfig.php';

// Fetch the logged-in user's email from the session
$email = $_SESSION['email'];

// Prepare and execute the SQL query to fetch user data
$query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the user data
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="CSS/dashboard.css">
</head>
<body>

    <h1>Welcome, <?php echo $user['name']; ?></h1>

    <div class="user-details">
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Course looking for:</strong> <?php echo $user["course_name"]; ?></p>
        <p><strong>Current education level:</strong> <?php echo $user['education_level']; ?></p>
        <!-- Add more user-specific data here -->
    </div>

    <!-- Option to log out -->

    <div class="button-container">
    <form action="logout.php" method="POST">
        <button id="logout-button" type="submit">Logout</button>
    </form>
    <button id="home-button" onclick="location.href='index.php'">Home</button>
</div>


</body>
</html>

<?php
// Close the database connection
$stmt->close();
$conn->close();
?>
