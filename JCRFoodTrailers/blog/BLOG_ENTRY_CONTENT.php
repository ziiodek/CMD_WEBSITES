<?php
include 'PHP/BLOG.php';
$blog_manager = new Blog();
$blog_manager->printBlog($_GET['title']);


?>




