<?php session_start();
 if (isset($_SESSION['psw'])) {
   header('Location: delegates.php?ModPagespeed=off');
} else {

	// do nothing
}  ?>
<!Doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="AlphaNav Mobile Demo">
    <title>CIO Year Ahead 2018 | Login Page</title>
	<link rel="shortcut icon" href="http://www.cio.in/sites/default/files/companyprivate_favicon_1.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="dist/normalize.css" />
    <link rel="stylesheet" href="dist/alphaNav.min.css" />
    <link rel="stylesheet" href="dist/custom.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
    <script type="text/javascript" src="dist/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="dist/velocity.min.js"></script>
    <!-- Using the un-minified version for debugging purposes only; you should use the minified version in production -->
    <script type="text/javascript" src="dist/alphaNav.min.js"></script>
    <script type="text/javascript">
        $(document).on('ready', function () {
            $('#list-content').alphaNav({
                autoHeight: false,
                arrows: false,
                debug: false,
                growEffect: false,
                overlay: false,
                scrollDuration: '450ms',
                trimList: true,
                onScrollComplete: function (elements) {
                    console.log("onScrollComplete! ", elements);
                }
            });


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
    <style>

    </style>
</head>
<body>
    <div id="wrapper" class="loginpage">
		<header>
		<div class="header-class">
			  <div class="sidebar hidden-sm-up float-left">
			<div class="mini-submenu  hidden-sm-up mt-3 mr-2" style="display: block;float: left;">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</div>
			<div class="list-group" style="display: none;">
				<span class="float-right" id="slide-submenu">
						<i class="fa fa-times">&times </i>
					</span>

				<a href="#" class="list-group-item">DELEGATES 2017</a>
				<a href="#" class="list-group-item">
					<i class="fa fa-search"></i> VIEW BY PERSON NAME</a>
				<a href="#" class="list-group-item">
					<i class="fa fa-user"></i> VIEW BY COMPANY NAME</a>
				<a href="#" class="list-group-item">
					<i class="fa fa-folder-open-o"></i> AGENDA</a>
				<a href="#" class="list-group-item">
					<i class="fa fa-bar-chart-o"></i> SPEAKERS<!--<span class="badge">14</span>--></a>
				<a href="#" class="list-group-item">
					<i class="fa fa-envelope"></i> SPONSORS	</a>
			</div>
			<div id="headerlogo" style="position: relative;float: left;width: 80%;">
		     <img src="images/headerlogo2.png" alt="yearahead18-logo-logo" border="0" align="left" width="100%" height="100%" style="margin:0px auto;display:block" />
		    </div>
		</div>
		</header>
		<div id="content">
			<div class="logintext">
			<p style="font-size: 43px; font-weight: bold; font-family: helvetica; padding-top: 38px;">MAXIMISER</p>
				<!-- <p class="rcolor">12th Annual Edition</p>
				<p style="margin-top:15px">31 Aug - 1 Sep, 2017  </p> -->
				<p style="padding-bottom: 23px; border-bottom: 1px solid rgb(94, 94, 94);"><!--JW Marriott, Pune --></p>
			</div>
			<div class="logintext-2">
				<!--<p class="rcolor">cio100</p> -->
				<p style="">Welcome</p>
			</div>
			<form name="loginform" id="loginform" action="verification.php" method="post" class="">
				<p class="login-username">
					<input type="text" name="uname" id="user_login" class="input" value="" size="20"
					placeholder="Your Registration Code">
				</p>
				<p class="login-password">
					 <input type="password" name="psw" id="user_pass" class="input" value="" size="20" placeholder="Your Mobile Number">
				</p>

				<p class="login-submit">
					<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="login">
				</p>
				<p class="login-remember" style="color:#ddd;">
					<?php if (isset($_SESSION['error_msg'])) {
					echo $_SESSION['error_msg'];
					} ?>
				</p>
			</form>
		</div>
 </div>
</div> <!--wrapper endshere -->
</body>
</html>
