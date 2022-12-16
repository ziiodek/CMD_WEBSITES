<?php
function validate_password($password){
	if(strlen($password) < 8){
		return false;
	}
	
$containsLetter  = preg_match('/[a-zA-Z]/',    $password);
$containsDigit   = preg_match('/\d/',          $password);
$containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);
	
	if(!$containsLetter || !$containsDigit || !$containsSpecial){
		return false;
	}
	
	return true;
}		
  						 
?>
