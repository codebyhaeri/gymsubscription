<?php

session_start();
include_once "../config/db_connect.php";

if (!isset($_SESSION['l_user_id'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Unauthorized access."]);
    exit;
}

$ep_user_id = intval($_POST['user_id']); // convert to integer

$ep_age = mysqli_real_escape_string($conn, $_POST['age']);
$ep_height_cm = mysqli_real_escape_string($conn, $_POST['height_cm']);
$ep_weight_kg = mysqli_real_escape_string($conn, $_POST['weight_kg']);
$ep_fitness_goal = mysqli_real_escape_string($conn, $_POST['fitness_goal']);
$ep_activity_level = mysqli_real_escape_string($conn, $_POST['activity_level']);
$ep_medical_conditions = mysqli_real_escape_string($conn, $_POST['medical_conditions']);

$check = mysqli_query($conn, "SELECT profile_id FROM user_profiles WHERE user_id = $ep_user_id");

if (mysqli_num_rows($check) > 0) {
    $update = "UPDATE user_profiles SET 
                age = '$ep_age',
                height_cm = '$ep_height_cm',
                weight_kg = '$ep_weight_kg',
                fitness_goal = '$ep_fitness_goal',
                activity_level = '$ep_activity_level',
                medical_conditions = '$ep_medical_conditions'
               WHERE user_id = $ep_user_id";
} else {
    $update = "INSERT INTO user_profiles 
                (user_id, age, height_cm, weight_kg, fitness_goal, activity_level, medical_conditions) 
               VALUES 
                ($ep_user_id, '$ep_age', '$ep_height_cm', '$ep_weight_kg', '$ep_fitness_goal', '$ep_activity_level', '$ep_medical_conditions')";
}

if (mysqli_query($conn, $update)) {
    echo json_encode(["status" => "success", "message" => "Profile updated successfully."]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database error: " . mysqli_error($conn)]);
}




// session_start();
// include_once "../config/db_connect.php";

// // Validate session
// if (!isset($_SESSION['l_user_id'])) {
//     http_response_code(401);
//     echo json_encode(["status" => "error", "message" => Unauthorized access."]);
//     exit;
// }

// // Collect and sanitize POST data
// $ep_user_id = $_POST['user_id'];
// $ep_age = mysqli_real_escape_string($conn, $_POST['age']);
// $ep_height_cm = mysqli_real_escape_string($conn, $_POST['height_cm']);
// $ep_weight_kg = mysqli_real_escape_string($conn, $_POST['weight_kg']);
// $ep_fitness_goal = mysqli_real_escape_string($conn, $_POST['fitness_goal']);
// $ep_activity_level = mysqli_real_escape_string($conn, $_POST['activity_level']);
// $ep_medical_conditions = mysqli_real_escape_string($conn, $_POST['medical_conditions']);

// // Check if user profile exists
// $check = mysqli_query($conn, "SELECT profile_id FROM user_profiles WHERE user_id = $ep_user_id");

// if (mysqli_num_rows($check) > 0) {
//     // Update existing profile
//     $update = "UPDATE user_profiles SET 
//                 age = '$ep_age',
//                 height_cm = '$ep_height_cm',
//                 weight_kg = '$ep_weight_kg',
//                 fitness_goal = '$ep_fitness_goal',
//                 activity_level = '$ep_activity_level',
//                 medical_conditions = '$ep_medical_conditions'
//                WHERE user_id = $ep_user_id";
// } else {
//     // Insert new profile
//     $update = "INSERT INTO user_profiles 
//                 (user_id, age, height_cm, weight_kg, fitness_goal, activity_level, medical_conditions) 
//                VALUES 
//                 ($ep_user_id, '$ep_age', '$ep_height_cm', '$ep_weight_kg', '$ep_fitness_goal', '$ep_activity_level', '$ep_medical_conditions')";
// }

// if (mysqli_query($conn, $update)) {
//     echo json_encode(["status" => "success", "message" => "Profile updated successfully."]);
// } else {
//     http_response_code(500);
//     echo json_encode(["status" => "error", "message" => "Database error: " . mysqli_error($conn)]);
// }
?>
