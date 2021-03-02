<?php
$id = NULL;

require_once "config.php";

if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
}

if($id){
    $connection = $link;
    $sql = "select * from user_roles where user_id = $id";
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
        $roleID = $apidata->role_id;
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
            
            //Check permission
            foreach($data3 as $apidata3){
                $slug = $apidata3->slug;
                
                if($slug === "ADMIN_READ"){
                    $ADMIN_READ = 1;
                }
                if($slug === "APPLICANT_READ"){
                    $APPLICANT_READ = 1;
                }
                if($slug === "ROLE_MANAGE"){
                    $ROLE_READ = 1;
                }
                if($slug === "USER_ROLE_MANAGE"){
                    $USER_ROLE_WRITE = 1;
                }
            }
        }
    }
}

?>