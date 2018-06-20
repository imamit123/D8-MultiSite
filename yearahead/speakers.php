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
    <title>CIO Year Ahead 2018 | Speakers</title>
	<link rel="shortcut icon" href="http://www.cio.in/sites/default/files/companyprivate_favicon_1.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="/yearahead/dist/normalize.css" />
    <link rel="stylesheet" href="/yearahead/dist/alphaNav.min.css" />
	<link rel="stylesheet" href="/yearahead/dist/custom.css" />
   <script type="text/javascript" src="/yearahead/dist/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/yearahead/dist/velocity.min.js"></script>
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


					<a href="http://www.cio.in/yearahead/delegates.php" class="list-group-item">DELEGATES 2017</a>
					<a href="http://www.cio.in/yearahead/view-by-person.php" class="list-group-item">
						<i class="fa fa-search"></i> INDEX BY PERSON</a>
					<a href="http://www.cio.in/yearahead/view-by-company.php" class="list-group-item">
						<i class="fa fa-user"></i> INDEX BY COMPANY</a>
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
			</div>
		</header>
		<div class="listdiv">
			Speakers 2017
		</div>
		 <div id="content" class="delegateslist speakerslist">

		 <figure>
					<img src="images/speakers/vaitheeswaran.jpg" alt="vaitheeswaran" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">K.Vaitheeswaran</span>
				  <span class="dtext-2">Known as Father of E-Commerce in India</span>
				  <!--<span class="dtext-3"><Label>Topic:</Label>Your Digital Communication: Strategy or Spaghetti</span>
				  <span class="dtext-3">& </span>
				  <span class="dtext-3"><Label>Topic:</Label>The Human Technology</span> -->
				 <!-- <span class="dtext-4"><Label>Time:</Label>31st August, Thursday 2:00 PM</span>
				  <span class="dtext-3">& </span>
				<span class="dtext-4"><Label>Time:</Label>1st September, Friday 11:25 AM </span>-->
			  </figcaption>
			</figure>

			<figure>
					<img src="images/speakers/prashant-mali.jpg" alt="prashant-mali" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Prashant Mali</span>
				  <span class="dtext-2">Cyber Crime & Law Expert</span>
				  <!-- <span class="dtext-3"><Label>Topic:</Label>Digital Innovation & Transformation</span>
				 <span class="dtext-4"><Label>Time:</Label>31st August, Thursday,2:40 PM</span>-->

			  </figcaption>
			</figure>
			<figure>
					<img src="images/speakers/venu-reddy.jpg" alt="venu-reddy" width="300" height="225"/>
			  <figcaption>
			 	  <span class="dtext-1">Venu Reddy</span>
				  <span class="dtext-2">General Manager, IDC CCR</span>
				 <!-- <span class="dtext-3"><Label>Topic:</Label>Business model innovation and how CIOs can enable it</span>
				  <span class="dtext-4"><Label>Time:</Label>31st August, Thursday 3:30 PM</span>-->

			  </figcaption>
</figure>
<figure>
					<img src="images/speakers/s-raghunath.jpg" alt="venu-reddy" width="300" height="225"/>
			<figcaption>
			 	  <span class="dtext-1">DR. S Raghunath</span>
				  <span class="dtext-2">Professor Cororate Strategy & Policy, IIM-Bangalore</span>
				 <!-- <span class="dtext-3"><Label>Topic:</Label>Business model innovation and how CIOs can enable it</span>
				  <span class="dtext-4"><Label>Time:</Label>31st August, Thursday 3:30 PM</span>-->

			  </figcaption>
</figure>
<figure>
					<img src="images/speakers/sarad-sharma.jpg" alt="sarad-sharma" width="300" height="225"/>
			<figcaption>
			 	  <span class="dtext-1">Sharad Sharma</span>
				  <span class="dtext-2">Co-Founder,ISPIRT Foundation</span>
				 <!-- <span class="dtext-3"><Label>Topic:</Label>Business model innovation and how CIOs can enable it</span>
				  <span class="dtext-4"><Label>Time:</Label>31st August, Thursday 3:30 PM</span>-->

			  </figcaption>
</figure>
			

			<figure>
					<img src="images/speakers/Guru-prasad.jpg" alt="Guru-prasad" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1">Guruprasad Rao</span>
				  <span class="dtext-2">CEO -Imaginarum</span>
				   <!-- <span class="dtext-3"><Label>Topic:</Label>Build what’s next with Google Cloud</span>
				<span class="dtext-4"><Label>Time:</Label>31st August, Thursday,3:50 PM</span>-->


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
