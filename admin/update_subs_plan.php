<?php
//Display errors for debugging (optional during development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Send JSON header before anything else
header('Content-Type: application/json');

include __DIR__ . "/../config/db_connect.php";

        // Helper to send JSON response
        function respond($success, $message = '') {
            echo json_encode(['success' => $success, 'message' => $message]);
            exit;
        }

        // Ensure it's a POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            respond(false, 'Invalid request method.');
        }

        // Validate required fields
        $required_fields = ['u_plan_id', 'u_plan_name', 'u_plan_type', 'u_plan_tier', 'u_plan_price', 'u_plan_duration_days', 'u_plan_desc'];
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
                respond(false, "Missing field: " . $field);
            }
        }

        //Sanitize inputs
        $plan_id = mysqli_real_escape_string($conn, $_POST['u_plan_id']);
        $plan_name = mysqli_real_escape_string($conn, $_POST['u_plan_name']);
        $plan_type = mysqli_real_escape_string($conn, $_POST['u_plan_type']);
        $plan_tier = mysqli_real_escape_string($conn, $_POST['u_plan_tier']);
        $plan_price = floatval($_POST['u_plan_price']);
        $plan_duration_days = intval($_POST['u_plan_duration_days']);
        $plan_desc = mysqli_real_escape_string($conn, $_POST['u_plan_desc']);

        //Build & run query
        $sql = "UPDATE subscription_plans SET 
                    plan_name = '$plan_name',
                    plan_type = '$plan_type',
                    plan_tier = '$plan_tier',
                    plan_price = '$plan_price',
                    plan_duration_days = '$plan_duration_days',
                    plan_desc = '$plan_desc'
                WHERE plan_id = '$plan_id'";

        if (mysqli_query($conn, $sql)) {
            respond(true, "Plan updated successfully.");
        } else {
            respond(false, "Database error: " . mysqli_error($conn));
        }

?>