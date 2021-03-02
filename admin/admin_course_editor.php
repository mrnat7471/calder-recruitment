<?php include 'layout/navbar.php';
$name = "";
$content = "";
?>
<form method="post" action='../controllers/updater.php'>
    <input type="hidden" name="page" value="<?=$name?>">
    <h1 class="h2 mb-4">Edit the <?php echo $name?> page here:</h1>
    <div class="form-group">
        <textarea id="editor" style="height:500px;width:100%" name="content"><?php echo $content ?></textarea>
        <button type="submit" class="btn btn-primary">Edit</button>
    </div>
</form>

<script src="https://cdn.tiny.cloud/1/pipdgmsou66d41xkafxem7ri5owqu7f6rgv3n1z7h33b2opi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#editor',
	skin: "oxide-dark",
	content_css: "dark",
    plugins: 'lists, link, image, media, code',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help code',
    menubar: false
  });
</script>
<?php include 'layout/footer.php';?>
<style>
    .form-group{
        margin-left:150px;
        margin-right:150px;
    }
    @media(max-width:500px){
        .form-group{
            margin-left:15px;
            margin-right:15px;
        }
    }
</style>