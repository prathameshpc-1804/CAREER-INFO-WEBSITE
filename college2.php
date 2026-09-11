<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/college2.css">
    
</head>
<body>
<div class="college-list">


<?php
session_start();
include 'loginconfig.php'; // Your database connection

// Get the selected course from the URL
$course = isset($_GET['course']) ? $_GET['course'] : '';

// If no course is selected, redirect to the homepage or show a message
if (empty($course)) {
    echo "No course selected.";
    exit();
}

// Fetch the colleges offering the selected course
$query = "SELECT * FROM college_overview WHERE course1 = ? OR course2 = ? OR course3 = ? OR course4 = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssss", $course, $course, $course, $course);
$stmt->execute();
$result = $stmt->get_result();

// Display the colleges
if ($result->num_rows > 0) {
    echo "<h1>Colleges offering $course</h1>";
    while ($college = $result->fetch_assoc()) {
        echo "<div class='college'>";
        echo "<h2>" . $college['college_name'] . "</h2>";
        echo "<p>Location: " . $college['location'] . "</p>";
        echo "<p>Rating: " . $college['rating'] . "/5</p>";
        echo "<a href='college_details.php?id=" . $college['id'] . "'>View Details</a>";
        echo "</div>";
    }
} else {
    echo "<p>No colleges found offering $course.</p>";
}

// Close the connection
$stmt->close();
$conn->close();
?>
</div>
</body>
</html>
