<?php session_start();
//echo $_SESSION['user'];
 if (isset($_SESSION['psw'])) {
   // do nothing
} else {
    header('Location: index.php');
}

function baseurl() 
{
    // output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF']; 
    
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath); 
    
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST']; 
    
    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
    
    // return: http://localhost/myproject/
    return $protocol.$hostName.$pathInfo['dirname'];
}  

?>
 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="AlphaNav Mobile Demo">
    <title>Premier 100 2018 | Speakers</title>
    <link rel="shortcut icon" href="http://www.channelworld.in/sites/channelworld/files/channelworld_favicon.png" type="image/png" />
    <link rel="stylesheet" href="/dist/normalize.css" />
    <link rel="stylesheet" href="/dist/alphaNav.min.css" />
	<link rel="stylesheet" href="/dist/custom.css" />
   <script type="text/javascript" src="/dist/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/dist/velocity.min.js"></script>
    <!-- Using the un-minified version for debugging purposes only; you should use the minified version in production -->
    <script type="text/javascript" src="/dist/alphaNav.js"></script>


</head>
<body>
		<style>
.speakerslist label {
    color: #e90000;
    display: inline-block;
    padding-right: 5px;
}

.speakerslist .dtext-3 {
    color: #000000;
    font-size: 15px;
    font-weight: lighter;
    padding-left: 15px;
}

.speakerslist .dtext-4 {
    color: #8b0000;
    font-size: 12px;
    font-weight: lighter;
    padding-right: 15px;
}
	.speakerslist.delegateslist figure	{
	background:#dedede;}
		</style>

<div id="wrapper" class="viewbyperson">
	<header>
		<div class="header-class">
			<div class="sidebar hidden-sm-up float-left">
				<div class="mini-submenu  hidden-sm-up mt-3 mr-2" style="display: block;">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</div>
				<div class="list-group" style="display: none;">
					<span class="float-right" id="slide-submenu">
							<i class="fa fa-times">&times</i>
						</span>


					<a href="<?php echo $baseurl;?>/delegates.php" class="list-group-item">DELEGATES 2017</a>
					<a href="<?php echo $baseurl;?>/view-by-person.php" class="list-group-item">
						<i class="fa fa-search"></i> INDEX BY PERSON</a>
					<a href="<?php echo $baseurl;?>/view-by-company.php" class="list-group-item">
						<i class="fa fa-user"></i> INDEX BY COMPANY</a>
					<a href="<?php echo $baseurl;?>/agenda.php" class="list-group-item">
						<i class="fa fa-folder-open-o"></i> AGENDA</a>
					<a href="<?php echo $baseurl;?>/speakers.php" class="list-group-item">
						<i class="fa fa-bar-chart-o"></i> SPEAKERS</a>
					<a href="<?php echo $baseurl;?>/sponsors.php" class="list-group-item">
						<i class="fa fa-envelope"></i> SPONSORS	</a>
						<a href="<?php echo $baseurl;?>/logout.php" class="list-group-item">
						<i class="fa fa-envelope"></i> LOG OUT	</a>
				</div>
				<img src="http://www.channelworld.in/sites/channelworld/themes/channelworld/images/channelworld-logo.svg" alt="cio-logo" border="0" align="left" width="200" height="100%" />
		     </div>
			</div>
		</header>
		<div class="listdiv">
			Speakers 2017
		</div>
		 <div id="content" class="delegateslist speakerslist">
		 
		 <figure>
					<img src="../images/speakers/danielle.jpg" alt="danielle" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Danielle Di-Masi</span>
				  <span class="dtext-2">Keynote Speaker and Digital Communicator</span>
				  <span class="dtext-3"><Label>Topic:</Label>Your Digital Communication: Strategy or Spaghetti</span>
				  <span class="dtext-3">& </span>
				  <span class="dtext-3"><Label>Topic:</Label>The Human Technology</span>
				 <!-- <span class="dtext-4"><Label>Time:</Label>31st August, Thursday 2:00 PM</span>
				  <span class="dtext-3">& </span>
				<span class="dtext-4"><Label>Time:</Label>1st September, Friday 11:25 AM </span>-->		  
			  </figcaption>
			</figure>

			<figure>
					<img src="../images/speakers/Kamal-Nath-Sify.jpg" alt="Kamal-Nath-Sify" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Kamal Nath</span>
				  <span class="dtext-2">CEO, Sify Technologies</span>
				  <span class="dtext-3"><Label>Topic:</Label>Digital Innovation & Transformation</span>
				 <!-- <span class="dtext-4"><Label>Time:</Label>31st August, Thursday,2:40 PM</span>-->
				  
			  </figcaption>
			</figure>
			<figure>
					<img src="../images/speakers/kishorPatil.jpg" alt="kishorPatil" width="300" height="225"/>
			  <figcaption>
			 	  <span class="dtext-1">Kishor Patil</span>
				  <span class="dtext-2">CEO of KPIT Technologies</span>
				  <span class="dtext-3"><Label>Topic:</Label>Business model innovation and how CIOs can enable it</span>
				  <!--<span class="dtext-4"><Label>Time:</Label>31st August, Thursday 3:30 PM</span>-->
				  
			  </figcaption>
			</figure>
			
			<figure>
					<img src="../images/speakers/Mohit-Pande-Google.jpg" alt="Mohit-Pande-Google" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Mohit Pande</span>
				  <span class="dtext-2">Country Manager - India, Google Cloud</span>
				  <span class="dtext-3"><Label>Topic:</Label>Build what’s next with Google Cloud</span>
				  <!--<span class="dtext-4"><Label>Time:</Label>31st August, Thursday,3:50 PM</span>-->
				  
				  
			  </figcaption>
			</figure>
			<figure>
					<img src="../images/speakers/Nutanix-and-Lenovo.jpg" alt="Nutanix-and-Lenovo" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Vivek Sharma </span>
				  <span class="dtext-2">MD of Lenovo Global Technology India Pvt Ltd</span>
				   <span class="dtext-2">&</span>
				 
				  <span class="dtext-1">Sunil Mahale</span>
				  <span class="dtext-2">Vice President & MD of Nutanix India</span>
				  
				  <span class="dtext-3"><Label>Topic:</Label>Journey to building an Enterprise Cloud</span>
				  <!--<span class="dtext-4"><Label>Time:</Label>31st August, Thursday,04:08 PM</span>-->
				  
				  
			  </figcaption>
			</figure>
			
			<figure>
					<img src="../images/speakers/Arun-Firodia.jpg" alt="Arun-Firodia" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Arun Firodia</span>
				  <span class="dtext-2">Chairman of Kinetic Group</span>
				  <span class="dtext-3"><Label>Topic:</Label>Innovation is leadership for business outcomes</span>
				 <!-- <span class="dtext-4"><Label>Time:</Label>1st September, Friday 09:30 Am</span>-->
			  </figcaption>
			</figure>
			<figure>
					<img src="../images/speakers/Sukesh-Jain-samsung.jpg" alt="Sukesh-Jain-samsung" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Sukesh Jain </span>
				  <span class="dtext-2">Vice President Enterprise Business Samsung India</span>
				  <span class="dtext-3"><Label>Topic:</Label>Enterprise mobility: The next-gen mobile enterprise</span>
				 <!-- <span class="dtext-4"><Label>Time:</Label>1st September, Friday,10:05 AM</span>-->
				  
				  
			  </figcaption>
			</figure>
			<figure>
					<img src="../images/speakers/Vikram-Kumar-Yerram.jpg" alt="Vikram-Kumar-Yerram" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Y. Vikram Kumar </span>
				  <span class="dtext-2">Country Manager - Technology Services Support, Hewlett-Packard Enterprise India</span>
				  <span class="dtext-3"><Label>Topic:</Label>HPE Pointnext Update</span>
				 <!-- <span class="dtext-4"><Label>Time:</Label>1st September, Friday,11:45 AM</span>-->
				  
				  
			  </figcaption>
			</figure>
			<figure>
					<img src="../images/speakers/Leo-Joseph-HP.jpg" alt="Leo Joseph" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Leo Joseph</span>
				  <span class="dtext-2">Sr. Director Enterprise Sales & Solutions</span>
				  <span class="dtext-3"><Label>Topic:</Label>Enterprise Digital Transformation</span>
				 <!-- <span class="dtext-4"><Label>Time:</Label>1st September, Friday,12:05 PM</span>-->
				  
				  
			  </figcaption>
			</figure>
			<figure>
					<img src="../images/speakers/Professor-Raghunath.jpg" alt="Professor-Raghunath" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Dr. S Raghunath</span>
				  <span class="dtext-2">Dean and Professor at IIM-Bangalore</span>
				  <span class="dtext-3"><Label>Topic:</Label>CIO as a strategist - Enabling an intelligent world</span>
				 <!-- <span class="dtext-4"><Label>Time:</Label>1st September, Friday 2:00 PM</span>-->
				  
				  
			  </figcaption>
			</figure>
			<figure>
					<img src="../images/speakers/Arvind-Gupta.jpg" alt="Arvind-Gupta" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Arvind Gupta</span>
				  <span class="dtext-2">Co-founder of Digital India Foundation</span>
				  <span class="dtext-3"><Label>Topic:</Label>ReBooting a Nation</span>
				  <!--<span class="dtext-4"><Label>Time:</Label>1st September, Friday 2:00 PM</span>-->
				  
				  
			  </figcaption>
			</figure>
			
         </div>

</div> <!--wrapper endshere -->
 <script type="text/javascript">
        $(document).on('ready', function () {
     $('#slide-submenu').on('click',function() {
		$(".mini-submenu").removeClass("open");
        $(this).closest('.list-group').fadeOut('slide',function(){

        });

      });

	$('.mini-submenu').on('click',function(){
		$(".mini-submenu").addClass("open");
        $(this).next('.list-group').toggle('slide');

	})
	
	
	 $('html, body').hide();
        if (window.location.hash) {
            setTimeout(function() {
                $('html, body').scrollTop(0).show();
                $('html, body').animate({
                    scrollTop: $(window.location.hash).offset().top
                    }, 1000)
            }, 0);
        }
        else {
            $('html, body').show();
        }

        });
    </script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61646-2', 'auto');
  ga('send', 'pageview',{'dimension1':'<?php echo $_SESSION['user'];?>'});

</script>

</body>
</html>
