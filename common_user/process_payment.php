<?php

include '../config/db_connect.php';

header('Content-Type: application/json');

// Input from form
$user_id = $_POST['user_id'];
$plan_id = $_POST['plan_id'];

// Validate plan exists and is active
$plan_query = mysqli_query($conn, "SELECT * FROM subscription_plans 
                                            WHERE plan_id = $plan_id 
                                            AND plan_status = 'A'");
if (!$plan_query || mysqli_num_rows($plan_query) === 0) {
    echo json_encode(['success' => false, 'message' => 'Selected plan is not available.']);
    exit;
}

$plan = mysqli_fetch_assoc($plan_query);
$amount = $plan['plan_price'];
$method = 'Gcash'; // or 'Online', depending on form source

// Insert pending payment
$payment_query = "INSERT INTO payments (user_id, payment_amount, payment_date, payment_method, payment_status)
                                VALUES ('$user_id', '$amount', NOW(), '$method', 'pending')";

if (mysqli_query($conn, $payment_query)) {
    $payment_id = mysqli_insert_id($conn);
    echo json_encode([
        'success' => true,
        'message' => 'Payment initialized. Awaiting confirmation.',
        'payment_id' => $payment_id
    ]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to create payment record.']);
}
?>
