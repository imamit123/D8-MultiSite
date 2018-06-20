<?php
session_start();
if($_SESSION['usertype'] == 'Admin'){
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
<title>Upload</title>
    <body>
		<?php if(isset($_SESSION['updated_record'])):?>
			<div id="updated-records"><?php echo $_SESSION['updated_record'];unset($_SESSION['updated_record']);?></div>
		<?php endif;?>
		<p> Last Inserted Record ID: <?php echo get_last_inserted_id();?></p>
        <form action="reader.php" method="post" enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="file" id="file" /><br>
		<p>New ID Starts From: <span><input type="text" name="generated_id" id="new-gen-id" /></span></p>
            <input id="submit" type="submit" name="submit" value="Submit" />
        </form>
        <input type="button" name="export" id="export" value="Export All" />
        <input type="button" name="cleardata" id="cleardata" value="Clear" />
        <div id="table-details">
        <div id="tbl_org" class="Table">
  <div class="Heading">
        <div class="Cell"><p>Type</p></div>
        <div class="Cell"><p>Pre Registered</p></div>
        <div class="Cell"><p>Checked In </p></div>
        <div class="Cell"><p>Added New</p></div>
        <div class="Cell"><p>Visiting Card</p></div>
        <div class="Cell"><p>Export</p></div>
    </div>
    <?php $query_type = "select * from type";
     $result_type = mysqli_query($link,$query_type);
            while ($row_type = mysqli_fetch_assoc($result_type)){
               $preresg = total_count($row_type['Type']);
               $chckin = cheakin ($row_type['Type'],1);
               $vcard = visit ($row_type['Type']);
               $add_new = cheakin ($row_type['Type'],2);?>
   <div class="Row" >
        <div class="Cell"><p><?php echo $row_type['Type'];?></p></div>
        <div class="Cell"><p><?php echo $preresg;?></p></div>
        <div class="Cell"><p><?php echo $chckin;?></p></div>
        <div class="Cell"><p><?php echo $add_new;?></p></div>
        <div class="Cell"><p><?php echo $vcard;?></p></div>
        <div class="Cell"><p><a href="download.php?type=<?php echo $row_type['Type'] ?>">Export</a></p></div>
  </div>
            <?php } ?>
  
     </div></div>
    </body>
</html>
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
<script src="../jquery-1.10.2.js"></script>
<script src="../jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $("#export").click(function () {
        window.location.assign("download.php")   
 });
 $("#cleardata").click(function () {
     if (confirm("Are You Sure!") == true) {
         window.location.assign("cleardata.php");
    } 
          
 });

    });

</script>
<?php } else {
    header('Location: ../index.php');
}?>