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
        <h5><b>Personal Details:</b></h5>
        <label for="title">Title:</label><br>
        <input type="text" class="form-control" id="title" name="title" required>

        <label for="firstName">First Name:</label><br>
        <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $firstName ?>" required disabled>

        <label for="middleName">Middle Name: (Optional)</label><br>
        <input type="text" class="form-control" id="middleName" name="middleName">

        <label for="lastName">Last Name:</label><br>
        <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $lastName ?>" required disabled>

        <label for="email">Email:</label><br>
        <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required disabled>
        <p style="font-size:13px;">This email has been verified. To change, visit your account page.</p>

        <label for="NInumber">National Insurance Number:</label><br>
        <input type="text" class="form-control" id="NInumber" name="NInumber" required>

        <label for="sex">Sex:</label><br>
        <input type="text" class="form-control" id="sex" name="sex" required>

        <label for="DOB">Date of Birth:</label><br>
        <input type="date" id="myDate" name="DOB" required><br>

        <label for="mobile">Mobile:</label><br>
        <input type="text" class="form-control" id="mobile" name="mobile" required>

        <br><p>That is the first section complete but we need a few more personal details to continue.</p>
        <h5><b>Correspondence Address:</b></h5>

        <label for="oneLineAddress">1st Line Address:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>

        <label for="twoLineAddress">2nd Line Address:</label><br>
        <input type="text" class="form-control" id="twoLineAddress" name="twoLineAddress" required>

        <label for="postcode">Postcode:</label><br>
        <input type="text" class="form-control" id="postcode" name="postcode" required>

        <label for="town">Town:</label><br>
        <input type="text" class="form-control" id="town" name="town" required><br>


        <h5><b>Equal Opportunities:</b></h5>
        <label for="oneLineAddress">Of which country are you a national?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>

        <label for="ethnicity">Ethnicity:</label><br>
        <input type="text" class="form-control" id="ethnicity" name="ethnicity" required>

        <label for="postcode">Resident in the UK/EU for 3 years:</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <label for="town">Criminal Conviction:</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br>


        <h5><b>Support Needs:</b></h5>
        <label for="oneLineAddress">Learning Difficulty or Disability:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>

        <label for="ethnicity">Have you ever been fostered, adopted or placed in a children's home?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <label for="postcode">Do you care for someone else's health or wellbeing needs?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <label for="town">Interview Assistance Required? </label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br>
        
        <p>Final section...POG. We need to know what you been up to during secondary school. Let us know what qualifications you have
        or going to get below.</p>
        <h5><b>List of Qualifications:</b></h5>

        <h6>1st GCSE:</h6>
        <label for="oneLineAddress">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="postcode">Is this a predicted grade?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="postcode">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required><br><br>

        <h6>2nd GCSE:</h6>
        <label for="oneLineAddress">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="postcode">Is this a predicted grade?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="postcode">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required><br><br>

        <h6>3rd GCSE:</h6>
        <label for="oneLineAddress">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="postcode">Is this a predicted grade?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="postcode">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required><br><br>

        <h6>4th GCSE:</h6>
        <label for="oneLineAddress">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="postcode">Is this a predicted grade?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="postcode">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required><br><br>

        <h6>5th GCSE:</h6>
        <label for="oneLineAddress">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="postcode">Is this a predicted grade?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="postcode">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required><br><br>

        <h6>6th GCSE:</h6>
        <label for="oneLineAddress">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="postcode">Is this a predicted grade?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="postcode">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required><br><br>

        <h6>7th GCSE:</h6>
        <label for="oneLineAddress">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="postcode">Is this a predicted grade?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="postcode">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required><br><br>

        <h6>8th GCSE:</h6>
        <label for="oneLineAddress">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="postcode">Is this a predicted grade?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="postcode">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required><br><br>

        <h6>9th GCSE:</h6>
        <label for="oneLineAddress">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="oneLineAddress">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>
        <label for="postcode">Is this a predicted grade?</label><br>
        <select name="cars" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="postcode">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required><br>

        <p>Are you all ready with your application? Submit it below, we can't wait to hear from you.</p>

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
<?php include '../layout/footer.php';?>