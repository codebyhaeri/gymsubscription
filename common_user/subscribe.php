<?php
include '../config/db_connect.php';
session_start();

if (!isset($_SESSION['l_user_id'])) {
    header('Location: ../login.php'); // redirect if not logged in
    exit();
}
$c_user_id = $_SESSION['l_user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
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

          <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

        <!-- FontAwesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        />

        <!-- Your CSS -->
        <link rel="stylesheet" href="../style/try.css">
        <style>
            
    /* FitLife Colors from your palette */
    :root {
        --fitlife-darkest: #3B0016;
        --fitlife-dark: #6B0837;
        --fitlife-medium: #A53A6B;
        --fitlife-light: #E573A2;
        --fitlife-pale: #F7A1C4;
    }

    /* Container */
    .subscribe-container {
        background-color: var(--fitlife-pale);
        border-radius: 10px;
        padding: 30px 25px;
        width: 380px;
        box-shadow: 0 4px 8px rgba(107, 8, 55, 0.2);
        color: var(--fitlife-darkest);
        margin: 20vh 0 0 80vh;
        
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: 700;
        color: var(--fitlife-dark);
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: var(--fitlife-dark);
    }

    select {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 18px;
        border-radius: 6px;
        border: 1px solid var(--fitlife-dark);
        font-size: 1rem;
        background: #fff;
        color: var(--fitlife-darkest);
        transition: border-color 0.3s ease;
    }

    select:focus {
        outline: none;
        border-color: var(--fitlife-medium);
        box-shadow: 0 0 6px var(--fitlife-medium);
    }

    button[type="submit"] {
        width: 100%;
        padding: 12px 0;
        border: none;
        border-radius: 7px;
        background-color: var(--fitlife-medium);
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: var(--fitlife-dark);
    }
        </style>


<link href="../style/homepage.css" rel="stylesheet">
<title>Subscribe</title>

</head>
<body>

 <?php include "../user_nav.php"; ?>

<div style="justify-content: center">
<div class="subscribe-container" >
    <h2>Subscribe to a Plan</h2>

    <form action="process_subscription.php" method="POST" id="subscribeForm">
        <label for="plan_id">Choose Plan:</label>
        <select name="plan_id" id="plan_id" required>
            <option value="">-- Select Plan --</option>
            <?php
            $result = $conn->query("SELECT * FROM subscription_plans WHERE plan_status = 'A' ORDER BY plan_name ASC");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['plan_id']}'>"
                    . htmlspecialchars($row['plan_name']) . " - ₱" . number_format($row['plan_price'], 2) . " ({$row['plan_duration_days']} days)"
                    . "</option>";
            }
            ?>
        </select>

        <label for="payment_method_id">Payment Method:</label>
        <select name="payment_method_id" id="payment_method_id" required>
            <option value="">-- Select Method --</option>
            <?php
            $result = $conn->query("SELECT * FROM payment_methods WHERE payment_method_status = 'A' ORDER BY payment_method_desc ASC");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['payment_method_id']}'>"
                    . htmlspecialchars($row['payment_method_desc'])
                    . "</option>";
            }
            ?>
        </select>

        <!-- No need to pass user_id in form; handle via session -->

        <button type="submit">Proceed to Payment</button>
    </form>
</div>
</div>

<script src="../js/payment_script.js"></script>
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
