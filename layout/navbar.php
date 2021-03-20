<?php 

session_start(); 
require_once '../controllers/permission_checker.php';

// Destroys session when logout button is pushed.
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header('Location: ./');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="../assets/icon.png" type="image/png" sizes="16x16">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>Calderdale Recruitment</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgb(47, 153, 138);box-shadow: 0px 5px rgba(47, 153, 138, 0.4);">
  <a class="navbar-brand" href="../"><img src="https://nathan7471.xyz/img/lAco9/FaKaJOTe11.png/raw" style="max-width:100px;"></a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../">Home</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="../courses/">Courses</a>
      </li>

      <li class="nav-item dropdown">
      <?php if($PROGRESS >= 1){ ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Applications
        </a>
      <?php } ?>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../recruit/your-applications">Your Applications</a>
            <?php if($PROGRESS >= 3){ ?>
              <!--<a class="dropdown-item disabled" href="../recruit/enrolment">Enrolment</a>-->
              <a class="dropdown-item" href="../recruit/evidence">Evidence</a>
            <?php } ?>
          <div class="dropdown-divider"></div>
          <?php if($PROGRESS >= 2){ ?>
            <a class="dropdown-item" href="../recruit/interview">Interview</a>
          <?php } ?>
          <a class="dropdown-item" href="../recruit/messages">Messages</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <?php if($ADMIN_READ === 1){ ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administrator
        </a>
        <?php } ?>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="../admin/applications">Applications</a>
          <a class="dropdown-item" href="../admin/all-applications">All Applications</a>
          <a class="dropdown-item" href="../admin/your-applications">Applications assigned to you</a>
          <a class="dropdown-item" href="../admin/messages">Messages</a>
          <?php if($USER_ROLE_MANAGE === 1 || $ROLE_MANAGE === 1){?>
            <div class="dropdown-divider"></div>
            <?php if($USER_ROLE_MANAGE === 1){ ?>
            <a class="dropdown-item" href="../admin/account-management">Account Management</a>
            <?php } ?>
            <?php if($ROLE_MANAGE === 1){ ?>
            <a class="dropdown-item" href="../admin/role-management">Role Management</a>
            <?php } ?>
          <?php } ?>
        </div>
      </li>
      <?php if(isset($_SESSION['loggedin'])){ ?>
        <li class="nav-item">
        <a class="nav-link" href="../account"><i class="fas fa-user"></i> Account</a>
      </li>
        <li class="nav-item">
            <a class="nav-link" href="../?logout=true">Logout</a>
        </li>
      <?php } else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../account/login"><i class="fas fa-user"></i> Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../account/register"><i class="fas fa-user"></i> Register</a>
      </li>
      <?php } ?>
    </ul>
    <!--<form class="form-inline my-2 my-lg-0 search" action="../courses/search">
      <input class="form-control mr-sm-2" type="search" placeholder="Search for a course" name="search" aria-label="Search" required>
      <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
    </form>-->
  </div>
</nav>
<?php if(isset($_GET['success']) || isset($_GET['danger'])){ ?>
<div class="m-2">
    <?php if(isset($_GET['success'])){ ?>
    <div class="alert alert-success" role="alert">
        <?= $_GET['success']; ?>
    </div>
    <?php } if(isset($_GET['danger'])){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $_GET['danger']; ?>
    </div>
    <?php } ?>
</div>
<?php } ?>
<?php if(isset($success_message) || isset($danger_message)){ ?>
<div class="m-2">
    <?php if(isset($success_message)){ ?>
    <div class="alert alert-success" role="alert">
        <?= $success_message; ?>
    </div>
    <?php } if(isset($danger_message)){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $danger_message; ?>
    </div>
    <?php } ?>
</div>
<?php } ?>
<style>
    .nav-link{
        color:black!important;
    }
</style>
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<style>
@media(max-width:500px){
    .search{
        display:none;
    }
}
</style>