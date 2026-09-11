<?php
// Start session and include database connection
session_start();
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Get college_id from the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Use intval for security

    // Query to fetch the college details
    $query = "SELECT * FROM college_overview WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $college = mysqli_fetch_assoc($result);  // Fetch the college details
    } else {
        echo "No data found for this college.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $college['college_name']; ?> - College Details</title>
    <link rel="stylesheet" href="CSS/clgs.css">
</head>
<body>
    <div class="college-details">
        <h2><?php echo $college['college_name']; ?></h2>
        <p>Location: <?php echo $college['location']; ?></p>
        <p>Established: <?php echo $college['established_year']; ?></p>
        <p>Type: <?php echo $college['type_of_institution']; ?></p>
        <p>Rating: <?php echo $college['rating']; ?> / 5</p>
        <p>Accreditation: <?php echo $college['accreditation']; ?></p>
        <p>Website: <a href="<?php echo $college['website_url']; ?>"><?php echo $college['website_url']; ?></a></p>
        <p>Description: <?php echo $college['description']; ?></p>
        <p>Contact: <?php echo $college['contact_number']; ?></p>
        <p>Email: <?php echo $college['email_id']; ?></p>

        <h3>Placement Information</h3>
        <p>Average Package: <?php echo $college['average_package']; ?></p>
        <p>Highest Package: <?php echo $college['highest_package']; ?></p>
        <p>Top Recruiters: <?php echo $college['top_recruiters']; ?></p>
        <p>Placement Rate: <?php echo $college['placement_rate']; ?>%</p>

        <h3>Courses Offered</h3>
        <ul>
            <li><?php echo $college['course1']; ?> - Fee: <?php echo $college['fee1']; ?></li>
            <li><?php echo $college['course2']; ?> - Fee: <?php echo $college['fee2']; ?></li>
            <li><?php echo $college['course3']; ?> - Fee: <?php echo $college['fee3']; ?></li>
            <li><?php echo $college['course4']; ?> - Fee: <?php echo $college['fee4']; ?></li>
        </ul>

        <h3>Gallery</h3>
        <div class="gallery">
            <img src="images/<?php echo $college['img1']; ?>" alt="Image 1">
            <img src="images/<?php echo $college['img2']; ?>" alt="Image 2">
            <img src="images/<?php echo $college['img3']; ?>" alt="Image 3">
            
        </div>
        <h3>Notable Alumni</h3>
        <div class="gallery">
        <img src="images/<?php echo $college['img4']; ?>" alt="Image 4">
            <img src="images/<?php echo $college['img5']; ?>" alt="Image 5">
</div>
    </div>
</body>
</html>
