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
    <title>Premier 100 2018 | Delegates</title>
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
						<i class="fa fa-bar-chart-o"></i> SPEAKERS</a>
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
			Delegates 2017
		</div>
		<div id="content" class="delegateslist">
		 <?php include_once "lib.php";
	         $file_name = 'test2.xlsx';
				//echo $file_name."<br />";
				$xlsx = new SimpleXLSX($file_name);
				$rows = $xlsx->rows();
				//echo "<pre>"; print_r($rows);
				foreach ($rows as $key=>$k) {
					//echo $k[1];
					$id = $k[0];
					$name = $k[1];
					$designation = $k[2];
					$company = $k[3]; ?>

				<figure id="<?php echo $id;?>">
				<a id="<?php echo $id;?>" href="#"><a>
					<img src="../images/delegates/<?php echo $name;?>.jpg?id=<?php echo time();?>" alt="<?php echo $name;?>" width="300" height="225"/>
			  <figcaption>
				  <span class="dtext-1"><?php echo $name;?></span>
				  <span class="dtext-2"><?php echo $designation;?></span>
				  <span class="dtext-3"><?php echo $company;?></span>
				  <span class="dtext-4"><?php echo $id;?></span>


			  </figcaption>
			</figure>

			<?php	} 	?>



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
