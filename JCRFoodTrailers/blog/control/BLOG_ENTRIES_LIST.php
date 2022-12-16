<br>
<br>
<a href='ADD_BLOG.php'>Add new Blog Entry</a>
<br>
<br>
<?php
include '../PHP/BLOG.php';
$blog_manager = new Blog();
$blog_manager->printBlogListControlPanel(); 

?>
<br>
<br>
