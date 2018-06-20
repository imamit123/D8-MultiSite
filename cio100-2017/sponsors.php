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
    <title>Premier 100 2018 | Sponsors</title>
     <link rel="shortcut icon" href="http://www.channelworld.in/sites/channelworld/files/channelworld_favicon.png" type="image/png" />
    <link rel="stylesheet" href="dist/normalize.css" />
    <link rel="stylesheet" href="dist/alphaNav.min.css" />
	  <link rel="stylesheet" href="dist/custom.css" />
    <script type="text/javascript" src="dist/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="dist/velocity.min.js"></script>
    <!-- Using the un-minified version for debugging purposes only; you should use the minified version in production -->
 <!-- <script type="text/javascript" src="dist/alphaNav.min.js"></script>-->
    <script type="text/javascript" src="dist/alphaNav.js"></script>
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


					<a href="<?php echo $baseurl;?>/delegates.php?ModPagespeed=off" class="list-group-item">DELEGATES 2017</a>
					<a href="<?php echo $baseurl;?>/view-by-person.php" class="list-group-item">
						<i class="fa fa-search"></i> INDEX BY PERSON</a>
				<a href="<?php echo $baseurl;?>/view-by-company.php" class="list-group-item">
					<i class="fa fa-user"></i> INDEX BY COMPANY</a>
				<a href="<?php echo $baseurl;?>/agenda.php" class="list-group-item">
						<i class="fa fa-folder-open-o"></i> AGENDA</a>
				<a href="<?php echo $baseurl;?>/speakers.php?ModPagespeed=off" class="list-group-item">
					<i class="fa fa-bar-chart-o"></i> SPEAKERS<!--<span class="badge">14</span>--></a>
				<a href="<?php echo $baseurl;?>/sponsors.php?ModPagespeed=off" class="list-group-item">
					<i class="fa fa-envelope"></i> SPONSORS	</a>
					<a href="<?php echo $baseurl;?>/logout.php" class="list-group-item">
						<i class="fa fa-envelope"></i> LOG OUT	</a>
				</div>
				<img src="http://www.channelworld.in/sites/channelworld/themes/channelworld/images/channelworld-logo.svg" alt="cio-logo" border="0" align="left" width="200" height="100%" />
		     </div>
		</div>
		</header>
		<div class="listdiv">
			sponsors 2017
		</div>
		<div id="content" class="delegateslist sponsors">

		<style>
		
#sponsorsdiv > img {
    border: 1px solid #dedede;
    box-sizing: content-box;
    margin: 1px;
    text-align: center;
    width: 125px;
}
#sponsorsdiv {
				text-align: center;margin-top:20px;
			}

#sponsorsdiv h2 {
    font-size: 15px;
    font-weight: bold;
    margin-top: 0;
    text-transform: uppercase;
	position:relative;
	  z-index: 9999;
}
#sponsorsdiv h2 span {
    background-color: #f6f6f6;
    padding-right: 10px;
	padding-left:10px;
}

#sponsorsdiv h2:before {
    content:"";
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 0.7em;
    border-top: 1px solid black;
    z-index: -1;
}
		</style>
				<div id="sponsorsdiv">
				<h2><span>Keynote sponsors</span></h2>
				<img style="float: none;" src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/sify.png" alt="google" width="150" />
				</div>
				<div id="sponsorsdiv">
				<h2><span>SYMPOSIUM PARTNERS</span></h2>
				<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Aruba.png" alt="Aruba"  />
				<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Google.png" alt="google"  />
				<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/HPE.png" alt="HPE"  />
				<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Lenovo- Nutanix.png" alt="Lenovo - Nutanix"  />
				</div>
				<div id="sponsorsdiv">
					<h2><span>SPECIAL AWARDS PARTNERS</span></h2>
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Canon.png" alt="Canon"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/CtrlS.png" alt="Ctrls"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/hp.png" alt="HP"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Juniper.png" alt="Juniper"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Samsung.png" alt="Samsung"  />
				</div>
				<div id="sponsorsdiv">
					<h2><span>ASSOCIATE PARTNERS</span></h2>
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/BMC.png" alt="Canon"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/commvault.png" alt="Commvault"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/eScan.png" alt="eSoan"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/F5.png" alt="F5"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/FarEye.png" alt="FarEye"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Forcepoint.png" alt="Forcepoint"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Galaxy.png" alt="Galaxy"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/IBM.png" alt="IBM"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/infor.png" alt="infor"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Informatica.png" alt="Informatica"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/NetApp.png" alt="NetApp"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Nutanix.png" alt="Nutanix"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/polycom.png" alt="polycom"  />
					<img src="http://www.cio.in/sites/all/themes/cio_2015/images/cio100-2017-partners/Qlik.png" alt="Qlik"  />

				</div>
         </div>
 </div>
<script type="text/javascript">
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
