<?php
session_start();
include 'basic.php';
//echo $_SESSION['export_result'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>IDG EVENT</title>
        <meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
        <link rel="stylesheet" href="jquery-ui.css">


        <style>
            #small-div > div {
                float: left;
                font-size: 20px;
                margin-left: 5px !important;
                margin-right:0px!important;
                margin-top:0px!important;
                margin-bottom:0px!important;
            }

            #big-text-div {
                clear: both;
                display: inline-block;
                font-size: 4em;
                margin: 13px;
                text-align: center;
                width: 450px;
            }

            .ui-widget label {
                display: inline-block;
                margin-right: 31px;
                text-align: right;
                width: 36%;
            }
            .tftextinput3 {
                width: 51%;
            }
            span {
                margin-left: 11px;
            }

            #a1 {
                display: block;
                margin: 0 0 0 20px !important;
                width: auto;
            }

            #a2 {
                margin: 0 0 0 10px !important;
                width: 15% !important;
            }
            #a5 {
                margin-top: 0 !important;
                width: 45% !important;
            }

            #a6, #a7, #a8 {
                width: 44% !important;
            }

            #a4, #a3 {
                display: block;
                width: 44% !important;
            }

            #tfheader > input {
                margin-bottom: 22px;
                margin-left: 80px;
            }

            #wrapper {
                border: 1px solid gray;
                height: 550px;
            }

            .TabbedPanelsContent.TabbedPanelsContentVisible > #tfheader1 {
                margin: 0 20%;
                width: 57%;
            }

            #tfheader1 > input
            {
                margin-bottom: 22px;
                margin-left: 52%;}
            </style>

            <script src="jquery-1.10.2.js"></script>
            <script src="jquery-ui.js"></script>
            <script>
                $(document).ready(function () {

                   /* $("#TabbedPanels1").tabs();
                    $("#button23").click(function () {
                        var selected = $("#TabbedPanels1").tabs("option", "selected");
                        $("#tabs").tabs("option", "selected", selected + 1);
                    });*/
                    $('#tfheader').on('click', '.button1', function () {
                        var form_value = $('#tfnewsearch').serialize();
                        var dataString = form_value + '&details_another_form=1';
                        $.ajax({
                            type: "GET",
                            url: "search.php",
                            data: dataString,
                            dataType: 'json',
                            success: function (data) {
                                $('#searchbox').val("");
                                $('#searchcmpny').val("");
                                $('#searchemail').val("");
                                $('#searchmobile').val("");
                                $('#a1').html(data['first_name']);
                                $('#a2').html(data['last_name']);
                                $('#a3').html(data['comapny_name']);
                                $('#a4').html(data['reference']);
                                $('#a5').html(data['email_id']);
                                $('#a6').html(data['mobile_number']);
                                $('#a7').html(data['type']);
                                $('#a8').html(data['designation']);
                                var reg = data['registered'];
                                if (reg == 1) {
                                    $('#chkbox').prop('checked', true);
                                } else {
                                    $('#chkbox').prop('checked', false);
                                }
                                $('#big-text-div').html(data['id']);
                            }
                        });
                    });
                    $('#tfheader1').on('click', '#button2', function () {
                       // alert("ashwini");
                        var form_value = $('#tfnewsearch1').serialize();
                        var dataString = form_value + '&add_user=1';
                        $.ajax({
                            type: "GET",
                            url: "save.php",
                            data: dataString,
                            dataType: 'json',
                            success: function (data) {
                                
                                //$(".TabbedPanelsTabGroup li:nth-child(2)").removeClass('TabbedPanelsTabSelected');
                                //$(".TabbedPanelsContent #tfheader1").css("display","none");
                                $(".TabbedPanelsTabGroup li:first-child()").click();
                               // $(".TabbedPanelsContent").css("display","block");  
                               // $(".TabbedPanelsTabGroup li:nth-child(2)").removeClass('TabbedPanelsTabSelected');
                                //$(".TabbedPanelsContent #tfheader1").css("display","block");
                                $('#add-searchbox').val("");
                                $('#add-searchcmpny').val("");
                                $('#add-searchemail').val("");
                                $('#add-searchmobile').val("");
                                $('#add-type').val("");
                                $('#a1').html(data['first_name']);
                                $('#a2').html(data['last_name']);
                                $('#a3').html(data['comapny_name']);
                                $('#a4').html("");
                                $('#a5').html(data['email_id']);
                                $('#a6').html(data['mobile_number']);
                                $('#a7').html(data['type']);
                                $('#a8').html("");
                                $('#big-text-div').html(data['id']);
                            }
                        });
                    });
                    $('form').on("submit", function (event) {
                        var form_values = $(this).serialize();
                        var id = $('#big-text-div').html();
                        var dataString = "form_sub=1&" + form_values + '&id=' + id;
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

            </script>

            <!--sprytabbedpanels.css startshere-->
            <style>

            .TabbedPanels{overflow:hidden;margin:0;padding:0;clear:none;width:100%}.TabbedPanelsTabGroup{margin:0;padding:0}.TabbedPanelsTab{position:relative;top:1px;float:left;padding:4px 10px;margin:0 1px 0 0;font:700 .7em sans-serif;background-color:#207cca;color:white;list-style:none;border-left:solid 1px #CCC;border-bottom:solid 1px #999;border-top:solid 1px #999;border-right:solid 1px #999;-moz-user-select:none;-khtml-user-select:none;cursor:pointer}.TabbedPanelsTabHover{background-color:#CCC}.TabbedPanelsTabSelected{background-color:#FFF;color:#207cca;border-bottom:1px solid #EEE}.TabbedPanelsTab a{color:#000;text-decoration:none}.TabbedPanelsContentGroup{clear:both;border-left:solid 1px #CCC;border-bottom:solid 1px #CCC;border-top:solid 1px #999;border-right:solid 1px #999;background-color:#c3dfef;}.TabbedPanelsContent{overflow:hidden;padding:1px}.VTabbedPanels{overflow:hidden;zoom:1}.VTabbedPanels .TabbedPanelsTabGroup{float:left;width:10em;height:20em;background-color:#EEE;position:relative;border-top:solid 1px #999;border-right:solid 1px #999;border-left:solid 1px #CCC;border-bottom:solid 1px #CCC}.VTabbedPanels .TabbedPanelsTab{float:none;margin:0;border-top:none;border-left:none;border-right:none}.VTabbedPanels .TabbedPanelsTabSelected{background-color:#EEE;border-bottom:solid 1px #999}.VTabbedPanels .TabbedPanelsContentGroup{clear:none;float:left;padding:0;width:30em;height:20em}@media print{.TabbedPanels{overflow:visible!important}.TabbedPanelsContentGroup{display:block!important;overflow:visible!important;height:auto!important}.TabbedPanelsContent,.TabbedPanelsTab{overflow:visible!important;display:block!important;clear:both!important}}
        </style> <!--sprytabbedpanels.css Endshere-->


    </head>
    <body>
        <div id="TabbedPanels1" class="TabbedPanels">
            <ul class="TabbedPanelsTabGroup">
                <li class="TabbedPanelsTab" tabindex="0">HOME</li>
                <li class="TabbedPanelsTab" tabindex="0">ADD</li>
            </ul>
            <div class="TabbedPanelsContentGroup">
                <div class="TabbedPanelsContent">
                    <div id="wrapper">
                        <!-- HTML for SEARCH BAR -->

                        <div id="tfheader">
                            <p>Search By</p>
                            <form id="tfnewsearch" method="get" >	
                                <div class="ui-widget">
                                    <p><label for="tags">Name<span>:</span> </label><input type="text" id="searchbox"   onkeyup="search(this.value);" class="tftextinput3" name="searchbox" size="21" maxlength="120" value="" placeholder="Search Name"></p>
                                    <p><label for="tags">Company<span>:</span></label><input type="text" id="searchcmpny"   onkeyup="search_company(this.value);" class="tftextinput3" name="searchcmpny" size="21" maxlength="120" value="" placeholder="Search Company"></p>
                                    <p><label for="tags">Email<span>:</span> </label><input type="text" id="searchemail"  onkeyup="search_email(this.value);" class="tftextinput3"  name="searchmail" size="21" maxlength="120" value="" placeholder="Search Email"></p>
                                    <p><label for="tags">Mobile<span>:</span> </label><input type="text" id="searchmobile"   onkeyup="search_mobile(this.value);"class="tftextinput3" name="searchmobile" size="21" maxlength="120" value="" placeholder="Search Mobile"></p>
                                    
                                </div>
                            </form>
                            <div class="tfclear"></div>
                            <input  class="button1" type="button" value="Search">
                            
                        </div>
                        <div id="rightcontainer">
                            <div id= "small-div">
                                <div  id="a4"></div>
                                <div id="a1"></div>
                                <div id="a2"></div>
                                <div id="a3"></div>               
                                <div id="a5"></div>
                                <div id="a6"></div>
                                <div id="a7"></div>
                                <div id="a8"></div>
                            </div>
                            <div id="big-text-div">
                            </div>
                            <form name="sub-form" class="sub-form" action="">
                                <label><input class="checkbox12" name="chkbox" id="chkbox" type="checkbox"  value="1">Register</label><br>
                                <input id="btn2" class="button2" type="submit" value="Register">
                                <input id="btn3" class="button2" type="button" value="Export" onclick="window.location = 'download.php';">
                            </form>
                        </div>
                    </div> <!--
            
            wraper EndeHere
            
                    -->
                </div>
                <div class="TabbedPanelsContent"><div id="tfheader1">
                        <p>Search By</p>
                        <form id="tfnewsearch1" method="get" >	
                            <div class="ui-widget">
                                <p><label for="tags">Name<span>:</span> </label><input type="text" id="add-searchbox"   onkeyup="search(this.value);" class="tftextinput3" name="searchbox" size="21" maxlength="120" value="" required="required" placeholder="Add Name"></p>
                                <p><label for="tags">Company<span>:</span></label><input type="text" id="add-searchcmpny"   onkeyup="search_company(this.value);" class="tftextinput3" name="searchcmpny" size="21" maxlength="120" value=""required="required" placeholder="Add Company"></p>
                                <p><label for="tags">Email<span>:</span> </label><input type="text" id="add-searchemail"  onkeyup="search_email(this.value);" class="tftextinput3"  name="searchmail" size="21" maxlength="120" value="" required="required"placeholder="Add Email"></p>
                                <p><label for="tags">Mobile<span>:</span> </label><input type="text" id="add-searchmobile"   onkeyup="search_mobile(this.value);"class="tftextinput3" name="searchmobile" size="21" maxlength="120" required="required" value="" placeholder="Add Mobile"></p>
                                <p><label for="tags">Type<span>:</span> </label><input type="text" id="add-type" class="tftextinput3" name="type" size="21" maxlength="120" value="" required="required" placeholder="Add Type"></p>
                            </div>
                        </form>
                        <div class="tfclear"></div>
                        <input  id="button2" class="button2" type="button" value="Add">
                    </div></div>
            </div>
        </div>
    </body>

    <!--sprytabbedpanels.js Startshere-->
    <script>
        (function () {
            if (typeof Spry == "undefined")
                window.Spry = {};
            if (!Spry.Widget)
                Spry.Widget = {};
            Spry.Widget.TabbedPanels = function (e, t) {
                this.element = this.getElement(e);
                this.defaultTab = 0;
                this.tabSelectedClass = "TabbedPanelsTabSelected";
                this.tabHoverClass = "TabbedPanelsTabHover";
                this.tabFocusedClass = "TabbedPanelsTabFocused";
                this.panelVisibleClass = "TabbedPanelsContentVisible";
                this.focusElement = null;
                this.hasFocus = false;
                this.currentTabIndex = 0;
                this.enableKeyboardNavigation = true;
                this.nextPanelKeyCode = Spry.Widget.TabbedPanels.KEY_RIGHT;
                this.previousPanelKeyCode = Spry.Widget.TabbedPanels.KEY_LEFT;
                Spry.Widget.TabbedPanels.setOptions(this, t);
                if (typeof this.defaultTab == "number") {
                    if (this.defaultTab < 0)
                        this.defaultTab = 0;
                    else {
                        var n = this.getTabbedPanelCount();
                        if (this.defaultTab >= n)
                            this.defaultTab = n > 1 ? n - 1 : 0
                    }
                    this.defaultTab = this.getTabs()[this.defaultTab]
                }
                if (this.defaultTab)
                    this.defaultTab = this.getElement(this.defaultTab);
                this.attachBehaviors()
            };
            Spry.Widget.TabbedPanels.prototype.getElement = function (e) {
                if (e && typeof e == "string")
                    return document.getElementById(e);
                return e
            };
            Spry.Widget.TabbedPanels.prototype.getElementChildren = function (e) {
                var t = [];
                var n = e.firstChild;
                while (n) {
                    if (n.nodeType == 1)
                        t.push(n);
                    n = n.nextSibling
                }
                return t
            };
            Spry.Widget.TabbedPanels.prototype.addClassName = function (e, t) {
                if (!e || !t || e.className && e.className.search(new RegExp("\\b" + t + "\\b")) != -1)
                    return;
                e.className += (e.className ? " " : "") + t
            };
            Spry.Widget.TabbedPanels.prototype.removeClassName = function (e, t) {
                if (!e || !t || e.className && e.className.search(new RegExp("\\b" + t + "\\b")) == -1)
                    return;
                e.className = e.className.replace(new RegExp("\\s*\\b" + t + "\\b", "g"), "")
            };
            Spry.Widget.TabbedPanels.setOptions = function (e, t, n) {
                if (!t)
                    return;
                for (var r in t) {
                    if (n && t[r] == undefined)
                        continue;
                    e[r] = t[r]
                }
            };
            Spry.Widget.TabbedPanels.prototype.getTabGroup = function () {
                if (this.element) {
                    var e = this.getElementChildren(this.element);
                    if (e.length)
                        return e[0]
                }
                return null
            };
            Spry.Widget.TabbedPanels.prototype.getTabs = function () {
                var e = [];
                var t = this.getTabGroup();
                if (t)
                    e = this.getElementChildren(t);
                return e
            };
            Spry.Widget.TabbedPanels.prototype.getContentPanelGroup = function () {
                if (this.element) {
                    var e = this.getElementChildren(this.element);
                    if (e.length > 1)
                        return e[1]
                }
                return null
            };
            Spry.Widget.TabbedPanels.prototype.getContentPanels = function () {
                var e = [];
                var t = this.getContentPanelGroup();
                if (t)
                    e = this.getElementChildren(t);
                return e
            };
            Spry.Widget.TabbedPanels.prototype.getIndex = function (e, t) {
                e = this.getElement(e);
                if (e && t && t.length) {
                    for (var n = 0; n < t.length; n++) {
                        if (e == t[n])
                            return n
                    }
                }
                return-1
            };
            Spry.Widget.TabbedPanels.prototype.getTabIndex = function (e) {
                var t = this.getIndex(e, this.getTabs());
                if (t < 0)
                    t = this.getIndex(e, this.getContentPanels());
                return t
            };
            Spry.Widget.TabbedPanels.prototype.getCurrentTabIndex = function () {
                return this.currentTabIndex
            };
            Spry.Widget.TabbedPanels.prototype.getTabbedPanelCount = function (e) {
                return Math.min(this.getTabs().length, this.getContentPanels().length)
            };
            Spry.Widget.TabbedPanels.addEventListener = function (e, t, n, r) {
                try {
                    if (e.addEventListener)
                        e.addEventListener(t, n, r);
                    else if (e.attachEvent)
                        e.attachEvent("on" + t, n)
                } catch (i) {
                }
            };
            Spry.Widget.TabbedPanels.prototype.cancelEvent = function (e) {
                if (e.preventDefault)
                    e.preventDefault();
                else
                    e.returnValue = false;
                if (e.stopPropagation)
                    e.stopPropagation();
                else
                    e.cancelBubble = true;
                return false
            };
            Spry.Widget.TabbedPanels.prototype.onTabClick = function (e, t) {
                this.showPanel(t);
                return this.cancelEvent(e)
            };
            Spry.Widget.TabbedPanels.prototype.onTabMouseOver = function (e, t) {
                this.addClassName(t, this.tabHoverClass);
                return false
            };
            Spry.Widget.TabbedPanels.prototype.onTabMouseOut = function (e, t) {
                this.removeClassName(t, this.tabHoverClass);
                return false
            };
            Spry.Widget.TabbedPanels.prototype.onTabFocus = function (e, t) {
                this.hasFocus = true;
                this.addClassName(t, this.tabFocusedClass);
                return false
            };
            Spry.Widget.TabbedPanels.prototype.onTabBlur = function (e, t) {
                this.hasFocus = false;
                this.removeClassName(t, this.tabFocusedClass);
                return false
            };
            Spry.Widget.TabbedPanels.KEY_UP = 38;
            Spry.Widget.TabbedPanels.KEY_DOWN = 40;
            Spry.Widget.TabbedPanels.KEY_LEFT = 37;
            Spry.Widget.TabbedPanels.KEY_RIGHT = 39;
            Spry.Widget.TabbedPanels.prototype.onTabKeyDown = function (e, t) {
                var n = e.keyCode;
                if (!this.hasFocus || n != this.previousPanelKeyCode && n != this.nextPanelKeyCode)
                    return true;
                var r = this.getTabs();
                for (var i = 0; i < r.length; i++)
                    if (r[i] == t) {
                        var s = false;
                        if (n == this.previousPanelKeyCode && i > 0)
                            s = r[i - 1];
                        else if (n == this.nextPanelKeyCode && i < r.length - 1)
                            s = r[i + 1];
                        if (s) {
                            this.showPanel(s);
                            s.focus();
                            break
                        }
                    }
                return this.cancelEvent(e)
            };
            Spry.Widget.TabbedPanels.prototype.preorderTraversal = function (e, t) {
                var n = false;
                if (e) {
                    n = t(e);
                    if (e.hasChildNodes()) {
                        var r = e.firstChild;
                        while (!n && r) {
                            n = this.preorderTraversal(r, t);
                            try {
                                r = r.nextSibling
                            } catch (i) {
                                r = null
                            }
                        }
                    }
                }
                return n
            };
            Spry.Widget.TabbedPanels.prototype.addPanelEventListeners = function (e, t) {
                var n = this;
                Spry.Widget.TabbedPanels.addEventListener(e, "click", function (t) {
                    return n.onTabClick(t, e)
                }, false);
                Spry.Widget.TabbedPanels.addEventListener(e, "mouseover", function (t) {
                    return n.onTabMouseOver(t, e)
                }, false);
                Spry.Widget.TabbedPanels.addEventListener(e, "mouseout", function (t) {
                    return n.onTabMouseOut(t, e)
                }, false);
                if (this.enableKeyboardNavigation) {
                    var r = null;
                    var i = null;
                    this.preorderTraversal(e, function (t) {
                        if (t.nodeType == 1) {
                            var n = e.attributes.getNamedItem("tabindex");
                            if (n) {
                                r = t;
                                return true
                            }
                            if (!i && t.nodeName.toLowerCase() == "a")
                                i = t
                        }
                        return false
                    });
                    if (r)
                        this.focusElement = r;
                    else if (i)
                        this.focusElement = i;
                    if (this.focusElement) {
                        Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "focus", function (t) {
                            return n.onTabFocus(t, e)
                        }, false);
                        Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "blur", function (t) {
                            return n.onTabBlur(t, e)
                        }, false);
                        Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "keydown", function (t) {
                            return n.onTabKeyDown(t, e)
                        }, false)
                    }
                }
            };
            Spry.Widget.TabbedPanels.prototype.showPanel = function (e) {
                var t = -1;
                if (typeof e == "number")
                    t = e;
                else
                    t = this.getTabIndex(e);
                if (!t < 0 || t >= this.getTabbedPanelCount())
                    return;
                var n = this.getTabs();
                var r = this.getContentPanels();
                var i = Math.max(n.length, r.length);
                for (var s = 0; s < i; s++) {
                    if (s != t) {
                        if (n[s])
                            this.removeClassName(n[s], this.tabSelectedClass);
                        if (r[s]) {
                            this.removeClassName(r[s], this.panelVisibleClass);
                            r[s].style.display = "none"
                        }
                    }
                }
                this.addClassName(n[t], this.tabSelectedClass);
                this.addClassName(r[t], this.panelVisibleClass);
                r[t].style.display = "block";
                this.currentTabIndex = t
            };
            Spry.Widget.TabbedPanels.prototype.attachBehaviors = function (e) {
                var t = this.getTabs();
                var n = this.getContentPanels();
                var r = this.getTabbedPanelCount();
                for (var i = 0; i < r; i++)
                    this.addPanelEventListeners(t[i], n[i]);
                this.showPanel(this.defaultTab)
            }
        })()</script>
    <!--sprytabbedpanels.js endshere-->

    <script type="text/javascript">
        var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
    </script>
</html>