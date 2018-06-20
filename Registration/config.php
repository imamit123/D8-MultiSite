<?php

$db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
//mysqli_query("set names 'utf8'");

//if (!$link) {
  //  echo "Error: Unable to connect to MySQL." . PHP_EOL;
   // echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
   // echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
   // exit;
//}
//echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
//echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

//mysqli_close($link);
?>
