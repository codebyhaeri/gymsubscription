<?php
// Display errors (development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set response type
header('Content-Type: application/json');

// Include DB connection
include __DIR__ . "/../config/db_connect.php";

// Helper function to send JSON response
function respond($success, $message = '') {
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

// Ensure it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.');
}

// Validate required fields
$required_fields = ['fmu_trainer_id'];
foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
        respond(false, "Missing field: " . $field);
    }
}

// Sanitize inputs
$trainer_id = mysqli_real_escape_string($conn, $_POST['fmu_trainer_id']);
$trainer_fullname = mysqli_real_escape_string($conn, $_POST['fmu_trainer_fullname']);
$trainer_specialization = mysqli_real_escape_string($conn, $_POST['fmu_trainer_spzn']);
$trainer_contact_number = mysqli_real_escape_string($conn, $_POST['fmu_trainer_contact_no']);

// Build and run the UPDATE query
$sql = "UPDATE fitness_trainers SET 
            trainer_fullname = '$trainer_fullname',
            trainer_specialization = '$trainer_specialization',
            trainer_contact_number = '$trainer_contact_number'
        WHERE trainer_id = '$trainer_id'";

if (mysqli_query($conn, $sql)) {
    respond(true, "Fitness trainer updated successfully.");
} else {
    respond(false, "Database error: " . mysqli_error($conn));
}
?>
