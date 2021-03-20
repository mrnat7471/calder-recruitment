<?php include '../layout/navbar.php';

$id = $_SESSION['id'];
$date_1 = "";

// Grabs interview information of user.
$stmt = $link->prepare('SELECT * FROM interviews WHERE profile_id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($uuid, $profile_id, $staff_id, $date_1);
$stmt->fetch();
$stmt->close();

// Grabs user's information.
$stmt = $link->prepare('SELECT firstName, lastName, email, verified, user_role FROM users WHERE uuid = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $email, $verified, $name);
$stmt->fetch();
$stmt->close();

// Grabs staff member's information
$stmt = $link->prepare('SELECT firstName, lastName FROM users WHERE uuid = ?');
$stmt->bind_param('i', $staff_id);
$stmt->execute();
$stmt->bind_result($staff_firstName, $staff_lastName);
$stmt->fetch();
$stmt->close();
?>
<div class="content">
    <h5><b>Interview</b></h5>
    <p>Dear <?=$firstName;?><br><br>

    Thank you for applying for your course and would love to offer you an interview, 
    you are now on your way to becoming a student at Calderdale College.<br><br>

    Please attend the Admissions Event below to secure your place on a course.<br><br>

    <b>Date:</b> <?=$date_1?><br><br>

    Please arrive ten minutes prior to your appointment time above, please be aware the event may take longer than planned.<br><br>

    Your Admissions Advisor will meet you in reception at the Percival Whitely Centre, Francis Street, HX1 3UZ.<br><br>

    The Admissions appointment can vary depending upon the course you have chosen, this will include:<br>
    <ul>
        <li>Short Presentation in the course area</li>
        <li>Look around the facilities in the subject area</li>
        <li>Q and A Session</li>
        <li>Short informal interview with the tutor.</li>
    </ul>

    We will either send you an email, text or letter to remind you about the appointment.<br><br>

    If you are unable to attend this event please contact the Admissions Team by e-mail admissions@calderdale.ac.uk 
    or by phone 01422 399316.<br><br>

    If you would like to discuss your required support needs, or for further information about the support available when 
    you attend the event, please contact the Admissions Team as above.<br><br>

    We look forward to meeting you at the event.<br><br>

    <b><?=$staff_firstName?> <?=$staff_lastName?></b><br>
    Staff Member.</p>
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