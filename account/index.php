<?php 
include '../layout/navbar.php';
require_once '../controllers/email_verification.php';
$id = $_SESSION['id'];

if(isset($ROLE_READ)){
    $sql3 = "select * from user_roles where user_id = $id";
    $result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
    $emparray3 = array();
    while($row3 =mysqli_fetch_assoc($result3))
    {
        $emparray3[] = $row3;
    }
    $apidata3 = json_encode($emparray3);
    $data3 = json_decode($apidata3);
}

$stmt = $link->prepare('SELECT firstName, lastName, email, verified FROM users WHERE uuid = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($firstName, $lastName, $email, $verified);
$stmt->fetch();
$stmt->close();
?>
<div class="account-content">
    <h2><b>Your Account</b></h2>
    <h5>Hello, <?= $firstName ?>.</h5>
    <?php if(isset($ROLE_READ)){ ?>
    <h6>Roles:</h6>
    <ul>
    <?php 
    foreach($data3 as $apidata3){
        $roleID = $apidata3->role_id;
        $sql2 = "select * from roles where uuid = $roleID";
        $result2 = mysqli_query($connection, $sql2) or die("Error in Selecting " . mysqli_error($connection));
        $emparray2 = array();
        while($row2 =mysqli_fetch_assoc($result2))
        {
            $emparray2[] = $row2;
        }
        $apidata2 = json_encode($emparray2);
        $data2 = json_decode($apidata2);

        foreach($data2 as $apidata2){
            $name = $apidata2->name;
            if(isset($USER_ROLE_WRITE)){
            echo '<li>' . $name . ' <a href="#"><i class="fas fa-minus-circle"></i></a></li>';
            }else{
                echo '<li>' . $name . '</li>';
            }
        }
    } ?>
    </ul>
    <?php } ?>
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