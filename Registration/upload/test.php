<?php
require 'lib.php';
require '../config.php';
 $xlsx = new SimpleXLSX('book1.xls');
 print_r( $xlsx->rows() );

?>
