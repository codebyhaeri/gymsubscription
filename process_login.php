<?php

include_once "./config/db_connect.php";
session_start();

    if(isset($_POST['l_username_or_l_email'])){
        $usrnm_or_email = $_POST['l_username_or_l_email'];
        $psswrd = $_POST['l_password'];

        $sql_check_userstable = "SELECT *
                                    FROM `users`
                                        WHERE (`username` = '$usrnm_or_email' 
                                            OR `email` = '$usrnm_or_email') 
                                        AND `password` = '$psswrd'";
        $sql_result = mysqli_query($conn,$sql_check_userstable);
        $count_result = mysqli_num_rows($sql_result);

        if($count_result == 1){
            //existing user
            $row = mysqli_fetch_assoc($sql_result);
            
             // Set session variables from user table
                $_SESSION['l_user_id'] = $row['user_id'];
                $_SESSION['l_fullname'] = $row['fullname'];
                $_SESSION['l_username'] = $row['username'];
                $_SESSION['l_email'] = $row['email'];
                $_SESSION['l_contact_number'] = $row['contact_number'];
                $_SESSION['l_user_type'] = $row['user_type'];
                $_SESSION['l_password'] = $row['password'];
                $_SESSION['l_gender'] = $row['gender'];
                $_SESSION['l_address'] = $row['address'];
    
                // session variables user_profile table
                $_SESSION['ep_profile_id'] = $row['profile_id'];
                $_SESSION['ep_user_id'] = $row['user_id'];
                $_SESSION['ep_age'] = $row['age'];
                $_SESSION['ep_height_cm'] = $row['height_cm'];
                $_SESSION['ep_weight_kg'] = $row['weight_kg'];
                $_SESSION['ep_fitness_goal'] = $row['fitness_goal'];
                $_SESSION['ep_activity_level'] = $row['activity_level'];
                $_SESSION['ep_medical_conditions'] = $row['medical_conditions'];
        
            if($row['user_type'] == 'A'){
                header("location: admin");
                exit();
            }
            else if($row['user_type'] == 'C'){
                header("location: common_user");
                exit();
            }
            else{
                header("location: index.php?error=user_not_found");
                exit();
            }
        }
        else{
        header("location: login.php?error=Invalid username/email or password. Please try again.");
        exit();
        }
    }
    




// if (isset($_POST['l_username_or_l_email']) && isset($_POST['l_password'])) {
//     $usrnm_or_email = mysqli_real_escape_string($conn, $_POST['l_username_or_l_email']);
//     $psswrd = $_POST['l_password'];

//     // Prepare SQL to prevent SQL injection
//     $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
//     $stmt->bind_param("ss", $usrnm_or_email, $usrnm_or_email);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result && $result->num_rows === 1) {
//         $row = $result->fetch_assoc();

//         // Verify the password using password_verify
//         if (password_verify($psswrd, $row['password'])) {

//             // Set session variables from user table
//             $_SESSION['l_user_id'] = $row['user_id'];
//             $_SESSION['l_fullname'] = $row['fullname'];
//             $_SESSION['l_username'] = $row['username'];
//             $_SESSION['l_email'] = $row['email'];
//             $_SESSION['l_contact_number'] = $row['contact_number'];
//             $_SESSION['l_user_type'] = $row['user_type'];
//             $_SESSION['l_password'] = $row['password'];
//             $_SESSION['l_gender'] = $row['gender'];
//             $_SESSION['l_address'] = $row['address'];
 
//             // session variables user_profile table
//             $_SESSION['ep_profile_id'] = $row['profile_id'];
//             $_SESSION['ep_user_id'] = $row['user_id'];
//             $_SESSION['ep_age'] = $row['age'];
//             $_SESSION['ep_height_cm'] = $row['height_cm'];
//             $_SESSION['ep_weight_kg'] = $row['weight_kg'];
//             $_SESSION['ep_fitness_goal'] = $row['fitness_goal'];
//             $_SESSION['ep_activity_level'] = $row['activity_level'];
//             $_SESSION['ep_medical_conditions'] = $row['medical_conditions'];    

//             // Redirect based on user type
//             if ($row['user_type'] === 'A') {
//                 header("Location: admin");
//             } elseif ($row['user_type'] === 'C') {
//                 header("Location: common_user");
//             } else {
//                 header("Location: index.php?error=Invalid user role");
//             }
//             exit();
//         } else {
//             header("Location: login.php?error=Incorrect password");
//             exit();
//         }
//     } else {
//         header("Location: login.php?error=User not found");
//         exit();
//     }
// } else {
//     header("Location: login.php?error=Missing credentials");
//     exit();
// }
?>


