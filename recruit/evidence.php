<?php include '../layout/navbar.php';?>
<div class="content">
<h5><b>Qualifications Evidence:</b></h5>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Date/Time</th>
            <th scope="col">Document Type:</th>
            <th scope="col">Attachment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">18/03/2020 16:24:04</th>
                <td>GCSE Qualification Results</td>
                <td><a href="../assets/results/results.pdf" target="_blank">Results.pdf</a></td>
            </tr>
        </tbody>
    </table>
    <h5><b>Upload your qualifications evidence:</b></h5>
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8"><br><br>
                <div class="form-group">
                    <form>
                        <label for="postcode">Evidence Type?</label><br>
                        <select name="cars" class="form-control" required>
                            <option value="GCSE">GCSE Qualification Results</option>
                            <option value="ID">Identification Documents</option>
                            <option value="BEN">Benefit/Fee Reduction Evidence</option>
                        </select><br>
                        <div class="input-group">
                            <input type="text" class="form-control" readonly>
                            <div class="input-group-btn">
                                <span class="fileUpload btn btn-info">
                                    <span class="upl" id="upload">Upload evidences file</span>
                                    <input type="file" class="upload up" name="images" id="up" onchange="readURL(this);" multiple required/>
                                </span>
                            </div>
                        </div><br>
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
$(document).on('change','.up', function(){
        var names = [];
        var length = $(this).get(0).files.length;
          for (var i = 0; i < $(this).get(0).files.length; ++i) {
              names.push($(this).get(0).files[i].name);
          }
          // $("input[name=file]").val(names);
        if(length>2){
          var fileName = names.join(', ');
          $(this).closest('.form-group').find('.form-control').attr("value",length+" files selected");
        }
        else{
          $(this).closest('.form-group').find('.form-control').attr("value",names);
        }
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

.it .btn-orange
{
  background-color: blue;
  border-color: #777!important;
  color: #777;
  text-align: left;
  width:100%;
}
.it input.form-control
{
  
  border:none;
  margin-bottom:0px;
  border-radius: 0px;
  border-bottom: 1px solid #ddd;
  box-shadow: none;
}
.it .form-control:focus
{
  border-color: #ff4d0d;
  box-shadow: none;
  outline: none;
}
.fileUpload {
    position: relative;
    overflow: hidden;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>