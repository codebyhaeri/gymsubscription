<?php 

session_start();
        include __DIR__ . "/../config/db_connect.php";

        $c_user_id = $_SESSION['l_user_id']; //holds user id parameter for all processing
        
        if($_SESSION['l_user_type'] != 'C'){
            header("location: ../index.php");
        }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Subscribe</title>
  <link rel="stylesheet" href="../style/user.css">
</head>
<body>
    <div class="gym-subscription-wrapper">
        <h2>Select a Subscription Plan</h2>
            <form id="subscriptionForm">
                    <?php
                        $plans = mysqli_query($conn, "SELECT * FROM subscription_plans WHERE plan_status = 'A'");
                        while ($plan = mysqli_fetch_assoc($plans)) {
                        echo "<div>
                                <input type='radio' name='plan_id' value='{$plan['plan_id']}' required>
                                <b>{$plan['plan_name']}</b> ({$plan['plan_tier']}, {$plan['plan_type']}) - ₱{$plan['plan_price']}
                                <p>{$plan['plan_desc']}</p>
                                </div>";
                        }
                    ?>
                <input type="hidden" name="user_id" value="1"> <!-- Replace with real user ID -->
                <button type="submit" class="gym-subscribe-btn">Subscribe</button>
            </form>
    </div>


  <script src="../js/payments_script.js"></script>
</body>
</html>
