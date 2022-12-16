<?php


$title = $_GET['title'];



include ('BLOG.php');


$img_url = '/var/www/html/ZIIODEK/blog/images/';
$img_public_url = 'https://www.ziiodek.com/blog/images/';
$blog_manager = new Blog();


   $filename = $_FILES['img']['name'];
  
    $blog_manager->addImage($title,$img_public_url.$filename);
   
   // Upload file
   move_uploaded_file($_FILES['img']['tmp_name'],$img_url.$filename);
  
    

header('Location: ../control/BLOG_ENTRIES.php');

?>
