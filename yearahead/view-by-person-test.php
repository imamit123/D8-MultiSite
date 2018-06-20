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
    <title>CIO100 2017 | Index By Person</title>
    <link rel="stylesheet" href="/dist/normalize.css" />
    <link rel="stylesheet" href="/dist/alphaNav.min.css" />
	  <link rel="stylesheet" href="/dist/custom.css" />
    <script type="text/javascript" src="/dist/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/dist/velocity.min.js"></script>
    <!-- Using the un-minified version for debugging purposes only; you should use the minified version in production -->
    <script type="text/javascript" src="/dist/alphaNav.js"></script>
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

  
</head>
<body>
<style>
.listdiv {
    position: fixed;
    top: 100px;
    width: 302px;
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

					<a href="http://cio100.cio.in/delegates.php" class="list-group-item">DELEGATES 2017</a>
					<a href="http://cio100.cio.in/view-by-person.php" class="list-group-item">
						<i class="fa fa-search"></i> INDEX BY PERSON</a>
				<a href="http://cio100.cio.in/view-by-company.php" class="list-group-item">
					<i class="fa fa-user"></i> INDEX BY COMPANY</a>
				<a href="http://cio100.cio.in/agenda.php" class="list-group-item">
						<i class="fa fa-folder-open-o"></i> AGENDA</a>
				<a href="http://cio100.cio.in/speakers.php" class="list-group-item">
					<i class="fa fa-bar-chart-o"></i> SPEAKERS<!--<span class="badge">14</span>--></a>
				<a href="http://cio100.cio.in/sponsors.php" class="list-group-item">
					<i class="fa fa-envelope"></i> SPONSORS	</a>
					<a href="http://cio100.cio.in/logout.php" class="list-group-item">
						<i class="fa fa-envelope"></i> LOG OUT	</a>
			</div>
		<img src="CIO100 Logo.png" alt="cio-logo" border="0" align="left" width="200" height="100%" />
		</div>
		</header>
		<div class="listdiv">
			View By Person Name
		</div>
		<div id="content">
		<?php include_once "lib.php";
	         $file_name = 'person.xlsx';
				//echo $file_name."<br />";
				$xlsx = new SimpleXLSX($file_name);
				$rows = $xlsx->rows();
				//echo "<pre>"; print_r($rows); ?>
        <ul id="list-content">
            <li class="alphanav-header-A">
                <ul class='list-section-content'>
				<?php for ($i = 0; $i <= 15; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
					
				<a class="" href="http://cio100.cio.in/delegates-test.php/#<?php echo $rows[$i][0]; ?>" onclick="window.location.hash='#<?php echo $rows[$i][0]; ?>';window.location.reload(true);">
					<span><?php echo $rows[$i][1]; ?></span>
					<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
				</a>
					</p>
						</div>
					</li>
	            <?php	} ?>
				 </ul>
            </li>
            <li class="alphanav-header-B">
                <ul class='list-section-content'>
				<?php for ($i = 16; $i <= 21; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
	            <?php	} ?>
				 </ul>
            </li>
            <li class="alphanav-header-C">
                <ul class='list-section-content'>
                   <?php for ($i = 22; $i <= 22; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
	            <?php	} ?>
                </ul>
            </li>
            <li class="alphanav-header-D">
			 <ul class='list-section-content'>
                <?php for ($i = 23; $i <= 28; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
	            <?php	} ?>
                </ul>
            </li>
            <!--<li class="alphanav-header-E">
				
            </li>-->
            <li class="alphanav-header-F">
				<ul class='list-section-content'>
                <?php for ($i = 29; $i <= 29; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-G">
                <ul class='list-section-content'>
                <?php for ($i = 30; $i <= 35; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-H">
                 <ul class='list-section-content'>
                <?php for ($i = 36; $i <= 36; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <!--<li class="alphanav-header-I">

            </li>-->
            <li class="alphanav-header-J">
               <ul class='list-section-content'>
                <?php for ($i = 37; $i <= 43; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
onclick="window.location.hash='#slide-3';window.location.reload(true);
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-K">
                <ul class='list-section-content'>
                <?php for ($i = 44; $i <= 50; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-L">
                 <ul class='list-section-content'>
                <?php for ($i = 51; $i <= 51; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-M">
                <ul class='list-section-content'>
                <?php for ($i = 52; $i <= 63; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-N">
                 <ul class='list-section-content'>
                <?php for ($i = 64; $i <= 69; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <!--<li class="alphanav-header-O">

            </li>-->
            <li class="alphanav-header-P">
                <ul class='list-section-content'>
                <?php for ($i = 70; $i <= 75; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
           <!-- <li class="alphanav-header-Q">

            </li>-->
            <li class="alphanav-header-R">
               <ul class='list-section-content'>
                <?php for ($i = 76; $i <= 91; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-S">
                <ul class='list-section-content'>
                <?php for ($i = 92; $i <= 113; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-T">
                <ul class='list-section-content'>
                <?php for ($i = 114; $i <= 114; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-U">
               <ul class='list-section-content'>
                <?php for ($i = 115; $i <= 115; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-V">
                <ul class='list-section-content'>
                <?php for ($i = 116; $i <= 120; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
           <!-- <li class="alphanav-header-W">

            </li>

            <li class="alphanav-header-X">

            </li>-->

            <li class="alphanav-header-Y">
               <ul class='list-section-content'>
                <?php for ($i = 121; $i <= 122; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-Z">
                <ul class='list-section-content'>
                <?php for ($i = 123; $i <= 123; $i++) { ?>
					<li>
						<div class="viewlist">
					<p>
<a class="" href="http://cio100.cio.in/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
        </ul>
    </div>
 </div>
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
