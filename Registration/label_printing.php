<?php 
session_start();
include 'basic.php';
include 'config.php';
$db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
   
$_SESSION['mailflag'] =$wchmail = $_GET['mail'];

// $query ="SELECT * FROM `delegate`";
 $query =$_SESSION['export_result'];
 unset($_SESSION['export_result']);
// $query = "SELECT * FROM delegate WHERE comapny_name LIKE '%ABFSG%' and CONCAT (first_name , ' ', last_name) = 'RAJIVE THAMPY '";
$result = mysqli_query($link,$query);
$i=2;
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Kolkata');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';

// Create new PHPExcel object
echo date('H:i:s') , " Create new PHPExcel object" , EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
echo date('H:i:s') , " Set document properties" , EOL;
$objPHPExcel->getProperties()->setCreator("Ashwini Jain")
							 ->setLastModifiedBy("Ashwini Jain")
							 ->setTitle("Ashwini Jain")
							 ->setSubject("Ashwini Jain")
							 ->setDescription("Ashwini Jain")
							 ->setKeywords("Ashwini Jain")
							 ->setCategory("Ashwini Jain");


// Add some data
echo date('H:i:s') , " Add some data" , EOL;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'reference')
            ->setCellValue('C1', 'First Name')  //changed
            ->setCellValue('D1', 'Last Name')   //changed
            ->setCellValue('E1', 'comapny_name')
            ->setCellValue('F1', 'email_id')
            ->setCellValue('G1', 'mobile_number')
            ->setCellValue('H1', 'type')
            ->setCellValue('I1', 'designation')
            ->setCellValue('J1', 'registered')
            ->setCellValue('K1', 'radio1')
            ->setCellValue('L1', 'new_id')
        ;

// Miscellaneous glyphs, UTF-8
while ($row=  mysqli_fetch_assoc($result)) {
    //print_r($row);exit();//
   // $new = $row['first_name'] . " " . $row['last_name'];
    $blnk = "";
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $row['id'])
            ->setCellValue('B'.$i, $row['reference'])
            ->setCellValue('C'.$i, $row['first_name']) //changed
            ->setCellValue('D'.$i, $row['last_name'])   //changed
            ->setCellValue('E'.$i, $row['comapny_name'])
            ->setCellValue('F'.$i, $row['email_id'])
            ->setCellValue('G'.$i, $row['mobile_number'])
            ->setCellValue('H'.$i, $row['type'])
            ->setCellValue('I'.$i, $row['designation'])
            ->setCellValue('J'.$i, $row['registered'])
            ->setCellValue('K'.$i, $row['field1'])
            ->setCellValue('L'.$i, $row['id']);              
			$i++;
	$value =$row['id'];		
	}

//$objPHPExcel->getActiveSheet()->setCellValue('A8',"Hello\nWorld");
$objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(-1);
//$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);


// Rename worksheet
echo date('H:i:s') , " Rename worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Save Excel 95 file
echo date('H:i:s') , " Write to Excel5 format" , EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo memory peak usage
echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo done
echo date('H:i:s') , " Done writing files" , EOL;
echo 'Files have been created in ' , getcwd() , EOL;
if($wchmail == 'hi'){
    //file_get_contents('http://registration.idgindia.com/label_printing.xlsx');
    header('Location: text.php?value='.$value);
}else{
    //file_get_contents('http://registration.idgindia.com/label_printing.xlsx');
    header('Location: text2.php?value='.$value);
}


?>
