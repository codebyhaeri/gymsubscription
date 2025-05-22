<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include '../../config/db_connect.php';

$status = $_GET['status'] ?? 'active';
$search = $_GET['search'] ?? '';

$query = "SELECT s.*, u.fullname, u.email, p.plan_name, p.plan_type, p.plan_tier, s.subs_end_date
          FROM subscriptions s
          JOIN users u ON s.user_id = u.user_id
          JOIN subscription_plans p ON s.plan_id = p.plan_id
          WHERE s.subs_status = ?
          AND (u.fullname LIKE ? OR u.email LIKE ?)
          ORDER BY s.subs_start_date DESC";

$stmt = $conn->prepare($query);
$searchWildcard = "%$search%";
$stmt->bind_param("sss", $status, $searchWildcard, $searchWildcard);
$stmt->execute();
$result = $stmt->get_result();

$rows = [];
while ($row = $result->fetch_assoc()) {
  $rows[] = $row;
}

echo json_encode($rows);
?>
