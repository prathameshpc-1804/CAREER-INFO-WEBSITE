<?php

include 'loginconfig.php'; // Include your database connection file

if(isset($_POST['search-btn'])){
    $search_query = trim(strtolower($_POST['search_query']));

    if ($search_query == ''){
        echo "<script> alert('Search bar is empty'); window.location.href='index.php';</script>";
        
    }
    else{
        $query = "SELECT * FROM college_overview";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $res = $stmt->get_result();

        while($row = $res->fetch_object()){
            $collegename = trim(strtolower($row->college_name));

            if($search_query == $collegename){
                ?>

                    <script>
                        var cid = <?php echo $row->id;?>;
                        var url = "college_details.php?id=" + cid;
                        window.location.href = url;
                    </script>
<?php
                
                
            }
        }
    }
}


// if (isset($_GET['search_query'])) {
//     $search_query = $_GET['search_query'];

//     // Sanitize the input to prevent SQL injection
//     $search_query = mysqli_real_escape_string($conn, $search_query);

//     // Check if the search query is not empty after sanitization
//     if (!empty($search_query)) {
//         // Query to search for colleges that exactly match the search query
//         // Enclose the query string in single quotes
//         $query = "SELECT * FROM college_overview WHERE college_name = '$search_query'";
//         $result = mysqli_query($conn, $query);

//         if ($result === false) {
//             // If there's a query error, show it
//             echo "Error in query: " . mysqli_error($conn);
//             exit();
//         }

//         if (mysqli_num_rows($result) > 0) {
//             // If a matching college is found, fetch its data
//             $college_data = mysqli_fetch_assoc($result);

//             // Redirect to the college_details.php page with the college's name
//             header("Location: college_details.php?college_name=" . urlencode($college_data['college_name']));
//             exit();
//         } else {
//             // If no college is found, show a message
//             echo "No college found for: " . htmlspecialchars($search_query);
//         }
//     } else {
//         // If the search query is empty after sanitization, show a message
//         echo "Please enter a valid search query.";
//     }
// } else {
//     echo "Invalid request. No search query provided.";
// }

?>