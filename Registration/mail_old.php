
<?php
require_once('class.phpmailer.php');
echo $mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "mail.idgindia.net";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "idgcrm@idgindia.net";
$mail->Password = "IDG_crm1015";
$mail->SetFrom("idgcrm@idgindia.net");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("idgcrm@idgindia.net");

 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
    
 }?>