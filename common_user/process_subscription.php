<?php
include '../config/db_connect.php';
session_start();

$c_user_id = $_SESSION['l_user_id'] ?? 0;

if (!$c_user_id) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan_id = intval($_POST['plan_id'] ?? 0);
    $payment_method_id = intval($_POST['payment_method_id'] ?? 0);

    // Check if plan exists and active
    $stmt = $conn->prepare("SELECT plan_price, plan_duration_days FROM subscription_plans WHERE plan_id = ? AND plan_status = 'A'");
    $stmt->bind_param('i', $plan_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid or inactive subscription plan.']);
        exit();
    }
    $plan = $result->fetch_assoc();
    $stmt->close();

    // Prevent duplicate active/pending subscriptions
    $stmt = $conn->prepare("SELECT 1 FROM subscriptions WHERE user_id = ? AND subs_status IN ('active','pending') AND subs_end_date >= CURDATE() LIMIT 1");
    $stmt->bind_param('i', $c_user_id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'You already have an active or pending subscription.']);
        exit();
    }
    $stmt->close();

    $start_date = date('Y-m-d');
    $end_date = date('Y-m-d', strtotime("+{$plan['plan_duration_days']} days"));
    $price = $plan['plan_price'];

    // Begin transaction to keep data consistent
    $conn->begin_transaction();

    try {
        // Insert subscription - pending status
        $stmt = $conn->prepare("INSERT INTO subscriptions (user_id, plan_id, subs_start_date, subs_end_date, subs_status) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->bind_param('iiss', $c_user_id, $plan_id, $start_date, $end_date);
        $stmt->execute();
        $subs_id = $stmt->insert_id;
        $stmt->close();

        // Insert payment - pending status
        $stmt = $conn->prepare("INSERT INTO payments (user_id, payment_amount, payment_date, payment_status, payment_method_id) VALUES (?, ?, NOW(), 'pending', ?)");
        $stmt->bind_param('idi', $c_user_id, $price, $payment_method_id);
        $stmt->execute();
        $payment_id = $stmt->insert_id;
        $stmt->close();

        $conn->commit();

        // Choose gateway URL
        $gateway_url = ($payment_method_id === 2) ? 'mock_paypal_gateway.php' : 'mock_gcash_gateway.php';

        echo json_encode([
            'status' => 'success',
            'redirect' => "$gateway_url?payment_id=$payment_id&subs_id=$subs_id"
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => 'Transaction failed: ' . $e->getMessage()]);
    }
}
?>
