<?php


$email = strtoupper($_POST['email']);
$password = strtoupper($_POST['password']);

include ('USER.php');

$register_manager = new User();

$register_manager->logIn($email,$password);

?>