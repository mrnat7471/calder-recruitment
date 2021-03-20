<?php 
include 'navbar.php';
?>
<div class="home-background">
    <div class="home-background-text">
        <h4><b>Welcome to the Calderdale College Recruitment Center!</b></h4>
    </div>
</div>
<div class="container">
    <div class="row" style="margin:auto;">
      <div class="col-md-4 mt-2">
        <div class="card mb-2 mt-2" style="width: 18rem;">
            <img class="card-img-top" height=190px style="object-fit:cover;" src="../assets/card.jpg" alt="Card image cap">
            <div class="card-body" style="min-height:250px">
                <h5 class="card-title">Level 3 Extended Diploma in Computing</h5>
                <p class="card-text">You’d like to program a voice-based application that lets people do their banking through their Amazon Echo?</p>
                <a href="courses/course?id=1" class="btn btn-primary">More Information</a>
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
<?php include 'layout/footer.php';?>
<style>
.home-background{
    background-image: url("assets/banner.jpg");
    background-position: 50%;
    background-repeat: no-repeat;
    background-size: cover;
    min-height:250px;
}
.home-background-text{
    margin-left:55px;
    margin-right:55px;
    padding-top:70px;
    color:black;
    text-align:center;
}
</style>