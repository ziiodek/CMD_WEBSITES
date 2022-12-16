<?php

 
// Initialize a file URL to the variable
$url = '../apk/my_shopping_app1.apk';
 
// Use basename() function to return the base name of file
$file_name = basename($url);
  
// Use file_get_contents() function to get the file
// from url and use file_put_contents() function to
// save the file by using base name
header("Cache-Control: public");
header("Content-Description: File Transfer");
header('Content-Type: application/vnd.android.package-archive');
header("Content-Transfer-Encoding: binary");    
header("Content-length: " . filesize($url));
header('Content-Disposition: attachment; filename="my_shopping_app.apk"');
//ob_end_flush();
readfile($url);
return true;
 

?>