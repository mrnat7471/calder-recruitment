<?php include '../layout/navbar.php';?>
<div class="content">
    <h5><b>Your Application</b></h5>

    <h6>Qualifications</h6>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Subject</th>
            <th scope="col">Qualifications</th>
            <th scope="col">Grade</th>
            <th scope="col">Year</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">AQA Level 1/Level 2 GCSE (9-1) in English Language</th>
                <td>GCSE (9 to 1)</td>
                <td>4</td>
                <td>2019</td>
            </tr>
            <tr>
                <th scope="row">AQA Level 1/Level 2 GCSE (9-1) in Combined Science: Trilogy</th>
                <td>GCSE (9 to 1)</td>
                <td>44 (P)</td>
                <td>2021</td>
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