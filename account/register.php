<?php 
include '../layout/navbar.php';

$firstName = "";
$lastName = "";
$email = "";
$error = 0;
$message = NULL;
$complete = FALSE;

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
                    $sql = "INSERT INTO users (firstName, lastName, email, password)
                            VALUES ('$firstName', '$lastName', '$email', '$password')";

                            if ($conn->query($sql) === TRUE) {
                                $complete = TRUE;
                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                }
            }
        }
    }
}

?>
<div style="text-align:center;">
    <h2>Register for a account!</h2>
    <?php if($message){ ?>
        <div class="alert alert-danger m-2" role="alert">
            <?= $message; ?>
        </div>
    <?php } if($complete === FALSE){ ?>
    <form action="#" method="POST">
    <label for="first_name">First name:</label><br>
    <input type="text" id="first_name" name="first_name" value="<?= $firstName ?>" required><br>
    <label for="last_name">Last name:</label><br>
    <input type="text" id="last_name" name="last_name" value="<?= $lastName ?>" required><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?= $email ?>" required><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br>
    <label for="confirm_password">Confirm Password:</label><br>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>
    <input type="submit" name="register_submit" value="Submit">
    </form> 
    <?php }else{ ?>
        <p>Thank you for registering!<br>Please check your email to verify your account.</p>
    <?php } ?>
</div>
<?php include '../layout/footer.php';?>