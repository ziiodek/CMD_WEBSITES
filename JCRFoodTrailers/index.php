<?php
include 'components/head.php';
include 'components/Nav.php';
include 'components/Banner.php';
?>
   <div id="content" class="container">
   
   <?php
   
	if(!isset($_GET['content'])){
		echo "Sorry url could not be found";	
		}else{
	$content = "components/".ucfirst($_GET['content']).".php";
	include $content;
	
		if($content == "page"){
			if(!isset($_GET['id'])){
				echo "Sorry url could not be found";
			}
		}
	
	
	
		}
   ?>
   
   </div>
   
   
<?php
include 'components/foot.php';
?>
	
	


