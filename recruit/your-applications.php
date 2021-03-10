<?php include '../layout/navbar.php';$progress = 1;?>
<div class="content">
    <h5><b>Your Applications</b></h5><br>
    <h6>Track your application process</h6>
    <p>You can track your application below. For full details, check your messages for latest information.</p>
    <div class="progress" style="height: 15px;">
        <div class="progress-bar 
            <?php if($progress === 0) {echo "w-10 bg-danger";}
            elseif($progress === 1){echo "w-25 bg-warning";}
            elseif($progress === 2){echo "w-50 bg-warning";}
            elseif($progress === 3){echo "w-75 bg-info";}
            elseif($progress === 4){echo "w-100 bg-success";}
            else{echo "w-0 bg-danger";} ?>" role="progressbar" 
            style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <?php if ($progress === 0) {echo "15%";}
                elseif($progress === 1){echo "25%";}
                elseif($progress === 2){echo "50%";}
                elseif($progress === 3){echo "75%";}
                elseif($progress === 4){echo "100%";}
                else{echo "Unknown";} 
            ?>
        </div>
    </div>
    <p style="text-align:center">
        <?php if ($progress === 0) {echo "15% - Apply today!";}
            elseif($progress === 1){echo "25% - We be in contact soon!";}
            elseif($progress === 2){echo "50% - You got an offer!";}
            elseif($progress === 3){echo "75% - Enrolment";}
            elseif($progress === 4){echo "100% - See you in September!";}
            else{echo "Unknown";} 
        ?>
    </p>
    <br><br>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Course</th>
            <th scope="col">Status</th>
            <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Level 3 Computing</td>
                <td>Under Review</td>
                <td><a href="view-application?id=2"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></a></td>
            </tr>
        </tbody>
    </table>
</div>
<?php include '../layout/footer.php';?>
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
</style>