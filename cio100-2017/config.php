<?php
// Create connection
/* $db_handle = mysql_connect('202.138.100.141', 'root','St@g!ng');
mysql_select_db('idg_event', $db_handle);
mysql_query("set names 'utf8'"); */

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

$query = "SELECT * FROM delegate";

     $result = mysqli_query($link,$query);
   
    $cnt = 0;
    while ($row = mysqli_fetch_array($result)) {
       echo "<pre>"; print_r($row);
    }
?>