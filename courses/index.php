<?php 
include '../layout/navbar.php';
require_once "../controllers/config.php";

$connection = $link;
//ORDER BY RAND() 
$sql3 = "select * from courses LIMIT 3";
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
      <div class="col-md-4 mt-2">
        <div class="card mb-2 mt-2" style="width: 18rem;">
            <img class="card-img-top" height=190px style="object-fit:cover;" src="../assets/card.jpg" alt="Card image cap">
            <div class="card-body" style="min-height:250px">
                <h5 class="card-title">Level 3 Extended Diploma in Computing</h5>
                <p class="card-text">You’d like to program a voice-based application that lets people do their banking through their Amazon Echo?</p>
                <a href="course?id=1" class="btn btn-primary">More Information</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-2">
        <div class="card mb-2 mt-2" style="width: 18rem;">
            <img class="card-img-top" height=190px style="object-fit:cover;" src="https://www.calderdale.ac.uk/wp-content/uploads/2020/08/Homepage-FE.png" alt="Card image cap">
            <div class="card-body" style="min-height:250px">
                <h5 class="card-title">Computing and IT – Level 1</h5>
                <p class="card-text">BTEC Level 1 Certificate for IT Users & Work Skills</p>
                <a href="courses/course?id=2" class="btn btn-primary">More Information</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-2">
        <div class="card mb-2 mt-2" style="width: 18rem;">
            <img class="card-img-top" height=190px style="object-fit:cover;" src="https://www.calderdale.ac.uk/wp-content/uploads/2020/05/homepage-14-16.png" alt="Card image cap">
            <div class="card-body" style="min-height:250px">
                <h5 class="card-title">Computer Systems & Networks – Level 3</h5>
                <p class="card-text">BTEC Level 3 National Extended Diploma in Computer Systems and Data Analysis (Business Information Systems)</p>
                <a href="courses/course?id=3" class="btn btn-primary">More Information</a>
            </div>
        </div>
    </div>
  </div>
  </div>
</div>
<?php include '../layout/footer.php';?>
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