<?php include '../layout/navbar.php';
$connection = $link;
// Grabs all applications from applications table and outputs as a JSON array.
$sql3 = "select * from applications";
$result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
$emparray3 = array();
while($row3 =mysqli_fetch_assoc($result3))
{
    $emparray3[] = $row3;
}
$apidata3 = json_encode($emparray3);
$data3 = json_decode($apidata3);
?>
<div class="content">
<?php if($APPLICANT_READ == 1){ ?>
    <h5><b>Applications</b></h5>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Course</th>
            <th scope="col">Status</th>
            <th scope="col">Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data3 as $apidata3){
            $uuid = $apidata3->uuid;
            $course_id = $apidata3->course_id;
            $profile_id = $apidata3->profile_id;
            $staff_id = $apidata3->staff_id; 
            // Grabs user's firstName, lastName.
            $stmt = $link->prepare('SELECT firstName, lastName FROM users WHERE uuid = ?');
            $stmt->bind_param('i', $profile_id);
            $stmt->execute();
            $stmt->bind_result($firstName, $lastName);
            $stmt->fetch();
            $stmt->close();

            // Grabs course Name.
            $stmt = $link->prepare('SELECT name FROM courses WHERE uuid = ?');
            $stmt->bind_param('i', $course_id);
            $stmt->execute();
            $stmt->bind_result($course_name);
            $stmt->fetch();
            $stmt->close();

            // Only displays application if unclaimed.
            if($staff_id == 0){
            ?>
            <tr>
                <th scope="row"><?=$uuid?></th>
                <td><?=$firstName?> <?= $lastName?></td>
                <td><?=$course_name?></td>
                <td>Claimable</td>
                <td><a href="./view-application?claim=<?=$uuid?>"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Claim</button></a>
                <a href="./view-application?id=<?=$uuid?>"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></a></td>
            </tr>
        <?php }} ?>
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