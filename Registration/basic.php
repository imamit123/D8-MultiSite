<?php

include 'config.php';

function search_name($value) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query = "SELECT * FROM delegate where first_name  LIKE  '%$value%' OR last_name LIKE '%$value%' OR CONCAT(`first_name`, ' ', `last_name`) LIKE  '%$value%' ";
//mysql_set_charset("UTF8");
    $result = mysqli_query($link,$query);
    //  header('Content-type: text/html; charset=utf-8');
    $data = "";

    $cnt = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($cnt > 0) {
            $data .= ',';
        }
        $comapnyname = $row['first_name'] . " " . $row['last_name'] . " (" . $row['comapny_name'] . ")";
        //$comapnyname = str_replace(',','~',$comapnyname);
        // $data .='"';
        $data .= "$comapnyname";
        // $data .='"';
        $cnt++;
    }
    // $data .= ']';

    return $data;
}

function search_company($value) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query = "SELECT * FROM delegate where comapny_name LIKE  '%$value%'";

    $result = mysqli_query($link,$query);
    $data = "";

    $cnt = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($cnt > 0) {
            $data .= '~';
        }
        $comapnyname = $row['comapny_name'] . " (" . $row['first_name'] . " " . $row['last_name'] . ")";
        $data .= "$comapnyname";
        // $data .='"';
        $cnt++;
    }
    // $data .= ']';

    return $data;
}

function search_email($value) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query = "SELECT * FROM delegate where email_id LIKE  '%$value%'";

    $result = mysqli_query($link,$query);
    $data = "";

    $cnt = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($cnt > 0) {
            $data .= ',';
        }
        $comapnyname = $row['email_id'];
        // $data .='"';
        $data .= "$comapnyname";
        // $data .='"';
        $cnt++;
    }
    // $data .= ']';

    return $data;
}

function search_mobile($value) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query = "SELECT * FROM delegate where mobile_number LIKE  '%$value%'";

    $result = mysqli_query($link,$query);
    $data = "";

    $cnt = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($cnt > 0) {
            $data .= ',';
        }
        $comapnyname = $row['mobile_number'];
        // $data .='"';
        $data .= "$comapnyname";
        // $data .='"';
        $cnt++;
    }
    // $data .= ']';

    return $data;
}

function search_id($value) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query = "SELECT * FROM delegate where id LIKE  '%$value%'";

    $result = mysqli_query($link,$query);
    $data = "";

    $cnt = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($cnt > 0) {
            $data .= ',';
        }
        $id = $row['id'];
        // $data .='"';
        $data .= "$id";
        // $data .='"';
        $cnt++;
    }
    // $data .= ']';

    return $data;
}

function get_details($field_name, $field_value) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query = "SELECT * FROM delegate WHERE $field_name = '$field_value'";
    $_SESSION['export_result'] = $query;
    $result = mysqli_fetch_assoc(mysqli_query($link,$query));
    return $result;
}

function get_details_using_name1($f_name, $comp) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query = "SELECT * FROM delegate WHERE comapny_name LIKE '%$comp%' and CONCAT (first_name , ' ', last_name)  = '$f_name' ";
    $_SESSION['export_result'] = $query;
    $result = mysqli_fetch_assoc(mysqli_query($link,$query));
    return $result;
}

function get_details_using_name_company($f_name, $comp) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query = "SELECT * FROM delegate WHERE comapny_name = '$comp' and CONCAT (first_name , ' ', last_name)  = '$f_name' ";
    $_SESSION['export_result'] = $query;
    $result = mysqli_fetch_assoc(mysqli_query($link,$query));
    return $result;
}

function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}


function update_record($id,$visit_card) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $reg_value = mysqli_result(mysqli_query($link,"SELECT registered FROM delegate WHERE id = $id"), 0);
    if (!empty($reg_value)) {
        echo "Already Registered";
    } else {
        $query = "UPDATE `delegate` SET `registered`= 1, visit_card = '$visit_card' WHERE id = " . $id;
        mysqli_query($link,$query);
        echo "Registered Successfully";
    }
}

function total_count($type) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query_total = "select count(*) as cnt from delegate where type = '$type' and (registered = '' or registered = '1') ";
    $result_total = mysqli_query($link,$query_total);
    $row_total = mysqli_fetch_assoc($result_total);
    //print_r($row_total);exit();
    $count = $row_total['cnt'];
    return $count;
}

function cheakin($type, $val) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query_total = "select count(*) as cnt from delegate where type = '$type' and registered = '$val'";
    $result_total = mysqli_query($link,$query_total);
    $row_total = mysqli_fetch_assoc($result_total);
    //print_r($row_total);exit();
    $count = $row_total['cnt'];
    return $count;
}

function visit($type) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $query_total = "select count(*) as cnt from delegate where type = '$type' and visit_card = 1";
    $result_total = mysqli_query($link,$query_total);
    $row_total = mysqli_fetch_assoc($result_total);
    //print_r($row_total);exit();
    $count = $row_total['cnt'];
    return $count;
}

function add_user($user_info) {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    // list($first_name,$last_name) = explode(" ", $user_info['searchbox']);
    $first_name = $user_info['searchbox'];
    $last_name = $user_info['searchlast'];
    $company_name = strtoupper($user_info['searchcmpny']);
    $email = $user_info['searchmail'];
    $phone = $user_info['searchmobile'];
    $type = $user_info['type'];
    $field1 = $user_info['radio1'];
    $reference = $user_info['searchreference'];

    if ($first_name != ''  or $last_name != ''  or $company_name != '' or $email != '' or $phone != '' or $type != '' or $reference != '') {
        $insert_query = "INSERT INTO `delegate`(`first_name`,`last_name`,`comapny_name`, `email_id`, `mobile_number`,`type`, `field1`,registered,reference) VALUES ('$first_name','$last_name','$company_name', '$email', '$phone', '$type','$field1','2','$reference')";
        mysqli_query($link,$insert_query);
        $user_inserted_info = get_details('id', mysqli_insert_id($link));
        return $user_inserted_info;
    }
}

function get_last_inserted_id() {
    $db_host        = 'mysql-idgindia-prod-va.c4b9mvejjops.us-east-1.rds.amazonaws.com';
$db_user        = 'idgevent';
$db_pass        = 'idgcrm27';
$db_database    = 'idg_event'; 
$db_port        = '3306';

$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database,$db_port);
    $id = mysqli_fetch_assoc(mysqli_query($link,"SELECT id FROM delegate ORDER BY id DESC LIMIT 0,1"));
    if (empty($id)) {
        $id = 1000;
    } else {
        $id = $id['id'];
    }
    return $id;
}

?>
