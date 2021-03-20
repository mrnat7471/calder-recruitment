<?php include '../layout/navbar.php';

if(isset($_SESSION['id'])){

    // Grabs their application details.
    $id = $_SESSION['id'];
    $stmt = $link->prepare('SELECT * FROM applications WHERE profile_id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($uuid, $profile_id, $course_id, $title, $nin,$sex, $dob, $mobile, $one_address, $postcode, $town, $national, $ethnicity, 
    $uk_eu_resident, $criminal_con, $learning_diff, $children_home, $wellbeing, $interview_assist, $staff_id, $progress);
    $stmt->fetch();
    $stmt->close();

    // Grabs the course name.
    $stmt = $link->prepare('SELECT name FROM courses WHERE uuid = ?');
    $stmt->bind_param('i', $course_id);
    $stmt->execute();
    $stmt->bind_result($course_name);
    $stmt->fetch();
    $stmt->close();

    // Grabs user's name.
    $stmt = $link->prepare('SELECT firstName, lastName, email FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $profile_id);
    $stmt->execute();
    $stmt->bind_result($user_firstName, $user_lastName, $user_email);
    $stmt->fetch();
    $stmt->close();

    // Grabs user's qualifications
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
}else{
    header("Location: ../?danger=You need to login to access this.");
}
?>
<div class="content">
    <h5><b>Your Application</b></h5>
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
            $profile_id = $apidata3->profile_id;
            if($id == $profile_id){
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