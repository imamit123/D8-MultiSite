<?php
$a = 1;
$b = 2;
session_start();
require 'lib.php';
require '../config.php';
$uploads_dir = 'uploaded-files';
$move = false;
$name = "";
$i = 0;
$id = mysql_fetch_assoc(mysql_query("SELECT id FROM delegate ORDER BY id DESC LIMIT 0,1"));
	if (empty($id)) {
		$id = 1100;
	} else {
		$id = $id['id'];
	}
if (isset($_REQUEST['generated_id']) && !empty($_REQUEST['generated_id'])) {
	if ($_REQUEST['generated_id'] < $id ) {
		$_SESSION['updated_record'] = "This ID is already exists. Please give Id Greter then $id";
		header('Location:upload.php');
		exit;
	} else {
		mysql_query("ALTER TABLE `delegate` AUTO_INCREMENT = ".$_REQUEST['generated_id']);
	}
}
if ($_FILES["file"]["error"] == 0) {
    $tmp_name = $_FILES["file"]["tmp_name"];
    $name = $_FILES["file"]["name"];
    echo "</br>";
    $new = $uploads_dir . "/" . $name;
    $move = move_uploaded_file($tmp_name, $new);
}
if ($move) {
    $xlsx = new SimpleXLSX($new);
    list($cols, $rows) = $xlsx->dimension();
    $rows = $xlsx->rows();
    unset($rows[0]); // unset the heading....
    $i=0;
    foreach ($rows as $k) {

        $reference = trim(isset($k[0]) ? addslashes($k[0]) : "");
        $first_name = trim(isset($k[1]) ? addslashes($k[1]) : "");
        $last_name = trim(isset($k[2]) ? addslashes($k[2]) : "");
        $company_name = trim(isset($k[3]) ? addslashes($k[3]) : "");
        $email = trim(isset($k[4]) ? addslashes($k[4]) : "");
        $phone = trim(isset($k[5]) ? addslashes($k[5]) : "");
        $type = trim(isset($k[6]) ? addslashes($k[6]) : "");
        $designation = trim(isset($k[7]) ? addslashes($k[7]) : "");
        
        
       
        if($reference != '' or $first_name != '' or $last_name != '' or $company_name != ''or $email != '' or $phone != '' or $type !='' or $designation != ''){
       $i++;
           $insert_query = "INSERT INTO `delegate`(`reference`, `first_name`, `last_name`, `comapny_name`, `email_id`, `mobile_number`,type,designation) VALUES ('$reference','$first_name','$last_name','$company_name', '$email', '$phone','$type','$designation')";
        //echo $insert_query."<br />";
        mysql_query($insert_query);}
    }
    echo $i." Rows Succefully Updated";
	$_SESSION['updated_record'] = $i." Rows Succefully Updated";
	header('Location:upload.php');
	exit;
} else {
    echo "Please re-upload the file again.";
	$_SESSION['updated_record'] = "Please re-upload the file again.";
	header('Location:upload.php');
	exit;
}
?>