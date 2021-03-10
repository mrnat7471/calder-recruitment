<?php include '../layout/navbar.php';?>
<div class="content">
    <h5><b>Your Messages</b></h5>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Date/Time</th>
            <th scope="col">Subject</th>
            <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">18/03/2020 16:24:04</th>
                <td>Interview Invitation</td>
                <td><a href="interview"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></a></td>
            </tr>
            <tr>
                <th scope="row">18/03/2019 16:24:04</th>
                <td>Induction Information</td>
                <td><a href="view-message?id=2"><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></a></td>
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