<?php
include '../layout/navbar.php';
if(isset($_GET['claim'])){
    // Claims the application by setting progress to 1 (Claimed) and adding their account ID to the application.
    $id = $_GET['claim'];
    $staffid = $_SESSION['id'];
    $sql = "UPDATE applications SET staff_id=$staffid, progress='1' WHERE uuid=$id";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Application claimed.";
    } else {
    echo "Error:" . $conn->error;
    }
}
if(isset($_GET['offer'])){
    // When an interview is complete, the staff member can check offer given and it will sent application to progress 3 (Offer Given).
    $id = $_GET['id'];
    $sql = "UPDATE applications SET progress='3' WHERE uuid=$id";
    if ($conn->query($sql) === TRUE) {
        
    } else {
    echo "Error:" . $conn->error;
    }

    // Grabs application information for selected application.
    $stmt = $link->prepare('SELECT * FROM applications WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($uuid, $profile_id, $course_id, $title, $nin,$sex, $dob, $mobile, $one_address, $postcode, $town, $national, $ethnicity, 
    $uk_eu_resident, $criminal_con, $learning_diff, $children_home, $wellbeing, $interview_assist, $staff_id, $progress);
    $stmt->fetch();
    $stmt->close();

    $sql = "UPDATE users SET progress='3' WHERE uuid=$profile_id";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Offer has been given.";
    } else {
    echo "Error:" . $conn->error;
    }

}

if(isset($_POST['interviewDate'])){
    // Grabs interview date and adds it to the interviews table and changes application progress to 2 (Interview scheduled).
    if(isset($_GET['claim'])){
        $id = $_GET['claim'];
    }else{
        $id = $_GET['id'];
    }
    $stmt = $link->prepare('SELECT * FROM applications WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($uuid, $profile_id, $course_id, $title, $nin,$sex, $dob, $mobile, $one_address, $postcode, $town, $national, $ethnicity, 
    $uk_eu_resident, $criminal_con, $learning_diff, $children_home, $wellbeing, $interview_assist, $staff_id, $progress);
    $stmt->fetch();
    $stmt->close();

    $staff_id = $_SESSION['id'];
    $date_1 = $_POST['interviewDate'];
    
    $sql = "INSERT INTO interviews (profile_id, staff_id, date_1) VALUES ('$profile_id', '$staff_id', '$date_1')";

    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE applications SET progress='2' WHERE uuid=$id";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Inteview date added.";
        } else {
        echo "Error:" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn = NULL;
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $sql2 = "UPDATE users SET progress='2' WHERE uuid=$profile_id";
    if ($conn->query($sql2) === TRUE) {
    }else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}


if(isset($_GET['id']) || isset($_GET['claim'])){
    if(isset($_GET['claim'])){
        $id = $_GET['claim'];
    }else{
        $id = $_GET['id'];
    }
    // Grabs selected application information.
    $stmt = $link->prepare('SELECT * FROM applications WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($uuid, $profile_id, $course_id, $title, $nin,$sex, $dob, $mobile, $one_address, $postcode, $town, $national, $ethnicity, 
    $uk_eu_resident, $criminal_con, $learning_diff, $children_home, $wellbeing, $interview_assist, $staff_id, $progress);
    $stmt->fetch();
    $stmt->close();

    // Grabs course name.
    $stmt = $link->prepare('SELECT name FROM courses WHERE uuid = ?');
    $stmt->bind_param('i', $course_id);
    $stmt->execute();
    $stmt->bind_result($course_name);
    $stmt->fetch();
    $stmt->close();

    // Grabs User's profile details.
    $stmt = $link->prepare('SELECT firstName, lastName, email FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $profile_id);
    $stmt->execute();
    $stmt->bind_result($user_firstName, $user_lastName, $user_email);
    $stmt->fetch();
    $stmt->close();

    // Grabs all user's qualifications.
    $connection = $link; 
    $sql3 = "SELECT * from qualifications";
    $result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
    $emparray3 = array();
    while($row3 =mysqli_fetch_assoc($result3))
    {
        $emparray3[] = $row3;
    }
    $apidata3 = json_encode($emparray3);
    $data3 = json_decode($apidata3);

    // Grabs all user's evidences.
    $connection = $link; 
    $sql2 = "SELECT * from evidences where profile_id = '$profile_id'";
    $result2 = mysqli_query($connection, $sql2) or die("Error in Selecting " . mysqli_error($connection));
    $emparray2 = array();
    while($row2 =mysqli_fetch_assoc($result2))
    {
        $emparray2[] = $row2;
    }
    $apidata2 = json_encode($emparray2);
    $data2 = json_decode($apidata2);
}
?>
<div class="content">
<?php if($APPLICANT_READ == 1){ ?>
    <?php if(isset($success_message) || isset($danger_message)){ ?>
    <div class="m-2">
        <?php if(isset($success_message)){ ?>
        <div class="alert alert-success" role="alert">
            <?= $success_message; ?>
        </div>
        <?php } if(isset($danger_message)){ ?>
        <div class="alert alert-danger" role="alert">
            <?= $danger_message; ?>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
    <h5><b><?=$user_firstName?>'s Application</b></h5>
    <h6><b>Course:</b> <?=$course_name?></h6>

    <br><h6>Personal Details:</h6>
    <h6><b>Title:</b> <?=$title?></h6>
    <h6><b>First Name:</b> <?=$user_firstName?></h6>
    <h6><b>Last Name:</b> <?=$user_lastName?></h6>
    <h6><b>Email:</b> <?=$user_email?></h6>

    <br><h6><b>National Insurance Number:</b> <?=$nin?></h6>
    <h6><b>Sex:</b> <?=$sex?></h6>
    <h6><b>Date of Birth:</b> <?=$dob?></h6>
    <h6><b>Mobile:</b> <?=$mobile?></h6>

    <br><h6>Correspondence Address:</h6>
    <h6><b>1st Line Address:</b> <?=$one_address?></h6>
    <h6><b>Postcode:</b> <?=$postcode?></h6>
    <h6><b>Town:</b> <?=$town?></h6>

    <br><h6>Equal Opportunities:</h6>
    <h6><b>Of which country are you a national?</b> <?=$national?></h6>
    <h6><b>Ethnicity:</b> <?=$ethnicity?></h6>
    <h6><b>Resident in the UK/EU for 3 years:</b> <?php if($uk_eu_resident == 0){echo "No";}else{echo "Yes";}?></h6>
    <h6><b>Criminal Conviction:</b> <?php if($criminal_con == 0){echo "No";}else{echo "Yes";}?></h6>

    <br><h6>Support Needs:</h6>
    <h6><b>Learning Difficulty or Disability:</b> <?=$learning_diff?></h6>
    <h6><b>Have you ever been fostered, adopted or placed in a children's home?</b> <?php if($children_home == 0){echo "No";}else{echo "Yes";}?></h6>
    <h6><b>Do you care for someone else's health or wellbeing needs?</b> <?php if($wellbeing == 0){echo "No";}else{echo "Yes";}?></h6>
    <h6><b>Interview Assistance Required?</b> <?php if($interview_assist == 0){echo "No";}else{echo "Yes";}?></h6>

    <br><h6>Qualifications</h6>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Subject</th>
            <th scope="col">Qualifications</th>
            <th scope="col">Grade</th>
            <th scope="col">Year</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data3 as $apidata3){
            $profile_id2 = $apidata3->profile_id;
            if($profile_id == $profile_id2){
                $profile_id = $apidata3->profile_id;
                $subject = $apidata3->subject;
                $qual = $apidata3->qual;
                $grade = $apidata3->grade;
                $predicted = $apidata3->predicted;
                $year = $apidata3->year;
                
                if($predicted == 0){
                    $predicted_text = "";
                }else{
                    $predicted_text = "(P)";
                } ?>
            <tr>
                <th scope="row"><?=$subject?></th>
                <td><?=$qual?></td>
                <td><?=$grade?> <?=$predicted_text?></td>
                <td><?=$year?></td>
            </tr>
        <?php }} ?>
        </tbody>
    </table>

    <br><h6>User's Evidences</h6>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Date/Time</th>
            <th scope="col">Document Type:</th>
            <th scope="col">Attachment</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data2 as $apidata2){
            $timestamp = $apidata2->timestamp;
            $doc_type = $apidata2->doc_type;
            $file_name = $apidata2->file_name; ?>
            <tr>
                <th scope="row"><?=$timestamp?></th>
                <td><?=$doc_type?></td>
                <td><a href="../assets/results/<?=$file_name?>" target="_blank">Download</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <h6>Admin:</h6>
    <?php if($progress == 1){ ?>
    <form method="POST">
        <label for="interviewDate">Interview date & time:</label><br>
        <input type="text" id="birthdaytime" name="interviewDate">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Update</button><br>
        <small>Format: DD-MM-YYYY - HH:MM</small><br><br>
    </form> 
    <?php }elseif($progress == 2){ ?>
        <a href="view-application?id=<?=$id?>&offer=True"><button class="btn btn-primary my-2 my-sm-0" type="submit">Confirm Offer</button></a><br><br>
    <?php } ?>
    <?php }else{ ?>
  <h6>You don't have permission to go there. </h6>
<?php }  ?>
</div>
<?php include '../layout/footer.php';?>
<style>
.content{
    margin-left:250px;
    margin-right:250px;
    margin-top:30px;
}
@media(max-width:500px){
    .content{
        margin-left:15px!important;
        margin-right:15px;
        margin-top:10px;
    }
}
</style> 