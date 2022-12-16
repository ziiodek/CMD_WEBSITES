<?php
class Review{
	
function addReview($review,$rate){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	
	
	
	  $query = "insert into reviews(review,rate) values(?,?);";
	   $stmt = $conn->prepare($query);
	  $stmt->bind_param('si',$review,$rate);
		$stmt->execute();
		$stmt->close();
		
}	
	


function updateReview($id,$review,$rate){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  	  
	 $query = "update reviews set review=?,rate=? where id=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('sii',$review,$rate,$id);
	 $stmt->execute();
	 $stmt->close(); 
}

function deleteReview($id){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	 $query = "delete from reviews where id=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('i',$id);
	 $stmt->execute();
	 $stmt->close(); 
	 	
}

function deleteAllReviews(){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	 $query = "delete from reviews;";
	 $stmt = $conn->prepare($query);
	 $stmt->execute();
	 $stmt->close(); 
	 	
}


function createReviewCard($review,$rate){


	echo " 
            <div class='card'>
              <div class='card-body'>
                <p class='card-text'>
                  ".$review."
                </p>
				".$this->printRateStarts($rate)."
              </div>
            </div>";	

}

function printRateStarts($rate){
	for($i=0;$i<$rate;$i++){
		echo "<i class='bi bi-star-fill'></i>";
	}
}
function printReviewList__mainPage(){
	include ('utilities.php');

	$conn = mysqli_connect($host,$user,$pass);


	if(! $conn ){
		die('Could not connect: ' . mysqli_error());
	 }
  mysqli_select_db($conn,$database);
  

	   
  $query = "select * from reviews;";
 $stmt = $conn->prepare($query);
  $stmt->execute();
   $result = $stmt->get_result();
	
	$counter=0;
	 while($row = $result->fetch_assoc()){
		
		echo "  <div class='carousel-item active'>
		<div class='container'>";
		
		$this->createReviewCard($row['review'],$row['rate']);
			echo "</div>
			</div>";			
	 }
	
}

function printReviewListControlPanel(){
		include ('utilities.php');


	
	
		$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
 
		   
	  $query = "select * from reviews;";
	 $stmt = $conn->prepare($query);
	  $stmt->execute();
	   $result = $stmt->get_result();
		
		
		 while($row = $result->fetch_assoc()){
			
			
			echo "<center>";
			echo "<div class='alert alert-primary'>";
			
			echo "<div class='row'>";
			echo "<div class='col-sm'>";
			echo $row['review'];
			echo "</div>";	
			echo "<div class='col-sm'>";
			echo "<a href='REVIEW_EDIT.php?id=".$row['id']."'>Edit</a>";
			echo "</div>";		
			echo "<div class='col-sm'>";
			echo "<a href='../php/delete_review.php?id=".$row['id']."'>delete entry</a>";
			echo "</div>";
			
			echo "</div>";
			
			
			echo "</div>";
			echo "</center>";
			
			
				

				
				
				
				
		 }
		  
		  
	  

	
	
}



function printReviewControlPanelEditForm($id){
	include ('utilities.php');
	

	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	  $query = "select * from reviews where id=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('i',$id);
	  $stmt->execute();
		 $result = $stmt->get_result();
		 $row = $result->fetch_assoc();
		 
		 
		 if($row != null){

			echo "<div class='container' id='section2'>";

			echo "<form action='../PHP/update_review.php' method='post'>";
            echo "<h2>Add Blog Entry</h2>";
			echo "<br>";
			echo "<input type='hidden' name='id' value='".$row['id']."'>";
			echo "<div class='form-group'>";
			echo "<label>Review</label>";
			echo "<input type='text' name='review' class='form-control' value='".$row['review']."'/></div>";
			echo "<br>";
			echo "</div>";
			echo "<div class='form-group'>";
			echo "<label>Rate</label>";
			echo "<input type='number' name='rate' class='form-control' value='".$row['rate']."'/></div>";
			echo "<br>";
			echo "</div>"
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