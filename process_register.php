<?php
session_start();
include_once "./config/db_connect.php";

// Helper to send error and exit
function abort($msg) {
    header("Location: register.php?error=" . urlencode($msg));
    exit;
}

// 1) Collect & validate POST
$fullname       = trim($_POST['s_fullname'] ?? '');
$username       = trim($_POST['s_username'] ?? '');
$password       = $_POST['s_password']   ?? '';
$conf_password  = $_POST['s_conf_password'] ?? '';
$contact        = trim($_POST['s_contact_number'] ?? '');
$address        = trim($_POST['s_address'] ?? '');
$gender         = $_POST['s_gender']     ?? '';
$email          = trim($_POST['s_email'] ?? '');

// Fitness profile
$age            = intval($_POST['s_age'] ?? 0);
$height         = floatval($_POST['s_height'] ?? 0);
$weight         = floatval($_POST['s_weight'] ?? 0);
$goal           = $_POST['s_goal'] ?? '';
$conditions     = trim($_POST['s_conditions'] ?? '');
$time_pref      = $_POST['s_time_pref'] ?? '';
$activity_level = $_POST['s_activity_level'] ?? '';

// Basic validation
if (!$fullname || !$username || !$email || !$password) {
    abort("Please fill in all required fields.");
}
if ($password !== $conf_password) {
    abort("Passwords do not match.");
}

// 2) Check email uniqueness
$stmt = $conn->prepare("SELECT 1 FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    abort("That email is already registered.");
}

// 3) Check username uniqueness
$stmt = $conn->prepare("SELECT 1 FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    abort("Username already exists.");
}

// 4) Insert into `users` WITHOUT hashing
$stmt = $conn->prepare("
    INSERT INTO users
      (fullname, username, password, contact_number, address, gender, email)
    VALUES (?,?,?,?,?,?,?)
");
$stmt->bind_param(
    "sssssss",
    $fullname,
    $username,
    $password,     // store raw password
    $contact,
    $address,
    $gender,
    $email
);
if (!$stmt->execute()) {
    abort("Failed to create user: " . $stmt->error);
}
$new_user_id = $conn->insert_id;

// 5) Insert into `user_profiles` (omit time_preference if column not present)
$stmt = $conn->prepare("
    INSERT INTO user_profiles
      (user_id, age, height_cm, weight_kg, fitness_goal, activity_level, medical_conditions)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param(
    "iddssss",
    $new_user_id,
    $age,            // i
    $height,         // d
    $weight,         // d
    $goal,           // s
    $activity_level, // s
    $conditions      // s
);
if (!$stmt->execute()) {
    // rollback user insert
    $conn->query("DELETE FROM users WHERE user_id = $new_user_id");
    abort("Profile insert failed: " . $stmt->error);
}

// 6) Success!
header("Location: login.php?msg=" . urlencode("Successfully registered — please log in."));
exit;
