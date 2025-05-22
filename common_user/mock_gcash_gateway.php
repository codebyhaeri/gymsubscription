<?php
include '../config/db_connect.php';

$payment_id = intval($_GET['payment_id'] ?? 0);
$subs_id = intval($_GET['subs_id'] ?? 0);

// Validate payment & subscription exist
$stmt = $conn->prepare("SELECT payment_id FROM payments WHERE payment_id = ?");
$stmt->bind_param('i', $payment_id);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    die("Invalid payment ID.");
}
$stmt->close();

$stmt = $conn->prepare("SELECT subs_id FROM subscriptions WHERE subs_id = ?");
$stmt->bind_param('i', $subs_id);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows === 0) {
    die("Invalid subscription ID.");
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>GCash Payment</title>
<link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<h2>GCash Payment Simulator</h2>
<p>Simulate completing your payment here.</p>

<form id="paymentForm">
    <input type="hidden" name="payment_id" value="<?= $payment_id ?>" />
    <input type="hidden" name="subs_id" value="<?= $subs_id ?>" />
    <button type="submit">Simulate Payment</button>
</form>

    <script src="../js/payment_script.js"></script>
</body>
</html>