<?php  
require_once "../controllers/config.php";

$roleName = "";

if(isset($_POST['role_name'])){
  // Adds new role to roles table.
  $roleName = $_POST['role_name'];
  $roleslug = strtoupper($roleName);

  $sql = "INSERT INTO roles (name, slug)
  VALUES ('$roleName', '$roleslug')";

  if ($conn->query($sql) === TRUE) {

  } else {
      $danger_message = "Error updating record: " . $conn->error;
  }
  $conn->close();
  header("Location: ./role-permissions?name=" . $roleName . "&success=Role has been created. Please manage your permissions.");

}

if(isset($post)){
  // Checks permission given to role.
  if(isset($_POST['ADMIN_READ'])){
    $ADMIN_READ = 1;
  }else{
    $ADMIN_READ = 0;
  }
  if(isset($_POST['APPLICANT_READ'])){
    $APPLICANT_READ = 1;
  }else{
    $APPLICANT_READ = 0;
  }
  if(isset($_POST['ROLE_MANAGE'])){
    $ROLE_MANAGE = 1;
  }else{
    $ROLE_MANAGE = 0;
  }
  if(isset($_POST['USER_ROLE_MANAGE'])){
    $USER_ROLE_MANAGE = 1;
  }else{
    $USER_ROLE_MANAGE = 0;
  }

  // Adds the roles permission to the role permission table.
  $sql = "INSERT INTO roles_permissions (role_id, ADMIN_READ, APPLICANT_READ, ROLE_MANAGE, USER_ROLE_MANAGE)
  VALUES ('$roleUUID', '$ADMIN_READ', '$APPLICANT_READ', '$ROLE_MANAGE', '$USER_ROLE_MANAGE')";

  if ($conn2->query($sql) === TRUE) {
    $success_message = "Role permissions have been set.";
  } else {
      $danger_message = "Error updating record: " . $conn->error;
  }
  $conn2->close();
}

include '../layout/navbar.php'; ?>

<div class="role-content">
<?php if($ROLE_MANAGE == 1){ ?>
  <h5><b>Role Management:</b></h5>
      <form method="POST">
    <div class="row">
      <div class="col">
        <label>Name:</label>
        <input class="form-control" type="text" id="text" name="role_name" value="<?= $roleName ?>" required><br>
      </div>
    </div>
    <br><button class="btn btn-primary my-2 my-sm-0" type="submit">Create</button>
  </form>
<?php }else{ ?>
  <h6>You don't have permission to go there. </h6>
<?php }  ?>  
</div>

<?php include '../layout/footer.php';?>
<style>
.role-content{
    margin-left:250px;
    margin-right:250px;
    margin-top:30px;
}
@media(max-width:500px){
    .role-content{
        margin-left:15px!important;
        margin-right:15px;
        margin-top:10px;
    }
}
.switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
  }
  
  .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
  }
  
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
  }
  
  .slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
  }
  
  input:checked + .slider {
    background-color: rgb(47, 153, 138);
  }
  
  input:focus + .slider {
    box-shadow: 0 0 1px rgb(47, 153, 138);
  }
  
  input:checked + .slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
  }
  
  /* Rounded sliders */
  .slider.round {
    border-radius: 34px;
  }
  
  .slider.round:before {
    border-radius: 50%;
  }
</style>
