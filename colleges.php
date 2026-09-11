<?php 
include("loginconfig.php");

$query = "Select * from college_overview";
$stmt = $conn->prepare($query);
$stmt->execute();
$res = $stmt->get_result();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/colleges.css">
    <title>College Ratings</title>
</head>
<body>
<div class="college-list">
    <?php 
    while($row = $res->fetch_object()){        
    ?>
    <a href="college_details.php?id=<?php echo $row->id;?>" class="college-item">
        <img src="images/<?php echo $row->img1;?>" alt="<?php echo $row->college_name; ?>">
        <div>
            <h3><?php echo $row->college_name;?></h3>
            <p><?php echo $row->location;?> | <span class="rating"><?php echo $row->rating; ?></span></p>
        </div>
    </a>
    <?php }?>
</div>
        

    </div>
</body>
</html>

