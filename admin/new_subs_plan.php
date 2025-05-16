<?php

include __DIR__ . "/../config/db_connect.php";

    // Tell the browser this is a JSON response
    header('Content-Type: application/json');

    if (isset($_POST['n_plan_type'])) {

        $plan_name = $_POST['n_plan_name'];
        $plan_type = $_POST['n_plan_type']; 
        $plan_tier = $_POST['n_plan_tier'];
        $plan_price = $_POST['n_plan_price'];
        $plan_duration_days = $_POST['n_plan_duration_days'];
        $plan_desc = $_POST['n_plan_desc'];

        $sql_insert_subs_plan = "INSERT INTO `subscription_plans`
            (`plan_name`,`plan_type`, `plan_tier`, `plan_price`, `plan_duration_days`, `plan_desc`)
            VALUES
            ('$plan_name','$plan_type','$plan_tier','$plan_price','$plan_duration_days','$plan_desc')";

        $execute_query = mysqli_query($conn, $sql_insert_subs_plan);

        if ($execute_query) { 
            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Missing required data']);
        exit;
    }
    
?>


