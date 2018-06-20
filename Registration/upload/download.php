<?php

include '../basic.php';
include '../config.php';
$type = $_GET['type'];
if($type != ''){
$query = "SELECT * FROM delegate where type ='$type'";}
else {
    $query = "SELECT * FROM delegate";
}
$db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
$result = mysqli_query($link,$query);
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {

    $data[$i]['id'] = $row['id'];
    $data[$i]['reference'] = $row['reference'];
    $data[$i]['first_name'] = $row['first_name'];
    $data[$i]['last_name'] = $row['last_name'];
    $data[$i]['comapny_name'] = $row['comapny_name'];
    $data[$i]['email_id'] = $row['email_id'];
    $data[$i]['mobile'] = $row['mobile_number'];
    $data[$i]['Type'] = $row['type'];
    $data[$i]['Designation'] = $row['designation'];
    $data[$i]['registered'] = $row['registered'];
    $data[$i]['visit_card'] = $row['visit_card'];
    $data[$i]['Field1'] = $row['field1'];
    $data[$i]['Field2'] = $row['field2'];
    $data[$i]['Field3'] = $row['field3'];
    $data[$i]['Field4'] = $row['field4'];
    $i++;
}

//print_r($data);exit();

function cleanData(&$str) {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", " ", $str);
    if (strstr($str, '"'))
        $str = '"' . str_replace('"', '""', $str) . '"';
}

// filename for download
$filename = "Contact_" . date('Ymd') . ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

$flag = false;
foreach ($data as $row) {
    if (!$flag) {
        // display field/column names as first row
        echo implode("\t", array_keys($row)) . "\r\n";
        $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\r\n";
}
exit;
?>