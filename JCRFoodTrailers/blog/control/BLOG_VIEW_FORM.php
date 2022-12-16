<br>
<br>
<?php
include '../PHP/BLOG.php';
$blog_manager = new Blog();
$blog_manager->printBlogControlPanel($_GET['id']); 

?>
<br>
<br>
