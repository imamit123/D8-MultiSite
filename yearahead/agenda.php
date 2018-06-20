<?php session_start();
//echo $_SESSION['user'];
 if (isset($_SESSION['psw'])) {
   // do nothing
} else {
    header('Location: login.php');
}



?>
 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="AlphaNav Mobile Demo">
    <title>CIO Year Ahead 2018 | Agenda</title>
	<link rel="shortcut icon" href="http://www.cio.in/sites/default/files/companyprivate_favicon_1.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="/yearahead/dist/normalize.css" />
    <link rel="stylesheet" href="/yearahead/dist/alphaNav.min.css" />
	  <link rel="stylesheet" href="/yearahead/dist/custom.css" />
    <script type="text/javascript" src="/yearahead/dist/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/yearahead/dist/velocity.min.js"></script>
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


					<a href="http://www.cio.in/yearahead/delegates.php" class="list-group-item">DELEGATES 2017</a>
					<a href="http://www.cio.in/yearahead/view-by-person.php" class="list-group-item">
						<i class="fa fa-search"></i> VIEW BY PERSON NAME</a>
					<a href="http://www.cio.in/yearahead/view-by-company.php" class="list-group-item">
						<i class="fa fa-user"></i> VIEW BY COMPANY NAME</a>
					<a href="http://www.cio.in/yearahead/agenda.php" class="list-group-item">
						<i class="fa fa-folder-open-o"></i> AGENDA</a>
					<a href="http://www.cio.in/yearahead/speakers.php" class="list-group-item">
						<i class="fa fa-bar-chart-o"></i> SPEAKERS</a>
					<a href="http://www.cio.in/yearahead/sponsors.php" class="list-group-item">
						<i class="fa fa-envelope"></i> SPONSORS	</a>
						<a href="http://www.cio.in/yearahead/logout.php" class="list-group-item">
						<i class="fa fa-envelope"></i> LOG OUT	</a>
				</div>
				<img src="images/yearahead18-logov1.png" alt="yearahead18-logo-logo" border="0" align="left" width="120" height="100%" style="margin: -10px 25px; width: 131px; height: auto !important;" />
		     </div>
		</header>
		<div class="listdiv">
			YEAR AHEAD - AGENDA 2018
		</div>
		<div id="content" class="delegateslist">
			<div class="tab">
				<button class="tablinks active" onclick="openCity(event, 'agenda1')">AGENDA DAY 1</button><span style="color:#dadada;">|</span>
				<button class="tablinks" onclick="openCity(event, 'agenda2')">Agenda Day 2</button>
			</div>
			<div id="agenda1" class="tabcontent" style="display:block;">
				<div class="agendacontent">
					<p  class="agendaday-t"style="text-align:center;color:#990000">DAY 1 <span>&nbsp;-&nbsp;</span> 22nd November 2017</p>
					<div class="insideagdenda">
						<p class="time"> 11:30 PM - 01:00 PM </p>
						<h5>Welcome Note</h5>
						<p class="text1"><STRONG>Shanthari Mallaya</STRONG>,Executive Editor - IDG INDIA, <br><STRONG>Meraj Ahmad</STRONG>,Country Manager - Enterprise Strategy & Global Accounts, Hewlett-Packard India</p>
					</div>
					<div class="insideagdenda">
						<!--<p class="time">TIME: 2:00 - 3:00 PM </p>-->
						<h5>Keynote Session – Leadership in the Digital Economy</h5>
						<p class="text1"><STRONG>K. Vaitheeswaran</STRONG>, Serial Entrepreneur & Author, known as the “Father of E-Commerce in India”</p>
						<h5></h5>
						<!--<p class="text1">Kamal Nath, CEO, Sify Technologies</p>-->

					</div>
					<div class="insideagdenda">
						<!--<p class="time">TIME: 2:00 - 3:00 PM </p>-->
						<h5>Chat with Editor – Office of the Future</h5>
						<p class="text1"><STRONG>Meraj Ahmad</STRONG>,Country Manager - Enterprise Strategy & Global Accounts, Hewlett-Packard India</p>
						<h5>&</h5>
						<p class="text1"><STRONG>Anurag Gupta</STRONG>,Country PC Category Head, Hewlett-Packard India</p>
						<h5></h5>
						<!--<p class="text1">Kamal Nath, CEO, Sify Technologies</p>-->
					</div>
					<div class="insideagdenda">
						<!--<p class="time">TIME: 2:00 - 3:00 PM </p>-->
						<h5>Solving “X”</h5>
						<p class="text1"><STRONG>Gangadhar Heralgi</STRONG>,Co-Founder & CTO, Monocept</p>
						<h5></h5>
						<!--<p class="text1">Kamal Nath, CEO, Sify Technologies</p>-->
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 1:00 - 2:30 PM </p>
						<h5>Lunch and Check-in</h5>
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 2:30 PM - 3:10 PM </p>
						<h5>Today’s Data Protection – Inside, Outside and Mobilized</h5>
						<p class="text1"><STRONG>Prashant Mali</STRONG>,Cyber Crime Expert Lawyer</p>
						<h5>Importance of Integrated Approach to Security</h5>
						<p class="text1"><STRONG>Vishak Raman</STRONG>,Director - Security Business, Cisco India & SAARC</p>
						
						<h5></h5>
						<p class="text1"></p>
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 3:10 PM - 3:30 PM </p>
						<h5>Tea Break</h5>
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 3:30 PM - 4:30 PM </p>
						<h5>Cloud Spawl – The Rising Epidemic and What to do About it</h5>
						<p class="text1"><STRONG>Dr. S. Raghunath</STRONG>, Professor - Corporate Strategy & Policy, IIM-Bangalore</p>
						<h5>Infrastructure for the Cognitive Era</h5>
						<p class="text1"><STRONG>Ravi Jain</STRONG>, Associate Director, IBM Server Solutions, India SA</p>
						<h5>The Journey to Cloud</h5>
						<p class="text1"><STRONG>Suvasish Mohapatra</STRONG>, Managing Director - Operations, Accenture India</p>
						
					</div>


					<div class="insideagdenda">
						<p class="time">TIME: 7:00 PM Onwards</p>
						<p class="text1">Gala Dinner and Cocktails – SKY DECK</p>
					</div>

				</div>

			</div>
			<div id="agenda2" class="tabcontent" style="display:none;">
				<div class="agendacontent">
					<p  class="agendaday-t"style="text-align:center;color:#990000">DAY 2 <span>&nbsp;-&nbsp;</span>23rd November 2017</p>
					<div class="insideagdenda">
						<p class="time"> TIME: 09:30 AM - 11:30 AM</p>
						<h5>State of the CIO 2018 Survey</h5>
						<p class="text1"><STRONG>Yogesh Gupta</STRONG>, Executive Editor, IDG India</p>

						<h5>CIO Task Force – Thought Paper Discussions</h5>
					</div>
					<div class="insideagdenda">
						<p class="time"> TIME: 11:30 AM- 12:00 PM</p>
						<h5>Tea Break</h5>
					</div>
					<div class="insideagdenda">
						<p class="time"> TIME: 12:00 PM - 1:00 PM</p>
						<h5>Analytics – The Differentiator that has Long Term Impact</h5>
						<p class="text1"><STRONG>Venu Reddy</STRONG>, General Manager, IDC, CCR</p>
						<h5>Disruptive Analytics – Innovation with Acceleration</h5>
						<p class="text1"><STRONG>Raghavendran Kandaswami</STRONG>, Practice Head – Public Sector, SAS India</p>
					    <h5>Unified Governance and Integration for Building Governed Data Lakes & Deriving Trusted Insights</h5>
						<p class="text1"><STRONG>Manmeet Singh Kahlon</STRONG>, Senior Technical Specialist, Analytics, IBM</p>
					</div>

					<div class="insideagdenda">
						<p class="time">TIME: 01:00 PM - 02:30 PM</p>
						<h5>Lunch Break</h5>
					</div>
					<div class="insideagdenda">
						<p class="time">TIME: 02:30 PM - 03:10 PM</p>
						<p class="text1">3D Printing – Future Technology</p>
						<p class="text1"><STRONG>Guruprasad Rao</STRONG>, CEO, Imaginarium</p>
					</div>	
					<div class="insideagdenda">
						<h5>Closing Keynote – India’s Rapidly Digitising Economy: What Businesses
Should do to Thrive in this New Era</h5>
						<p class="text1"><STRONG>Sharad Sharma</STRONG>, Co-founder, iSPIRT Foundation</p>
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
