<?php  
require_once "../controllers/config.php";

if(isset($_GET['delete_id'])){
  // Deletes selected role from roles table and role_permissions table.
  $roleuuid = $_GET['delete_id'];
  $sql = "DELETE FROM roles WHERE uuid=$roleuuid";

  if ($conn->query($sql) === TRUE) {
  } else {
      $danger_message = "Error updating record: " . $conn->error;
  }

  $sql = "DELETE FROM roles_permissions WHERE role_id=$roleuuid";

  if ($conn->query($sql) === TRUE) {
      header("Location: ./role-management?success=Role has been deleted.");
  } else {
      $danger_message = "Error updating record: " . $conn->error;
  }
}
  if(isset($_GET['role_update'])){
    // Updates the roles permissions in the database.
    $role_id = $_GET['id'];
    if(isset($_GET['ADMIN_READ'])){
      $ADMIN_READ = 1;
    }else{
      $ADMIN_READ = 0;
    }
    if(isset($_GET['APPLICANT_READ'])){
      $APPLICANT_READ = 1;
    }else{
      $APPLICANT_READ = 0;
    }
    if(isset($_GET['ROLE_MANAGE'])){
      $ROLE_MANAGE = 1;
    }else{
      $ROLE_MANAGE = 0;
    }
    if(isset($_GET['USER_ROLE_MANAGE'])){
      $USER_ROLE_MANAGE = 1;
    }else{
      $USER_ROLE_MANAGE = 0;
    }
  
    $sql = "UPDATE roles_permissions SET ADMIN_READ='$ADMIN_READ', APPLICANT_READ='$APPLICANT_READ',
    ROLE_MANAGE='$ROLE_MANAGE', USER_ROLE_MANAGE='$USER_ROLE_MANAGE' WHERE role_id=$role_id";
  
    if ($conn->query($sql) === TRUE) {
      $success_message = "Permissions has been updated.";
    } else {
      $danger_message = "Error updating record: " . $conn->error;
    }
  
    $conn->close();
  }

if(isset($_GET['role_name'])){
  // Updates the role name in the roles database.
  $role_name = $_GET['role_name'];
  $role_id = $_GET['id'];
  
  $sql = "UPDATE roles SET name='$role_name' WHERE uuid=$role_id";

  if ($conn->query($sql) === TRUE) {
    $success_message = "Role name has been updated.";
  } else {
    $danger_message = "Error updating record: " . $conn->error;
  }

  $conn->close();
}
?>


<?php include '../layout/navbar.php'; 
// Grabs role name from roles database.
$roleID = $_GET['id'];
$stmt = $link->prepare("SELECT name FROM roles WHERE uuid = $roleID");
$stmt->execute();
$stmt->bind_result($roleName);
$stmt->fetch(); 
$stmt->close();

// Grabs role permissions from roles_permissions database.
$stmt = $link->prepare('SELECT * FROM roles_permissions WHERE role_id = ?');
$stmt->bind_param('i', $roleID);
$stmt->execute();
$stmt->bind_result($uuid, $roleID, $ADMIN_READ, $APPLICANT_READ, $ROLE_MANAGE, $USER_ROLE_MANAGE);
$stmt->fetch();
$stmt->close();
?>

<div class="role-content">
<?php if($ROLE_MANAGE_2 == 1){ ?>
  <h5><b>Role Management:</b></h5>
    <div class="row">
      <div class="col">
        <form>
          <div class="row">
            <input type="text" name="id" value="<?=$roleID?>" style="display:none;">
            <div class="col"><input class="form-control" type="text" id="text" name="role_name" value="<?= $roleName ?>" required></div>
            <div class="col"><button class="btn btn-primary my-2 my-sm-0" type="submit" value="role_name_update">Update</button></div>
          </div>
        </form>
      </div>
      <div class="col">
      <form>
        <input type="text" name="id" value="<?=$roleID?>" style="display:none;">
        <input type="text" name="delete_id" value="<?=$roleID?>" style="display:none;">
        <button class="btn btn-primary my-2 my-sm-0" type="submit" value="Delete">Delete</button>
      </form>
      </div>  
    </div>
  

  <form>
    <input type="text" name="id" value="<?=$roleID?>" style="display:none;">
    <input type="text" name="role_update" value="true" style="display:none;">

    <div class="row">

      <div class="col">
        <h6>Administrator/read</h6>
        <label class="switch">
            <input type="checkbox" name="ADMIN_READ" value="true" <?php if($ADMIN_READ == "1"){echo 'Checked';}?>>
            <span class="slider round"></span>
        </label>
      </div>

      <div class="col">
        <h6>Applicant/read</h6>
        <label class="switch">
            <input type="checkbox" name="APPLICANT_READ" value="true" <?php if($APPLICANT_READ == "1"){echo 'Checked';}?>>
            <span class="slider round"></span>
        </label>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <h6>Role/manage</h6>
        <label class="switch">
            <input type="checkbox" name="ROLE_MANAGE" value="true" <?php if($ROLE_MANAGE == "1"){echo 'Checked';}?>>
            <span class="slider round"></span>
        </label>
      </div>

      <div class="col">
        <h6>User_role/manage</h6>
        <label class="switch">
            <input type="checkbox" name="USER_ROLE_MANAGE" value="true" <?php if($USER_ROLE_MANAGE == "1"){echo 'Checked';}?>>
            <span class="slider round"></span>
        </label>
      </div>
    </div>
    <br><br><button class="btn btn-primary my-2 my-sm-0" type="submit" value="perm_role_update">Update</button>
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
