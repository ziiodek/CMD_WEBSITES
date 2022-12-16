<?php
class Client{
	
function addClientEntry($text,$img){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	
	
	
	  $query = "insert into clients(text,img) values(?,?);";
	   $stmt = $conn->prepare($query);
	  $stmt->bind_param('ss',$text,$img);
		$stmt->execute();
		$stmt->close();
		
		

	
}	
	

function addImage($id,$img_url){
		include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	

	
	  $query = "update clients set img=? where id=?;";
	   $stmt = $conn->prepare($query);
	  $stmt->bind_param('si',$img_url,$id);
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

	
	  $query = "update clients set img=? where id=?;";
	   $stmt = $conn->prepare($query);
	  $stmt->bind_param('si',$img_url,$id);
		$stmt->execute();
		$stmt->close();
	
	
	
	
	
}

function updateClient($id,$text,$img){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);

	  
	 $query = "update clients set text=?,img=? where id=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('ssi',$text,$img,$id);
	 $stmt->execute();
	 $stmt->close(); 
}

function deleteClient($id){
	include ('utilities.php');
	
	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	 $query = "delete from clients where id=?;";
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
	  
	 $query = "delete from clients;";
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
	  
 
		   
	  $query = "select img from clients where id=?;";
	  $stmt = $conn->prepare($query);
	  $stmt->bind_param('i',$id);
	  $stmt->execute();
	   $result = $stmt->get_result();
		
		while($row = $result->fetch_assoc()){
			 
			 return $row['img'];
		 }
	
	
	
}



function createClientCard($img,$text){
	echo " 
            <div class='card'>
              <img
                src='".$img."'
                class='card-img-top'
                alt='".$text."'
              />
              <div class='card-body'>
                <h5 class='card-title'>".$text."</h5>
              </div>
            </div>";	

}
function printClientList__mainPage(){
	include ('utilities.php');

	$conn = mysqli_connect($host,$user,$pass);


	if(! $conn ){
		die('Could not connect: ' . mysqli_error());
	 }
  mysqli_select_db($conn,$database);
  

	   
  $query = "select * from clients;";
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
		$this->createClientCard($row['img'],$row['text']);
		if($counter==4){
			echo "</div>
			</div>
	  		</div>
	  		</div>";
			$counter=0;
		}	
			
	 }
	
}


function printClientListControlPanel(){
		include ('utilities.php');


	
	
		$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
 
		   
	  $query = "select * from clients;";
	 $stmt = $conn->prepare($query);
	  $stmt->execute();
	   $result = $stmt->get_result();
		
		
		 while($row = $result->fetch_assoc()){
			
			
			echo "<center>";
			echo "<div class='alert alert-primary'>";
			
			echo "<div class='row'>";
			echo "<div class='col-sm'>";
			echo $row['text'];
		
			echo "</div>";
			echo "<div class='col-sm'>";
			echo "<img src='".$row['img']."' class='img-thumbnail'>";
			echo "</div>";
			echo "<div class='col-sm'>";
			echo "<a href='CLIENT_EDIT.php?id=".$row['id']."'>Edit</a>";
			echo "</div>";
			
		

				echo "<div class='col-sm'>";
			echo "<a href='../php/delete_client.php?id=".$row['id']."'>delete entry</a>";
			echo "</div>";
			
			echo "</div>";
			
			
			echo "</div>";
			echo "</center>";
			
			
				

				
				
				
				
		 }
		  
		  
	  

	
	
}



function printClientControlPanelEditForm($id){
	include ('utilities.php');
	

	$conn = mysqli_connect($host,$user,$pass);
	
	
	    if(! $conn ){
            die('Could not connect: ' . mysqli_error());
         }
	  mysqli_select_db($conn,$database);
	  
	  $query = "select * from clients where id=?;";
	 $stmt = $conn->prepare($query);
	 $stmt->bind_param('i',$id);
	  $stmt->execute();
		 $result = $stmt->get_result();
		 $row = $result->fetch_assoc();
		 
		 
		 if($row != null){

			echo "<div class='container' id='section2'>";

			echo "<form action='../PHP/update_client.php' method='post'>";
            echo "<h2>Add Blog Entry</h2>";
			echo "<br>";
			echo "<input type='hidden' name='id' value='".$row['id']."'>";
			echo "<div class='form-group'>";
			echo "<label>Text</label>";
			echo "<input type='text' name='text' class='form-control' value='".$row['text']."'/></div>";
			echo "<br>";
			echo "</div>";
			echo "<button type='Submit' class='btn btn-primary'>Save</button>";
			echo "</form>";
			echo "<br>";
			echo "<a href='UPDATE_CLIENT_IMAGE.php?id=".$row['id']."'>Edit Image</a><br>";
			echo "<img src='".$row['img']."' class='img-fluid' style='width:50%;'>";
			echo "</div>";



		
			 
		
		}
	  
	
	
	
}


}
?>