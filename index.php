<?php
    include_once "./config/db_connect.php";

if(isset($_SESSION['l_user_type'])) {
    if($_SESSION['l_user_type'] == 'A'){
       header("location: admin/");   
       exit; 
    }

    if($_SESSION['l_user_type'] == 'C'){
       header("location: common_user/");
       exit; 
    }
} 
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
        <link href="./style/homepage.css" rel="stylesheet">
    </head>
    <body>

       <!-- landing page goes here?? -->
        
        <?php include "visitor_nav.php";?>

        <!-- Hero Start -->
        <div class="hero">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-12 col-md-6">
                        <div class="hero-text">
                            <h1>Transform Your Life with FitLife</h1>
                            <p>
                                Join the ultimate fitness experience with state-of-the-art equipment, expert trainers, and premium facilities. Start your fitness journey today!
                            </p>
                            <div class="hero-btn">
                                <a class="btn" href="register.php">Join Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 d-none d-md-block">
                        <div class="hero-image">
                            <img src="img/hero.png" alt="Hero Image">
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
                            <img src="img/about.png" alt="Image">
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
                                <i class="flaticon-workout"></i>
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
                                <i class="flaticon-workout-1"></i>
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
                                <i class="flaticon-workout-2"></i>
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
                                <i class="flaticon-workout-3"></i>
                            </div>
                            <h3>Recovery Zone</h3>
                            <p>
                                Dedicated recovery area with foam rollers, stretching zones, and massage equipment
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.8s">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-workout-4"></i>
                            </div>
                            <h3>Swimming Pool</h3>
                            <p>
                                Olympic-sized pool for lap swimming, aqua fitness, and relaxation
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="1s">
                        <div class="service-item">
                            <div class="service-icon">
                                <i class="flaticon-workout-5"></i>
                            </div>
                            <h3>Spa & Sauna</h3>
                            <p>
                                Relax after your workout in our spa, sauna, and steam rooms
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->
        
        
        <!-- Discount Start -->
        <div class="discount wow zoomIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="section-header text-center">
                    <p>Awesome Discount</p>
                    <h2>Get <span>30%</span> Discount for all Classes</h2>
                </div>
                <div class="container discount-text">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec pretium mi. Curabitur facilisis ornare velit non vulputate. Aliquam metus tortor, auctor id gravida condimentum, viverra quis sem. Curabitur non nisl nec nisi scelerisque maximus. 
                    </p>
                    <a class="btn">Join Now</a>
                </div>
            </div>
        </div>
        <!-- Discount End -->
        
        
        <!<!--=======Subscription Plan Pricing ===========-->

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
                                            <a class='btn' href='index.php?page=subscribe&plan_id={$row['plan_id']}'>Choose this Plan</a>
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


        <!-- Footer Start -->
        <div class="footer wow fadeIn" data-wow-delay="0.3s">
            <div class="container-fluid">
                <div class="container">
                    <div class="footer-info">
                        <a href="index.html" class="footer-logo">Fit<span>Life</span></a>
                        <h3>123 Street, New York, USA</h3>
                        <div class="footer-menu">
                            <p>+012 345 67890</p>
                            <p>info@example.com</p>
                        </div>
                        <div class="footer-social">
                            <a href=""><i class="fab fa-twitter"></i></a>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-youtube"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="container copyright">
                    <div class="row">
                        <div class="col-md-6">
                            <p>&copy; <a href="#">Your Site Name</a>, All Right Reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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
        <script src="js/main.js"></script>
</body>
</html>