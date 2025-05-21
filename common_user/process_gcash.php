<?php
include '../config/db_connect.php';

header('Content-Type: application/json');

$payment_id = $_POST['payment_id'];

// Get payment details (must be pending)
$payment_query = mysqli_query($conn, "SELECT * FROM payments WHERE payment_id = $payment_id AND status = 'pending'");
if (!$payment_query || mysqli_num_rows($payment_query) === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid or already processed payment.']);
    exit;
}

$payment = mysqli_fetch_assoc($payment_query);
$user_id = $payment['user_id'];
$amount = $payment['amount'];

// Get plan from amount match (safer: store plan_id in payments table later)
$plan_query = mysqli_query($conn, "
    SELECT * FROM subscription_plans 
    WHERE plan_price = $amount AND plan_status = 'active' 
    LIMIT 1
");

if (!$plan_query || mysqli_num_rows($plan_query) === 0) {
    echo json_encode(['success' => false, 'message' => 'Matching plan not found.']);
    exit;
}

$plan = mysqli_fetch_assoc($plan_query);
$plan_id = $plan['plan_id'];
$duration = $plan['plan_duration_days'];
$start_date = date('Y-m-d');
$end_date = date('Y-m-d', strtotime("+$duration days"));

// Start transaction
mysqli_begin_transaction($conn);

try {
    // 1. Update payment to paid
    $update_payment = "UPDATE payments SET status = 'paid' WHERE payment_id = $payment_id";
    if (!mysqli_query($conn, $update_payment)) {
        throw new Exception("Failed to update payment.");
    }

    // 2. Insert subscription
    $insert_subscription = "INSERT INTO subscriptions (user_id, plan_id, subs_start_date, subs_end_date, subs_status)
                                                VALUES ('$user_id', '$plan_id', '$start_date', '$end_date', 'active')";

    if (!mysqli_query($conn, $insert_subscription)) {
        throw new Exception("Failed to insert subscription.");
    }

    mysqli_commit($conn);
    echo json_encode(['success' => true, 'message' => 'Subscription successful!']);
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo json_encode(['success' => false, 'message' => 'Error processing subscription.']);
}
?>
