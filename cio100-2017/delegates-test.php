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
    <title>CIO100 2017 | Delegates</title>
    <link rel="stylesheet" href="/dist/normalize.css" />
    <link rel="stylesheet" href="/dist/alphaNav.min.css" />
	<link rel="stylesheet" href="/dist/custom.css" />
   <script type="text/javascript" src="/dist/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/dist/velocity.min.js"></script>
    <!-- Using the un-minified version for debugging purposes only; you should use the minified version in production -->
    <script type="text/javascript" src="/dist/alphaNav.js"></script>
	<script type="text/javascript" src="/dist/jquery.scrollTo.min.js"></script>


</head>
<body>
<style>

.listdiv {
    position: fixed;
    top: 100px;
    width: 302px;
    z-index: 9999;
}
header {
    position: fixed;
    width: 320px;
}

#content {
    top: 136px;
}
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


					<a href="http://cio100.cio.in/delegates.php?ModPagespeed=off" class="list-group-item">DELEGATES 2017</a>
					<a href="http://cio100.cio.in/view-by-person.php" class="list-group-item">
						<i class="fa fa-search"></i> INDEX BY PERSON</a>
					<a href="http://cio100.cio.in/view-by-company.php" class="list-group-item">
						<i class="fa fa-user"></i> INDEX BY COMPANY</a>
					<a href="http://cio100.cio.in/agenda.php" class="list-group-item">
						<i class="fa fa-folder-open-o"></i> AGENDA</a>
					<a href="http://cio100.cio.in/speakers.php?ModPagespeed=off" class="list-group-item">
						<i class="fa fa-bar-chart-o"></i> SPEAKERS</a>
					<a href="http://cio100.cio.in/sponsors.php?ModPagespeed=off" class="list-group-item">
						<i class="fa fa-envelope"></i> SPONSORS	</a>
						<a href="http://cio100.cio.in/logout.php" class="list-group-item">
						<i class="fa fa-envelope"></i> LOG OUT	</a>
				</div>
				<img src="../images/CIO100 Logo.png" alt="cio-logo" border="0" align="left" width="200" height="100%" />
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
					<img src="/cio100-2017/images/delegates/<?php echo $name;?>.jpg?id=<?php echo time();?>" alt="<?php echo $name;?>" width="300" height="225"/>
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

(function($){
  
    var jump=function(e)
    {
       if (e){
           e.preventDefault();
           var target = $(this).attr("href");
       }else{
           var target = location.hash;
       }

       $('html,body').animate(
       {
           scrollTop: $(target).offset().top
       },1000,function()
       {
           location.hash = target;
       });

    }


    $(document).ready(function()
    {
			 $('html,body').animate({
  scrollTop: $(window.location.hash).offset().top
});
		
		
        $('a[href^=#]').bind("click", jump);

        if (location.hash){
            setTimeout(function(){
                $('html, body').scrollTop(0).show()
                jump()
            }, 0);
        }else{
          $('html, body').show()
        }
    });
  
})(jQuery)
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
