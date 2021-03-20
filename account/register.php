<?php 
include '../layout/navbar.php';

$firstName = "";
$lastName = "";
$email = "";
$error = 0;
$message = NULL;
$complete = FALSE;

// Grabs form details, checks to see if there an email that matches if there is, doesn't create a account if there isn't create new account.
if(isset($_POST['register_submit'])){
    require_once '../controllers/config.php';
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if($password != $confirmPassword){
        $error = 1;
        $message = "Your password doesn't match!";
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    if($error === 0){
        $sql = "SELECT email FROM users WHERE email = ?";
            
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $email);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $message = "Email is already registered, please login!";
                } else{
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
                    $sql = "INSERT INTO users (firstName, lastName, email, password, email_verify)
                            VALUES ('$firstName', '$lastName', '$email', '$password', '$emailverify')";

                            if ($conn->query($sql) === TRUE) {
                                require_once '../controllers/email_verify.php';
                                header("Location: verify");
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                }
            }
        }
    }
}

?>
<div class="content" style="text-align:center;">
    <h2>Register for a account!</h2>
    <?php if($message){ ?>
        <div class="alert alert-danger m-2" role="alert">
            <?= $message; ?>
        </div>
    <?php } if($complete === FALSE){ ?>
    <form action="#" method="POST">
    <label for="first_name">First name:</label><br>
    <input class="form-control" type="text" id="first_name" name="first_name" value="<?= $firstName ?>" required><br>
    <label for="last_name">Last name:</label><br>
    <input class="form-control" type="text" id="last_name" name="last_name" value="<?= $lastName ?>" required><br>
    <label for="email">Email:</label><br>
    <input class="form-control" type="email" id="email" name="email" value="<?= $email ?>" required><br>
    <label for="password">Password:</label><br>
    <input class="form-control" type="password" id="password" name="password" required><br>
    <label for="confirm_password">Confirm Password:</label><br>
    <input class="form-control" type="password" id="confirm_password" name="confirm_password" required><br><br>
    <input type="text" name="register_submit" value="Submit" style="display:none">
    <button class="btn btn-primary my-2 my-sm-0" type="submit">Register</button>
    </form> 
    <?php }else{ ?>
        <p>Thank you for registering!<br>Please check your email to verify your account.</p>
    <?php } ?>
</div>
<?php include '../layout/footer.php';?>
<style>
.content{
    margin-left:450px;
    margin-right:450px;
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