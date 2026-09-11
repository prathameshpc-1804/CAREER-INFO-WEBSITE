<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="CSS/login&signup.css">
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <form action="userregister.php" method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="course_name" placeholder="Course Name" required>
            <input type="text" name="education_level" placeholder="Current Education Section" required>
            <button type="submit">Register</button>
        </form>
    </div>
<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $course_name = $_POST['course_name'];
    $education_level = $_POST['education_level'];

    $sql = "INSERT INTO users (name, email, password, course_name, education_level) 
            VALUES ('$name', '$email', '$password', '$course_name', '$education_level')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
</body>
</html>