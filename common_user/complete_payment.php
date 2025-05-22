<?php
include '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = intval($_POST['payment_id'] ?? 0);
    $subs_id = intval($_POST['subs_id'] ?? 0);

    if ($payment_id <= 0 || $subs_id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters.']);
        exit();
    }

    // Use transaction for atomic updates
    $conn->begin_transaction();

    try {
        // Update payment status
        $stmt = $conn->prepare("UPDATE payments SET payment_status = 'paid' WHERE payment_id = ?");
        $stmt->bind_param('i', $payment_id);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            throw new Exception('Payment update failed.');
        }
        $stmt->close();

        // Update subscription status
        $stmt = $conn->prepare("UPDATE subscriptions SET subs_status = 'active' WHERE subs_id = ?");
        $stmt->bind_param('i', $subs_id);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            throw new Exception('Subscription update failed.');
        }
        $stmt->close();

        $conn->commit();

        echo json_encode(['status' => 'success', 'message' => 'Payment successful! Subscription is now active.']);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => 'Transaction failed: ' . $e->getMessage()]);
    }
}
?>
