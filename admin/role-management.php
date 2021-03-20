<?php include '../layout/navbar.php'; ?>
<div class="role-content">
<?php if($ROLE_MANAGE == 1){ ?>
    <h5><b>Role Management:</b> <a href="create-role"><button class="btn btn-primary my-2 my-sm-0">Create Role</button></a></h5>
<?php
require_once "../controllers/config.php";

if(isset($_SESSION['id'])){
    // Grabs all roles from roles database and outputs JSON array.
    $connection = $link;
    $sql = "select uuid, name from roles";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));
    $emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
    $apidata = json_encode($emparray);
    $data = json_decode($apidata);
    
    //Check all Users Roles
    foreach($data as $apidata){
        $connection = $link;
        $roleID = $apidata->uuid;
        $roleName = $apidata->name;?>
        <?php if($roleID == 0 || $roleID == 1 || $roleID == 18){ ?>
            <h5><?=$roleName?></h5> 
        <?php }else{ ?>
            <h5><?=$roleName?> (<a href="manage-role?id=<?=$roleID?>">Manage</a>)</h5> 
        <?php } ?>
    <?php }
}
?>
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