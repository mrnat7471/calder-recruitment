<?php 
include '../layout/navbar.php';
require_once '../controllers/email_verification.php';
$id = $_SESSION['id'];

// Updates firstName AND lastName in users table for this account.
if(isset($_POST['firstName'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $sql = "UPDATE users SET firstName='$firstName', lastName='$lastName' WHERE uuid=$id";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Name updated.";
    } else {
    echo "Error:" . $conn->error;
    }
}

// Updates email in users table for this account. It also unverifies the email, generates a new email verify string and sends a email to the
// new email to verify it.
if(isset($_POST['email'])){
    function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $emailverify =  generateRandomString();
    $email = $_POST['email'];

    $sql = "UPDATE users SET email='$email', verified='0', email_verify='$emailverify' WHERE uuid=$id";
    if ($conn->query($sql) === TRUE) {
        $success_message = "Email updated.";
        $stmt = $link->prepare('SELECT firstName, lastName, email, verified, user_role FROM users WHERE uuid = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($firstName, $lastName, $email, $verified, $name);
        $stmt->fetch();
        $stmt->close();
        require_once '../controllers/email_verify.php';
    } else {
    echo "Error:" . $conn->error;
    }

}

// Changes the current password in the database using the current password of the account.
if(isset($_POST['currentPassword'])){
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    $stmt = $link->prepare('SELECT password FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($password);
    $stmt->fetch();
    $stmt->close();

    if(password_verify($currentPassword, $password)){
        if($newPassword == $confirmNewPassword){
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password='$newPassword' WHERE uuid=$id";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Password updated. Please use this when you next login.";
        } else {
        echo "Error:" . $conn->error;
        }
        }else{
            $danger_message = "New passwords do not match.";
        }
    }else{
        $danger_message = "Current Password is incorrect.";
    }

}

// Grabs account information.
$stmt = $link->prepare('SELECT firstName, lastName, email, verified, user_role FROM users WHERE uuid = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $email, $verified, $name);
$stmt->fetch();
$stmt->close();

// Grabs account role name.
$stmt = $link->prepare('SELECT name FROM roles WHERE uuid = ?');
$stmt->bind_param('i', $name);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();
?>
<div class="account-content">
<?php if($verified != 0){ ?>
    <h2><b>Your Account</b></h2>
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
    <h5>Hello, <?= $firstName ?>.</h5>
    <?php if($ROLE_MANAGE){ ?>
    <h6><b>Role:</b> 
    <?php
    if(isset($USER_ROLE_MANAGE)){
        echo $name;
        }
    }
    ?></h6>

    <form method="POST">
        <label>First Name:</label><br>
        <input type="text" name="firstName" class="form-control" value="<?=$firstName?>" required>

        <label>Last Name:</label><br>
        <input type="text" name="lastName" class="form-control" value="<?=$lastName?>" required><br>

        <button class="btn btn-primary my-2 my-sm-0" type="submit">Update</button><br><br>
    </form>

    <form method="POST">
        <label>Email:</label><br>
        <input type="text" name="email" class="form-control" value="<?=$email?>" required>
        <small>Your account will become un-verified until you re-verify your email</small><br><br>
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Update</button><br><br>
    </form>

    <form method="POST">
        <label>Current Password:</label><br>
        <input type="password" name="currentPassword" class="form-control" required>

        <label>New Password:</label><br>
        <input type="password" name="newPassword" class="form-control" required>
        
        <label>Confirm new Password:</label><br>
        <input type="password" name="confirmNewPassword" class="form-control" required><br>

        <button class="btn btn-primary my-2 my-sm-0" type="submit">Update</button><br><br>
    </form>
    <?php }else{ ?>
        <h2>Email Verification required!</h2>
    <p>Please verify your email before continueing.</p> 
<?php }  ?>
</div>

<style>
.account-content{
    margin-left:250px;
    margin-right:250px;
    margin-top:30px;
}
@media(max-width:500px){
    .account-content{
        margin-left:15px!important;
        margin-right:15px;
        margin-top:10px;
    }
}
</style>
<?php include '../layout/footer.php';?>