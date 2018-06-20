 
<?php
	
	function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
	
	    $file = $path.$filename;
	    $file_size = filesize($file);
	    $handle = fopen($file, "r");
	    $content = fread($handle, $file_size);
	    fclose($handle);
	    $content = chunk_split(base64_encode($content));
	    
	    $uid = md5(uniqid(time()));
	    
	    $header = "From: ".$from_name." <".$from_mail.">\r\n";
	    $header .= "Reply-To: ".$replyto."\r\n";
	    $header .= "MIME-Version: 1.0\r\n";
	    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
	    $header .= "This is a multi-part message in MIME format.\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
	    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
	    $header .= $message."\r\n\r\n";
	    $header .= "--".$uid."\r\n";
	    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
	    $header .= "Content-Transfer-Encoding: base64\r\n";
	    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
	    $header .= $content."\r\n\r\n";
	    $header .= "--".$uid."--";
	    
	    // Messages for testing only, nobody will see them unless this script URL is visited manually
	    if (mail($mailto, $subject, "", $header)) {
	        //echo "Message sent!";
	    } else {
	        //echo "ERROR sending message.";
	    }
	    
	}
		
	
	
	
	
	// EDIT FROM HERE DOWN TO 
	// CUSTOMIZE EMAIL
	
	
	
	// File to attach
	$my_file = "How To Reduce Cyber Risks.pdf";
	$my_path = 'reports/pdf/'; // $_SERVER['DOCUMENT_ROOT']."/your_path_here/";
	
	// Who email is FROM
	$my_name    = "Akamai Security Survey";
	$my_mail    = "survey@idgindia.net";
	$my_replyto = "survey@idgindia.net";
	
	// Whe email is going TO
	$to_email   = $_POST["business_email"]; // Comes from Wufoo WebHook
	
	// Subject line of email
	$my_subject = "Your Complimentary Cyber Risk Guide is Ready!";
	
	// Content of email message (Text only)
	$requester   = $_POST["first_name"];  // Comes from Wufoo WebHook
	$message     = "Dear $requester,
	
Please download the attachment to save your complimentary copy of Cyber Risk guide";
	
	// Call function to send email
	mail_attachment($my_file, $my_path, $to_email, $my_mail, $my_name, $my_replyto, $my_subject, $message);

 

/* $to = $_POST["business_email"];
$subject = 'Security Survey';
$message = 'Your Complimentary Cyber Risk Guide is Ready!'; 
$from = 'cio_notifications@idgindia.com';
$mail->AddAttachment('reports/pdf/MP-1861 Financial Services Threat Brief - India.pdf'); 

// Sending email
if(mail($to, $subject, $message)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
} */


   $firstname = $_POST["first_name"];
   $lastname = $_POST["last_name"];
   $companyname = $_POST["company_name"];
   $jobtitle = $_POST["job_title"];
   $business_email = $_POST["business_email"];
   $telephone_number = $_POST["telephone_number"];
    $country= $_POST['country'];
   $purchase_security_solutions = $_POST["purchase_security_solutions"];
   $receive_security_briefing = $_POST["receive_security_briefing"];

   $qus1_ans = $_POST["qus1_ans"];
   $qus2_ans = $_POST["qus2_ans"];
   $qus3_ans = $_POST["qus3_ans"];
   $an3='';
   foreach($qus3_ans as $answer3)
   {
      $an3 .= $answer3.';';
   }

   $qus4_ans = $_POST["qus4_ans"];
   $qus5_ans = $_POST["qus5_ans"];
   $qus6_ans = $_POST["qus6_ans"];
   $an6='';
   foreach($qus6_ans as $answer6)
   {
      $an6 .= $answer6.';';
   }
    $qus7_ans = $_POST["qus7_ans"];
     $qus8_ans = $_POST["qus8_ans"];
      $qus9_ans = $_POST["qus9_ans"];
       $an9='';
   foreach($qus9_ans as $answer9)
   {
      $an9 .= $answer9.';';
   }
       $qus10_ans = $_POST["qus10_ans"];
        $qus11_ans = $_POST["qus11_ans"];
         $an11='';
   foreach($qus11_ans as $answer11)
   {
      $an11 .= $answer11.';';
   }
  // $new_line = "\nFirstname:".$firstname . "\nLastname:" . $lastname . "\nCompany Name:" . $companyname . "\nJob Title:" . $jobtitle ."\nBusiness Email:" . $business_email ."\nTelephone Number:" . $telephone_number ."\nPurchase Security Solutions:" . $purchase_security_solutions ."\nReceive Security Solutions:" . $receive_security_briefing . "\n";
   $new_line= '';
    $new_line = $firstname . ":" . $lastname . ":" . $companyname . ":" . $jobtitle .":" . $business_email .":" . $telephone_number .":".$country.":" . $purchase_security_solutions .":" . $receive_security_briefing . ":".$qus1_ans.":".$qus2_ans.":".$an3.":".$qus4_ans.":".$qus5_ans.":".$an6.":".$qus7_ans.":".$qus8_ans.":".$an9.":".$qus10_ans.":".$an11."\n";
  $file = 'formsubmission.txt';

   // Open the file to get existing content
      $current = file_get_contents($file);

   // Append a new person to the file
      $current .= $new_line;

   // Write the contents back to the file
      file_put_contents($file, $current);
?>



<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
      <!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
      <title>Akamai - Security Survey</title>
	  <link rel="shortcut icon" href="/sites/cio/themes/cio/images/companyprivate_favicon_1.ico" type="image/x-icon"/>
      <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet">
      <!-- Custom styles for this template -->
	   <link href="/sites/cio/themes/cio/akamai/css/style.css" rel="stylesheet">
      <script>
	 /*  var link = document.createElement('a');
		link.href = 'reports/pdf/MP-1861 Financial Services Threat Brief - India.pdf';
		link.download = 'Financial Services Threat Brief.pdf';
		link.dispatchEvent(new MouseEvent('click')); */
	   </script>
	   <style>
    footer{position:fixed;bottom: 0px;right: 0px;left: 0px;}
    @media only screen and (max-height:910px) {
        footer{position: inherit;}
    }
    @media only screen and (max-width:991px) {
        footer{position: inherit;}
    }
</style>
   </head>
   <!--<body onload='window.open("reports/pdf/MP-1861 Financial Services Threat Brief - Singapore.pdf", "_blank")'>-->
   <body>
<!-- Header Starts -->

<section class="ch_sections">
   <style>
.ch_sections{height:40px;background:#333;margin:0px auto;border-bottom:1px solid #fff;} .ch_sections span.label{display:block;float:left;color:#000;font-size:13px;background-color:#f5cd55;width:75px;height:32px;line-height:33px;text-transform:uppercase;text-indent:12px;position:relative;margin:0 40px 0 0;} .ch-content a>label{cursor:pointer;} .ch_sections span.label:after{content:"";width: 0;height: 0;border-top:32px solid #f5cd55;border-right:14px solid transparent;position:absolute;top:0;right:-14px;} .ch_sections ul { margin: 0 auto; width: 955px;padding-left:10px;display:table; } .ch_sections ul li{border-right: 1px solid #000;display:table-cell;color:#bcbcbc;position:relative;background:#4e4242;text-align:center;vertical-align:middle;} .ch_sections ul li:last-child{margin:0;} .ch_sections ul li a { color: #fff; font-family: "Ubuntu", sans-serif; font-size: 14px; line-height: 35px; text-decoration: none; } .ch_sections ul li a:hover{color:#BCBCBC;} 
.ch_sections ul li.itrsitelogo > a{line-height:18px !important;} 
.itrsitelogo { padding: 2px 16px 0 0; } .itrsitelogo > a::before { background: rgba(0, 0, 0, 0) none repeat scroll 0 0 !important; } 
.itrsitelogo img { width:38px; } li { list-style: none; } li.itrsitelogo > a { line-height: 27px !important; } li.itrsitelogo > a img { padding-top: 6px; } li.withchild > a::after { content: "\25Bc"; font-size: 10px; margin-left: 4px; } ul li a:hover{ color: inherit; } ul li ul.dropdown{ min-width: 125px; /* Set width of the dropdown */ /*background: #f2f2f2; */ display: none; position: absolute; z-index: 999; left: -11px; width:205px; border-top:1px solid #000; } ul li:hover ul.dropdown{ display: block; /* Display the dropdown */ } ul li ul.dropdown li { display: block !important; width: 100%; border-bottom: 1px solid #000; } 
</style>
                    <ul>
                        <li class="itrsitelogo"><a href="http://www.cio.in"><img alt="IT Roadmap Channelworld" src="/sites/cio/themes/cio/images/cio_logo_svg.svg"></a></li>
						<li class="withoutchild"><a href="/news">NEWS</a></li>
						<li class="withoutchild"><a href="/case-studies">CASE STUDIES</a></li>
						<li class="withchild"><a href="/features">FEATURES</a>
							<ul class="dropdown">
								<li><a href="/how-to">HOW-TO</a></li>
								<li><a href="/analysis">ANALYSIS</a></li>
								<li><a href="/news">NEWS</a></li>
								<li><a href="/features">ALL</a></li>
							</ul>
						</li> 
						<li class="withchild"><a href="/view-points">VIEW POINTS</a>
							<ul class="dropdown">
							<li><a href="/cio-interviews">CIO INTERVIEWS</a></li>
							<li><a href="/cxo-interviews">CXO INTERVIEWS</a></li>
							<li><a href="/opinions">OPINIONS</a></li>
							<li><a href="/view-points">ALL</a></li>
							</ul>
						</li> 
						<li class="withoutchild"><a href="/slideshows">SLIDESHOWS</a></li> <li class="withoutchild"><a href="/videos">VIDEOS</a></li>
                    </ul>
</section>
<header style="padding:15px 0;height:100%;position:inherit;">
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <div class="name">Understanding Your Cyber Risk Profile</div>
      </div>
      <div class="col-md-5 logo"> <img src="/sites/cio/themes/cio/akamai/images/logo.png" alt=""> </div>
    </div>
  </div>
</header>
<!-- Header Ends -->
      <!-- Thankyou Starts --><section class="container">
         <div class="row">
            <div class="col-md-12">
               <article class="thankyou-wrap">
                  <h1>Thank You!</h1>
                  <p>We appreciate the time you have taken to complete this survey. We hope the results and the guide will help you take your organization’s security one step closer to perfection.
                  </p>
                  <!--<p>If your download does not begin automatically, please <a href="http://www.cio.in/sites/all/themes/cio_2015/akamai/reports/pdf/MP-1861 Financial Services Threat Brief - India.pdf" target="_blank" download="Financial Services Threat Brief.pdf">click here</a></p>-->
                  <img src="/sites/cio/themes/cio/akamai/images/thank-you.png" alt="">
               </article>
            </div>
         </div>
         <img height="1" width="1" style="display:none;" alt="" src="https://dc.ads.linkedin.com/collect/?pid=62114&conversionId=231465&fmt=gif" />
      </section><!-- Thankyou Ends --> 
      <!-- google analytics code -->
<script type="text/javascript">var gaJsHost=(("https:"==document.location.protocol)?"https://ssl.":"http://www.");document.write(unescape("%3Cscript src='"+gaJsHost+"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));</script>

<script type="text/javascript">try{var author="none";var guid="none";var type="page";var published="01:13:2017";var pageTracker=_gat._getTracker("UA-61646-2");pageTracker._setDomainName(".cio.in");if(author!='none'){pageTracker._setCustomVar(1,"Author",author,3);}
if(guid!='none'){pageTracker._setCustomVar(2,"GUID",guid,3);}
if(type!='none'){pageTracker._setCustomVar(3,"Type",type,3);pageTracker._setCustomVar(4,"Published",published,3);}
pageTracker._trackPageview();}catch(err){}</script>
<!-- end of google analytics code --> 
      <!-- Footer Starts --><footer>
        <p>&copy;2017 Akamai Technologies</p>
      </footer><!-- Footer Ends -->
   </body>
</html>