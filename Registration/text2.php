<?php
$value = $_GET['value'];
$my_file = 'print.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
//include 'mail2.php';
//include 'downlaod.php';
//include 'download1.php';
header('Location: index.php?value='.$value);
?>