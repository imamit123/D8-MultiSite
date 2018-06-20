<? php
session_start();
include '../basic.php'; ?>


<html>
    <body>
        <form action="reader.php" method="post" enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="file" id="file" /><br>
            <input id="submit" type="submit" name="submit" value="Submit" />
        </form>
        <input type="button" name="export" id="export" value="Export All" />
        <input type="button" name="cleardata" id="cleardata" value="Clear" />
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
    </style>
<script src="../jquery-1.10.2.js"></script>
<script src="../jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $("#export").click(function () {
        window.location.assign("download.php")   
 });
 $("#cleardata").click(function () {
        window.location.assign("cleardata.php")   
 });

    });

</script>