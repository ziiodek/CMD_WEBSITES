<?php


$title = $_GET['title'];
$id = $_POST['id'];


include ('BLOG.php');

$img_url = '/var/www/html/ZIIODEK/blog/images/';
$img_public_url = 'https://www.ziiodek.com/blog/images/';
$blog_manager = new Blog();

	
	unlink($blog_manager->getImageUrl($id));

   
   $filename = $_FILES['img']['name'];
  
    $blog_manager->updateImage($id,$img_public_url.$filename);
   
   // Upload file
   move_uploaded_file($_FILES['img']['tmp_name'],$img_url.$filename);
  
    

header('Location: ../control/BLOG_EDIT.php?id='.$id);

?>
