<?php
// Create connection
/* $db_handle = mysql_connect('202.138.100.141', 'root','St@g!ng');
mysql_select_db('idg_event', $db_handle);
mysql_query("set names 'utf8'"); */

$servername = '202.138.100.141';
$username = "root";
$password = "St@g!ng";

// Create connection
$conn = mysql_connect($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
mysql_select_db('idg_event', $conn);

$query = "SELECT * FROM delegate";

    $result = mysql_query($query);
   
    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
       echo "<pre>"; print_r($row);
    }
?>