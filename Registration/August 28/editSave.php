<?php
	session_start();
	include 'config.php';
	$update_info_array = $_GET;
	$id = $update_info_array['uid'];
	$name = $update_info_array['name'];
	$comp = $update_info_array['company'];
	$update_query = "UPDATE `delegate` SET `first_name`='$name', `last_name`='' ,`comapny_name`= '$update_info_array[company]', `email_id`='$update_info_array[email]', `mobile_number`='$update_info_array[mobile_number]', `designation`='$update_info_array[designation]', `field1`='$update_info_array[field1]' ,`field2`='$update_info_array[field2]' ,`field3`='$update_info_array[field3]' , `type` = '$update_info_array[type]' WHERE id= $id";
	
	mysqli_query($link,$update_query);
	$query = "SELECT * FROM delegate WHERE id = $id";
    $_SESSION['export_result'] = $query;
	$result_data = mysqli_fetch_assoc(mysql_query($link,"SELECT * FROM delegate WHERE id = $id"));
	//echo "<pre>";print_r($result_data);exit;
	$json_encode = json_encode($result_data);
	echo $json_encode;
	//echo "<pre>";print_r(json_decode($json_encode));exit;
?>