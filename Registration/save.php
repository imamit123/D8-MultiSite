<?php
	session_start();
	include 'basic.php';
	$user_info = $_REQUEST;
       	$query = add_user($user_info); 
	echo json_encode($query);
?>