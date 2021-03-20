<?php include '../layout/navbar.php';

if(isset($_POST['type'])){
    // Uploads evidence to folder.
    $target_dir = "../assets/results/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $uploadOk == 1;
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $file_name = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
        $owner = $_SESSION['id'];
        $type = $_POST['type'];
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Adds evidence to database of evidences so users can find it.
        $sql = "INSERT INTO evidences (profile_id, doc_type, file_name) VALUES ('$owner', '$type', '$file_name')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Evidence uploaded";
        } else {
            $danger_message = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }
}
$connection = $link;
$owner = $_SESSION['id'];
$sql3 = "SELECT * FROM evidences WHERE profile_id = '$owner'";
$result3 = mysqli_query($connection, $sql3) or die("Error in Selecting " . mysqli_error($connection));
$emparray3 = array();
while($row3 =mysqli_fetch_assoc($result3))
{
    $emparray3[] = $row3;
}
$apidata3 = json_encode($emparray3);
$data3 = json_decode($apidata3);
?>
<div class="content">
<h5><b>Qualifications Evidence:</b></h5>
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
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Date/Time</th>
            <th scope="col">Document Type:</th>
            <th scope="col">Attachment</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($data3 as $apidata3){
            $timestamp = $apidata3->timestamp;
            $doc_type = $apidata3->doc_type;
            $file_name = $apidata3->file_name; ?>
            <tr>
                <th scope="row"><?=$timestamp?></th>
                <td><?=$doc_type?></td>
                <td><a href="../assets/results/<?=$file_name?>" target="_blank">Download</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <br><h5><b>Upload your qualifications evidence:</b></h5>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <div class="form-group">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="type">Evidence Type?</label><br>
                        <select name="type" class="form-control" required>
                            <option value="GCSE Qualification Results">GCSE Qualification Results</option>
                            <option value="Identification Documents">Identification Documents</option>
                            <option value="Benefit/Fee Reduction Evidence">Benefit/Fee Reduction Evidence</option>
                        </select><br>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        
                        <button class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php';?>
<script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<style>
.content{
    margin-left:250px;
    margin-right:250px;
    margin-top:30px;
}
@media(max-width:500px){
    .content{
        margin-left:15px!important;
        margin-right:15px;
        margin-top:10px;
    }
}

.file-upload input[type='file'] {
  display: none;
}
.rounded-lg {
  border-radius: 1rem;
}

.custom-file-label.rounded-pill {
  border-radius: 50rem;
  background-color: white;
  color:black;
}

.custom-file-label.rounded-pill::after {
  border-radius: 0 50rem 50rem 0;
  background-color: white;
  color:black;
}
</style> 