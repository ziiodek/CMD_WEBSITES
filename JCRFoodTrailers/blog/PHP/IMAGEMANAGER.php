<?php
class ImageManager{
	
function addBlogEntry($title,$introduction,$text1,$text2,$text3,$url_title){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	
	$date = date("d/m/Y");
	
	  $query = "insert into blog(title,introduction,text1,text2,text3,date,title_url) values(?,?,?,?,?,?,?);";
	   $stmt = $conn->prepare($query);
	  $stmt->bind_param('sssssss',$title,$introduction,$text1,$text2,$text3,$date,$url_title);
		$stmt->execute();
		$stmt->close();
		
		

	
}	
	

function addImage($title,$img_url){
		include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	
	$date = date("d/m/Y");
	
	  $query = "update blog set img=? where title=?;";
	   $stmt = $conn->prepare($query);
	  $stmt->bind_param('ss',$img_url,$title);
		$stmt->execute();
		$stmt->close();
	
	
	
	
	
}



function updateImage($id,$img_url){
		include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	
	$date = date("d/m/Y");
	
	  $query = "update blog set img=? where id=?;";
	   $stmt = $conn->prepare($query);
	  $stmt->bind_param('si',$img_url,$id);
		$stmt->execute();
		$stmt->close();
	
	
	
	
	
}

function updateBlogEntry($id,$title,$introduction,$text1,$text2,$text3,$url_title){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	  $date = date("d/m/Y");
	  
	 $query = "update blog set title=?,introduction=?,text1=?,text2=?,text3=?,date=?,title_url=? where id=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('sssssssi',$title,$introduction,$text1,$text2,$text3,$date,$url_title,$id);
	 $stmt->execute();
	 $stmt->close(); 
}

function deleteBlog($id){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	 $query = "delete from blog where id=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('i',$id);
	 $stmt->execute();
	 $stmt->close(); 
	 	
}

function deleteAllBlogs(){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	 $query = "delete from blog;";
	 $stmt = $conn->prepare($query);
	 $stmt->execute();
	 $stmt->close(); 
	 	
}
function getImageUrl($id){
	
		include ('utilities.php');


	
	
		$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
 
		   
	  $query = "select img from blog where id=?;";
	  $stmt = $conn->prepare($query);
	  $stmt->bind_param('i',$id);
	  $stmt->execute();
	   $result = $stmt->get_result();
		
		while($row = $result->fetch_assoc()){
			 
			 return $row['img'];
		 }
	
	
	
}



function createBlogCard($img,$title,$titleUrl,$summary){
	include "URLRESOLVER.php";
	$urlResolver = new UrlResolver();
	$urlBlog = $urlResolver->addCustomURLParameter("page","title",$titleUrl);
	echo " 
            <div class='card'>
              <img
                src='".$img."'
                class='card-img-top'
                alt='".$title."'
              />
              <div class='card-body'>
                <h5 class='card-title'>".$title."</h5>
				<br>
                <p class='card-text'>
                  ".$summary."
                </p>
                <a href='".$urlBlog."' class='btn btn-primary'>Continue Reading</a>
              </div>
            </div>";	

}
function printBlogList__mainPage(){
	include ('utilities.php');

	$conn = mysqli_connect($host,$user,$pass);


	if(! $conn ){
		die('Could not connect: ' . mysqli_error());
	 }
  mysqli_select_db($conn,$database);
  

	   
  $query = "select * from blog;";
 $stmt = $conn->prepare($query);
  $stmt->execute();
   $result = $stmt->get_result();
	
	$counter=0;
	 while($row = $result->fetch_assoc()){
		if($counter == 0){
		echo "  <div class='carousel-item active'>
		<div class='container'>
		  <div class='row'>
			<div class='col-lg-4'>";
			
		}
		$counter+=1;
		$this->createBlogCard($row['img'],$row['title'],$row['title_url'],$row['introduction']);
		if($counter==4){
			echo "</div>
			</div>
	  		</div>
	  		</div>";
			$counter=0;
		}	
			
	 }
	
}


function printBlogList(){
		include ('utilities.php');


	
	
		$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
 
		   
	  $query = "select * from blog;";
	 $stmt = $conn->prepare($query);
	  $stmt->execute();
	   $result = $stmt->get_result();
		
		
		 while($row = $result->fetch_assoc()){
			
			echo "<center>";
			echo "<div class='jumbotron bg-transparent' style='width:80%; overflow:hidden;'>";
			echo "<center><img src='".$row['img']."' style='width:80%;'/></center>";
		    echo "<br>";
			echo "<hr class='my-4'><br>";
			echo "<center>";
			echo " <h5 class='display-4'>".$row['title']."</h5><br>";
			echo "<p class='text-justify'>";
			echo $row['introduction'];
			echo "</p>";
			echo "</center>";
			echo "<a href='?content=page&title=".$row['title_url']."'><button type='button' class='btn btn-primary'>Continue Reading</button></a>";
			
			echo "</div>";
			echo "</center>";
			echo "<br>";
				

				
				
				
				
		 }
		  
		  
	  

	
	
}


function printBlogListControlPanel(){
		include ('utilities.php');


	
	
		$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
 
		   
	  $query = "select * from blog;";
	 $stmt = $conn->prepare($query);
	  $stmt->execute();
	   $result = $stmt->get_result();
		
		
		 while($row = $result->fetch_assoc()){
			
			
			echo "<center>";
			echo "<div class='alert alert-primary'>";
			
			echo "<div class='row'>";
			echo "<div class='col-sm'>";
			echo "<a href='BLOG_VIEW.php?id=".$row['id']."'>";
			echo $row['title'];
			echo "</a>";
			echo "</div>";
			echo "<div class='col-sm'>";
			echo "<img src='".$row['img']."' class='img-thumbnail'>";
			echo "</div>";
			
				echo "<div class='col-sm'>";
			echo "<a href='../php/delete_entry.php?id=".$row['id']."'>delete entry</a>";
			echo "</div>";
			
			echo "</div>";
			
			
			echo "</div>";
			echo "</center>";
			
			
				

				
				
				
				
		 }
		  
		  
	  

	
	
}


function printBlogControlPanel($id){
	include ('utilities.php');
	

	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	  $query = "select * from blog where id=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('i',$id);
	  $stmt->execute();
		 $result = $stmt->get_result();
		 $row = $result->fetch_assoc();
		 
		 
		 if($row != null){

			echo "<div class='container' id='section2'>";

			echo "<form action='../PHP/add_blog_entry.php' method='post'>";
            echo "<h2>Add Blog Entry</h2>";
			echo "<br>";
			echo "<a href='BLOG_EDIT.php?id=".$row['id']."'>Edit</a>";
			echo "<br>";
			echo "<br>";
			echo "<div class='form-group'>";
			echo "<label>Title</label>";
			echo "<input type='text' name='title' class='form-control' value='".$row['title']."' disabled/></div>";
			echo "<br>";
			echo "<div class='form-group'>";
			echo "<br>";
			echo "<label>Introduction</label>";
			echo "<textarea name='introduction' rows='4' cols='50' class='form-control' disabled />";
			echo $row['introduction'];
			echo "</textarea>";
			echo "</div>";
			echo "<br>";
			echo "<div class='form-group'>";
			echo "<br>";
			echo "<label>Paragraph</label>";
			echo "<textarea name='text1' rows='4' cols='50' class='form-control' disabled/>";
			echo $row['text1'];
			echo "</textarea>";
			echo "<br>";
			echo "<div class='form-group'>";
			echo "<br>";
			echo "<label>Paragraph</label>";
			echo "<textarea name='text2' rows='4' cols='50' class='form-control' disabled/>";
			echo $row['text2'];
			echo "</textarea>";
			echo "</div>";
			echo "<br>";
			echo "<div class='form-group'>";
			echo "<br>";
			echo "<label>Paragraph</label>";
			echo "<textarea name='text3' rows='4' cols='50' class='form-control' disabled/>";
			echo $row['text3'];
			echo "</textarea>";
			echo "</div>";
			echo "<br>";
			echo "</div>";
			echo "</form>";
			echo "<br>";
			echo "</div>";



		
			 
		
		}
	  
	
	
	
}



function printBlogControlPanelEditForm($id){
	include ('utilities.php');
	

	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	  $query = "select * from blog where id=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('i',$id);
	  $stmt->execute();
		 $result = $stmt->get_result();
		 $row = $result->fetch_assoc();
		 
		 
		 if($row != null){

			echo "<div class='container' id='section2'>";

			echo "<form action='../PHP/update_blog_entry.php' method='post'>";
            echo "<h2>Add Blog Entry</h2>";
			echo "<br>";
			echo "<input type='hidden' name='id' value='".$row['id']."'>";
			echo "<div class='form-group'>";
			echo "<label>Title</label>";
			echo "<input type='text' name='title' class='form-control' value='".$row['title']."'/></div>";
			echo "<br>";
			echo "<div class='form-group'>";
			echo "<br>";
			echo "<label>Introduction</label>";
			echo "<textarea name='introduction' rows='4' cols='50' class='form-control'>";
			echo $row['introduction'];
			echo "</textarea>";
			echo "</div>";
			echo "<br>";
			echo "<div class='form-group'>";
			echo "<br>";
			echo "<label>Paragraph</label>";
			echo "<textarea name='text1' rows='4' cols='50' class='form-control'>";
			echo $row['text1'];
			echo "</textarea>";
			echo "<br>";
			echo "<div class='form-group'>";
			echo "<br>";
			echo "<label>Paragraph</label>";
			echo "<textarea name='text2' rows='4' cols='50' class='form-control'>";
			echo $row['text2'];
			echo "</textarea>";
			echo "</div>";
			echo "<br>";
			echo "<div class='form-group'>";
			echo "<br>";
			echo "<label>Paragraph</label>";
			echo "<textarea name='text3' rows='4' cols='50' class='form-control'>";
			echo $row['text3'];
			echo "</textarea>";
			echo "</div>";
			echo "<br>";
			echo "</div>";
			echo "<br>";
			echo "<button type='Submit' class='btn btn-primary'>Save</button>";
			echo "</form>";
			echo "<br>";
			echo "<a href='UPDATE_BLOG_IMAGE.php?id=".$row['id']."'>Edit Image</a><br>";
			echo "<img src='".$row['img']."' class='img-fluid' style='width:50%;'>";
			
			echo "</div>";



		
			 
		
		}
	  
	
	
	
}


function printBlog($title_url){
	include ('utilities.php');
	

	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	  $query = "select * from blog where title_url=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('s',$title_url);
	  $stmt->execute();
		 $result = $stmt->get_result();
		 $row = $result->fetch_assoc();
		 
		 
		 if($row != null){

			echo "<div class='container-fluid' id='section2'>";
			echo "<center>";
			echo "<div class='jumbotron bg-transparent' style='width:80%; overflow:hidden;'>";
			echo "<center><img src='".$row['img']."' style='width:80%;'></center>";
			echo "<br>";
			echo "<hr class='my-4'><br>";
			echo "<center>";
			echo "<h5 class='display-4'>".$row['title']."</h5><br><br>";
			echo "<p class='text-justify'>";
			echo $row['text1'];
			echo "</p>";
	
			echo "<br>";
			
			echo "<p class='text-justify'>";
			echo $row['text2'];
			echo "</p>";
			echo "<br>";
			echo "<p class='text-justify'>";
			echo $row['text3'];
			echo "</p>";
			echo "</center>";
  
			
			echo "</div>";
			echo "</center>";
			echo "<br>";
			echo "</div>";



		
			 
		
		}
	  
	
	
	
}

}
?>