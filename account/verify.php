<?php
if(isset($_GET['code'])){
    $code = $_GET['code'];
}

// Grabs password from form. Checks to see if it matches account then verifies email.
if(isset($_POST['code'])){
    $code = $_POST['code'];
    require_once '../controllers/config.php';
    $sql = "SELECT password, email_verify FROM users WHERE email_verify = ?";
            
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $code);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                $stmt->bind_result($database_password, $database_verify);
                $stmt->fetch();
                $stmt->close();

                $password = $_POST['password'];
                if(password_verify($password, $database_password)){
                    if($code == $database_verify){
                        $sql = "UPDATE users SET verified='1' WHERE email_verify='$code'";

                        if ($conn->query($sql) === TRUE) {
                            header('Location: ../?success=Email verified, you can now login.');
                        } else {
                            $danger_message = "Error updating record: " . $conn->error;
                        }

                        $conn->close();
                    }else{
                        $message = "The email code is invalid.";
                    }
                }else{
                    $message = "Your password is incorrect.";
                }
                
            } else{
                $message = "No account can be found.";
            }
        }
    }
}
include '../layout/navbar.php';
?>
<div class="content" style="text-align:center;margin-top:25px;">
    <h2>Email Verification required!</h2>
    <p>Please verify your email before continueing.</p> 
    <?php if(isset($_GET['code'])){ ?>
        <form method="POST">
            <input type="text" name="code" value="<?=$code?>" style="display:none">
            <label>Confirm Password: </label>
            <input class="form-control" type="password" name="password"><br>
            <button class="btn btn-primary my-2 my-sm-0" type="submit">Verify</button>
        </form>
    <?php } ?>
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