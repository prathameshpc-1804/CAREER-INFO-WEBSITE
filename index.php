<?php
session_start();
$is_logged_in = isset($_SESSION['user']);
include 'loginconfig.php';
$query = "SELECT * FROM reviews";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/styles.css">
        <link rel="stylesheet" href="CSS/login&signup.css">
        <link rel="stylesheet" href="CSS/reviews.css">
        <Title>
            CareerInfo 360
        </Title>

    </head>
        <body>
            <header>
                <nav>
                    <ul>
                        <li><b><a href="index.php">Home</a></b></li>
                        <li><b><a href="colleges.php">Colleges</a></b></li>
                        <li><b><a href="#category">Courses</a></b></li>
                        <li><b><a href="#review">Reviews</a></b></li>
                        <li><b><a href="#contact">Contact Us</a></b></li>
                        
                     
                    </ul>
                </nav>
                </div>
                <div class="login-container">
                <?php if ($is_logged_in): ?>
            <!-- Show Dashboard button if user is logged in -->
            <button id="dashboard-button" onclick="location.href='dashboard.php'" class="login-button">Dashboard</button>
        <?php else: ?>
            <!-- Show Login button if user is not logged in -->
            <button  id="login-button" onclick="location.href='login.php'" class="login-button">Login</button>
        <?php endif; ?>
        </div>

            </header>
        
            <!-- Hero Section -->
           
            <section class="hero">

                    <h2>Welcome to careerInfo 360...</h2><br>

                    <h1><p> find the best college that suits you</p></h1>
            </section>

            <section class="search-bar">
                <form action="search.php" method="post">
                    <input type="text" name="search_query" placeholder="Search for colleges ..." >
                   <button type="submit" name="search-btn">Search</button>
                </form>
            </section>

            
            <section class="coourses">
            <main>
                <div class="category-boxes" id="category">
                    <div class="box" onclick="toggleOptions('science-options')">
                        Science
                    </div>
                    <div class="box" onclick="toggleOptions('arts-options')">
                        Arts
                    </div>
                    <div class="box" onclick="toggleOptions('commerce-options')">
                        Commerce
                    </div>
                </div>
            
                <div id="science-options" class="options hidden">
    <div class="box" onclick="window.location.href='college2.php?course=HSC%20(Science)'">
        <h3>HSC (Science)</h3>
    </div>
    <div class="box">
        <h3>UG</h3>
        <ul>
            <li><a href="college2.php?course=BSc">BSc</a></li>
            <li><a href="college2.php?course=BTech">BTech</a></li>
            <li><a href="college2.php?course=BCA">BCA</a></li>
        </ul>
    </div>
    <div class="box">
        <h3>PG</h3>
        <ul>
            <li><a href="college2.php?course=MSc">MSc</a></li>
            <li><a href="college2.php?course=MTech">MTech</a></li>
            <li><a href="college2.php?course=MCA">MCA</a></li>
        </ul>
    </div>
</div>

<div id="arts-options" class="options hidden">
    <div class="box" onclick="window.location.href='college2.php?course=HSC%20(Arts)'">
        <h3>HSC (Arts)</h3>
    </div>
    <div class="box">
        <h3>UG</h3>
        <ul>
            <li><a href="college2.php?course=BA">B.A</a></li>
            <li><a href="college2.php?course=BFA">B.F.A</a></li>
            <li><a href="college2.php?course=BMUS">B.Mus</a></li>
        </ul>
    </div>
    <div class="box">
        <h3>PG</h3>
        <ul>
            <li><a href="college2.php?course=MA">M.A</a></li>
            <li><a href="college2.php?course=MFA">M.F.A</a></li>
            <li><a href="college2.php?course=MMUS">M.Mus</a></li>
        </ul>
    </div>
</div>

<div id="commerce-options" class="options hidden">
    <div class="box" onclick="window.location.href='college2.php?course=HSC%20(Commerce)'">
        <h3>HSC (Commerce)</h3>
    </div>
    <div class="box">
        <h3>UG</h3>
        <ul>
            <li><a href="college2.php?course=BCom">BCom</a></li>
            <li><a href="college2.php?course=BBA">BBA</a></li>
            <li><a href="college2.php?course=BBM">BBM</a></li>
        </ul>
    </div>
    <div class="box">
        <h3>PG</h3>
        <ul>
            <li><a href="college2.php?course=MCom">MCom</a></li>
            <li><a href="college2.php?course=MBA">MBA</a></li>
            <li><a href="college2.php?course=PGDM">PGDM</a></li>
        </ul>
    </div>
</div>
        </section>

            </main>
                <script src="JS/script.js"></script>

<br><br><br>
            <!-- User Reviews and Testimonials -->
            <section class="testimonials" id="review">
        <h1>What Our Students Say</h1><br><br>

        <!-- Loop through each review and display it -->
        <?php while ($review = mysqli_fetch_assoc($result)) : ?>
            <div class="review-box">
                <div class="user-profile">
                    <!-- Initials of the user -->
                    <div class="user-initials">
                        <?php
                        // Display first letter of first name and last name as initials
                        $initials = strtoupper(substr($review['user_name'], 0, 1) . substr(strrchr($review['user_name'], ' '), 1, 1));
                        echo $initials;
                        ?>
                    </div>

                    <!-- User Info -->
                    <div class="user-info">
                        <h3><?php echo $review['user_name']; ?></h3> <!-- User Name -->
                    </div>
                </div>

                <!-- User's Review -->
                <blockquote>
                    <p>"<?php echo $review['review_text']; ?>"</p> <!-- User's Review Text -->
                </blockquote>
            </div>
        <?php endwhile; ?>
    </section>

             </section>
                 <?php if (isset($_SESSION['user'])): ?>
                 <section class="submit-review">
                 <h2>Submit Your Review</h2>
                     <form action="submit_review.php" method="POST">
                        <textarea name="review_text" placeholder="Write your review..." required></textarea>
                        <button type="submit">Submit Review</button>
                        </form>
                        </section>
                <?php endif; ?>

        
            <!-- Footer Section -->
            <footer>
                <div class="contact-info" id="contact">
                    <p>Contact us at: info@educationalplatform.com</p>
                    <p>Phone: +123 456 7890</p>
                </div>
                <div class="social-media">
                    <a href="#">Facebook</a>
                    <a href="#">Twitter</a>
                    <a href="#">Instagram</a>
                </div>
                <div class="legal">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="adminlogin.php">Admin Login</a> 
                </div>
            </footer>
    </body>
</html>