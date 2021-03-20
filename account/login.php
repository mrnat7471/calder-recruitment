<?php 
include '../layout/navbar.php';

$message = NULL;
$email = "";

//Checks the email and password match a account the starts a session for the login user.
if(isset($_POST['login_submit'])){
    $email = $_POST['email'];

    require_once '../controllers/config.php';
    $sql = "SELECT uuid, email, password FROM users WHERE email = ?";
            
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $email);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){
                $stmt->bind_result($id, $database_email, $database_password);
                $stmt->fetch();
                $stmt->close();

                $password = $_POST['password'];
                echo 'hi';
                if(password_verify($password, $database_password)){
                    $message = "Password verified.";
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['id'] = $id;
                    header('Location: ../');
                }else{
                    $message = "Your password is incorrect.";
                }
                
            } else{
                $message = "No account can be found.";
            }
        }
    }
}
?>
<div class="content" style="text-align:center;">
    <h2>Log into your account!</h2>
    <?php if($message){ ?>
        <div class="alert alert-danger m-2" role="alert">
            <?= $message; ?>
        </div>
    <?php } ?>

    <form action="#" method="POST">
        <label for="email">Email:</label><br>
        <input class="form-control" type="email" id="email" name="email" value="<?= $email ?>" required><br>
    
        <label for="password">Password:</label><br>
        <input class="form-control" type="password" id="password" name="password" required><br><br>
        
        <input type="text" name="login_submit" value="true" style="display:none">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Login</button><br><br>
    </form>
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