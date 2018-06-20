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
//chnages

?>
 <!DOCTYPE html>	
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="AlphaNav Mobile Demo">
    <title>Premier 100 2018 | Agenda</title>
    <link rel="shortcut icon" href="http://www.channelworld.in/sites/channelworld/files/channelworld_favicon.png" type="image/png" />
    <link rel="stylesheet" href="dist/normalize.css" />
    <link rel="stylesheet" href="dist/alphaNav.min.css" />
	  <link rel="stylesheet" href="dist/custom.css" />
    <script type="text/javascript" src="dist/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="dist/velocity.min.js"></script>
    <!-- Using the un-minified version for debugging purposes only; you should use the minified version in production -->
    <script type="text/javascript" src="dist/alphaNav.min.js"></script>
	<style>
		.insideagdenda .text3 {
    color: #8b0000;
    display: block;
    font-family: helvetica;
    font-size: 12px;
    font-weight: 600;
    margin: 0;
    padding: 0;
}
	</style>
</head>
<body>
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
						<i class="fa fa-search"></i> VIEW BY PERSON NAME</a>
					<a href="<?php echo $baseurl;?>/view-by-company.php" class="list-group-item">
						<i class="fa fa-user"></i> VIEW BY COMPANY NAME</a>
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
		</header>
		<div class="listdiv">
			AGENDA 2017
		</div>
		<div id="content" class="delegateslist">
			<div class="tab">
				<button class="tablinks active" onclick="openCity(event, 'agenda1')">AGENDA DAY 1</button><span style="color:#dadada;">|</span>
				<button class="tablinks" onclick="openCity(event, 'agenda2')">Agenda Day 2</button>
			</div>
			<div id="agenda1" class="tabcontent" style="display:block;">
				<div class="agendacontent">
					<p  class="agendaday-t"style="text-align:center;color:#990000">DAY 1 <span>&nbsp;-&nbsp;</span> 31ST AUGUST 2017</p>
					<div class="insideagdenda">
						<p class="time"> TIME: 11:00 AM - 2:00 PM </p>
						<h5>Photo-shoots & Networking Lunch</h5>
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 2:00 - 3:00 PM </p>
						<h5>Your Digital Communication: Strategy or Spaghetti</h5>
						<p class="text1">Danielle Di-Masi</p>
						<h5>Digital Innovations & Transformation</h5>
						<p class="text1">Kamal Nath, CEO, Sify Technologies</p>
											
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 3:30 PM - 4:30 PM </p>
						<h5>Business model innovation and how CIOs can enable it</h5>
						<p class="text1">Kishor Patil, CEO of KPIT Technologies</p>
						<h5>Build what’s next with Google Cloud</h5>
						<p class="text1">Mohit Pande, Country Manager - India, Google Cloud</p>
						<h5>Journey to building an Enterprise Cloud</h5>
						<p class="text1">Vivek Sharma, Managing Director of Lenovo Global Technology India Private Limited
Sunil Mahale, Vice President & Managing Director, Nutanix India</p>	
					</div>
				
					
					<div class="insideagdenda">
						<p class="time">TIME: 4:55 PM - 5:55 PM</p>
						<p class="text1">Focus Business Series</p>
						<p class="text3">Venue: 1st Floor Meeting Rooms</p>
						<h5>1. Activate your Data </h5>
						<p class="text1">Huzefa Motiwala, Director - Systems Engineering, India and Global SI’s, Commvault</p>
						<p class="text3">Venue: Meeting Room 1</p>
						
						<h5>2. Giving Voice to Your Data </h5>
						<p class="text1">Varun Babbar, Alliance Director, Qlik <br/>Nilesh Kulkarni, Pre-sales Head, Qlik</p> 
						<p class="text3">Venue: Meeting Room 2</p>
						<h5>3. Fast Track Digital Business </h5>
						<p class="text1">Saurav Sinha, Head Pre Sales, BMC</p> 
						<p class="text3">Venue: Meeting Room 3</p>
						
						<h5>4. Driving business outcomes with machine learning  </h5>
						<p class="text1">Prasanna Keny, Senior Technical Manager, IBM India</p>
						<p class="text3">Venue: Meeting Room 4</p>
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 5:55 PM -6:30 PM</p>
						<p class="text1">Hotel Check-In</p>
					</div>	
					<div class="insideagdenda">
						<p class="time">TIME: 6:30 PM Onwards</p>
						<p class="text1">Awards & Cocktails</p>
					</div>					
					
				</div>

			</div>
			<div id="agenda2" class="tabcontent" style="display:none;">
				<div class="agendacontent">
					<p  class="agendaday-t"style="text-align:center;color:#990000">DAY 2 <span>&nbsp;-&nbsp;</span> 1ST SEPTEMBER 2017</p>
					<div class="insideagdenda">
						<p class="time"> TIME: 09:30 AM - 10:45 AM</p>
						<h5>Innovation is leadership for business outcomes</h5>
						<p class="text1">Arun Firodia, Chairman of Kinetic Group</p>
					
						<h5>Enterprise Mobility : Next Gen Mobile Enterprise</h5>
						<p class="text1">Sukesh Jain, Vice President Enterprise Business Samsung India</p>
						<h5>Enabling New Digital Experiences At The Convergence Of People,Places And Things</h5>
						<p class="text1">Santanu Ghose Director-Aruba,Hewlett Packard Enterprise Company</p>
					</div>
					<div class="insideagdenda">
						<p class="time"> TIME: 11:25 AM- 12:30 PM</p>
						<h5>The Human Technology</h5>
						<p class="text1">Danielle Di-Masi</p>
					
						<h5>Chat-With-Editor-'Enterprise Digital Transformation'</h5>
						<p class="text1">Leo Joseph, Sr. Director Enterprise Sales & Solutions, HP</p>
						<h5>HPE Pointnext Update</h5>
						<p class="text1">Y. Vikram Kumar, Country Manager - Technology Services Support, Hewlett-Packard Enterprise India </p>
					</div>
					
					<div class="insideagdenda">
						<p class="time">TIME: 2:00 PM- 3:30 PM</p>						
						
						<h5>CIO As A Strategist : Enabling Intelligen World</h5>	
						<p class="text1">Dr.S.Raghunath,Dean and Proffessor at IIM-Bangalore </p>
						<h5>Chat-with-Editor: 'Cloud Conundrum-Between A Rock And A Hard Place?'</h5>	
						<p class="text1">Sridhar Pinnapureddy,Chairman & Managing Director,Ctrls</p>
						<h5>ReBooting a Nation</h5>	
						<p class="text1">Arvind Gupta, Co-founder of Digital India Foundation </p>
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 3:30 PM- 4:30 PM</p>
						<p class="text1">Focus Business Series</p> 
						<p class="text3">Venue: 1st Floor Meeting Rooms</p>
						
						<h5>1. Digital Transformation - The age of connected intelligence</h5>
						<p class="text1">Bino George, Business Head, Solution Consulting – South Asia, Infor </p> 
						<p class="text3">Venue: Meeting Room 1</p>						
						<h5>2. Data to ML Journey - Maximize your Business Advantage</h5>
						<p class="text1">Mohit Pande, Country Manager - India, Google Cloud</p> 
						<p class="text3">Venue: Meeting Room 2</p>	
						<h5>3. Digital Master Class- Crash Course for Innovation & Transformation</h5>
						<p class="text1">Bhavesh Mathur, Transformation Evangelist Sify Technologies</p> 
						<p class="text3">Venue: Meeting Room 3</p>						
						<h5>4. Data – The currency of Digital Economy</h5>
						<p class="text1">Amit Didolkar, Director Sales, NetApp</p> 
						<p class="text3">Venue: Meeting Room 4</p>						
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 6:30 PM Onwards</p>
						<p class="text1">Awards & Cocktails</p>
					</div>					
				</div>
			</div>
         </div>
 </div>
 <script>

</script>
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

        });
		
		function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
    </script>
</div> <!--wrapper endshere -->
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
