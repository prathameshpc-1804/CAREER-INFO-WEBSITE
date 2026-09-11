<?php
session_start();
include 'loginconfig.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user'])) {
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    $user_email = $_SESSION['email']; // Get the email of the logged-in user

    // Fetch the user's name from the database using the email
    $user_query = "SELECT name FROM users WHERE email = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $user_result = $stmt->get_result();
    $user_data = $user_result->fetch_assoc();
    $user_name = $user_data['name']; // Assuming the 'users' table has a 'name' column

    // Insert the review into the 'reviews' table
    $insert_review = "INSERT INTO reviews (user_name, review_text, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($insert_review);
    $stmt->bind_param("ss", $user_name, $review_text);
    
    if ($stmt->execute()) {
        // Redirect back to the index or review page after submission
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
