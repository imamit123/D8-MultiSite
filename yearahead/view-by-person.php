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
    <title>CIO Year Ahead 2018 | Index By Person</title>
    <link rel="stylesheet" href="/yearahead/dist/normalize.css" />
    <link rel="stylesheet" href="/yearahead/dist/alphaNav.min.css" />
	  <link rel="stylesheet" href="/yearahead/dist/custom.css" />
    <script type="text/javascript" src="/yearahead/dist/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/yearahead/dist/velocity.min.js"></script>
    <!-- Using the un-minified version for debugging purposes only; you should use the minified version in production -->
    <script type="text/javascript" src="/yearahead/dist/alphaNav.js"></script>
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
body{background:#333;}
#wrapper{width:320px;margin:0px auto;}
#content {
    background: #f6f6f6 none repeat scroll 0 0;
    position: relative;

}
#content{height:78vh !important;}
#alphanav-slider{height:77vh !important;}
#list-content {
     width: 100%;
     height: 100%;
	background:#f6f6f6;padding-top:5px;
}
.alphanav-list {
    display: block;
    list-style: outside none none;
    margin: 0;
    overflow-x: hidden !important;
    overflow-y: scroll !important;
    padding-left: 0;
}
#alphanav-slider{position:absolute;}
#alphanav-slider {
    list-style: outside none none;
    margin: 0;
    min-height: 250px;
    padding: 2px 0;
    position: absolute;
    right: 0 !important;
    transition: width 250ms ease 0s;
    width: 25px;
    z-index: 10;top:0px !important;
}
.alphanav-component{background:#f6f6f6;}

#alphanav-slider li {
    color: #999999;
    font-size: 2vh;
    padding: 0 1px;
}
#alphanav-slider li.letter:hover {
    color: #8b0000;
}
.mini-submenu {
    float: left;
    margin: 8px 20px 20px 10px;
    padding: 10px 9px;
}
.mini-submenu:hover{
  cursor: pointer;
  background:#343434;
}
.mini-submenu.open {
    background: #343434 none repeat scroll 0 0;
}
.mini-submenu .icon-bar {
  border-radius: 1px;
  display: block;
  height: 2px;
  width: 22px;
  margin-top: 3px;
}
.mini-submenu .icon-bar:first-child {
    margin-top: 0;
}

.mini-submenu .icon-bar {
  background-color: #fff;
}


#slide-submenu {
    border-radius: 4px;
    color: #ffffff;
    cursor: pointer;
    display: block;
    padding: 0 8px;
    position: absolute;
    right: 2px;
    text-align: right;
    top: 1px;
    z-index: 999;
}


.list-group {
    -moz-box-direction: normal;
    -moz-box-orient: vertical;
    background-color: #242424;
    box-sizing: border-box;
    flex-direction: column;
    margin-bottom: 0;
    padding: 20px 30px;
    position: absolute;
    top: 100px;
    width: 230px;
    z-index: 99999;
}

.list-group-item {
    -moz-box-align: center;
    align-items: center;
    text-transform:uppercase;
    border-bottom: 1px solid #666;
    color: #fff;
    display: flex;
    flex-flow: row wrap;
    margin-bottom: -1px;
    padding: 0.75rem 0rem;
    position: relative;
    text-decoration: none;
	font-size:14px;
}
.list-group-item:hover{
color:#ff0000;
}

.list-group .list-group-item:last-child {
    border: medium none;
}

.fa {
    display: inline-block;
    font: bold 20px/1 helvetica;
    text-rendering: auto;
}

.viewlist {
    border-bottom: 1px solid #dadada;
    display: block;
    margin-left: 14px;
    padding-bottom: 10px;
    padding-top: 10px;
    width: 90%;
}
.viewlist p {
    margin: 1px 0;
	display:block;
}
.viewlist p a{
	font-size:14px;
	font-weight:bold;
	text-decoration:none;
	text-transform:capitalize;
	color:#333;
	display:block;
}

.viewlist span {
    display: block;
}

.viewlist p a span:nth-child(2){
	font-size:12px;
	font-weight:normal;
	text-decoration:none;
	text-transform:capitalize;
	color:#666;
	display:block;
}
.viewlist p a:hover{background:none !important;}

.viewlist p a:hover span:nth-child(2)::after {
    bottom: 20px;
    content: "≻";
    float: right;
    font-size: 25px;
    font-weight: bold;
    position: relative;
}

.viewlist p a:hover span{color:#ff0000 !important;background:none !important;}
.viewlist p:hover{color:#ff0000 !important;}
.notattending {display:none;}
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
						<i class="fa fa-times">&times </i>
					</span>

					<a href="http://www.cio.in/yearahead/delegates.php" class="list-group-item">DELEGATES 2017</a>
					<a href="http://www.cio.in/yearahead/view-by-person.php" class="list-group-item">
						<i class="fa fa-search"></i> INDEX BY PERSON</a>
				<a href="http://www.cio.in/yearahead/view-by-company.php" class="list-group-item">
					<i class="fa fa-user"></i> INDEX BY COMPANY</a>
				<a href="http://www.cio.in/yearahead/agenda.php" class="list-group-item">
						<i class="fa fa-folder-open-o"></i> AGENDA</a>
				<a href="http://www.cio.in/yearahead/speakers.php" class="list-group-item">
					<i class="fa fa-bar-chart-o"></i> SPEAKERS<!--<span class="badge">14</span>--></a>
				<a href="http://www.cio.in/yearahead/sponsors.php" class="list-group-item">
					<i class="fa fa-envelope"></i> SPONSORS	</a>
					<a href="http://www.cio.in/yearahead/logout.php" class="list-group-item">
						<i class="fa fa-envelope"></i> LOG OUT	</a>
			</div>
		<img src="http://www.cio.in/yearahead/images/yearahead18-logov1.png" alt="yearahead18-logo-logo" border="0" align="left" width="120" height="100%" style="margin: -10px 25px; width: 131px; height: auto !important;" />
		</div>
		</header>
		<div class="listdiv">
			View By Person Name
		</div>
		<div id="content">
		<?php include_once "lib.php";
	         $file_name = 'person-yearahead.xlsx';
				//echo $file_name."<br />";
				$xlsx = new SimpleXLSX($file_name);
				$rows = $xlsx->rows();
				
				//echo "<pre>"; print_r($rows); ?>
        <ul id="list-content">
            <li class="alphanav-header-A">
                <ul class='list-section-content'>
				<?php for ($i = 0; $i <= 28; $i++) {
						if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
					
				<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>" onclick="window.location.hash='#<?php echo $rows[$i][0]; ?>';window.location.reload(true);">
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
				<?php for ($i = 29; $i <= 33; $i++) { 
						if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                   <?php for ($i = 34; $i <= 38; $i++) { 
				   	if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                <?php for ($i = 39; $i <= 60; $i++) { 	
				if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
           <!-- <li class="alphanav-header-F">
				
            </li>-->
            <li class="alphanav-header-G">
                <ul class='list-section-content'>
                <?php for ($i = 61; $i <= 67; $i++) {
						if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
           <!-- <li class="alphanav-header-H">
                
            </li>-->
            <li class="alphanav-header-I">
				<ul class='list-section-content'>
							<?php for ($i = 68; $i <= 68; $i++) { 
									if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
									<div class="viewlist">
								<p>
			<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
						<span><?php echo $rows[$i][1]; ?></span>
						<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
			</a>
								</p>
									</div>
								</li>
							<?php	} ?>
							</ul>
            </li>
            <li class="alphanav-header-J">
               <ul class='list-section-content'>
                <?php for ($i = 69; $i <= 77; $i++) {
						if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>

					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <li class="alphanav-header-K">
                <ul class='list-section-content'>
                <?php for ($i = 78; $i <= 86; $i++) { 
						if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <!--<li class="alphanav-header-L">
                 //skipped L cos its 0
				
            </li> -->
            <li class="alphanav-header-M">
                <ul class='list-section-content'>
                <?php for ($i = 88; $i <= 105; $i++) { 
					if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                <?php for ($i = 106; $i <= 113; $i++) {
					if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                <?php for ($i = 114; $i <= 126; $i++) { 
					if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                <?php for ($i = 127; $i <= 149; $i++) { 
					if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                <?php for ($i = 150; $i <= 182; $i++) {
						if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                <?php for ($i = 183; $i <= 185; $i++) { 
					if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                <?php for ($i = 186; $i <= 188; $i++) { 
					if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                <?php for ($i = 189; $i <= 208; $i++) {
						if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
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
                <?php for ($i = 209; $i <= 209; $i++) {
						if($rows[$i][4]==0){
						$class = 'notattending';
						} else  {
						$class='attending'; }?>
					<li class='<?php echo $class;?>'>
						<div class="viewlist">
					<p>
<a class="" href="http://www.cio.in/yearahead/delegates.php/#<?php echo $rows[$i][0]; ?>">
			<span><?php echo $rows[$i][1]; ?></span>
			<span style="font-size:12px;font-weight:normal;color:#666;"><?php echo $rows[$i][3];?></span>
</a>
					</p>
						</div>
					</li>
				<?php	} ?>
				</ul>
            </li>
            <!--<li class="alphanav-header-Z">
               
            </li> -->
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
<script>
$(window).load(function() {
    if (window.location.hash != '') {
        window.location.hash = window.location.hash;
    }
});
</script>
</body>
</html>
