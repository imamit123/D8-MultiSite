<?php
   session_start();
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
    mysqli_select_db($link,"idg_event") ;

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
   $result = mysqli_query($link,$query);
   $row = mysqli_fetch_array($result);
   //echo $row[0];
//if(!empty($_POST['psw'])) { 
function baseurl() 
{
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF']; 
    
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath); 
    
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST']; 
    
    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
    
    // return: http://localhost/myproject/
    return $protocol.$hostName.$pathInfo['dirname'];
}     
if ($row[0] == $_POST['psw']) {
   header('Location: delegates.php');
   $_SESSION['user'] = $userName;
   $_SESSION['psw'] = $loginpassWord;
  // echo 'correct';
} else {
  header('Location: <?php echo $baseurl;?>');
	//echo 'wrong';
	$_SESSION['error_msg'] = "Incorrect Registration Code or Mobile Number";
}
//}
	?>