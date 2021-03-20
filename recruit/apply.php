<?php
include '../layout/navbar.php';
require_once "../controllers/config.php";
require_once '../controllers/email_verification.php';

$qual = 0;
// Checks they are logged in.
if(isset($_SESSION['id'])){
        // Gets users details.
        $accountid = $_SESSION['id'];
        $stmt = $link->prepare('SELECT firstName, lastName, email FROM users WHERE uuid = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($firstName, $lastName, $email);
        $stmt->fetch();
        $stmt->close();
    // Checks a course has been selected.
    if(isset($_GET['id'])){
        // Gets course Name.
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
if(isset($_POST['title']) || isset($_POST['firstName'])){
    // Adds application to application table.
    $id = $_SESSION['id'];
    $course_id = $_GET['id'];

    $title = $_POST['title'];
    $nin = $_POST['NInumber'];
    $sex = $_POST['sex'];
    $dob = $_POST['DOB'];
    $mobile = $_POST['mobile'];
    $one_address = $_POST['oneLineAddress'];
    $postcode = $_POST['postcode'];
    $town = $_POST['town'];
    $national = $_POST['national'];
    $ethnicity = $_POST['ethnicity'];
    $uk_eu_resident = $_POST['uk_eu_res'];
    $criminal_con = $_POST['crim'];
    $learning_diff = $_POST['learning_diff'];
    $children_home = $_POST['children_home'];
    $wellbeing = $_POST['wellbeing'];
    $interview_assist = $_POST['interview_assist'];
    $sql = "INSERT INTO applications (profile_id, course_id, title, nin, sex, dob, mobile, one_address, postcode, town, national, ethnicity, uk_eu_resident, criminal_con, learning_diff, children_home, wellbeing, interview_assist, staff_id, progress)
        VALUES ('$id', '$course_id', '$title','$nin', '$sex', '$dob', '$mobile', '$one_address', '$postcode', '$town', '$national', '$ethnicity', '$uk_eu_resident', '$criminal_con', '$learning_diff', '$children_home', '$wellbeing', '$interview_assist', '0', '0')";

    if ($conn->query($sql) === TRUE) {
        $id = $_SESSION['id'];
        $sql = "UPDATE users SET progress='1' WHERE uuid=$id";
        if ($conn->query($sql) === TRUE) {
            $qual = 1;
            $connection = $link;
            $id = $_SESSION['id'];
            //ORDER BY RAND() 
            $sql3 = "SELECT * from qualifications";
            $result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
            $emparray3 = array();
            while($row3 =mysqli_fetch_assoc($result3))
            {
                $emparray3[] = $row3;
            }
            $apidata3 = json_encode($emparray3);
            $data3 = json_decode($apidata3);
        } else {
        echo "Error:" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['subject']) || isset($_POST['qualification']) || isset($_POST['grade']) || isset($_POST['pred']) || isset($_POST['year'])){
    // Adds qualifications to table.
    $id = $_SESSION['id'];

    $subject = $_POST['subject'];
    $qual = $_POST['qualification'];
    $grade = $_POST['grade'];
    $predicted = $_POST['pred'];
    $year = $_POST['year'];
    $sql = "INSERT INTO qualifications (profile_id, subject, qual, grade, predicted, year)
        VALUES ('$id', '$subject', '$qual', '$grade', '$predicted', '$year')";

        if ($conn->query($sql) === TRUE) {
            $qual = 1;
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
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
}
?>

<div class="apply-content">
<?php if($verified != 0){ ?>
    <h2><b>Application Process</b></h2>
    <?php if($qual == 0){ ?>
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
        <select name="title" class="form-control">
            <option value="" selected="selected" disabled="disabled">-- select one --</option>
            <option value="MISS">Miss</option>
            <option value="MR">Mr</option>
            <option value="MS">Ms</option>
            <option value="MRS">Mrs</option>
            <option value="DOCTOR">Doctor</option>
            <option value="PROFESSOR">Professor</option>
        </select>

        <label for="firstName">First Name:</label><br>
        <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $firstName ?>" required disabled>

        <label for="lastName">Last Name:</label><br>
        <input type="text" class="form-control" id="firstName" name="lastName" value="<?= $lastName ?>" required disabled><br>

        <p>That is the first section complete but we need a few more personal details to continue.</p>

        <label for="NInumber">National Insurance Number:</label><br>
        <input type="text" class="form-control" id="NInumber" name="NInumber" required>

        <label for="sex">Sex:</label><br>
        <select name="sex" class="form-control">
            <option value="" selected="selected" disabled="disabled">-- select one --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>

        <label for="DOB">Date of Birth:</label><br>
        <input type="date" id="myDate" name="DOB" required><br>

        <label for="mobile">Mobile:</label><br>
        <input type="tel" id="phone" name="mobile" class="form-control" placeholder="07000000000" pattern="0[0-9]{10}" required>
        <small>Format: 07000000000</small><br>

        <br><p>That is the first section complete but we need a few more personal details to continue.</p>
        <h5><b>Correspondence Address:</b></h5>

        <label for="oneLineAddress">1st Line Address:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="oneLineAddress" required>

        <label for="postcode">Postcode:</label><br>
        <input type="text" class="form-control" id="postcode" name="postcode" required>

        <label for="town">Town:</label><br>
        <input type="text" class="form-control" id="town" name="town" required><br>


        <h5><b>Equal Opportunities:</b></h5>
        <label for="national">Of which country are you a national?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="national" required>

        <label for="ethnicity">Ethnicity:</label><br>
        <select class="form-control dropdown" id="ethnicity" name="ethnicity">
            <option value="" selected="selected" disabled="disabled">-- select one --</option>
            <optgroup label="White">
                <option value="White English">English</option>
                <option value="White Welsh">Welsh</option>
                <option value="White Scottish">Scottish</option>
                <option value="White Northern Irish">Northern Irish</option>
                <option value="White Irish">Irish</option>
                <option value="White Gypsy or Irish Traveller">Gypsy or Irish Traveller</option>
                <option value="White Other">Any other White background</option>
            </optgroup>
            <optgroup label="Mixed or Multiple ethnic groups">
                <option value="Mixed White and Black Caribbean">White and Black Caribbean</option>
                <option value="Mixed White and Black African">White and Black African</option>
                <option value="Mixed White Other">Any other Mixed or Multiple background</option>
            </optgroup>
            <optgroup label="Asian">
                <option value="Asian Indian">Indian</option>
                <option value="Asian Pakistani">Pakistani</option>
                <option value="Asian Bangladeshi">Bangladeshi</option>
                <option value="Asian Chinese">Chinese</option>
                <option value="Asian Other">Any other Asian background</option>
            </optgroup>
                <optgroup label="Black">
                <option value="Black African">African</option>
                <option value="Black African American">African American</option>
                <option value="Black Caribbean">Caribbean</option>
                <option value="Black Other">Any other Black background</option>
            </optgroup>
            <optgroup label="Other ethnic groups">
                <option value="Arab">Arab</option>
                <option value="Hispanic">Hispanic</option>
                <option value="Latino">Latino</option>
                <option value="Native American">Native American</option>
                <option value="Pacific Islander">Pacific Islander</option>
                <option value="Other">Any other ethnic group</option>
            </optgroup>
        </select>

        <label for="uk_eu_res">Resident in the UK/EU for 3 years:</label><br>
        <select name="uk_eu_res" class="form-control">
            <option value="" selected="selected" disabled="disabled">-- select one --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <label for="crim">Criminal Conviction:</label><br>
        <select name="crim" class="form-control">
            <option value="" selected="selected" disabled="disabled">-- select one --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br>


        <h5><b>Support Needs:</b></h5>
        <label for="learning_diff">Learning Difficulty or Disability:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="learning_diff" required>

        <label for="children_home">Have you ever been fostered, adopted or placed in a children's home?</label><br>
        <select name="children_home" class="form-control">
            <option value="" selected="selected" disabled="disabled">-- select one --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <label for="wellbeing">Do you care for someone else's health or wellbeing needs?</label><br>
        <select name="wellbeing" class="form-control">
            <option value="" selected="selected" disabled="disabled">-- select one --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <label for="interview_assist">Interview Assistance Required? </label><br>
        <select name="interview_assist" class="form-control">
            <option value="" selected="selected" disabled="disabled">-- select one --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br>
        <br><button class="btn btn-primary my-2 my-sm-0" type="submit">Next</button>
    </form>
    <?php }
    if($qual == 1){ ?>

    <p>Final section...POG. We need to know what you been up to during secondary school. Let us know what qualifications you have
    or going to get below.</p>
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
    <form method="POST">
        <br><h5><b>List of Qualifications:</b></h5>
        <label for="subject">Subject:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="subject" required>
        <label for="qualification">Qualifications:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="qualification" required>
        <label for="grade">Grade:</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="grade" required>
        <label for="pred">Is this a predicted grade?</label><br>
        <select name="pred" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <label for="year">Year Achieved?</label><br>
        <input type="text" class="form-control" id="oneLineAddress" name="year" required><br><br>

        <button class="btn btn-primary my-2 my-sm-0" type="submit">Add</button><br><br>
    </form>
    

    <p>Are you all ready with your application? Submit it below, we can't wait to hear from you.</p>
    <a href="your-applications?success=Application has been sent"><button class="btn btn-primary my-2 my-sm-0" type="submit">Apply</button></a>
    <?php } ?>
    <?php }else{ ?>
        <h2>Email Verification required!</h2>
    <p>Please verify your email before continueing.</p> 
<?php }  ?>
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