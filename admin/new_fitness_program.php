<?php
include '../config/db_connect.php';
header('Content-Type: application/json');

// Helper to send JSON + exit
function respond(bool $ok, string $msg) {
    echo json_encode(['success' => $ok, 'message' => $msg]);
    exit;
}

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.');
}

// 1) Ensure all text fields are present
$required = [
    'ppn_program_name',
    'ppn_program_goal',
    'ppn_program_desc',
    'ppn_program_duration_weeks',
    'ppn_program_trainer'
];
foreach ($required as $f) {
    if (empty($_POST[$f])) {
        respond(false, "Missing required field: $f");
    }
}

// 2) Ensure file was uploaded without error
if (
    ! isset($_FILES['ppn_program_img']) ||
    $_FILES['ppn_program_img']['error'] !== UPLOAD_ERR_OK
) {
    respond(false, 'Program image is required.');
}

// 3) Validate & move the uploaded image
$targetDir  = __DIR__ . "/../img/";
$filename   = basename($_FILES['ppn_program_img']['name']);
$targetFile = $targetDir . $filename;
$ext        = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

if (! in_array($ext, ['jpg','jpeg','png','gif'], true)) {
    respond(false, 'Only JPG, JPEG, PNG & GIF allowed.');
}

if (! move_uploaded_file($_FILES['ppn_program_img']['tmp_name'], $targetFile)) {
    respond(false, 'Failed to save image.');
}

// 4) Sanitize inputs
$name  = mysqli_real_escape_string($conn, $_POST['ppn_program_name']);
$goal  = mysqli_real_escape_string($conn, $_POST['ppn_program_goal']);
$desc  = mysqli_real_escape_string($conn, $_POST['ppn_program_desc']);
$weeks = (int) $_POST['ppn_program_duration_weeks'];
$tid   = (int) $_POST['ppn_program_trainer'];

// 5) Insert into database with correct column names
$sql = "INSERT INTO fitness_programs
        (program_name, program_goal, program_desc, program_duration_weeks, trainer_id, program_main_img)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiss", $name, $goal, $desc, $weeks, $tid, $filename);

if ($stmt->execute()) {
    respond(true, 'Program added successfully.');
} else {
    respond(false, 'Database error: ' . $stmt->error);
}




// $program_name = $_POST['pp_program_name'];
// $goal = $_POST['ppn_program_goal'];
// $description = $_POST['ppn_program_desc'];
// $duration = $_POST['ppn_program_duration_weeks'];
// $trainer_id = $_POST['ppn_program_trainer'];

// $sql = "INSERT INTO fitness_programs (program_name, program_goal, program_desc, program_duration_weeks, trainer_id)
//         VALUES (?, ?, ?, ?, ?)";

// $stmt = $conn->prepare($sql);
// $stmt->bind_param("sssii", $program_name, $goal, $description, $duration, $trainer_id);


// $program_name = $_POST['pp_program_name'];
// $goal = $_POST['ppn_program_goal'];
// $description = $_POST['ppn_program_desc'];
// $duration = $_POST['ppn_program_duration_weeks'];
// $trainer_id = $_POST['ppn_program_trainer'];

// $sql = "INSERT INTO fitness_programs (program_name, goal, description, duration_weeks, trainer_id)
//         VALUES (?, ?, ?, ?, ?)";

// $stmt = $conn->prepare($sql);
// $stmt->bind_param("sssii", $program_name, $goal, $description, $duration, $trainer_id);

// if ($stmt->execute()) {
//     echo "<script>
//         alert('Program added successfully.');
//         window.location.href = 'your_form_page.php'; // redirect to form or list page
//     </script>";
// } else {
//     echo "<script>
//         alert('Error: " . addslashes($stmt->error) . "');
//         window.history.back(); // go back to the form
//     </script>";
// }

?>




