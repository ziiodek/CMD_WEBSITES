<br>
<br>
<?php
include '../PHP/BLOG.php';
$blog_manager = new Blog();
$blog_manager->printBlogControlPanelEditForm($_GET['id']); 

?>
<br>
<br>
