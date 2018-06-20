<?php
   session_start();
    $hostname = '202.138.100.141';
    $dbname   = 'idg_event';
    $username = 'root'; 
    $password = 'St@g!ng';
    mysql_connect($hostname, $username, $password) or DIE('Connection to host isailed, perhaps the service is down!');
    mysql_select_db($dbname) or DIE('Database name is not available!');

    $userName=$_POST['uname']; 
    $loginpassWord=$_POST['psw']; 
	
	//echo $userName;
   $query = "SELECT mobile_number FROM delegate WHERE id='$userName' and  mobile_number='$loginpassWord'";
// echo $query;
 //exit;
    //$query = "SELECT id FROM delegate WHERE id=1101 and  mobile_number=9841280299";
	//echo $query;
	
 //  $query = "SELECT CONCAT(id,mobile_number) as pwd  FROM delegate WHERE id = $userName";
   //echo $query;
   $result = mysql_query($query);
   $row = mysql_fetch_row($result);
   //echo $row[0];
//if(!empty($_POST['psw'])) { 
if ($row[0] == $_POST['psw']) {
   header('Location: delegates.php');
   $_SESSION['user'] = $userName;
   $_SESSION['psw'] = $loginpassWord;
  // echo 'correct';
} else {
  header('Location: http://www.cio.in/yearahead/login.php');
	//echo 'wrong';
	$_SESSION['error_msg'] = "Incorrect Registration Code or Mobile Number";
}
//}
	?>