<?php
include '../config/db_connect.php';
header('Content-Type: application/json');

function respond(bool $ok, string $msg) {
    echo json_encode(['success' => $ok, 'message' => $msg]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request method.');
}

// 1) Validate required text fields
$required = [
    'ppu_program_id',
    'ppu_program_name',
    'ppu_program_goal',
    'ppu_program_desc',
    'ppu_program_duration_weeks',
    'ppu_program_trainer'
];
foreach ($required as $f) {
    if (empty($_POST[$f])) {
        respond(false, "Missing required field: $f");
    }
}

// 2) Sanitize inputs
$id       = (int) $_POST['ppu_program_id'];
$name     = mysqli_real_escape_string($conn, $_POST['ppu_program_name']);
$goal     = mysqli_real_escape_string($conn, $_POST['ppu_program_goal']);
$desc     = mysqli_real_escape_string($conn, $_POST['ppu_program_desc']);
$weeks    = (int) $_POST['ppu_program_duration_weeks'];
$trainer  = (int) $_POST['ppu_program_trainer'];

// 3) Build the UPDATE query dynamically
$params   = [$name, $goal, $desc, $weeks, $trainer];
$types    = 'sssii';
$sql      = "UPDATE fitness_programs
             SET program_name = ?, program_goal = ?, program_desc = ?, program_duration_weeks = ?, trainer_id = ?";

// 4) If a new image was uploaded, process it and include in the query
if (isset($_FILES['ppu_program_img']) && $_FILES['ppu_program_img']['error'] === UPLOAD_ERR_OK) {
    $targetDir  = __DIR__ . "/../img/";
    $filename   = basename($_FILES['ppu_program_img']['name']);
    $targetFile = $targetDir . $filename;
    $ext        = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (! in_array($ext, ['jpg','jpeg','png','gif'], true)) {
        respond(false, 'Only JPG, JPEG, PNG & GIF allowed.');
    }
    if (! move_uploaded_file($_FILES['ppu_program_img']['tmp_name'], $targetFile)) {
        respond(false, 'Failed to save image.');
    }

    // add image column to update
    $sql    .= ", program_main_img = ?";
    $types  .= 's';
    $params[] = $filename;
}

// 5) Complete the query
$sql .= " WHERE program_id = ?";
$types .= 'i';
$params[] = $id;

// 6) Prepare, bind, execute
$stmt = $conn->prepare($sql);
// bind_param requires individual variables
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    respond(true, 'Program updated successfully.');
} else {
    respond(false, 'Database error: ' . $stmt->error);
}

?>