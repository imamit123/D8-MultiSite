<?php
session_start();

require 'config.php';
$db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
   
$query = "SELECT * FROM `delegate` WHERE `registered` = '2'";
$result = mysqli_query($link,$query);

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="CRM, sales, marketing, support, contact management, online CRM, on demand CRM, mobile CRM, project management, management, tools" />
        <meta name="author" content="VK" />
        <meta name="description" content="CRM Software to improve sales conversions, extend marketing reach, and build lasting customer relationships." />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="maximum-scale=1">
        <title>IDG India Registration Software</title>
        <?php $time = time(); ?>
        <link href="css/styles.css?achrtubynjhbib=<?php echo $time; ?>" rel="stylesheet" type="text/css" media="screen">
        <style type="text/css">
            .right-info-details{
                width: 98%;
            }
            .stle table{
                width: 100%;
                height: auto;
            }
            .stle table tr{
                width: 100%;
                height: auto;
            }
            .stle table tr th{
                width: 20%;
                height: auto;
                border: 1px solid black;
            }
            .stle table tr td{
                width: 20%;
                height: auto;
                border: 1px solid black;
            }
        </style>

    </head>
    <body>

        <div id="wrapper1">
            <!-- header -->
            <header id="head">
                <div id="logo-banner">
                    <div class="left-logo">
                        <a href="index.php" target="_self"><img src="images/idg.png" alt="IDG India" title="IDG India" width="258" height="66" /></a>
                    </div>
                    <div class="right-logDetails">
                        <p class="log-details"><span class="login-type"></span></p>
                    </div>
                </div>
                <!-- Navigation bar -->
            </header>
            <!-- header -->
            <!-- content -->
            <div id="content">
                <div class="navigation-type" style="border:none;"><h3></h3></div>
                <div class="org-content" style="width:85%;"> 
                    <!-- login -->


                    <div class="organisation-info">

                        <div class="info-details">


                            <div class="right-info-details">
                                <div class="info-title"><h3>New Registration </h3></div>
                                <div class="stle">
                                    <table>
                                       <tr>
                                            <th>ID</th>
                                            <th>Type</th>
                                            <th>Reference</th>
                                            <th>Name</th>
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Designation</th>
                                            <th>Source</th>
                                            
                                        </tr>
                                       <?php While($row = mysqli_fetch_assoc($result)){ 
                                            //print_r($row);?>
                                    
                                         <tr>
                                            <th><?php echo $row['id'];?></th>
                                            <th><?php echo $row['type'];?></th>
                                            <th><?php echo $row['reference'];?></th>
                                            <th><?php echo $row['first_name'];?></th>
                                            <th><?php echo $row['comapny_name'];?></th>
                                            <th><?php echo $row['email_id'];?></th>
                                            <th><?php echo $row['mobile_number'];?></th>
                                            
                                            <th><?php echo $row['designation'];?></th>
                                            <th><?php echo $row['field1'];?></th>
                                        </tr>
<?php }?>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- login -->
                </div>
            </div>
            <!-- content -->
            <!-- footer -->
            <footer id="foot">
                <div class="left-footer">
                    <p>Copyright 2005 - 2013 IDG Media Pvt. Ltd. All Rights Reserved.</p>
                </div>
                <div class="right-footer">
                    <p><a href="www.idg.in" target="_blank"><span class="idg-logo"><img src="images/IDG-(R).png" alt="IDG Media" width="100" height="40" /></span></a></p>

                </div>
            </footer>
            <!-- footer --> 
        </div>

    </body>
</html>
