<?php
header('Content-Type: application/json');
include __DIR__ . "/../config/db_connect.php";

if (isset($_POST['ppn_program_name'])) {
    $uploadOk = 1;
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["ppn_program_img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image
    $check = getimagesize($_FILES["ppn_program_img"]["tmp_name"]);
    if ($check === false) {
        echo json_encode(['success' => false, 'message' => 'File is not an image.']);
        exit;
    }

    // Validate file type
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo json_encode(['success' => false, 'message' => 'Only JPG, JPEG, PNG, and GIF files are allowed.']);
        exit;
    }

    // Move file
    if (!move_uploaded_file($_FILES["ppn_program_img"]["tmp_name"], $target_file)) {
        echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
        exit;
    }

    // Prepare data
    $db_filename = basename($_FILES["ppn_program_img"]["name"]);
    $program_name = $_POST['ppn_program_name'];
    $goal = $_POST['ppn_program_goal'];
    $description = $_POST['ppn_program_desc'];
    $duration = intval($_POST['ppn_program_duration_weeks']);
    $trainer_id = intval($_POST['ppn_program_trainer']);

    $sql = "INSERT INTO `fitness_programs`
            (`program_name`, `goal`, `description`, `duration_weeks`, `trainer_id`, `program_img`)
            VALUES
            ('$program_name', '$goal', '$description', $duration, $trainer_id, '$db_filename')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Missing required data.']);
}
?>












    // header('Content-Type: application/json');  // Tell the browser this is a JSON response

    // include __DIR__ . "/../config/db_connect.php";

    
    // if (isset($_POST['fmn_trainer_fulname'])) { //trap

    //         $uploadOk = 1;
    //         $target_dir = "../img";
            
    //         $target_file = $target_dir . basename($_FILES["fmn_trainer_prof_img"]["name"]);
    //         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
    //         $check_img = getimagesize($_FILES["fmn_trainer_prof_img"]["tmp_name"]);
            
    //         if($check !== false) {
    //                 echo "File is an image - " . $check["mime"] . ".";
    //                 $uploadOk = 1;
    //         } else {
    //                 echo "File is not an image.";
    //                 $uploadOk = 0;
    //         }
            
    //     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    //         && $imageFileType != "gif" ) {
    //         echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //         $uploadOk = 0;
    //     }
        
    //         // Check if $uploadOk is set to 0 by an error
    //     if ($uploadOk == 0) {
    //     // echo "Sorry, your file was not uploaded.";
    //     header("location: index.php?insert_status=99");
    //     // if everything is ok, try to upload file
    //     } 
    //     else {
    //     if (move_uploaded_file($_FILES["fmn_trainer_prof_img"]["tmp_name"], $target_file)) {
    //         echo "The file ". htmlspecialchars( basename( $_FILES["fmn_trainer_prof_img"]["name"])). " has been uploaded.";
    //     } 
    //     else {
    //         //echo "Sorry, there was an error uploading your file.";
    //         header("location: index.php?insert_status=99");
    //     }
    //     }
    //     //end of image function

    //     $db_filename = basename($_FILES["fmn_trainer_pdt_img"]["name"]);
    //     $fmn_trainer_fullname = $_POST['fmn_trainer_fullname']; 
    //     $fmn_trainer_speacilization = $_POST['fmn_trainer_speacilization'];
    //     $fmn_trainer_contact_no = $_POST['fmn_trainer_contact_no'];


    //     $sql_insert_fitness_trainer = "INSERT INTO `fitness_trainers`
    //         (`trainer_fullname`,`trainer_specialization`, `trainer_contact_number`, `trainer_profile_image`)
    //         VALUES
    //         ('$fmn_trainer_fullname','$fmn_trainer_speacilization','$fmn_trainer_contact_no','$db_filename')";

    //     $execute_query = mysqli_query($conn, $sql_insert_fitness_trainer);

    //     if ($execute_query) { 
    //         echo json_encode(['success' => true]);
    //         exit;
    //     } else {
    //         echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    //         exit;
    //     }
    // } else {
    //     echo json_encode(['success' => false, 'error' => 'Missing required data']);
    //     exit;
    // }
    
?>


