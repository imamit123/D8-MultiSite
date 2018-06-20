<?php
session_start();
include '../basic.php';
include '../config.php';
$db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
?>


<html>
    <head>

    <title>Bulk Registration</title>
    <style>
    body {
        background: none repeat scroll 0 0 #c3dfef;
        border: 1px solid;
        font-family: Verdana,Geneva,sans-serif;
        font-size: 17px;
        height: auto;
        margin: 54px auto;
        padding: 20px;
        width: 980px;
    }

    input {
        margin-bottom: 22px;
        margin-left: 80px;
    }

    #file ,#export,#cleardata{
        background-color: #207cca;
        color: #fafafa;
        font-size: 17px;
        margin-bottom: 20px;
        margin-left: 12px;
     padding:0px 5px;
     cursor:pointer;
    }

    .chkbx {
    margin-left: 0;
    margin-top: 10px;
    margin-bottom: 10px;
    }

    .register{
       margin-top: 20px;
    margin-left: 40%;
    }


    #export, #cleardata {
        border: medium none;
        margin-left: 104px;
    }

    #submit {
        background-color: #207cca;
        border: 2px solid #207cca;
        color: #fafafa;
        font-size: 23px;
        left: 23px;
        padding: 2px 18px;
        position: relative;
     cursor:pointer;
    }
    #export:hover,#cleardata:hover {
        background-color: white;
        color: #207cca;
      
    } 
     
    #submit:hover{
        background-color: white;
        color: #207cca;
        font-weight: bold;
    }

    /*
    Style for Table
    */

      .Table
        {
            display: table;
               border-collapse: collapse;
        font-size: 12px;
        table-layout: auto;
        text-align: left;
        width: 100%;
        background-color:#F3F3F3;
            
        }
      /*  .Title
        {
            display: table-caption;
            text-align: center;
            font-weight: bold;
            font-size: larger;
        }*/
        .Heading
        {
            display: table-row;
            font-weight: bold; 
        color: #2C6382;
        font-size: 14px;
        font-weight: bold;
        height: 40px;
        white-space: nowrap;
        }
        .Row
        {
            display: table-row;
        }
    #tbl_org {
        border-collapse: collapse;
        font-size: 13px;
        table-layout: auto;
        text-align: left;
        width: 45%;
    }
    .Cell {
        border: 1px solid #DFDFE9;
        display: table-cell;
        padding-left: 5px;
        padding-right: 5px;
        vertical-align: middle;
    }
    .Cell:first-child{
        text-align:center;}
        
        .Heading {
        background-color: #E1E5FF;
        color: #2C6382;
        display: table-row;
        font-weight: bold;
        height: 40px;
        text-align: center;
        white-space: nowrap;}
        </style>
    </head>
    <body>
        <h1 align='center'>Bulk Registration</h1>
    <form name="arrayoffields" method="post" action="register_submit.php">
   <div class="Row" >
        <div class="Cell"><h4 align='center'>#</h4></div>
        <div class="Cell"><h4 align='center'>ID</h4></div>
        <div class="Cell"><h4 align='center'>TYPE</h4></div>
        <div class="Cell"><h4 align='center'>NAME</h4></div>
        <div class="Cell"><h4 align='center'>COMPANY NAME</h4></div>
  </div>
		
    <?php $query = "select * from delegate where registered=''";
    $result = mysqli_query($link,$query);
    $count=1;
            while ($row = mysqli_fetch_assoc($result)){
            ?>
   <div class="Row" >
        <div class="cell"><input type="checkbox" class="chkbx" name="confirm<?php echo $count;?>" value="<?php echo $count;?>"></div>
        <div class="Cell"><input type="hidden" name="id<?php echo $count;?>" value="<?php echo $row['id'];?>"><?php echo $row['id'];?></input></div>
        <div class="Cell"><p><?php echo $row['type'];?></p></div>
        <div class="Cell"><p><?php echo $row['first_name'];?></p></div>
        <div class="Cell"><p><?php echo $row['comapny_name'];?></p></div>
  </div>
            <?php $count++;} ?>
            <input type="hidden" name="count" value="<?php echo $count;?>"/>
            <input type="submit" name="Register" value="Register" class="register" id="submit">
  </form>
     <div></div>
    </body>
</html>

