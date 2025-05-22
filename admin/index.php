<?php
    session_start();

    include __DIR__ . "/../config/db_connect.php"; 

    $a_user_id = $_SESSION['l_user_id'];

    if($_SESSION['l_user_type'] != 'A'){
        header("location:index.php");
        exit;
    }

    if(isset($_GET['logout'])){
        session_destroy();
        header("location: ../login.php");
        die();
    }
    
    if (!isset($_GET['page'])) {
        header("location: index.php?page=memberSubscriptions");
        exit;
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitLife - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style/admin.css">
    <link rel="stylesheet" href="../css/bootstrap.css"> 
</head>
<body>

    <!--========================= Sidebar Navigation ============================== -->
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-dumbbell"></i><h1>FitLife</h1>
            </div>
            <nav class="main-nav">
                <div class="nav-section">
                    <h3>Administrator</h3>
                    <ul>

                        <li class="<?= $currentPage === 'memberSubscriptions' ? 'active' : '' ?>">
                            <a href="?page=memberSubscriptions"><i class="fas fa-users"></i> Member Subscriptions</a>
                        </li>
                        <li class="<?= $currentPage === 'fitness_trainers' ? 'active' : '' ?>">
                            <a href="?page=fitness_trainers"><i class="fas fa-running"></i>Fitness Trainers</a>
                        </li>
                        <!-- <li class="   ">
                            <a href="?page=payments"><i class="fas fa-credit-card"></i> Payments & Billing</a>
                        </li> -->
                        <li class="<?= $currentPage === 'subsplan' ? 'active' : '' ?>">
                            <a href="?page=subsplan"><i class="fas fa-dumbbell"></i> Subscription Plans</a>
                        </li>
                        <li class="<?= $currentPage === 'program_plans' ? 'active' : '' ?>">
                            <a href="?page=program_plans"><i class="fas fa-calendar"></i>Program Plans</a>
                        </li>
                        <li>
                            <a href="?logout=true"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>

                    </ul>
                </div>
            </nav>
        </aside>



                <!--========================= Page starts here ============================== -->


    <?php if(isset($_GET['page'])){ 


//=========================================== page - memberSubscriptions ============================================  

        if($_GET['page'] == 'memberSubscriptions'){ ?>

        
        <script src="js/memberSubscriptions.js"></script>


            <!-- Main Content -->
            <main class="main-content">
                <header class="content-header">
                    <h2>Member Subscriptions</h2>
                    <div class="user-actions">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchInput" placeholder="Search members...">
                            <ul id="suggestionList" class="suggestion-list"></ul>
                        </div>
                        <button class="btn primary" onclick="window.location.href='add_member.php'">
                            <i class="fas fa-plus"></i> Add Member
                        </button>
                    </div>
                </header>

                <!-- Filter Tabs -->
                <div class="status-tabs">
                    <button class="tab active" data-status="active">Active</button>
                    <button class="tab" data-status="expired">Expired</button>
                    <button class="tab" data-status="pending">Pending</button>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <!-- <th>Date</th>
                            <th>Member</th>
                            <th>Plan</th>
                            <th>Status</th>
                            <th>Next Payment</th>
                            <th>Actions</th> -->

                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Plan</th>
                            <th>Type</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="subscriptionsTableBody">
                        <!-- Rows loaded via JS -->
                    </tbody>
                </table>

                <?php
                $totalQuery = "SELECT COUNT(*) AS total FROM subscriptions";
                $totalResult = $conn->query($totalQuery);
                $totalRow = $totalResult->fetch_assoc();
                $totalSubscriptions = $totalRow['total'] ?? 0;

                $shownQuery = "
                    SELECT COUNT(*) AS shown 
                    FROM subscriptions s
                    WHERE s.subs_status IN ('active', 'pending')
                    AND s.subs_end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
                ";
                $shownResult = $conn->query($shownQuery);
                $shownRow = $shownResult->fetch_assoc();
                $shownSubscriptions = $shownRow['shown'] ?? 0;

                ?>
                            
                <div class="table-footer" style="margin-bottom: 25px">                             
                        <div class="showing-text">
                            Showing <?php echo $shownSubscriptions; ?> out of <?php echo $totalSubscriptions; ?> subscriptions
                        </div>
                    <div class="pagination">
                        <button class="btn-icon"><i class="fas fa-chevron-left"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="btn-icon"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div> 

            <!-- Upcoming Renewals Section  -->
             <div class="card">
                <div class="card-header">
                    <h3><i class="far fa-calendar-alt"></i> Upcoming Renewals</h3>
                    <button class="btn secondary small">View Calendar</button>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th>Renewal Date</th>
                                <th>Time Remaining</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody>
<?php
// Query upcoming renewals for subscriptions that are active or pending, expiring within 30 days
                $query = "
                    SELECT u.fullname, u.email, sp.plan_name, s.subs_status, s.subs_end_date
                    FROM subscriptions s
                    JOIN users u ON s.user_id = u.user_id
                    JOIN subscription_plans sp ON s.plan_id = sp.plan_id
                    WHERE s.subs_status IN ('active', 'pending')
                    AND s.subs_end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
                    ORDER BY s.subs_end_date ASC
                    LIMIT 20
                ";

                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $today = new DateTime();
                        $endDate = new DateTime($row['subs_end_date']);
                        $interval = $today->diff($endDate);
                        $daysRemaining = (int)$interval->format('%r%a');

                        // Status badge classes
                        $status = strtolower($row['subs_status']);
                        $badgeClass = 'status-badge ';
                        if ($status === 'active') {
                            $badgeClass .= 'active';
                        } elseif ($status === 'pending') {
                            $badgeClass .= 'pending';
                        } elseif ($status === 'expired') {
                            $badgeClass .= 'expired';
                        } else {
                            $badgeClass .= 'unknown';
                        }

                        // Time remaining classes
                        $timeClass = 'time-remaining ';
                        if ($daysRemaining <= 5 && $daysRemaining >= 0) {
                            $timeClass .= 'warning';
                        } elseif ($daysRemaining < 0) {
                            $timeClass .= 'expired';
                        } else {
                            $timeClass .= 'normal';
                        }

                        // Get initials for avatar (max 2 letters)
                        $names = explode(' ', $row['fullname']);
                        $initials = '';
                        foreach ($names as $n) {
                            $initials .= strtoupper($n[0]);
                        }
                        $initials = substr($initials, 0, 2);

                        echo '<tr>';
                        echo '<td>
                                <div class="member-info">
                                    <div class="avatar">' . htmlspecialchars($initials) . '</div>
                                    <div>
                                        <div class="name">' . htmlspecialchars($row['fullname']) . '</div>
                                        <div class="email">' . htmlspecialchars($row['email']) . '</div>
                                    </div>
                                </div>
                            </td>';
                        echo '<td>' . htmlspecialchars($row['plan_name']) . '</td>';
                        echo '<td><span class="' . $badgeClass . '">' . ucfirst($status) . '</span></td>';
                        echo '<td>' . date('M j, Y', strtotime($row['subs_end_date'])) . '</td>';
                        echo '<td><span class="' . $timeClass . '">' . ($daysRemaining >= 0 ? $daysRemaining . ' days' : 'Expired') . '</span></td>';
                        echo '<td>
                                <button class="btn-icon" title="More options"><i class="fas fa-ellipsis-v"></i></button>
                            </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6" style="text-align:center;">No upcoming renewals found.</td></tr>';
                }
                ?>
                </tbody>
                </main>

                    <!-- Quick Add Section -->
                    <!-- <div class="card quick-add">
                        <h3><i class="fas fa-user-plus"></i> Add New Membership</h3>
                        <div class="add-options">
                            <button class="option-card">
                                <i class="fas fa-user"></i>
                                <span>Individual</span>
                            </button>
                            <button class="option-card">
                                <i class="fas fa-users"></i>
                                <span>Family Plan</span>
                            </button>
                            <button class="option-card">
                                <i class="fas fa-briefcase"></i>
                                <span>Corporate</span>
                            </button>
                        </div>
                    </div>
                </main>
            </div>
        </body>
        </html> -->

        <?php 
            } //end of memberships page 


//=========================================== page - Fitness Trainers ==================================================  


    if($_GET['page'] == 'fitness_trainers'){ ?>


        <div class="form-container">     
                <?php
                /*Deactivate Fitness Team*/
                        if(isset($_GET['deactivate_fm'])){
                            $trainer_id =$_GET['deactivate_fm'];

                            $sql_deactivate_fm = "UPDATE `fitness_trainers`
                                                            SET `trainer_status`='I'
                                                    WHERE `trainer_id`='$trainer_id';";

                            mysqli_query($conn, $sql_deactivate_fm);
                        }

                /*Activate Fitness Team*/        
                        if(isset($_GET['activate_fm'])){
                            $trainer_id = $_GET['activate_fm'];

                            $sql_activate_fm= "UPDATE `fitness_trainers`
                                                    SET `trainer_status`='A'
                                                WHERE `trainer_id`='$trainer_id';";

                            mysqli_query($conn,$sql_activate_fm);
                        }
                // Delete Fitness Team
                        if(isset($_GET['delete_fm'])){
                            $trainer_id = $_GET['delete_fm'];

                            $sql_delete_fm = "DELETE FROM `fitness_trainers` 
                                                        WHERE `trainer_id`='$trainer_id';";
                            mysqli_query($conn, $sql_delete_fm);
                        }  
                /*Update Fitness Team*/
                        if(isset($_GET['update_fm'])){
                            $trainer_id = $_GET['update_fm'];
                            
                            $sql_get_fm = "SELECT * FROM `fitness_trainers`
                                                        WHERE `trainer_id`='$trainer_id'";
                            $result = mysqli_query($conn, $sql_get_fm);
                            $data_row = mysqli_fetch_assoc($result);
                        ?>

                                    <!-- ==============Update Fitness Member form ================-->
                                    <form action="update_fitness_trainer.php" method="POST" class="fitness-trainer-form" id="UpdateFitMem-form">
                                        <div class="UpdateFitMem">
                                            <h2>Update Fitness Trainer</h2>
                                            <div id="message-container-fitness" class="message-container-fitness"></div>
                                        </div>

                                        <input type="hidden" name="fmu_trainer_id" value="<?php echo $data_row['trainer_id']; ?>">

                                        <div class="form-group"> 
                                            <label for="fmu_trainer_fullname">Full Name</label>
                                            <input value="<?php echo $data_row['trainer_fullname']; ?>" type="text" name="fmu_trainer_fullname" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fmu_trainer_spzn">Specialization:</label>
                                            <input value="<?php echo $data_row['trainer_specialization']; ?>" type="text" name="fmu_trainer_spzn" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fmu_trainer_spzn">Contact Number:</label>
                                            <input value="<?php echo $data_row['trainer_contact_number']; ?>" 
                                                type="text" 
                                                name="fmu_trainer_contact_no"
                                                maxlength="11" 
                                                pattern="\d{11}" 
                                                title="Please enter exactly 11 digits" 
                                                required 
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"> 
                                        </div>
                                        <button type="submit" class="btn-save">Update Fitness Member</button>
                                    </form>
                            
                    <?php } ?>



                <!--============= Add Fitness Trainer form===============-->
                    <form action="new_fitness_trainer.php" method="POST" class="fitness-trainer-form" id="AddNewFitMem-form">
                        <div class="addNewFitMem"> 
                            <h2>Add New Fitness Member</h2>
                            <div id="message-container-fitness" class="message-container-fitness"></div>
                        </div>
                        <div class="form-group">
                            <label for="fmn_trainer_fullname">Trainer Name:</label>
                            <input type="text" name="fmn_trainer_fullname" id="fmn_trainer_fullname" required>
                        </div>
                        <div class="form-group">
                            <label for="fmn_trainer_spzn">Specialization:</label>
                            <input type="text" name="fmn_trainer_spzn" id="fmn_trainer_spzn" required>
                        </div>
                        <div class="form-group">
                            <label for="fmn_trainer_contact_no">Contact Number:</label>
                            <input type="text" 
                                name="fmn_trainer_contact_no" 
                                id="fmn_trainer_contact_no" 
                                maxlength="11" 
                                pattern="\d{11}" 
                                title="Please enter exactly 11 digits" 
                                required 
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <div class="form-group">
                            <label for="fmn_trainer_prof_img">Trainer Profile Photo</label>
                            <input type="file" name="fmn_trainer_prof_img" id="fmn_trainer_prof_img" required>
                        </div>
                        <button type="submit" class="btn-save">Add New Fitness Member</button>
                    </form>


                
                            <!--====--======Active Fitness Member =====----======-->
                                <div class="subscription-plans">  <!-- check css of this "subscription-plans" --> 
                                    <div class="plan-table">
                                        <h3>Active Fitness Members</h3>
                                        <?php
                                            $sql_get_active_trainer_stat = "SELECT * FROM `fitness_trainers` WHERE `trainer_status`='A' ORDER BY trainer_id ASC";
                                            $get_resultA = mysqli_query($conn, $sql_get_active_trainer_stat);
                                        ?>
                                        <table class="table">
                                            <!-- Table Header with Column Titles -->
                                            <thead>
                                                <tr>
                                                    <th>Profile Image</th>
                                                    <th>Full Name</th>
                                                    <th>Specialization</th>
                                                    <th>Contact Number</th>   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($get_resultA)) { ?>
                                                    <tr>
                                                        <td><img src="../img/<?php echo $row['trainer_profile_image'];?>" alt="" class="img-fluid" width="50px"> </td>
                                                        <td><?php echo $row['trainer_fullname']; ?></td>
                                                        <td><?php echo $row['trainer_specialization']; ?></td>
                                                        <td><?php echo $row['trainer_contact_number']; ?></td>
                                                        <td>
                                                            <a href="../admin/index.php?page=fitness_trainers&update_fm=<?php echo $row['trainer_id']; ?>" class="btn btn-success">Update</a>
                                                            <a href="../admin/index.php?page=fitness_trainers&deactivate_fm=<?php echo $row['trainer_id']; ?>" class="btn btn-danger">Deactivate</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                            <!--============Inactive Fitness Member============-->
                                    <div class="plan-table">
                                        <h3>Inactive Fitness Members</h3>
                                        <?php
                                            $sql_get_inactive_trainer_stat = "SELECT * FROM `fitness_trainers` WHERE `trainer_status`='I' ORDER BY trainer_id ASC";
                                            $get_resultI = mysqli_query($conn, $sql_get_inactive_trainer_stat);
                                        ?>
                                        <table class="table">
                                            <!-- Table Header with Column Titles -->
                                            <thead>
                                                <tr>
                                                    <th>Profile Image</th>
                                                    <th>Full Name</th>
                                                    <th>Specialization</th>
                                                    <th>Contact Number</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($get_resultI)) { ?>
                                                    <tr>
                                                        <td><img src="../img/<?php echo $row['trainer_profile_image'];?>" alt="" class="img-fluid" width="50px"> </td>
                                                        <td><?php echo $row['trainer_fullname']; ?></td>
                                                        <td><?php echo $row['trainer_specialization']; ?></td>
                                                        <td><?php echo $row['trainer_contact_number']; ?></td>
                                                        <td>
                                                            <a href="../admin/index.php?page=fitness_trainers&update_fm=<?php echo $row['trainer_id']; ?>" class="btn btn-success">Update</a>
                                                            <a href="../admin/index.php?page=fitness_trainers&activate_fm=<?php echo $row['trainer_id']; ?>" class="btn btn-info">Activate</a>
                                                            <a href="../admin/index.php?page=fitness_trainers&delete_fm=<?php echo $row['trainer_id']; ?>" class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end of subscription_plans -->
        </div> <!--end form-container-->



       <?php
       } //end of fitness team page
       
          
       





//=========================================== page - subscription plans ======================================================  


    if($_GET['page'] == 'subsplan'){ ?>


    <div class="form-container" style="padding-left: 28px;">     
                <?php
                /*Deactivate Subscription Plan Status*/
                        if(isset($_GET['deactivate_plan'])){
                            $plan_id =$_GET['deactivate_plan'];

                            $sql_deactivate_plan = "UPDATE `subscription_plans`
                                                            SET `plan_status`='I'
                                                    WHERE `plan_id`='$plan_id';";

                            mysqli_query($conn, $sql_deactivate_plan);
                        }

                /*Activate Subscription Plan Status*/        
                        if(isset($_GET['activate_plan'])){
                        $plan_id = $_GET['activate_plan'];

                        $sql_activate_plan= "UPDATE `subscription_plans`
                                                        SET `plan_status`='A'
                                                    WHERE `plan_id`='$plan_id';";

                            mysqli_query($conn,$sql_activate_plan);
                        }
                // Delete Subscription Plan
                        if(isset($_GET['delete_plan'])){
                            $plan_id = $_GET['delete_plan'];

                            $sql_delete_plan = "DELETE FROM `subscription_plans` 
                                                        WHERE `plan_id`='$plan_id';";
                            mysqli_query($conn, $sql_delete_plan);
                        }  
                /*Update Subscription Plan*/
                        if(isset($_GET['update_plan'])){
                            $plan_id = $_GET['update_plan'];
                            
                            $sql_get_plan_info = "SELECT * FROM `subscription_plans`
                                                        WHERE `plan_id`='$plan_id'";
                            $result = mysqli_query($conn, $sql_get_plan_info);
                            $data_row = mysqli_fetch_assoc($result);
            ?>
                <!--========= Update subscription form ================-->
                        <form action="update_subs_plan.php" method="POST" class="subscription-form" id="UpdateSubsPlan-subscription-form">
                            <div class="UpdateSubsPlan">
                                <h2>Update Subscription Plan</h2>
                                <div id="message-container-subscription" class="message-container-subscription"></div>
                            </div>
                            <input type="hidden" name="u_plan_id" value="<?php echo $data_row['plan_id']; ?>">
                            <div class="form-group"> 
                                <label for="">Subscription Name</label>
                                <input value="<?php echo $data_row['plan_name']; ?>" type="text" name="u_plan_name" required>
                            </div>
                            <div class="form-group">
                                <label for="u_plan_type">Subscription Type:</label>
                                <select name="u_plan_type" id="u_plan_type" required>
                                    <option value="monthly" <?php if($data_row['plan_type'] == 'monthly') echo 'selected'; ?>>Monthly</option>
                                    <option value="yearly" <?php if($data_row['plan_type'] == 'yearly') echo 'selected'; ?>>Yearly</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="u_plan_tier">Tier:</label>
                                <select name="u_plan_tier" id="u_plan_tier" required>
                                    <option value="standard" <?php if($data_row['plan_tier'] == 'standard') echo 'selected'; ?>>Standard</option>
                                    <option value="premium" <?php if($data_row['plan_tier'] == 'premium') echo 'selected'; ?>>Premium</option>
                                </select>
                            </div>
                            <div class="form-group"> 
                                <label for="">Price (₱)</label>
                                <input value="<?php echo $data_row['plan_price']; ?>" type="number" name="u_plan_price" step="0.01" required>
                            </div>
                            <div class="form-group"> 
                                
                            <label for="">Duration (days)</label>
                                <input value="<?php echo $data_row['plan_duration_days']; ?>" type="number" name="u_plan_duration_days" required>
                            </div>
                            <div class="form-group"> 
                                <label for="u_plan_desc">Description</label>
                                <textarea name="u_plan_desc" id="u_plan_desc" rows="4" required><?php echo htmlspecialchars($data_row['plan_desc']); ?></textarea>
                            </div>
                            <button type="submit" class="btn-save">Update Subscription Plan</button>
                        </form>
                    <?php } ?>

                <!--============= Add New Subscription form===============-->
                    <form action="new_subs_plan.php" method="POST" class="subscription-form" id="AddNewSubsPlan-subscription-form">
                        <div class="addNewSubsPlan">
                            <h2>Add New Subscription Plan</h2>
                            <div id="message-container-subscription" class="message-container-subscription"></div>
                        </div>
                        <div class="form-group">
                            <label for="n_plan_name">Subscription Name:</label>
                            <input type="text" name="n_plan_name" id="n_plan_name" required>
                        </div>
                        <div class="form-group">
                            <label for="n_plan_type">Subscription Type:</label>
                            <select name="n_plan_type" id="n_plan_type" required>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="n_plan_tier">Tier:</label>
                            <select name="n_plan_tier" id="n_plan_tier" required>
                                <option value="Standard">Standard</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="n_plan_price">Price (₱):</label>
                            <input type="number" name="n_plan_price" id="n_plan_price" step="0.01" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="n_plan_duration_days">Duration (in days):</label>
                            <input type="number" name="n_plan_duration_days" id="n_plan_duration_days" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="n_plan_desc">Description:</label>
                            <textarea name="n_plan_desc" id="n_plan_desc" rows="4" placeholder="Type here" required></textarea>
                        </div>
                        <button type="submit" class="btn-save">Save Subscription Plan</button>
                    </form>


                    
                    

                            <!--==========Active Subscription Plans===========-->
                                <div class="subscription-plans">
                                    <!-- Active Subscription Plans -->
                                    <div class="plan-table">
                                        <h3>Active Subscription Plans</h3>
                                        <?php
                                            $sql_get_sub_plans = "SELECT * FROM `subscription_plans` WHERE `plan_status`='A' ORDER BY plan_id ASC";
                                            $get_result = mysqli_query($conn, $sql_get_sub_plans);
                                        ?>
                                        <table class="table">
                                            <!-- Table Header with Column Titles -->
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Tier</th>
                                                    <th>Price(₱)</th>
                                                    <th>Days</th>
                                                    <th>Type</th>
                                                    <th>Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($get_result)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['plan_name']; ?></td>
                                                        <td><?php echo $row['plan_tier']; ?></td>
                                                        <td><?php echo "₱" . number_format($row['plan_price'], 2); ?></td>
                                                        <td><?php echo $row['plan_duration_days']; ?></td>
                                                        <td><?php echo $row['plan_type']; ?></td>
                                                        <td><?php echo $row['plan_desc']; ?></td>
                                                        <td>
                                                            <a href="../admin/index.php?page=subsplan&update_plan=<?php echo $row['plan_id']; ?>" class="btn btn-success">Update</a>
                                                            <a href="../admin/index.php?page=subsplan&deactivate_plan=<?php echo $row['plan_id']; ?>" class="btn btn-danger">Deactivate</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!--============Inactive Subscription Plans============-->
                                    <div class="plan-table">
                                        <h3>Inactive Subscription Plans</h3>
                                        <?php
                                            $sql_get_sub_plans2 = "SELECT * FROM `subscription_plans` WHERE `plan_status`='I' ORDER BY plan_id ASC";
                                            $get_result2 = mysqli_query($conn, $sql_get_sub_plans2);
                                        ?>
                                        <table class="table">
                                            <!-- Table Header with Column Titles -->
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Tier</th>
                                                    <th>Price(₱)</th>
                                                    <th>Days</th>
                                                    <th>Type</th>
                                                    <th>Description</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($get_result2)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['plan_name']; ?></td>
                                                        <td><?php echo $row['plan_tier']; ?></td>
                                                        <td><?php echo "₱" . number_format($row['plan_price'], 2); ?></td>
                                                        <td><?php echo $row['plan_duration_days']; ?></td>
                                                        <td><?php echo $row['plan_type']; ?></td>
                                                        <td><?php echo $row['plan_desc']; ?></td>
                                                        <td>
                                                            <a href="../admin/index.php?page=subsplan&update_plan=<?php echo $row['plan_id']; ?>" class="btn btn-success">Update</a>
                                                            <a href="../admin/index.php?page=subsplan&activate_plan=<?php echo $row['plan_id']; ?>" class="btn btn-info">Activate</a>
                                                            <a href="../admin/index.php?page=subsplan&delete_plan=<?php echo $row['plan_id']; ?>" class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!--end subscription-->
        </div> <!--end form-container-->

        <?php 
        } //end of subscriptionPage
        
        
//=========================================== page - program plans ============================================  

        if($_GET['page'] == 'program_plans'){ ?>

       <div class="form-container">     
                <?php
                /*Deactivate Fitness Team*/
                        if(isset($_GET['deactivate_progPlan'])){
                            $program_id =$_GET['deactivate_progPlan'];

                            $sql_deactivate_progPlan = "UPDATE `fitness_programs`
                                                            SET `program_status`='I'
                                                    WHERE `program_id`='$program_id';";

                            mysqli_query($conn, $sql_deactivate_progPlan);
                        }

                /*Activate Fitness Team*/        
                        if(isset($_GET['activate_progPlan'])){
                            $program_id = $_GET['activate_progPlan'];

                            $sql_activate_progPlan= "UPDATE `fitness_programs`
                                                    SET `program_status`='A'
                                                WHERE `program_id`='$program_id';";

                            mysqli_query($conn,$sql_activate_progPlan);
                        }
                // Delete Fitness Team
                        if(isset($_GET['delete_progPlan'])){
                            $program_id = $_GET['delete_progPlan'];

                            $sql_delete_progPlan = "DELETE FROM `fitness_programs` 
                                                        WHERE `program_id`='$program_id';";
                            mysqli_query($conn, $sql_delete_progPlan);
                        }  
                /*Update Fitness Team*/
                        if(isset($_GET['update_progPlan'])){
                            $program_id = $_GET['update_progPlan'];
                            
                            $sql_get_progPlan = "SELECT * FROM `fitness_programs`
                                                        WHERE `program_id`='$program_id'";
                            $result = mysqli_query($conn, $sql_get_progPlan);
                            $data_row = mysqli_fetch_assoc($result);
                        ?>

                                    <!-- ==============Update Program Plan form ================-->
                                    <form action="update_fitness_program.php" method="POST" class="fitness-program-form" id="UpdateFitProgram-form">
                                        <div class="UpdateFitProg">
                                            <h2>Update Fitness Program</h2>
                                            <div id="message-container-fitness_prog" class="message-container-fitness-prog"></div>
                                        </div>

                                        <input type="hidden" name="ppu_program_id" value="<?php echo $data_row['program_id']; ?>">

                                        <div class="form-group"> 
                                            <label for="ppu_program_name">Program Name</label>
                                            <input value="<?php echo htmlspecialchars($data_row['program_name']); ?>" type="text" name="ppu_program_name" id="ppu_program_name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="ppu_program_goal">Goal</label>
                                            <select name="ppu_program_goal" id="ppu_program_goal" required>
                                                <option value="" disabled>Select a Goal</option>
                                                <option value="lose_weight" <?php if ($data_row['program_goal'] === 'lose_weight') echo 'selected'; ?>>Lose Weight</option>
                                                <option value="build_muscle" <?php if ($data_row['program_goal'] === 'build_muscle') echo 'selected'; ?>>Build Muscle</option>
                                                <option value="muscle_toning" <?php if ($data_row['program_goal'] === 'muscle_toning') echo 'selected'; ?>>Muscle Toning</option>
                                                <option value="increase_endurance" <?php if ($data_row['program_goal'] === 'increase_endurance') echo 'selected'; ?>>Increase Endurance</option>
                                                <option value="general_fitness" <?php if ($data_row['program_goal'] === 'general_fitness') echo 'selected'; ?>>General Fitness</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="ppu_program_desc">Program Description</label>
                                            <textarea name="ppu_program_desc" id="ppu_program_desc" rows="4" required><?php echo htmlspecialchars($data_row['program_desc']); ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="ppu_program_duration_weeks">Duration of Program (weeks)</label>
                                            <select name="ppu_program_duration_weeks" id="ppu_program_duration_weeks" required>
                                                <option value="" disabled>Select the duration</option>
                                                <option value="3" <?php if ($data_row['program_duration_weeks'] == 3) echo 'selected'; ?>>3 weeks(1 month)</option>
                                                <option value="52" <?php if ($data_row['program_duration_weeks'] == 52) echo 'selected'; ?>>6 weeks(1 year)</option>
                                            </select>
                                        </div>

                                        <!-- Trainer dropdown populated dynamically -->
                                        <div class="form-group">
                                            <label for="ppu_program_trainer">Trainer</label>
                                            <select name="ppu_program_trainer" id="ppu_program_trainer" required>)
                                                <option value="" disabled>Select a Trainer</option>
                                                <?php
                                                    include '../config/db_connect.php'; // Make sure path is correct
                                                    $sql = "SELECT trainer_id, trainer_fullname, trainer_specialization FROM fitness_trainers";
                                                    $result = mysqli_query($conn, $sql);

                                                    if ($result && mysqli_num_rows($result) > 0) {
                                                        while ($trainer = mysqli_fetch_assoc($result)) {
                                                            $selected = $trainer['trainer_id'] == $data_row['trainer_id'] ? 'selected' : '';
                                                            echo "<option value='{$trainer['trainer_id']}' $selected>" . htmlspecialchars($trainer['trainer_fullname']) . " - " . htmlspecialchars($trainer['trainer_specialization']) . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option disabled>No trainers found</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn-save">Update Fitness Program</button>
                                    </form>
                            
                    <?php } ?>



                <!--============= Add program plans form===============-->
            
                    <form action="new_fitness_program.php" method="POST" enctype="multipart/form-data" class="fitness-program-form" id="AddNewFitProgram-form">
                        <div class="addNewFitProg"> 
                            <h2>New Fitness Program</h2>
                            <div id="message-container-programs" class="message-container-programs"></div>
                        </div>
                        <div class="form-group">
                            <label for="ppn_program_name">Program Name:</label>
                            <input type="text" name="ppn_program_name" id="ppn_program_name" required>
                        </div>
                        <div class="form-group"> 
                            <label for="ppn_program_goal">Goal:</label>
                            <select name="ppn_program_goal" id="ppn_program_goal" required>
                                <option value="" disabled selected>Select a Goal</option>
                                <option value="lose_weight">Lose Weight</option>
                                <option value="build_muscle">Build Muscle</option>
                                <option value="muscle_toning">Muscle Toning</option>
                                <option value="increase_endurance">Increase Endurance</option>
                                <option value="general_fitness">General Fitness</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ppn_program_desc">Description:</label>
                            <textarea name="ppn_program_desc" id="ppn_program_desc" rows="4" placeholder="Type here" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="ppn_program_img">Add Program Main Photo</label>
                            <input type="file" name="ppn_program_img" id="ppn_program_img" required>
                        </div>
                        <div class="form-group">
                            <label for="ppn_program_desc">Program Duration (weeks)</label>
                            <select name="ppn_program_duration_weeks" id="ppn_program_duration_weeks" required>
                                <option value="" disabled selected>Select the duration</option>
                                <option value="3">3 weeks</option>
                                <option value="6">6 weeks</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ppn_program_trainer">Trainer:</label>
                            <select name="ppn_program_trainer" id="ppn_program_trainer">
                                <option value="" disabled selected>Select a Trainer</option>
                                <?php
                                    include '../config/db_connect.php'; // adjust path if needed
                                        $sql = "SELECT trainer_id, trainer_fullname, trainer_specialization 
                                                    FROM fitness_trainers";
                                        $result = mysqli_query($conn, $sql);
        
                                        if ($result && mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['trainer_id']}'>" . htmlspecialchars($row['trainer_fullname']) . " - " . htmlspecialchars($row['trainer_specialization']) . "</option>";
                                            }
                                        } else {
                                            echo "<option disabled>No trainers found</option>";
                                        }
                                ?>
                            </select>
                        </div> 
                        <button type="submit" class="btn-save">Add New Program Plan</button>
                    </form>
                        
                    
                                            
                                <!--==========Active Subscription Plans===========-->
                                <div class="subscription-plans">
                                
                                    <div class="plan-table">
                                        <h3>Active Programs</h3>
                                        <?php
                                            $sql_get_program_plans = "SELECT * FROM `fitness_programs` WHERE `program_status`='A' ORDER BY program_id ASC";
                                            $get_result = mysqli_query($conn, $sql_get_program_plans);
                                        ?>
                                        <table class="table">
                                            <!-- Table Header with Column Titles -->
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Goal</th>
                                                    <th>Description</th>
                                                    <th>Duration</th>
                                                    <th>TrainerID</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($get_result)) { ?>
                                                    <tr>
                                                        <td><img src="../img/<?php echo $row['program_main_img'];?>" alt="" class="img-fluid" width="50px"> </td>
                                                        <td><?php echo $row['program_name']; ?></td>
                                                        <td><?php echo $row['program_goal']; ?></td>
                                                        <td><?php echo $row['program_desc']; ?></td>
                                                        <td><?php echo $row['program_duration_weeks'] . " " . "weeks"; ?></td>
                                                        <td><?php echo $row['trainer_id']; ?></td>
                                                        <td>
                                                            <a href="../admin/index.php?page=program_plans&update_progPlan=<?php echo $row['program_id']; ?>" class="btn btn-success">Update</a>
                                                            <a href="../admin/index.php?page=program_plans&deactivate_progPlan=<?php echo $row['program_id']; ?>" class="btn btn-danger">Deactivate</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!--============Inactive Subscription Plans============-->
                                    <div class="plan-table">
                                        <h3>Inactive Programs</h3>
                                        <?php
                                            $sql_get_sub_plans2 = "SELECT * FROM `fitness_programs` WHERE `program_status`='I' ORDER BY program_id ASC";
                                            $get_result2 = mysqli_query($conn, $sql_get_sub_plans2);
                                        ?>
                                        <table class="table">
                                            <!-- Table Header with Column Titles -->
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Goal</th>
                                                    <th>Description</th>
                                                    <th>Duration</th>
                                                    <th>TrainerID</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($get_result2)) { ?>
                                                    <tr>
                                                        <tr>
                                                        <td><img src="../img/<?php echo $row['program_main_img'];?>" alt="" class="img-fluid" width="50px"> </td>
                                                        <td><?php echo $row['program_name']; ?></td>
                                                        <td><?php echo $row['program_goal']; ?></td>
                                                        <td><?php echo $row['program_desc']; ?></td>
                                                        <td><?php echo $row['program_duration_weeks'] . " " . "weeks"; ?></td>
                                                        <td><?php echo $row['trainer_id']; ?></td>
                                                        <td>
                                                            <a href="../admin/index.php?page=program_plans&update_progPlan=<?php echo $row['program_id']; ?>" class="btn btn-success">Update</a>
                                                            <a href="../admin/index.php?page=program_plans&activate_progPlan=<?php echo $row['program_id']; ?>" class="btn btn-info">Activate</a>
                                                            <a href="../admin/index.php?page=program_plans&delete_progPlan=<?php echo $row['program_id']; ?>" class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!--end subscription-->
        </div> <!--end form-container-->
                                  
        <?php 
            } //end of program_plans
        ?>

    <?php 
        } //end of page
    ?>

    <script src="../js/bootstrap.js"></script>
    <script src="../js/admin_script.js"></script>
    
</body>
</html>