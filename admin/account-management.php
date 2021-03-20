<?php 
include '../layout/navbar.php';
require_once "../controllers/config.php";

$search = "";
$roleSearch = "";

// Updates the selected accounts role.
if(isset($_POST['role'])){
    $setrole = $_POST['role'];
    $useruuid = $_POST['id'];
    $sql = "UPDATE users SET user_role='$setrole' WHERE uuid=$useruuid";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Role has been updated.";
    } else {
        $danger_message = "Error updating record: " . $conn->error;
    }
$conn->close();
}

// Deletes selected account.
if(isset($_GET['delete_account'])){
    $useruuid = $_GET['id'];
    $sql = "DELETE FROM users WHERE uuid=$useruuid";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Account has been deleted.";
    } else {
        $danger_message = "Error updating record: " . $conn->error;
    }

$conn->close();
}

// Gets a array of roles from roles table.
$connection = $link;
$sql2 = "select * from roles";
$result2 = mysqli_query($connection, $sql2) or die("Error in Selecting " . mysqli_error($connection));
$emparray2 = array();
while($row2 =mysqli_fetch_assoc($result2))
{
    $emparray2[] = $row2;
}
$apidata2 = json_encode($emparray2);
$data2 = json_decode($apidata2);

// Search for user by lastName
if(isset($_GET['search'])){
    $connection = $link;
    $search = $_GET['search'];
    $sql3 = "select * from users where lastName like '%$search%'";
    $result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
    $emparray3 = array();
    while($row3 =mysqli_fetch_assoc($result3))
    {
        $emparray3[] = $row3;
    }
    $apidata3 = json_encode($emparray3);
    $data3 = json_decode($apidata3);

    //Search for users by role
}elseif(isset($_GET['search_role'])){
    $connection = $link;
    $roleSearch = $_GET['search_role'];
    $sql3 = "SELECT * FROM users WHERE user_role = '$roleSearch'";
    $result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
    $emparray3 = array();
    while($row3 =mysqli_fetch_assoc($result3))
    {
        $emparray3[] = $row3;
    }
    $apidata3 = json_encode($emparray3);
    $data3 = json_decode($apidata3);

    //Gets all users.
}else{
    $connection = $link;
    $sql3 = "select * from users";
    $result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
    $emparray3 = array();
    while($row3 =mysqli_fetch_assoc($result3))
    {
        $emparray3[] = $row3;
    }
    $apidata3 = json_encode($emparray3);
    $data3 = json_decode($apidata3);
}
?>
<div class="role-content">
<?php if($USER_ROLE_MANAGE == 1){ ?>
<div class="row">
    <div class="col">
        <form class="form-inline my-2 my-lg-0 search">
            <input class="form-control mr-sm-2" type="search" placeholder="Search by last name" name="search" aria-label="Search" value="<?=$search?>" required>
        </form>
    </div>
    <div class="col">
        <form method="GET">
            <div class="row">
                <div class="col-sm-6">
                    <select name="search_role" class="form-control" style="width:150px;">
                    <?php foreach($data2 as $apidata2){
                        $uuid = $apidata2->uuid;
                        $name = $apidata2->name;
                    ?>
                        <option value="<?=$uuid?>" <?php if($roleSearch == $uuid){ echo 'selected="selected"';}?>><?=$name?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="col">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First Name:</th>
      <th scope="col">Last Name:</th>
      <th scope="col">Email:</th>
      <th scope="col">Role:</th>
      <th scope="col">Delete:</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($data3 as $apidata3){
        $uuid = $apidata3->uuid;
        $firstName = $apidata3->firstName;
        $lastName = $apidata3->lastName;
        $email = $apidata3->email;
        $verified = $apidata3->verified;
        $user_role = $apidata3->user_role; 

        $stmt = $link->prepare("SELECT name FROM roles WHERE uuid = $user_role");
        $stmt->execute();
        $stmt->bind_result($roleName);
        $stmt->fetch(); 
        $stmt->close();
    ?>
    <tr>
        <th scope="row"><?=$uuid?></th>
        <td><?=$firstName?></td>
        <td><?=$lastName?></td>
        <td><?=$email?> (<?php if($verified == 1){ echo 'Verified';}else{echo 'Un-verified';}?>)</td>
        <td>
            <form method="POST">
                <div class="row">
                    <div class="col-sm-5">
                        <input type="text" name="id" value="<?=$uuid?>" style="display:none;">
                        <select name="role" class="form-control" style="width:100px;">
                        <?php foreach($data2 as $apidata2){
                            $uuid = $apidata2->uuid;
                            $name = $apidata2->name;
                        ?>
                            <option value="<?=$uuid?>" <?php if($user_role == $uuid){ echo 'selected="selected"';}?>><?=$name?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="col">
                        <input class="btn btn-primary" type="submit" value="Update">
                    </div>
                </div>
            </form>
      </td>
      <td>
        <form method="GET">
            <input type="text" name="delete_account" value="true" style="display:none;">
            <input type="text" name="id" value="<?=$uuid?>" style="display:none;">
            <button class="btn btn-primary my-2 my-sm-0" type="submit" value="delete_account">Delete</button>
        </form>
      </td>
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
</style>