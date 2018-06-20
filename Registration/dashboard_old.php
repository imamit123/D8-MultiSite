<?php
session_start();
include 'basic.php';
//echo $_SESSION['export_result'];
$query = "select * from type";
$result = mysql_query($query);
$json_type_array = array();
$type_query = '';
while ($row = mysql_fetch_array($result)) {
    $type_query .= "<option value=" . $row['Type'] . ">" . $row['Type'] . "</option>";
    $json_type_array[] = $row['Type'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>IDG EVENT</title>
        <link rel="stylesheet" href="jquery-ui.css">
        <style>
            #small-div > div {
                font-size: 20px;
                margin-left: 5px !important;
                margin-right:0px!important;
                margin-top:0px!important;
                margin-bottom:0px!important;
            }
            input[type="checkbox"]{
                -moz-transform:scale(1.3);
                -webkit-tranform:scale(1.3);
            }

            .sub-form label{font-size:24px;}
            #big-text-div {
                clear: both;
                display: inline-block;
                font-size: 6em;
                margin: 13px;
                text-align: center;
                width: 450px;
            }
            .ui-widget label {
                display: inline-block;
                /*  margin-right: 31px;*/
                text-align: right;
                width: 36%;
            }
            .tftextinput3 {
                width: 30%;
                margin-left: 15px;
                box-shadow: none;
            }
            span {
                margin-left: 11px;
            }
            #tfheader > input {
                margin-bottom: 22px;
                margin-left: 190px !important;
            }
            #tfheader1 > input {
                margin-bottom: 22px;
                margin-left: 145px;
            }
            #tfheader1 > p {
                margin-left: 37px;
            }
            #tfheader1 > form {
                padding: 20px;
            }
            #tfheader > div {
                margin-top: -18px;
            }
            p {
                font-size: 20px;
                margin-bottom: 4px;
                margin-top: 0 !important;
            }
            .button2 {
                left: -2px;
                margin-top: -4px;
            }
            .button1 {
                left: 8px;
                margin-top: 11px;
            }
            #small-div label {
                display: inline-block;
                text-align: right;
                width: 16%;

            }
            #btn-refresh{
                width:88px}


            .ui-radio {
                font-size: 20px;
                margin-bottom: 10px;
                margin-top: 20px;
                text-align: center;
                width: inherit;
            }
            .btn2-opacity{opacity:.2}
            .search-delegate{
                opacity:.2;
            }
            .search-delegate-btn{
                opacity:1}
            .searchbox-visible{
                visibility:hidden;}
            </style>

            <script src="jquery-1.10.2.js"></script>
            <script src="jquery-ui.js"></script>
            <script>
                $(document).ready(function () {


                    $('#tfheader').on('click', '.button1', function () {
                        
                        var form_value = $('#tfnewsearch').serialize();
                        var dataString = form_value + '&details_another_form=1';
                        var type_array = <?php echo json_encode($json_type_array); ?>;
                        console.log(type_array);
                        var output = "<select name='type' class='edit-contact-info' style='display:none;'>";
                        $.ajax({
                            type: "GET",
                            url: "search.php",
                            data: dataString,
                            dataType: 'json',
                            success: function (data) {
                                for (var i = 0; i < type_array.length; i++) {
                                    if (data['type'] == type_array[i]) {
                                        output += "<option value = " + data['type'] + " selected>" + data['type'] + "</option>";
                                    } else {
                                        output += "<option value = " + type_array[i] + ">" + type_array[i] + "</option>";
                                    }
                                }
                                output += "</select>";
                                $('#searchbox').val("");
                                $('#searchcmpny').val("");
                                $('#searchemail').val("");
                                $('#searchmobile').val("");
                                $('#a1').html("<p><label>Reference<span>:</span></label><span >" + data['reference'] + "</span><input name='rfid' class='edit-contact-info' style='display:none;' type='hidden' value=" + data['reference'] + " /></p>");
                                $('#a2').html("<p><label>Name<span>:</span> </label><span class='hide-span' style='display: inline-flex; width: 300px;' >" + data['first_name'] + " " + data['last_name'] + "</span><input class='edit-contact-info' name='name' style='display:none;' type='text' value='" + data['first_name'] + " " + data['last_name'] + "' /></p>");
                                $('#a3').html("<p><label>Company Name<span>:</span>  </label><span class='hide-span' style='display: inline-flex; width: 300px;'>" + data['comapny_name'] + "</span><input class='edit-contact-info' style='display:none;' name='company' type='text' value='" + data['comapny_name'] + "' /></p>");
                                $('#a5').html("<p><label>Email<span>:</span> </label><span class='hide-span' style='display: inline-flex; width: 300px;' >" + data['email_id'] + "</span><input class='edit-contact-info' name='email' style='display:none;' type='text' value='" + data['email_id'] + "' /></p>");
                                $('#a6').html("<p><label>Mobile<span>:</span>  </label><span class='hide-span'>" + data['mobile_number'] + "</span><input name='mobile_number' class='edit-contact-info' style='display:none;' type='text' value='" + data['mobile_number'] + "' /></p>");
                                $('#a7').html("<p><label>Type<span>:</span>  </label><span class='hide-span'>" + data['type'] + "</span>" + output + "</p>");
                                $('#a8').html("<p><label>Designation<span>:</span>  </label><span class='hide-span' style='display: inline-flex; width: 300px;' >" + data['designation'] + "</span><input name='designation' class='edit-contact-info' style='display:none;' type='text' value='" + data['designation'] + "' /></p>");
                                $('#a9').html("<p><label>Source<span>:</span>  </label><span class='hide-span'>" + data['field1'] + "</span><input name='field1' class='edit-contact-info' style='display:none;' type='text' value='" + data['field1'] + "' /></p>");

                                var reg = data['registered'];
                                if (reg == 1) {
                                    $('#chkbox').prop('checked', true);
                                } else {
                                    $('#chkbox').prop('checked', false);
                                }
                                if (data['type'] == 'DENY' || reg != '') {
                                    $('#big-text-div').css('color', 'red');
                                }
                                $('#big-text-div').html(data['id'] + "<input id='data-id' name='uid' class='edit-contact-info' style='display:none;' type='hidden' value=" + data['id'] + " />");

                                $('#edit-contact').show();
                            }
                        });
                    });
                    $('#tfheader1').on('click', '#button2', function () {
                        //alert("ashwini");
                        var form_value = $('#tfnewsearch1').serialize();
                        var radio = ($("input[name=radio1]:checked").val());
                        //alert(radio);

                        if (!radio) {
                            alert("Please Select One Radio Button");
                        } else {
                            var dataString = form_value + '&add_user=1';
                            $.ajax({
                                type: "GET",
                                url: "save.php",
                                data: dataString,
                                dataType: 'json',
                                success: function (data) {
                                    $('#add-reference').val("");
                                    $('#add-searchbox').val("");
                                    $('#add-searchcmpny').val("");
                                    $('#add-searchemail').val("");
                                    $('#add-searchmobile').val("");
                                    $('#add-type').val("");
                                    $('#a1').html("<p><label>Reference<span>:</span></label><span >" + data['reference'] + "</span></p>");
                                    $('#a2').html("<p><label>Name<span>:</span> </label><span style='display: inline-flex; width: 300px;' >" + data['first_name'] + " " + data['last_name'] + "</span></p>");
                                    $('#a3').html("<p><label>Company Name<span>:</span>  </label><span style='display: inline-flex; width: 300px;'>" + data['comapny_name'] + "</span></p>");
                                    $('#a5').html("<p><label>Email<span>:</span> </label><span style='display: inline-flex; width: 300px;' >" + data['email_id'] + "</span> </p>");
                                    $('#a6').html("<p><label>Mobile<span>:</span>  </label><span >" + data['mobile_number'] + "</span></p>");
                                    $('#a7').html("<p><label>Type<span>:</span>  </label><span >" + data['type'] + "</span></p>");
                                    $('#a8').html("<p><label>Designation<span>:</span>  </label><span style='display: inline-flex; width: 300px;' >" + data['designation'] + "</span></p>");
                                    $('#a9').html("<p><label>Source<span>:</span>  </label><span >" + data['field1'] + "</span></p>");
                                    var reg = data['registered'];
                                    if (reg == 1) {
                                        $('#chkbox').prop('checked', true);
                                    } else {
                                        $('#chkbox').prop('checked', false);
                                    }
                                    if (data['type'] == 'DENY' || reg != '') {
                                        $('#big-text-div').css('color', 'red');
                                    }
                                    $('#big-text-div').html(data['id']);
                                }
                            });
                        }
                    });
                    $('form').on("submit", function (event) {
                        var form_values = $(this).serialize();
                        var id = $('#data-id').val();
                        var dataString = "id=" + id + "&form_sub=1&" + form_values;
                        console.log(dataString);
                        $.ajax({
                            type: "GET",
                            url: "search.php",
                            data: dataString,
                            success: function (data) {
                                //console.log(data);
                                alert(data);
                                $('#chkbox').prop('checked', false);
                                location.reload();
                            }
                        });
                        event.preventDefault();
                    });
                });
                function search(txt) {
                    var txt_new = document.getElementById("searchbox").value;
                    //alert(txt_new);
                    var dataString = 'name=' + txt_new;
                    var availableTags;
                    $.ajax({
                        type: "GET",
                        url: "search.php",
                        data: dataString,
                        success: function (data) {
                            //  console.log(data)
                            var data1 = data;
                            availableTags = data1.split(",");
                            $("#searchbox").autocomplete({
                                source: availableTags
                            });
                        }
                    });
                }
                function print() {


                    var availableTags;
                    $.ajax({
                        type: "GET",
                        url: "label_printing.php",
                        success: function (data) {
                            alert("Printed Sucessfully")
                        }
                    });
                }

                function search_company(txt) {
                    var txt_new = document.getElementById("searchcmpny").value;
                    //alert(txt_new);
                    var dataString = 'company=' + txt_new;
                    var availableTags;
                    $.ajax({
                        type: "GET",
                        url: "search.php",
                        data: dataString,
                        success: function (data) {
                            // console.log(data)
                            var data1 = data;
                            availableTags = data1.split("~");
                            $("#searchcmpny").autocomplete({
                                source: availableTags
                            });
                        }
                    });
                }
                function search_email(txt) {
                    var txt_new = document.getElementById("searchemail").value;
                    //alert(txt_new);
                    var dataString = 'email=' + txt_new;
                    var availableTags;
                    $.ajax({
                        type: "GET",
                        url: "search.php",
                        data: dataString,
                        success: function (data) {
                            //console.log(data)
                            var data1 = data;
                            availableTags = data1.split(",");
                            $("#searchemail").autocomplete({
                                source: availableTags
                            });
                        }
                    });
                }

                function search_mobile(txt) {
                    var txt_new = document.getElementById("searchmobile").value;
                    //alert(txt_new);
                    var dataString = 'mobile=' + txt_new;
                    var availableTags;
                    $.ajax({
                        type: "GET",
                        url: "search.php",
                        data: dataString,
                        success: function (data) {
                            //console.log(data)
                            var data1 = data;
                            availableTags = data1.split(",");
                            $("#searchmobile").autocomplete({
                                source: availableTags
                            });
                        }
                    });
                }
                function cleardata(txt) {

                    if (txt == "searchbox")
                    {
                        $("#searchcmpny").val("");
                        $("#searchemail").val("");
                        $("#searchmobile").val("");
                    } else if (txt == "searchcmpny")
                    {
                        $("#searchbox").val("");
                        $("#searchemail").val("");
                        $("#searchmobile").val("");
                    }
                    else if (txt == "searchemail")
                    {
                        $("#searchbox").val("");
                        $("#searchcmpny").val("");
                        $("#searchmobile").val("");
                    }
                    else if (txt == "searchmobile")
                    {
                        $("#searchbox").val("");
                        $("#searchcmpny").val("");
                        $("#searchemail").val("");
                    }
                }

                $(document).ready(function () {
                    $(".button1").click(function () {
                        $("#tfnewsearch").addClass("search-delegate");
                        $(".button1").addClass("search-delegate");
                        $(".search-btn").addClass("search-delegate");
                        $("#searchbox").attr("readonly", "true");
                        $("#searchcmpny").attr("readonly", "true");
                        $("#searchemail").attr("readonly", "true");
                        $("#searchmobile").attr("readonly", "true");
                        $("#btn2").removeClass("btn2-opacity");
                        $(".register").removeClass("btn2-opacity");
                        $("#chkbox").removeAttr("disabled");
                    });

                    $("btn2").click(function () {
                        $("#tfnewsearch").addClass("search-delegate-btn");
                        $(".button1").addClass("search-delegate-btn");
                        $(".search-btn").addClass("search-delegate-btn");

                    });
                    $("#button2").click(function () {
                        $("#chkbox").prop("disabled", "true");
                        $("#btn2").prop("disabled", "true");
                        $("#btn2").addClass("btn2-opacity");
                        $(".register").addClass("btn2-opacity")
                    })

                    $('#edit-contact').click(function () {
                        $('.hide-span').hide();
                        $('.edit-contact-info').css('display', 'inline');
                        $('#save').show();
                    });
                    $('#save').click(function () {
                        var form_data_string = $('#edit-contact-id').serialize();
                        $.ajax({
                            type: "GET",
                            url: "editSave.php",
                            data: form_data_string,
                            dataType: 'json',
                            success: function (output) {
                                var name = output['first_name'];
                                console.log(name);
                                $('#a2').html("<p><label>Name<span>:</span> </label><span class='hide-span' style='display: inline-flex; width: 300px;' >" + output['first_name'] + " " + output['last_name'] + "</span><input class='edit-contact-info' name='name' style='display:none;' type='text' value='" + name + "' /></p>");
                                $('#a3').html("<p><label>Company Name<span>:</span>  </label><span class='hide-span' style='display: inline-flex; width: 300px;'>" + output['comapny_name'] + "</span><input class='edit-contact-info' style='display:none;' name='company' type='text' value='" + output['comapny_name'] + "' /></p>");
                                $('#a5').html("<p><label>Email<span>:</span> </label><span class='hide-span' style='display: inline-flex; width: 300px;' >" + output['email_id'] + "</span><input class='edit-contact-info' name='email' style='display:none;' type='text' value='" + output['email_id'] + "' /></p>");
                                $('#a6').html("<p><label>Mobile<span>:</span>  </label><span class='hide-span'>" + output['mobile_number'] + "</span><input name='mobile_number' class='edit-contact-info' style='display:none;' type='text' value='" + output['mobile_number'] + "' /></p>");
                                $('#a7').html("<p><label>Type<span>:</span>  </label><span class='hide-span'>" + output['type'] + "</span><input class='edit-contact-info' style='display:none;' name='type' type='text' value='" + output['type'] + "'  /></p>");
                                $('#a8').html("<p><label>Designation<span>:</span>  </label><span class='hide-span' style='display: inline-flex; width: 300px;' >" + output['designation'] + "</span><input name='designation' class='edit-contact-info' style='display:none;' type='text' value='" + output['designation'] + "' /></p>");
                                $('#a9').html("<p><label>Source<span>:</span>  </label><span class='hide-span'>" + output['field1'] + "</span><input name='field1' class='edit-contact-info' style='display:none;' type='text' value='" + output['field1'] + "' /></p>");
                                $('#save').hide();
                            }
                        });
                    });
                });
            </script>
        </head>
        <body>
            <!-- HTML for SEARCH BAR -->
            <div id="tfheader">
            <p style="font-size: 28px;"><b class="search-btn">Search Delegate</b></p>
            <form id="tfnewsearch" method="get" >
                <div class="ui-widget">
                    <p style="margin-top: 0px;"><label for="tags">Name<span>:</span> </label><input type="text" id="searchbox" onclick="cleardata(this.id)"  onkeyup="search(this.value);" class="tftextinput3" name="searchbox" size="21" maxlength="120" value="" placeholder="Search Name"></p>
                    <p><label for="tags">Company<span>:</span></label><input type="text" id="searchcmpny"  onclick="cleardata(this.id)" onkeyup="search_company(this.value);" class="tftextinput3" name="searchcmpny" size="21" maxlength="120" value="" placeholder="Search Company"></p>
                    <p><label for="tags">Email<span>:</span> </label><input type="text" id="searchemail" onclick="cleardata(this.id)" onkeyup="search_email(this.value);" class="tftextinput3"  name="searchmail" size="21" maxlength="120" value="" placeholder="Search Email"></p>
                    <p><label for="tags">Mobile<span>:</span> </label><input type="text" id="searchmobile" onclick="cleardata(this.id)"  onkeyup="search_mobile(this.value);"class="tftextinput3" name="searchmobile" size="21" maxlength="120" value="" placeholder="Search Mobile"></p>

                </div>
            </form>
            <div class="tfclear"></div>
            <input  class="button1" type="button" value="Search">


            <div id="tfheader1">
                <p style="font-size: 28px;"><b>Add Delegate</b></p>
                <form id="tfnewsearch1" method="get" >
                    <div class="ui-widget">
                        <p><label for="tags">Reference<span>:</span> </label><input type="text" id="add-reference"   onkeyup="search(this.value);" class="tftextinput3" name="searchreference" size="21" maxlength="120" value="" placeholder="Add Reference"></p>
                        <p><label for="tags">Name<span>:</span> </label><input type="text" id="add-searchbox"   onkeyup="search(this.value);" class="tftextinput3" name="searchbox" size="21" maxlength="120" value="" required="required" placeholder="Add Name"></p>
                        <p><label for="tags">Company<span>:</span></label><input type="text" id="add-searchcmpny"   onkeyup="search_company(this.value);" class="tftextinput3" name="searchcmpny" size="21" maxlength="120" value="" placeholder="Add Company"></p>
                        <p><label for="tags">Email<span>:</span> </label><input type="text" id="add-searchemail"  onkeyup="search_email(this.value);" class="tftextinput3"  name="searchmail" size="21" maxlength="120" value="" placeholder="Add Email"></p>
                        <p><label for="tags">Mobile<span>:</span> </label><input type="text" id="add-searchmobile"   onkeyup="search_mobile(this.value);"class="tftextinput3" name="searchmobile" size="21" maxlength="120"  value="" placeholder="Add Mobile"></p>
                        <p ><label for="tags">Type<span>:</span> </label>

                            <select id="add-type" class="tftextinput3" name='type'><?php echo $type_query; ?>                   
                            </select></p>

                    </div> <div class="ui-radio"> <input type="radio" required="required" id="radio1" class="" name="radio1" value="Visiting Card" > <label for="tags">Visiting Card</label>
                        <input type="radio" id="radio1" class="" name="radio1" value="Filled Form" >
                        <label for="tags">Filled Form</label>
                        <input type="radio" id="radio1" class="" name="radio1" value="Nothing" ><label for="tags">Nothing</label>
                    </div>
                </form>
                <div class="tfclear"></div>
                <input  id="button2" class="button2" type="button" value="Add & Register">
            </div></div>
        <div id="rightcontainer">
            <form id="edit-contact-id">
                <div id="big-text-div"></div>
                <div id= "small-div">
                    <div id="a1"></div>
                    <div id="a2"></div>
                    <div id="a3"></div>
                    <div id="a5"></div>
                    <div id="a6"></div>
                    <div id="a7"></div>
                    <div id="a8"></div>
                    <div id="a9"></div>
                </div>
            </form>

            <form name="sub-form" class="sub-form" action="">
                <label><input class="checkbox12" name="chkbox" id="chkbox" type="checkbox"  value="1">Register</label><br>
                <input id="btn2" class="button2" type="submit" value="Register">
                <!--<input id="btn3" class="button2" type="button" value="Export" onclick="window.location = 'download.php';">-->
                <input id="btn3" class="button2" type="button" value="Refresh" onclick="window.location = 'dashboard.php';">
                <input id="btn4" class="button2" type="button" value="Print" onclick="print()">
                <input id="edit-contact" style="display:none;margin:17px 0 8px 25px;" class="button2" type="button" value="Edit" onclick="">
                <input id="save" style="display:none;margin:17px 0 8px 25px;" class="button2" type="button" value="Save" onclick="">
            </form>
        </div>
    </body>
</html>