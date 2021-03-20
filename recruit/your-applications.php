<?php 
include '../layout/navbar.php';
require_once "../controllers/config.php";
$progress=0;
if(isset($_SESSION['id'])){
    // Grabs application progress.
    $id = $_SESSION['id'];
    $stmt = $link->prepare('SELECT progress FROM users WHERE uuid = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($progress);
    $stmt->fetch();
    $stmt->close();

    // Grabs all applications sent.
    $connection = $link;
    $sql3 = "select * from applications";
    $result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
    $emparray3 = array();
    while($row3 =mysqli_fetch_assoc($result3))
    {
        $emparray3[] = $row3;
    }
    $apidata3 = json_encode($emparray3);
    $data3 = json_decode($apidata3);
}else{
    header("Location: ../?danger=You need to login to access this.");
}?>
<div class="content">
<h5><b>Your Applications</b></h5><br>
    <h6>Track your application process</h6>
    <p>You can track your application below. For full details, check your messages for latest information.</p>
    <div class="progress" style="height: 15px;">
        <div class="progress-bar 
            <?php if($progress === 0) {echo "w-10 bg-danger";}
            elseif($progress === 1){echo "w-25 bg-warning";}
            elseif($progress === 2){echo "w-45 bg-warning";}
            elseif($progress === 3){echo "w-50 bg-info";}
            elseif($progress === 4){echo "w-100 bg-success";}
            else{echo "w-0 bg-danger";} ?>" role="progressbar" 
            style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <?php if ($progress === 0) {echo "15%";}
                elseif($progress === 1){echo "25%";}
                elseif($progress === 2){echo "45%";}
                elseif($progress === 3){echo "50%";}
                elseif($progress === 4){echo "100%";}
                else{echo "Unknown";} 
            ?>
        </div>
    </div>
    <p style="text-align:center">
        <?php if ($progress === 0) {echo "15% - Apply today!";}
            elseif($progress === 1){echo "25% - We be in contact soon!";}
            elseif($progress === 2){echo "45% - Interview Stage!";}
            elseif($progress === 3){echo "50% - You got an offer!";}
            elseif($progress === 4){echo "100% - See you in September!";}
            else{echo "Unknown";} 
        ?>
    </p>
    <br><br>

    <h5><b>Your Applications</b></h5>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Course</th>
            <th scope="col">Status</th>
            <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data3 as $apidata3){
            $profile_id = $apidata3->profile_id;
            if($id == $profile_id){
                $course_id = $apidata3->course_id;
                $stmt = $link->prepare('SELECT name FROM courses WHERE uuid = ?');
                $stmt->bind_param('i', $course_id);
                $stmt->execute();
                $stmt->bind_result($course_name);
                $stmt->fetch();
                $stmt->close();
                $progress = $apidata3->progress;
                $uuid = $apidata3->uuid; ?>
            <tr>
                <th scope="row"><?=$uuid?></th>
                <td><?=$course_name?></td>
                <td><?php 
                if($progress == 0){ echo 'Un-claimed';}
                elseif($progress == 1){ echo 'Claimed';}
                elseif($progress == 2){ echo 'Interview Scheduled';}
                elseif($progress == 3){ echo 'Offer Given';}
                elseif($progress == 4){ echo 'Complete';}
                else{ echo 'Unknown';} ?></td>
                <td><a href="view-application?id=<?=$uuid?>"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></a></td>
            </tr>
        <?php }} ?>
        </tbody>
    </table>
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