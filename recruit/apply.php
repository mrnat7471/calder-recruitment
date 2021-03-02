<?php
include '../layout/navbar.php';
require_once "../controllers/config.php";
require_once '../controllers/email_verification.php';

if(isset($_SESSION['id'])){
    if(isset($_GET['id'])){
        $accountid = $_SESSION['id'];

        $stmt = $link->prepare('SELECT firstName, lastName, email FROM users WHERE uuid = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($firstName, $lastName, $email);
        $stmt->fetch();
        $stmt->close();

        $courseID = $_GET['id'];
        $stmt2 = $link->prepare('SELECT name FROM courses WHERE uuid = ?');
        $stmt2->bind_param('i', $courseID);
        $stmt2->execute();
        $stmt2->bind_result($courseName);
        $stmt2->fetch();
        $stmt2->close();
    }else{
        header("Location: ../?danger=Please search then apply for a course.");
    }
}else{
    header("Location: ../?danger=Please Login.");
}
?>

<div class="apply-content">
    <h2><b>Application Process</b></h2>
    <p>Hello, <b><?= $firstName ?></b>. Welcome to the Calderdale College application
    process, we will talk you through the full process till your fully enrolled
    and ready to study here. Firstly, you are applying for <b><?=$courseName?></b>.
    Is this the correct course? If not, leave this page and search for the correct
    course to make sure your applying for the course you want.</p>
    <h6><b>Lets get started...</b></h6>
    <p>We grabbed some details when you first created your account, we have prefilled
    these out below. If they are incorrect, please click <a href="account">here</a>
    and edit and save the details to make sure they are correct.</p>
    <form action="#" method="POST" class="mb-3">
        <label for="firstName">First Name:</label><br>
        <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $firstName ?>" required disabled>

        <label for="middleName">Middle Name: (Optional)</label><br>
        <input type="text" class="form-control" id="middleName" name="middleName">

        <label for="lastName">Last Name:</label><br>
        <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $lastName ?>" required disabled>

        <label for="email">Email:</label><br>
        <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required disabled>
        <p style="font-size:13px;">This email has been verified. To change, visit your account page.</p>

        <p>That is the first section complete but we need a few more personal details to continue.</p>

        <label for="NInumber">National Insurance Number:</label><br>
        <input type="text" class="form-control" id="NInumber" name="NInumber" required>

        <label for="oneLineAddress">1st Line Address:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>

        <label for="twoLineAddress">2nd Line Address:</label><br>
        <input type="text" class="form-control" id="twoLineAddress" name="twoLineAddress" required>

        <label for="postcode">Postcode:</label><br>
        <input type="text" class="form-control" id="postcode" name="postcode" required>

        <label for="town">Town:</label><br>
        <input type="text" class="form-control" id="town" name="town" required>
        
        <br><button class="btn btn-primary my-2 my-sm-0" type="submit">Apply</button>
    </form>
</div>

<style>
.apply-content{
    margin-left:250px;
    margin-right:250px;
    margin-top:30px;
}
@media(max-width:500px){
    .apply-content{
        margin-left:15px!important;
        margin-right:15px;
        margin-top:10px;
    }
}
</style>
<?php include '../layoutfooter.php';?>