<br>
<br>
<div class="container" id='section2'>

<?php
echo "<form action='../PHP/add_blog_entry_image.php?title=".$_GET['title']."' method='post' enctype='multipart/form-data'>";
?>
<h2>Add Blog Entry Image</h2>
<br>
<input type="file" name="img" >
<br>
<br>
<button type="submit" class="btn btn-primary">Add Image</button>

</form>

<br>
</div>
<br>
<br>