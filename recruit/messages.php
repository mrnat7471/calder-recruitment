<?php include '../layout/navbar.php';
$connection = $link;
$id = $_SESSION['id'];
// Grabs all messages sent to user.
$sql3 = "SELECT * FROM messages WHERE receiver=$id";
$result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
$emparray3 = array();
while($row3 =mysqli_fetch_assoc($result3))
{
    $emparray3[] = $row3;
}
$apidata3 = json_encode($emparray3);
$data3 = json_decode($apidata3);?>
<div class="content">
    <h5><b>Your Messages</b></h5>
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
                    $uuid = $apidata3->uuid;
                    $timestamp = $apidata3->timestamp;
                    $subject = $apidata3->subject; ?>
                <tr>
                    <th scope="row"><?=$timestamp?></th>
                    <td><?=$subject?></td>
                    <td><a href="view-message?id=<?=$uuid?>"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></a></td>
                </tr>
            <?php } ?>
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