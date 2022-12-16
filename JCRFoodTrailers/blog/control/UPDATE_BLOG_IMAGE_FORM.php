<br>
<br>
<div class="container" id='section2'>

<?php
echo "<form action='../PHP/update_blog_entry_image.php?id=".$_GET['id']."' method='post' enctype='multipart/form-data'>";
?>
<h2>Add Blog Entry Image</h2>
<br>
<?php
echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
?>
<input type="file" name="img" >
<br>
<br>
<button type="submit" class="btn btn-primary">Add Image</button>

</form>

<br>
</div>
<br>
<br>