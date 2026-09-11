<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="CSS/admin.css"> <!-- Link to your CSS file -->
</head>

<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the deletion of a college
if (isset($_POST['delete_college'])) {
    $college_id = $_POST['college_id'];
    $conn->query("DELETE FROM college_overview WHERE id = $college_id");
    echo "College deleted successfully!";
}

// Handle the addition of a new college
if (isset($_POST['add_college'])) {
    $college_name = $_POST['college_name'];
    $location = $_POST['location'];
    $established_year = $_POST['established_year'];
    $type_of_institution = $_POST['type_of_institution'];
    $rating = $_POST['rating'];
    $accreditation = $_POST['accreditation'];
    $website_url = $_POST['website_url'];
    $description = $_POST['description'];
    $contact_number = $_POST['contact_number'];
    $email_id = $_POST['email_id'];
    $average_package = $_POST['average_package'];
    $highest_package = $_POST['highest_package'];
    $top_recruiters = $_POST['top_recruiters'];
    $placement_rate = $_POST['placement_rate'];
    $course1 = $_POST['course1'];
    $course2 = $_POST['course2'];
    $course3 = $_POST['course3'];
    $course4 = $_POST['course4'];
    $fee1 = $_POST['fee1'];
    $fee2 = $_POST['fee2'];
    $fee3 = $_POST['fee3'];
    $fee4 = $_POST['fee4'];
    $img1 = $_POST['img1'];
    $img2 = $_POST['img2'];
    $img3 = $_POST['img3'];
    $img4 = $_POST['img4'];
    $img5 = $_POST['img5'];
    

    $query1 = "INSERT INTO college_overview (college_name, location, established_year, type_of_institution, rating, accreditation, website_url, description, contact_number, email_id,average_package,
    highest_package,top_recruiters,placement_rate,course1,course2,course3,course4,fee1,fee2,fee3,fee4,img1,img2,img3,img4,img5)
                  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    
    $stmt2 = $conn->prepare($query1);
    $stmt2->bind_param("ssisdsssissssssssssssssssss",$college_name,$location,$established_year,$type_of_institution,$rating,$accreditation,$website_url,$description,$contact_number,$email_id,$average_package,$highest_package,$top_recruiters,$placement_rate,$course1,$course2,$course3,$course4,$fee1,$fee2,$fee3,$fee4,$img1,$img2,$img3,$img4,$img5);
    $stmt2->execute();
    
    
    echo "College added successfully!";
}



   

// Fetch registered users
$users = $conn->query("SELECT * FROM users");

// Fetch registered colleges
$colleges = $conn->query("SELECT * FROM college_overview");

?>
<body>

<header>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <ul>
            <li><a href="#registered-users">Registered Users</a></li>
            <li><a href="#registered-colleges">Registered Colleges</a></li>
            <li><a href="#add-college">Add College</a></li>
        </ul>
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</header>

<div class="container content" id="registered-users">
    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course Name</th>
            <th>Current Education Section</th>
        </tr>
        <?php while ($user = $users->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['course_name']; ?></td>
                <td><?php echo $user['education_level']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="container content" id="registered-colleges">
    <h2>Registered Colleges</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>College Name</th>
            <th>Location</th>
            <th>Established Year</th>
            <th>Type of Institution</th>
            <th>Rating</th>
            <th>Accreditation</th>
            <th>Website URL</th>
            <th>Actions</th>
        </tr>
        <?php while ($college = $colleges->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $college['id']; ?></td>
                <td><?php echo $college['college_name']; ?></td>
                <td><?php echo $college['location']; ?></td>
                <td><?php echo $college['established_year']; ?></td>
                <td><?php echo $college['type_of_institution']; ?></td>
                <td><?php echo $college['rating']; ?></td>
                <td><?php echo $college['accreditation']; ?></td>
                <td><?php echo $college['website_url']; ?></td>
                <td>
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="college_id" value="<?php echo $college['id']; ?>">
                        <button type="submit" name="delete_college">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="container content" id="add-college">
    <h2>Add College</h2>
    <form method="post">
        <input type="text" name="college_name" placeholder="College Name" required>
        <input type="text" name="location" placeholder="Location" required>
        <input type="text" name="established_year" placeholder="Established Year" required>
        <input type="text" name="type_of_institution" placeholder="Type of Institution" required>
        <input type="text" name="rating" placeholder="Rating" required>
        <input type="text" name="accreditation" placeholder="Accreditation" required>
        <input type="text" name="website_url" placeholder="Website URL" required>
        <input type="text" name="description" placeholder="Description" required>
        <input type="text" name="contact_number" placeholder="Contact Number" required>
        <input type="email" name="email_id" placeholder="Email ID" required>
        <input type="text" name="average_package" placeholder="average package" required>
        <input type="text" name="highest_package" placeholder="Highest Package" required>
        <input type="text" name="top_recruiters" placeholder="Top recruiters" required>
        <input type="text" name="placement_rate" placeholder="placement rate" required>
        <input type="text" name="course1" placeholder="course no 1" required>
        <input type="text" name="course2" placeholder="course no 2" required>
        <input type="text" name="course3" placeholder="course no 3" >
        <input type="text" name="course4" placeholder="course no 4" >
        <input type="text" name="fee1" placeholder="fee no 1" required>
        <input type="text" name="fee2" placeholder="fee no 2" required>
        <input type="text" name="fee3" placeholder="fee no 3" >
        <input type="text" name="fee4" placeholder="fee no 4" >
        <input type="text" name="img1" placeholder="image no 1" required>
        <input type="text" name="img2" placeholder="image no 2" required>
        <input type="text" name="img3" placeholder="image no 3" required>
        <input type="text" name="img4" placeholder="image no 4">
        <input type="text" name="img5" placeholder="image no 5">
        <button type="submit" name="add_college">Add College</button>
    </form>
</div>

</body>
</html>

<?php $conn->close(); ?>