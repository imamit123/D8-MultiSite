<?php
include 'config.php';
$db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);

$value = $_GET['value'];

$query = "SELECT * FROM delegate WHERE id = ".$value;
$result = mysqli_query($link,$query);
while ($row=  mysqli_fetch_assoc($result)) {
    $first_name =$row['first_name'].';';
    $designation =$row['designation'].';';
    $comapny_name =$row['comapny_name'].';';
    $id =$row['id'].';';
            $type = $row['type'];
   
}
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <idgcrm@idgindia.com>' . "\r\n";
//$headers .= 'Cc: idgcrm2@idgindia.com' . "\r\n";

$to = 'idgcrm@idgindia.net';
$nameto = 'idgcrm@idgindia.net';

$namefrom = "IDGCRM";
$subject = "EVENT REGISTRATION PRINT NOTIFICATION";
//$choosen_data1= str_replace(",", "<br/>", $choosen_data);
$message = $first_name.$designation.$comapny_name.$id.$type;

mail($to,$subject,$message,$headers);
//authSendEmail($from, $namefrom, $to, $nameto, $subject, $message);
?>
<!doctype html>
<html>
<head>
<title>IDG India CRM Software</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>

<div id="wrapper">
<!-- header -->
	<header id="head">
    	<div id="logo-banner">
        	<div class="left-logo">
            	<a href="index.php" target="_self"><img src="images/idg.png" alt="IDG India" title="IDG India" width="258" height="66" /></a>
            </div>
            <div class="right-logDetails">
            	<p class="log-details"><span class="login-type"></span></p>
            </div>
        </div>
        <!-- Navigation bar -->
    </header>
  <!-- header -->
  <!-- content -->
	<div id="content">
    	        <div class="org-content" style="width:85%;"> 
   					<div class="organisation-info">
						<div class="thanks-approval"><p>Thanks for your Approval</p>
               		    </div>
					</div>
		 		</div>
     </div>
  <!-- content -->
  <!-- footer -->
  <footer id="foot">
  	<div class="left-footer">
        <p>Copyright ©  2005 - 2014 IDG Media Pvt. Ltd. All Rights Reserved.</p>
    </div>
  	<div class="right-footer">
    	<p><a href="www.idg.in" target="_blank"><span class="idg-logo"><img src="images/IDG-(R).png" alt="IDG Media" width="100" height="40" /></span></a></p>
        
    </div>
  </footer>
  <!-- footer --> 
</div>

</body>
</html>



