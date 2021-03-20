<?php
include '../layout/navbar.php';
require_once "../controllers/config.php";

if(isset($_GET['id'])){
    // Grabs course information from selected course ID.
    $id = $_GET['id'];
    $stmt = $link->prepare('SELECT uuid, name, department, summary, content FROM courses WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($uuid, $courseName, $department, $summary, $content);
    $stmt->fetch();
    $stmt->close();
}else{
    header("Location: ./");
}
?>
<div class="content">
    <h4 style="text-align:center;margin-top:15px;"><b><?= $courseName ?></b></h4>
    <h6 style="padding-bottom:5px;border-bottom: 5px solid rgb(47, 153, 138);"><?= $department ?></h6>
    <p style="padding-bottom:5px;border-bottom: 5px solid rgb(47, 153, 138);"><?= $summary ?></p>
    <p><?= $content ?></p>
    <?php if(isset($_SESSION['id'])){ ?>
        <a href="../recruit/apply?id=<?=$uuid?>" class="btn btn-primary">Apply Now</a>
    <?php } else { ?>
    <h6>Please login to apply.</h6>
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