<?php
$search = "";
include '../layout/navbar.php';
if(isset($_GET['search'])){
    // Grabs courses from search
    $connection = $link;
    $search = $_GET['search'];
    $sql3 = "select * from courses where name like '%$search%'";
    $result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
    $emparray3 = array();
    while($row3 =mysqli_fetch_assoc($result3))
    {
        $emparray3[] = $row3;
    }
    $apidata3 = json_encode($emparray3);
    $data3 = json_decode($apidata3);
}else{
    header("Location: ../");
}
?>
<div class="mt-2">
    <form action="#" class="ml-2 mr-2">
    <label for="email">Search:</label>
        <input type="text" id="password" name="search" value="<?=$search?>" required>
        <input type="submit" value="Search">
    </form>
    <h4 class="pb-2 ml-2 mr-2" style="border-bottom: 5px solid rgb(47, 153, 138);">Search Result for "<?= $search ?>"</h4>
    <?php
    foreach($data3 as $apidata3){
        $name = $apidata3->name;
        $summary = $apidata3->summary;
        $uuid = $apidata3->uuid; ?>
    <div class="ml-2 mr-2 pb-2 mt-2" style="border-bottom: 2px solid rgb(47, 153, 138);">
        <a href="course?id=<?=$uuid?>"><?= $name ?></a><br>
    </div>
</div>
<?php } include '../layout/footer.php';?>