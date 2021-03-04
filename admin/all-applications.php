<?php include '../layout/navbar.php';?>
<div class="content">
    <h5><b>All Applications</b></h5>
        <form method="GET">
            <div class="row" style="max-width:600px;">
                <div class="col" style="width:165px;">
                    <label>Staff: 
                    <select name="search_role" class="form-control" style="width:155px;">
                        <option value="test">All</option>
                        <option value="test">Unassigned</option>
                        <option value="test">Nathan Powell</option>
                    </select></label>
                </div>
                <div class="col" style="width:160px;">
                    <label>Status: 
                    <select name="search_role" class="form-control" style="width:150px;">
                        <option value="test">New</option>
                    </select></label>
                </div>
                <div class="col" style="width:200px;">
                    <label>Course: 
                    <select name="search_role" class="form-control" style="width:190px;">
                        <option value="test">Level 3 Computing</option>
                    </select></label>
                </div>
                <div class="col" style="width:40px;">
                    <label><br>
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Go</button>
                    </label>
                </div>
            </div>
        </form>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Course</th>
            <th scope="col">Status</th>
            <th scope="col">Claimed by</th>
            <th scope="col">Admin</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Raymond Holt</td>
                <td>Level 3 Computing</td>
                <td>Under Review</td>
                <td>N/A</td>
                <td><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Claim</button>
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Rosa Dias</td>
                <td>Level 2 IT</td>
                <td>Interview Stage</td>
                <td>Martyn Rosser</td>
                <td><button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Un-claim</button>
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">View</button></td>
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