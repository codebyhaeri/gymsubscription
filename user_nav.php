<?php
// At the top of user_nav.php
if(isset($_GET['logout'])){
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to login page
    header("location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <link href="style/homepage.css" rel="stylesheet">
</head>
<body>

        <!-- Top Bar Start -->
        <div class="top-bar d-none d-md-block" style="background-color: #E573A2;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="top-bar-left">
                            <div class="text">
                                <i class="far fa-clock"></i>
                                <h2>24/7</h2>
                                <p>Open All Day</p>
                            </div>
                            <div class="text">
                                <i class="fa fa-phone-alt"></i>
                                <h2>+1 (555) 123-4567</h2>
                                <p>Call for Membership</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="top-bar-right">
                            <div class="social">
                                <a href=""><i class="fab fa-twitter"></i></a>
                                <a href=""><i class="fab fa-facebook-f"></i></a>
                                <a href=""><i class="fab fa-linkedin-in"></i></a>
                                <a href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Bar End -->

        <!-- Nav Bar Start -->
        <div class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container-fluid">
                <a href="?page=home" class="navbar-brand text-white">Fit<span style="color:#E87BAA">Life</span></a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav ml-auto">
                            <a href="?page=home" class="nav-item nav-link">Home</a>
                            <a href="?page=about" class="nav-item nav-link">About</a>
                            <a href="?page=facilities" class="nav-item nav-link">Facilities</a>
                            <a href="?page=memberships" class="nav-item nav-link">Memberships</a>
                            <a href="?page=trainers" class="nav-item nav-link">Trainers</a>
                            <a href="?page=contact" class="nav-item nav-link">Contact</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Account</a>
                                <div class="dropdown-menu">
                                    <a href="?logout=true" class="dropdown-item">Log Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <!-- Nav Bar End -->

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


        