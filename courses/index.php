<?php 
include '../navbar.php';
require_once "../config.php";

$connection = $link;
$sql3 = "select * from courses ORDER BY RAND() LIMIT 3";
$result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
$emparray3 = array();
while($row3 =mysqli_fetch_assoc($result3))
{
    $emparray3[] = $row3;
}
$apidata3 = json_encode($emparray3);
$data3 = json_decode($apidata3);
?>
<div class="course-background">
    <div class="course-background-text">
        <h4><b>Find your perfect course!</b></h4>
    </div>
</div>
<div class="container">
  <div class="row" style="width:82%;margin:auto;">
  <?php foreach($data3 as $apidata3){
    $name = $apidata3->name;
    $summary = $apidata3->summary;
    $uuid = $apidata3->uuid;
    $image = $apidata3->image; ?>
    <div class="col-md-4 mt-2">
        <div class="card mb-2 mt-2" style="width: 18rem;">
            <img class="card-img-top" height=190px style="object-fit:cover;" src="<?=$image?>" alt="Card image cap">
            <div class="card-body" style="min-height:250px">
                <h5 class="card-title"><?=$name?></h5>
                <p class="card-text"><?=$summary?></p>
                <a href="course?id=<?=$uuid?>" class="btn btn-primary">More Information</a>
            </div>
        </div>
    </div>
<?php } ?>
  </div>
</div>
<?php include '../footer.php';?>
<style>
.course-background{
    background-image: url("https://www.calderdale.ac.uk/wp-content/uploads/2021/01/march-open-day.jpg");
    background-position: 50%;
    min-height:250px;
}
.course-background-text{
    margin-left:55px;
    margin-right:55px;
    padding-top:70px;
    color:black;
    text-align:center;
}
</style>