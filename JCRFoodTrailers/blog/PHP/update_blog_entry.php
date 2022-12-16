<?php
$id = $_POST['id'];
$title = $_POST['title'];
$title_url = str_replace(" ","_",$_POST['title']);
$title_url = str_replace("?","_",$title_url);
$introduction = $_POST['introduction'];
$text1 = $_POST['text1'];
$text2 = $_POST['text2'];
$text3 = $_POST['text3'];



include 'BLOG.php';
$blog_manager = new Blog();
$blog_manager->updateBlogEntry($id,$title,$introduction,$text1,$text2,$text3,$title_url);


header('Location: ../control/BLOG_VIEW.php?id='.$id);
?>
