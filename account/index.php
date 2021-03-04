<?php 
include '../layout/navbar.php';
require_once '../controllers/email_verification.php';
$id = $_SESSION['id'];

$stmt = $link->prepare('SELECT firstName, lastName, email, verified, user_role FROM users WHERE uuid = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $email, $verified, $name);
$stmt->fetch();
$stmt->close();

$stmt = $link->prepare('SELECT name FROM roles WHERE uuid = ?');
$stmt->bind_param('i', $name);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();
$stmt->close();
?>
<div class="account-content">
    <h2><b>Your Account</b></h2>
    <h5>Hello, <?= $firstName ?>.</h5>
    <?php if($ROLE_MANAGE){ ?>
    <h6><b>Role:</b> 
    <?php
    if(isset($USER_ROLE_MANAGE)){
        echo $name;
        }
    }
    ?></h6>
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