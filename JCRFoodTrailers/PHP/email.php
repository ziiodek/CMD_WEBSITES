<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



//echo "<div style='background-color:black;'>";

$emailFrom = "ziiodek@gmail.com";
$emailFromName = "MY SHOPPING APP CUSTOMER";	


$emailTo = "ziiodek@gmail.com";
$emailToName = 'MY SHOPPING APP';
//$emailTo = 'ziiodek@gmail.com';
$msg = "MY SHOPPIING APP CUSTOMER<br>".$_POST['name']."<br>".$_POST['lastname']."<br>".$_POST['email']."<br>".$_POST['phone']."<br>".$_POST['msg'];

	
	
$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is depracated
$mail->SMTPAuth = true;
$mail->Username = "ziiodek@gmail.com";
$mail->Password = "odio_el_invierno";
$mail->setFrom($emailFrom, $emailFromName);
$mail->addAddress($emailTo, $emailToName);
$mail->Subject = "MY SHOPPIING APP";
$mail->msgHTML($msg); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,

// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file


if(!$mail->send()){
	/**$file = fopen('../logs/mail_log.txt', 'w');
fwrite($file, "Mailer Error: " . $mail->ErrorInfo);
fclose($file);**/
    
}else{
echo '<script type="text/javascript">'; 
echo 'alert("Message sent!");'; 
echo 'window.location.href = "https://ziiodek3d.com/";';
echo '</script>';
	
    
	
}

	
//echo "</div>";
	



?>