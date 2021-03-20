<?php include '../layout/navbar.php';

// Grabs all messages sent by staff member and outputs as a JSON array.
$connection = $link;
$id = $_SESSION['id'];
$sql3 = "SELECT * FROM messages WHERE sender=$id";
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
    <h5><b>Messages</b></h5><a href="create-message"><button class="btn btn-primary my-2 my-sm-0" type="submit" value="role_name_update">Send Message</button></a>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Date</th>
            <th scope="col">Subject</th>
            <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data3 as $apidata3){
                    //JSON is parsed and displayed.
                    $uuid = $apidata3->uuid;
                    $timestamp = $apidata3->timestamp;
                    $subject = $apidata3->subject; ?>
                <tr>
                    <th scope="row"><?=$timestamp?></th>
                    <td><?=$subject?></td>
                    <td><a href="../recruit/view-message?id=<?=$uuid?>"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></a></td>
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