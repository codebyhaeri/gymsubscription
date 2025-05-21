<?php
        session_start();
        
        include __DIR__ . "/../config/db_connect.php";

        $c_user_id = $_SESSION['l_user_id']; //holds user id parameter for all processing
        
        if($_SESSION['l_user_type'] != 'C'){
            header("location: ../index.php");
        }

        // Logout mechanism
        if(isset($_GET['logout'])){
            // Unset all session variables
            $_SESSION = array();

            session_destroy();
        
            header("location: ../login.php");
            exit();
        }
        if (!isset($_GET['page'])) {
            header("location: index.php?page=home");
            exit;
        }
    // echo"hello user"; 
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
        <meta charset="utf-8">
        <title>FitLife - Premium Gym Memberships</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Gym Membership Website" name="keywords">
        <meta content="Premium Gym Memberships" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/flaticon/font/flaticon.css" rel="stylesheet"> 
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../style/user.css" rel="stylesheet">
    </head>
    <body>

        <?php include "../user_nav.php"; ?>
        
        <?php if(isset($_GET['page'])){ 


//=========================================== page - home ======================================================  


            if($_GET['page'] == 'home'){ ?>

             <!-- Hero Start -->
                    <div class="hero">
                    <div class="container-fluid">
                        <div class="row">
                        <!-- Text on the left -->
                        <div class="col-md-6 col-sm-12 d-flex align-items-center">
                            <div class="hero-text">
                            <h1>Welcome!</h1>
                            <div class="username">
                                <?php echo $_SESSION['l_fullname']; ?>
                            </div>
                            </div>
                        </div>

                        <!-- Image on the right -->
                        <div class="col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                            <div class="hero-image">
                            <img src="../img/3-removebg-preview.png" alt="Hero Image">
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>


                <!-- Hero End -->

                <!-- About Start -->
                <div class="about wow fadeInUp" data-wow-delay="0.1s">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-6">
                                <div class="about-img">
                                    <img src="../img/about.png" alt="Image">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="section-header text-left">
                                    <p>Learn About Us</p>
                                    <h2>Welcome to FitLife</h2>
                                </div>
                                <div class="about-text">
                                    <p>
                                        At FitLife, we're more than just a gym - we're a community dedicated to helping you achieve your fitness goals. Our state-of-the-art facility is equipped with the latest fitness technology and staffed by certified professionals.
                                    </p>
                                    <p>
                                        Whether you're a beginner or a seasoned athlete, our comprehensive programs and personalized training approach will help you reach new heights in your fitness journey. Join us and experience the difference that makes FitLife the premier fitness destination.
                                    </p>
                                    <a class="btn" href="about.html">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- About End -->

            <!-- Service Start -->
            <div class="service">
                <div class="container">
                    <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                        <p>What we offer</p>
                        <h2>Premium Facilities</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.0s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-dumbbell"></i>
                                </div>
                                <h3>Modern Equipment</h3>
                                <p>
                                    Access to the latest fitness technology and equipment for an optimal workout experience
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="service-item active">
                                <div class="service-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h3>Personal Training</h3>
                                <p>
                                    One-on-one sessions with certified trainers to help you reach your fitness goals
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3>Group Classes</h3>
                                <p>
                                    Dynamic group fitness classes for all levels, from HIIT to strength, cycling, and more
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <h3>Private Locker Rooms</h3>
                                <p>
                                    Spacious, air-conditioned lockers with showers, mirrors, and grooming areas.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.8s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-apple-alt"></i>
                                </div>
                                <h3>Nutrition Bar</h3>
                                <p>
                                    Fresh protein shakes, energy bars, and healthy snacks.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-coffee"></i>
                                </div>
                                <h3>Lounge</h3>
                                <p>
                                    A space to relax, hydrate, or chat with fellow members.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Service End -->

<!--================================ Class Start - saving when the user is subscribed =====================================-->
                <!-- <div class="class">
                    <div class="container">
                        <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                            <p>Our Classes</p>
                            <h2>Group Fitness Schedule</h2>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <ul id="class-filter">
                                    <li data-filter="*" class="filter-active">All Classes</li>
                                    <li data-filter=".filter-1">HIIT</li>
                                    <li data-filter=".filter-2">Strength</li>
                                    <li data-filter=".filter-3">CrossFit</li>
                                    <li data-filter=".filter-4">Core Blast</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row class-container">
                            <div class="col-lg-4 col-md-6 col-sm-12 class-item filter-1 wow fadeInUp" data-wow-delay="0.0s">
                                <div class="class-wrap">
                                    <div class="class-img">
                                        <img src="../img/class-1.jpg" alt="Image">
                                    </div>
                                    <div class="class-text">
                                        <div class="class-teacher">
                                            <img src="../img/teacher-1.png" alt="Image">
                                            <h3>Elise Moran</h3>
                                            <a href="">+</a>
                                        </div>
                                        <h2>HIIT</h2>
                                        <div class="class-meta">
                                            <p><i class="far fa-calendar-alt"></i>Mon, Wed, Fri</p>
                                            <p><i class="far fa-clock"></i>7:00 - 8:00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 class-item filter-2 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="class-wrap">
                                    <div class="class-img">
                                        <img src="../img/class-2.jpg" alt="Image">
                                    </div>
                                    <div class="class-text">
                                        <div class="class-teacher">
                                            <img src="../img/teacher-2.png" alt="Image">
                                            <h3>Kate Glover</h3>
                                            <a href="">+</a>
                                        </div>
                                        <h2>Strength Training</h2>
                                        <div class="class-meta">
                                            <p><i class="far fa-calendar-alt"></i>Tue, Thu</p>
                                            <p><i class="far fa-clock"></i>6:00 - 7:00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 class-item filter-3 wow fadeInUp" data-wow-delay="0.4s">
                                <div class="class-wrap">
                                    <div class="class-img">
                                        <img src="../img/class-3.jpg" alt="Image">
                                    </div>
                                    <div class="class-text">
                                        <div class="class-teacher">
                                            <img src="../img/teacher-3.png" alt="Image">
                                            <h3>Elina Ekman</h3>
                                            <a href="">+</a>
                                        </div>
                                        <h2>CrossFit</h2>
                                        <div class="class-meta">
                                            <p><i class="far fa-calendar-alt"></i>Sat, Sun</p>
                                            <p><i class="far fa-clock"></i>10:00 - 11:00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 class-item filter-4 wow fadeInUp" data-wow-delay="0.6s">
                                <div class="class-wrap">
                                    <div class="class-img">
                                        <img src="../img/class-4.jpg" alt="Image">
                                    </div>
                                    <div class="class-text">
                                        <div class="class-teacher">
                                            <img src="../img/teacher-4.png" alt="Image">
                                            <h3>Lilly Fry</h3>
                                            <a href="">+</a>
                                        </div>
                                        <h2>Core Blast</h2>
                                        <div class="class-meta">
                                            <p><i class="far fa-calendar-alt"></i>Sun, Tue, Thu</p>
                                            <p><i class="far fa-clock"></i>9:00 - 10:00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- Class End -->
                
                
                <!-- Discount Start -->
                <div class="discount wow zoomIn" data-wow-delay="0.1s">
                    <div class="container">
                        <div class="section-header text-center">
                            <p>Awesome Discount</p>
                            <h2>Get <span>30%</span> Discount for all Sessions</h2>
                        </div>
                        <div class="container discount-text">
                            <p>
                              Step into a healthier lifestyle without the heavy costs—our gym is offering exclusive discounts for all, giving you full access to our equipment, group workouts, and expert coaching at reduced rates, but only for a short time, so don’t miss out! 
                            </p>
                            <a class="btn">Join Now</a>
                        </div>
                    </div>
                </div>
                <!-- Discount End -->
                
                
<!--=======Subscription Plan Pricing ===========-->

            <div class="price">
                <div class="container">
                    <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                        <p>FITlife Package</p>
                        <h2>FITlife Pricing Plan</h2>
                    </div>
                    <div class="row d-flex flex-wrap">
                        <?php
                        $sql = "SELECT * FROM subscription_plans WHERE plan_status = 'A' ORDER BY plan_price ASC";
                        $result = mysqli_query($conn, $sql);

                        $delay = 0.0;
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $delay_value = number_format($delay, 1) . "s";
                            $is_featured = ($count === 1) ? "featured-item" : ""; // Make 2nd item featured
                            $is_popular = ($count === 1) ? "<div class='price-status'><span>Popular</span></div>" : "";

                            // Determine type text
                            $plan_type = strtolower($row['plan_type']);
                            switch ($plan_type) {
                                case 'daily': $period = '/ day'; break;
                                case 'weekly': $period = '/ wk'; break;
                                case 'monthly': $period = '/ mo'; break;
                                case 'yearly': $period = '/ yr'; break;
                                default: $period = ''; break;
                            }

                            echo "
                            <div class='col-md-4 d-flex wow fadeInUp' data-wow-delay='{$delay_value}'>
                                <div class='price-item {$is_featured} w-100 d-flex flex-column'>
                                    <div class='price-header'>
                                        {$is_popular}
                                        <div class='price-title'>
                                            <h2>" . htmlspecialchars($row['plan_tier']) . "</h2>
                                        </div>
                                        <div class='price-prices'>
                                            <h2><small>₱</small>" . number_format($row['plan_price'], 2) . "<span>{$period}</span></h2>
                                        </div>
                                    </div>
                                    <div class='price-body'>
                                        <div class='price-description'>
                                            <ul>
                                                <li>" . nl2br(htmlspecialchars($row['plan_desc'])) . "</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='price-footer mt-auto'>
                                        <div class='price-action'>
                                            <a class='btn' href='#'>Choose this Plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                            $delay += 0.3;
                            $count++;
                        }
                        ?>
                    </div>
                </div>
            </div>


<!--=============== Team Start=============== -->
<div class="team">
    <div class="container">
        <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
            <p>Our Trainers</p>
            <h2>Meet the FitLife Team</h2>
        </div>

        <?php
        $conn = new mysqli("localhost", "root", "315683", "gymsubsdb");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM fitness_trainers WHERE trainer_status = 'A'";
        $result = $conn->query($sql);

        $delay = 0.0;

        echo '<div class="row justify-content-center">';

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profileImage = (!empty($row['trainer_profile_image']) && file_exists("../img/" . $row['trainer_profile_image']))
                    ? "../img/" . $row['trainer_profile_image']
                    : "../img/default-profile.jpg";

                echo '
                <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="' . number_format($delay, 1) . 's">
                    <div class="team-item">
                        <div class="team-img">
                            <img src="' . htmlspecialchars($profileImage) . '" alt="Trainer Image">
                            <div class="team-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="team-text">
                            <h2>' . htmlspecialchars($row['trainer_fullname']) . '</h2>
                            <p>' . htmlspecialchars($row['trainer_specialization']) . '</p>
                        </div>
                    </div>
                </div>';
                $delay += 0.1;
            }
        } else {
            echo "<p>No active trainers found.</p>";
        }
        
        echo '</div>';

        $conn->close();
        ?>

        <script>
            window.addEventListener("load", () => {
                const cards = document.querySelectorAll(".team-item");
                let maxHeight = 0;

                cards.forEach(card => {
                    card.style.height = "auto";
                    maxHeight = Math.max(maxHeight, card.offsetHeight);
                });

                cards.forEach(card => {
                    card.style.height = maxHeight + "px";
                });
            });
        </script>
    </div>
</div> <!-- Team End -->







                <!-- Blog Start -->
                <div class="blog">
                    <div class="container">
                        <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                            <p>From Our Blog</p>
                            <h2>Latest Fitness Articles</h2>
                        </div>
                        <div class="owl-carousel blog-carousel wow fadeInUp" data-wow-delay="0.1s">
                            <div class="blog-item">
                                <div class="blog-img">
                                    <img src="../img/workingout1.webp" alt="Blog">
                                </div>
                                <div class="blog-text">
                                    <h2>How to Get the Most Out of Your Gym Membership</h2>
                                    <div class="blog-meta">
                                        <p><i class="far fa-list-alt"></i>Body Fitness</p>
                                        <p><i class="far fa-calendar-alt"></i>01-Jan-2045</p>
                                        <p><i class="far fa-comments"></i>5</p>
                                    </div>
                                    <p>
                                        Discover tips and tricks to maximize your results and stay motivated at FitLife Gym.
                                    </p>
                                    <a class="btn" href="">Read More <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                            <!-- Add more blog items as needed -->
                        </div>
                    </div>
                </div>
                <!-- Blog End -->

                <?php include_once "../footer.php"; ?>
        <?php 
            }  //end of home page  



//=========================================== page - about ======================================================         

         else if($_GET['page'] == 'about'){ ?>

         
                <!-- Page Header Start -->
                <div class="page-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2>About Us</h2>
                            </div>
                            <div class="col-12">
                                <a href="">Home</a>
                                <a href="">About Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page Header End -->


                <!-- About Start -->
                <div class="about wow fadeInUp" data-wow-delay="0.1s">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-6">
                                <div class="about-img">
                                    <img src="../img/about.png" alt="Image">
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="section-header text-left">
                                    <p>Learn About Us</p>
                                    <h2>Welcome to FitLife</h2>
                                </div>
                                <div class="about-text">
                                    <p>
                                        At FitLife, we're more than just a gym - we're a community dedicated to helping you achieve your fitness goals. Our state-of-the-art facility is equipped with the latest fitness technology and staffed by certified professionals.
                                    </p>
                                    <p>
                                        Whether you're a beginner or a seasoned athlete, our comprehensive programs and personalized training approach will help you reach new heights in your fitness journey. Join us and experience the difference that makes FitLife the premier fitness destination.
                                    </p>
                                    <a class="btn" href="about.html">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- About End -->
         <?php 
            }  
            
//=========================================== page - facilities ======================================================         

         else if($_GET['page'] == 'facilities'){ ?>

            
            <!-- Page Header Start -->
            <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Our Facilities</h2>
                        </div>
                        <div class="col-12">
                            <a href="index.html">Home</a>
                            <a href="service.html">Facilities</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->

             <!-- Service Start -->
            <div class="service">
                <div class="container">
                    <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                        <p>What we offer</p>
                        <h2>Premium Facilities</h2>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.0s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-dumbbell"></i>
                                </div>
                                <h3>Modern Equipment</h3>
                                <p>
                                    Access to the latest fitness technology and equipment for an optimal workout experience
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="service-item active">
                                <div class="service-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <h3>Personal Training</h3>
                                <p>
                                    One-on-one sessions with certified trainers to help you reach your fitness goals
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3>Group Classes</h3>
                                <p>
                                    Dynamic group fitness classes for all levels, from HIIT to strength, cycling, and more
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <h3>Private Locker Rooms</h3>
                                <p>
                                    Spacious, air-conditioned lockers with showers, mirrors, and grooming areas.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.8s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-apple-alt"></i>
                                </div>
                                <h3>Nutrition Bar</h3>
                                <p>
                                    Fresh protein shakes, energy bars, and healthy snacks.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1s">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-coffee"></i>
                                </div>
                                <h3>Lounge</h3>
                                <p>
                                    A space to relax, hydrate, or chat with fellow members.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Service End -->

             <!-- Additional Services Start -->
                <div class="about wow fadeInUp" data-wow-delay="0.1s">
                    <div class="container">
                        <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                            <p>Extra Services</p>
                            <h2>Additional Amenities</h2>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="about-item">
                                    <h3>Personal Training</h3>
                                    <p>One-on-one training sessions with certified personal trainers to help you reach your fitness goals.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="about-item">
                                    <h3>Nutrition Counseling</h3>
                                    <p>Professional nutrition advice and meal planning to complement your fitness journey.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="about-item">
                                    <h3>Child Care</h3>
                                    <p>On-site child care services while you work out, staffed by certified professionals.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Additional Services End -->
        <?php 
            } //end of facilities page


//=========================================== page - memberships ======================================================   

        else if($_GET['page'] == 'memberships'){ ?>

            <!-- Page Header Start -->
            <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Membership Plans</h2>
                        </div>
                        <div class="col-12">
                            <a href="index.html">Home</a>
                            <a href="price.html">Memberships</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->

            <!-- Price Start -->
                <div class="price">
                <div class="container">
                    <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                        <p>FITlife Package</p>
                        <h2>FITlife Pricing Plan</h2>
                    </div>
                    <div class="row d-flex flex-wrap">
                        <?php
                        $sql = "SELECT * FROM subscription_plans WHERE plan_status = 'A' ORDER BY plan_price ASC";
                        $result = mysqli_query($conn, $sql);

                        $delay = 0.0;
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $delay_value = number_format($delay, 1) . "s";
                            $is_featured = ($count === 1) ? "featured-item" : ""; // Make 2nd item featured
                            $is_popular = ($count === 1) ? "<div class='price-status'><span>Popular</span></div>" : "";

                            // Determine type text
                            $plan_type = strtolower($row['plan_type']);
                            switch ($plan_type) {
                                case 'daily': $period = '/ day'; break;
                                case 'weekly': $period = '/ wk'; break;
                                case 'monthly': $period = '/ mo'; break;
                                case 'yearly': $period = '/ yr'; break;
                                default: $period = ''; break;
                            }

                            echo "
                            <div class='col-md-4 d-flex wow fadeInUp' data-wow-delay='{$delay_value}'>
                                <div class='price-item {$is_featured} w-100 d-flex flex-column'>
                                    <div class='price-header'>
                                        {$is_popular}
                                        <div class='price-title'>
                                            <h2>" . htmlspecialchars($row['plan_tier']) . "</h2>
                                        </div>
                                        <div class='price-prices'>
                                            <h2><small>₱</small>" . number_format($row['plan_price'], 2) . "<span>{$period}</span></h2>
                                        </div>
                                    </div>
                                    <div class='price-body'>
                                        <div class='price-description'>
                                            <ul>
                                                <li>" . nl2br(htmlspecialchars($row['plan_desc'])) . "</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='price-footer mt-auto'>
                                        <div class='price-action'>
                                            <a class='btn' href='#'>Choose this Plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                            $delay += 0.3;
                            $count++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        <!-- Price End -->

        <?php
            } //end of memberships page
        
//=========================================== page - trainers ======================================================  

        else if($_GET['page'] == 'trainers'){ ?>

        <!-- Page Header Start -->
        <div class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2>Trainers</h2>
                    </div>
                    <div class="col-12">
                        <a href="">Home</a>
                        <a href="">Trainers</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Header End -->


        <div class="team">
            <div class="container">
                <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                    <p>Our Trainers</p>
                    <h2>Meet the FitLife Team</h2>
                </div>

                <?php
                $conn = new mysqli("localhost", "root", "315683", "gymsubsdb");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM fitness_trainers WHERE trainer_status = 'A'";
                $result = $conn->query($sql);

                $delay = 0.0;

                // ✅ This is where you start the centered row
                echo '<div class="row justify-content-center">';

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $profileImage = (!empty($row['trainer_profile_image']) && file_exists("../img/" . $row['trainer_profile_image']))
                            ? "../img/" . $row['trainer_profile_image']
                            : "../img/default-profile.jpg";

                        echo '
                        <div class="col-lg-2 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="' . number_format($delay, 1) . 's">
                            <div class="team-item">
                                <div class="team-img">
                                    <img src="' . htmlspecialchars($profileImage) . '" alt="Trainer Image">
                                    <div class="team-social">
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                                <div class="team-text">
                                    <h2>' . htmlspecialchars($row['trainer_fullname']) . '</h2>
                                    <p>' . htmlspecialchars($row['trainer_specialization']) . '</p>
                                </div>
                            </div>
                        </div>';
                        $delay += 0.1;
                    }
                } else {
                    echo "<p>No active trainers found.</p>";
                }

                // ✅ Close the centered row
                echo '</div>';

                $conn->close();
                ?>

                <script>
                    window.addEventListener("load", () => {
                        const cards = document.querySelectorAll(".team-item");
                        let maxHeight = 0;

                        cards.forEach(card => {
                            card.style.height = "auto";
                            maxHeight = Math.max(maxHeight, card.offsetHeight);
                        });

                        cards.forEach(card => {
                            card.style.height = maxHeight + "px";
                        });
                    });
                </script>
            </div>
        </div> <!-- Team End -->
        <?php 
        } //end of trainers 
        
        
//=========================================== page - memberships ======================================================   

        else if($_GET['page'] == 'contact'){ ?>
  
                <!-- Page Header Start -->
                <div class="page-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2>Contact</h2>
                            </div>
                            <div class="col-12">
                                <a href="">Home</a>
                                <a href="">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page Header End -->


                <!-- Contact Start -->
                <div class="contact">
                    <div class="container">
                        <div class="section-header text-center wow zoomIn" data-wow-delay="0.1s">
                            <p>Get In Touch</p>
                            <h2>For Any Query</h2>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4 contact-item wow zoomIn" data-wow-delay="0.2s">
                                        <i class="fa fa-map-marker-alt"></i>
                                        <div class="contact-text">
                                            <h2>Location</h2>
                                            <p>123 Street, New York, USA</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 contact-item wow zoomIn" data-wow-delay="0.4s">
                                        <i class="fa fa-phone-alt"></i>
                                        <div class="contact-text">
                                            <h2>Phone</h2>
                                            <p>+012 345 67890</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 contact-item wow zoomIn" data-wow-delay="0.6s">
                                        <i class="far fa-envelope"></i>
                                        <div class="contact-text">
                                            <h2>Email</h2>
                                            <p>info@example.com</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="contact-form">
                                    <div id="success"></div>
                                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                                        <div class="control-group">
                                            <input type="text" class="form-control" id="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <input type="email" class="form-control" id="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <input type="text" class="form-control" id="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject" />
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div class="control-group">
                                            <textarea class="form-control" id="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                                            <p class="help-block text-danger"></p>
                                        </div>
                                        <div>
                                            <button class="btn" type="submit" id="sendMessageButton">Send Message</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contact End -->

        <?php
            } //end of contact page
        
//=========================================== page - edit Profile ======================================================   
       
    else if($_GET['page'] == 'editProfile'){ 

    $profile_query = mysqli_query($conn, "SELECT * FROM user_profiles WHERE user_id = $c_user_id");
    $profile = mysqli_fetch_assoc($profile_query);
    ?>
    
    <!-- Page Content -->
     <div class="container my-5">

        <form id="profileForm" action="update_profile.php" method="POST" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;">
            
            <div id="alertBox" class="alert d-none mt-3" role="alert"></div>

            <h2 class="text-2xl font-bold text-center mb-4">Your Profile</h2>

        <form id="profileForm" action="../common_user/update_profile.php" method="POST" class="profile-form">
            <h2>Your Profile</h2>

            <input type="hidden" name="user_id" value="<?= $c_user_id ?>">

            <label>Age</label>
            <input type="number" name="age" value="<?= htmlspecialchars($profile['age']) ?>" min="18" max="70" disabled required>

            <label>Height (cm)</label>
            <input type="number" step="0.1" name="height_cm" value="<?= htmlspecialchars($profile['height_cm']) ?>" disabled required>

            <label>Weight (kg)</label>
            <input type="number" step="0.1" name="weight_kg" value="<?= htmlspecialchars($profile['weight_kg']) ?>" disabled required>

            <label>Fitness Goal</label>
            <select name="fitness_goal" disabled>
                <option value="lose_weight" <?= $profile['fitness_goal'] == 'lose_weight' ? 'selected' : '' ?>>Lose Weight</option>
                <option value="build_muscle" <?= $profile['fitness_goal'] == 'build_muscle' ? 'selected' : '' ?>>Build Muscle</option>
                <option value="muscle_toning" <?= $profile['fitness_goal'] == 'muscle_toning' ? 'selected' : '' ?>>Muscle Toning</option>
            </select>

            <label>Activity Level</label>
            <select name="activity_level" disabled>
                <option value="sedentary" <?= $profile['activity_level'] == 'sedentary' ? 'selected' : '' ?>>Sedentary</option>
                <option value="lightly_active" <?= $profile['activity_level'] == 'lightly_active' ? 'selected' : '' ?>>Lightly Active</option>
                <option value="active" <?= $profile['activity_level'] == 'active' ? 'selected' : '' ?>>Active</option>
                <option value="very_active" <?= $profile['activity_level'] == 'very_active' ? 'selected' : '' ?>>Very Active</option>
            </select>

            <label>Medical Conditions</label>
            <textarea name="medical_conditions" disabled><?= htmlspecialchars($profile['medical_conditions']) ?></textarea>

            <button id="updateBtn" type="submit" class="btn d-none">Update Profile</button>
        </form>

        <div class="text-center mt-3">
            <button onclick="enableEdit()" class="btn btn-edit">Edit</button>
        </div>
    </div>







        

        <?php
            } //end of editProfile
        ?>  
          
        <?php include_once "../footer.php";

            } //end of page
        ?> 




        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        
        <!-- Contact Javascript File -->
        <script src="mail/jqBootstrapValidation.min.js"></script>
        <script src="mail/contact.js"></script>

        <!-- Template Javascript -->
        <script src="../js/main.js"></script>
        <script src="../js/common_user_script.js"></script>
     
    <script>
    function enableEdit() {
        const form = document.getElementById('profileForm');
        const fields = form.querySelectorAll('input, select, textarea');
        fields.forEach(field => {
            if (field.name !== 'user_id') {
                field.removeAttribute('disabled');
            }
        });
        document.getElementById('updateBtn').classList.remove('d-none');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('profileForm');
        const alertBox = document.getElementById('alertBox');

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch('../common_user/update_profile.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        showAlert('success', data.message);
                        disableFormInputs();
                        document.getElementById('updateBtn').classList.add('d-none');
                    } else {
                        showAlert('danger', data.message);
                    }
                })
                .catch(error => {
                    showAlert('danger', 'Unexpected error: ' + error.message);
                });
            });
        }

        function disableFormInputs() {
            const fields = form.querySelectorAll('input, select, textarea');
            fields.forEach(field => field.setAttribute('disabled', 'disabled'));
        }

        function showAlert(type, message) {
            alertBox.className = `alert alert-${type} alert-dismissible fade show mt-3`;
            alertBox.innerHTML = `
                <strong>${type === 'success' ? 'Success!' : 'Error!'}</strong> ${message}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            `;
            alertBox.classList.remove('d-none');

            // Scroll to alert box smoothly
            alertBox.scrollIntoView({ behavior: 'smooth' });

            // Hide after 4 seconds
            setTimeout(() => {
                $(alertBox).fadeOut(500, () => {
                    alertBox.classList.add('d-none');
                    alertBox.style.display = '';
                });
            }, 4000);
        }
    });
</script>

 </body>
 </html>

