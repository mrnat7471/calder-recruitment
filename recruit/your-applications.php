<?php include '../layout/navbar.php';?>
<div class="content">
    <h5><b>Your Applications</b></h5>
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
                <td><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Level 2 IT</td>
                <td>Interview Stage</td>
                <td><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></td>
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