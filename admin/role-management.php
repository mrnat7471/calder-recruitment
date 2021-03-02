<?php include '../navbar.php'; ?>
<div class="role-content">
    <h5><b>Role Management:</b></h5>
<?php
require_once "./controllers/config.php";

if(isset($_SESSION['id'])){
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
        $roleID = $apidata->uuid;
        $roleName = $apidata->name;?>
        <h5><?=$roleName?>: (<a href="manage-role?id=<?=$roleID?>">Manage</a>)</h5> 
        <ul>
        <?php
        $connection = $link;
        $sql2 = "select * from roles_permissions where role_id = $roleID";
        $result2 = mysqli_query($connection, $sql2) or die("Error in Selecting " . mysqli_error($connection));
        $emparray2 = array();
        while($row2 =mysqli_fetch_assoc($result2))
        {
            $emparray2[] = $row2;
        }
        $apidata2 = json_encode($emparray2);
        $data2 = json_decode($apidata2);
        
        //Check roles permissions
        foreach($data2 as $apidata2){
            $roleID2 = $apidata2->permission_id;
            $sql3 = "select * from permissions where uuid = $roleID2";
            $result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
            $emparray3 = array();
            while($row3 =mysqli_fetch_assoc($result3))
            {
                $emparray3[] = $row3;
            }
            $apidata3 = json_encode($emparray3);
            $data3 = json_decode($apidata3);

            
            foreach($data3 as $apidata3){
                $slug = $apidata3->slug;
                $name = $apidata3->name;
                echo '<li>' . $name . '</li>';
            }
        }
        echo '</ul>';
    }
}else{
    header();
}

?>
</div>
<?php include '../footer.php';?>
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