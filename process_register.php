<?php

include_once "./config/db_connect.php";

    // Basic user info
    $fullname = $_POST['s_fullname'];
    $usrnm = $_POST['s_username']; 
    $psswrd = $_POST['s_password']; 
    $conf_psswrd = $_POST['s_conf_password']; 
    $contact = $_POST['s_contact_number']; 
    $address = $_POST['s_address']; 
    $gender = $_POST['s_gender'];
    $email = $_POST['s_email'];

    // Extended user fitness profile info
    $age = $_POST['s_age'];
    $height = $_POST['s_height'];
    $weight = $_POST['s_weight'];
    $fitness_level = $_POST['s_fitness_level'];
    $goal = $_POST['s_goal'];
    $conditions = $_POST['s_conditions'];
    $time_pref = $_POST['s_time_pref'];
    $activity_level = $_POST['s_activity_level'];

    // Password match check
    function chk_pass($p1, $p2) {
        return ($p1 == $p2) ? 1 : 0;
    }
    if(!chk_pass($psswrd, $conf_psswrd)){
        header("location: register.php?error=Password mismatch");
        die;
    }

    // Email uniqueness
    $verify_query = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    if(mysqli_num_rows($verify_query) != 0) {
        header("location: register.php?error=Email already registered");
        die;
    }

    // Username uniqueness
    $sql_chk_user = "SELECT user_id FROM users WHERE `username` = '$usrnm'";
    $sql_result = mysqli_query($conn, $sql_chk_user);
    if(mysqli_num_rows($sql_result) > 0){
        header("location: register.php?error=Username already exists");
        die;
    }

    // Insert into users table
    $sql_new_user = "INSERT INTO `users`
    (`fullname`, `username`, `password`, `contact_number`, `address`, `gender`, `email`)
    VALUES
    ('$fullname','$usrnm','$psswrd','$contact','$address','$gender', '$email')";
    $execute_query = mysqli_query($conn, $sql_new_user);

    if(!$execute_query){
        header("location: register.php?error=Insert Failed");
        die;
    }

    // Get user_id of the newly created user
    $new_user_id = mysqli_insert_id($conn);

    // Insert into user_profiles
    $sql_profile = "INSERT INTO `user_profiles`
    (`user_id`, `age`, `height_cm`, `weight_kg`, `fitness_goal`, `activity_level`, `medical_conditions`)
    VALUES
    ($new_user_id, $age, $height, $weight, '$goal', '$activity_level', '$conditions')";

    $profile_result = mysqli_query($conn, $sql_profile);

    if (!$profile_result) {
        header("location: register.php?error=Profile insert failed");
    } else {
        header("location: login.php?msg=Successfully registered");
    }

?>
