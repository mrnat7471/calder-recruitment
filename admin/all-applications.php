<?php include '../layout/navbar.php';
$connection = $link;
$sql3 = "select * from applications";
$result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
$emparray3 = array();
while($row3 =mysqli_fetch_assoc($result3))
{
    $emparray3[] = $row3;
}
$apidata3 = json_encode($emparray3);
$data3 = json_decode($apidata3);?>
<div class="content">
<?php if($APPLICANT_READ == 1){ ?>

    <h5><b>All Applications</b></h5>
    <!--    <form method="GET">
            <div class="row" style="max-width:600px;">
                <div class="col" style="width:165px;">
                    <label>Staff: 
                    <select name="search_role" class="form-control" style="width:155px;">
                        <option value="test">All</option>
                        <option value="test">Unassigned</option>
                        <option value="test">Nathan Powell</option>
                    </select></label>
                </div>
                <div class="col" style="width:160px;">
                    <label>Status: 
                    <select name="search_role" class="form-control" style="width:150px;">
                        <option value="test">New</option>
                    </select></label>
                </div>
                <div class="col" style="width:200px;">
                    <label>Course: 
                    <select name="search_role" class="form-control" style="width:190px;">
                        <option value="test">Level 3 Computing</option>
                    </select></label>
                </div>
                <div class="col" style="width:40px;">
                    <label><br>
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Go</button>
                    </label>
                </div>
            </div>
        </form>-->
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Course</th>
            <th scope="col">Status</th>
            <th scope="col">Claimed by</th>
            <th scope="col">Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data3 as $apidata3){
            $uuid = $apidata3->uuid;
            $course_id = $apidata3->course_id;
            $profile_id = $apidata3->profile_id;
            $staff_id = $apidata3->staff_id;
            $progress = $apidata3->progress;  
            $stmt = $link->prepare('SELECT firstName, lastName FROM users WHERE uuid = ?');
            $stmt->bind_param('i', $profile_id);
            $stmt->execute();
            $stmt->bind_result($firstName, $lastName);
            $stmt->fetch();
            $stmt->close();

            $stmt = $link->prepare('SELECT firstName, lastName FROM users WHERE uuid = ?');
            $stmt->bind_param('i', $staff_id);
            $stmt->execute();
            $stmt->bind_result($staff_firstName, $staff_lastName);
            $stmt->fetch();
            $stmt->close();

            $stmt = $link->prepare('SELECT name FROM courses WHERE uuid = ?');
            $stmt->bind_param('i', $course_id);
            $stmt->execute();
            $stmt->bind_result($course_name);
            $stmt->fetch();
            $stmt->close();

            ?>
            <tr>
                <th scope="row"><?=$uuid?></th>
                <td><?=$firstName?> <?= $lastName?></td>
                <td><?=$course_name?></td>
                <td><?php 
                if($progress == 0){ echo 'Un-claimed';}
                elseif($progress == 1){ echo 'Claimed';}
                elseif($progress == 2){ echo 'Interview Scheduled';}
                elseif($progress == 3){ echo 'Offer Given';}
                elseif($progress == 4){ echo 'Complete';}
                else{ echo 'Unknown';} ?></td>
                <td><?=$staff_firstName?> <?= $staff_lastName?></td>
                <td><!--<a href="./view-application?unclaim=<?=$uuid?>"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Un-claim</button></a>-->
                <a href="./view-application?id=<?=$uuid?>"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php }else{ ?>
  <h6>You don't have permission to go there. </h6>
<?php }  ?>  
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