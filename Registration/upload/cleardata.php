<?php

session_start();
include '../config.php';
$db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
$query = "TRUNCATE TABLE `delegate`";
mysqli_query($link,$query);
mysqli_query($link,"ALTER TABLE `delegate` AUTO_INCREMENT = 1101");

header ("Location:upload.php");
?>