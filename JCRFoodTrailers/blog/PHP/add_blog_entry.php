<?php
$title = $_POST['title'];
$url_title = str_replace(" ","_",$_POST['title']);
$url_title = str_replaCE("?","_",$url_title);
$introduction = $_POST['introduction'];
$text1 = $_POST['text1'];
$text2 = $_POST['text2'];
$text3 = $_POST['text3'];



include 'BLOG.php';
$blog_manager = new Blog();
$blog_manager->addBlogEntry($title,$introduction,$text1,$text2,$text3,$url_title);


header('Location: ../control/ADD_BLOG_IMAGE.php?title='.$title);
?>
