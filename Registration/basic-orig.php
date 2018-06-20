<?php
include 'config.php';

function search_name($value) {
    $query = "SELECT * FROM delegate where first_name  LIKE  '%$value%' OR last_name LIKE '%$value%' OR CONCAT(`first_name`, ' ', `last_name`) LIKE  '%$value%' ";
//mysql_set_charset("UTF8");
    $result = mysql_query($query);
  //  header('Content-type: text/html; charset=utf-8');
    $data = "";

    $cnt = 0;  
    while ($row = mysql_fetch_array($result)) {
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
    $query = "SELECT * FROM delegate where comapny_name LIKE  '%$value%'";

    $result = mysql_query($query);
    $data = "";

    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
        if ($cnt > 0) {
            $data .= '~';
        }
        $comapnyname = $row['comapny_name']. " (" . $row['first_name'] . " " . $row['last_name'] . ")";
        $data .= "$comapnyname";
        // $data .='"';
        $cnt++;
    }
    // $data .= ']';

    return $data;
}

function search_email($value) {
    $query = "SELECT * FROM delegate where email_id LIKE  '%$value%'";

    $result = mysql_query($query);
    $data = "";

    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
        if ($cnt > 0) {
            $data .= ',';
        }
        $comapnyname =  $row['email_id'];
        // $data .='"';
        $data .= "$comapnyname";
        // $data .='"';
        $cnt++;
    }
    // $data .= ']';

    return $data;
}

function search_mobile($value) {
    $query = "SELECT * FROM delegate where mobile_number LIKE  '%$value%'";

    $result = mysql_query($query);
    $data = "";

    $cnt = 0;
    while ($row = mysql_fetch_array($result)) {
        if ($cnt > 0) {
            $data .= ',';
        }
        $comapnyname =  $row['mobile_number'];
        // $data .='"';
        $data .= "$comapnyname";
        // $data .='"';
        $cnt++;
    }
    // $data .= ']';

    return $data;
}

function get_details($field_name,$field_value) {
	$query = "SELECT * FROM delegate WHERE $field_name = '$field_value'";
	$_SESSION['export_result'] = $query;
	$result = mysql_fetch_assoc(mysql_query($query));
	return $result;
}
function get_details_using_name1($f_name,$comp) {
	$query = "SELECT * FROM delegate WHERE comapny_name LIKE '%$comp%' and CONCAT (first_name , ' ', last_name)  = '$f_name' ";
	$_SESSION['export_result'] = $query;
	$result = mysql_fetch_assoc(mysql_query($query));
	return $result;
}
function get_details_using_name_company($f_name,$comp) {
	$query = "SELECT * FROM delegate WHERE comapny_name = '$comp' and CONCAT (first_name , ' ', last_name)  = '$f_name' ";
	$_SESSION['export_result'] = $query;
	$result = mysql_fetch_assoc(mysql_query($query));
	return $result;
}
function update_record($id) {
	$reg_value = mysql_result(mysql_query("SELECT registered FROM delegate WHERE id = $id"),0);
	if (!empty($reg_value)) {
		echo "Already Registered";
	} else {
		$query = "UPDATE `delegate` SET `registered`= 1 WHERE id = ".$id;
		mysql_query($query);
		echo "Registered Successfully";
	}
	
}

function add_user($user_info) {
	// list($first_name,$last_name) = explode(" ", $user_info['searchbox']);
	$name = explode(" ",$user_info['searchbox']);
        //print_r($name);
        
        $cnt = count($name);
	if (!isset($name[$cnt-1])) {
		$last_name = " ";
        }else {
            $last_name = $name[$cnt-1];
        }
        
    array_pop($name);
    $first_name = implode(" ", $name);
	$company_name = $user_info['searchcmpny'];
	$email = $user_info['searchmail'];
	$phone = $user_info['searchmobile'];
	$type = $user_info['type'];
        $field1 = $user_info['radio1'];
	
        
	if($first_name != '' or $last_name != '' or $company_name != '' or $email!='' or $phone != '' or $type != '') {
		$insert_query = "INSERT INTO `delegate`(`first_name`, `last_name`, `comapny_name`, `email_id`, `mobile_number`,`type`, `field1`) VALUES ('$first_name','$last_name','$company_name', '$email', '$phone', '$type','$field1')";
		mysql_query($insert_query);
	$user_inserted_info = get_details('id',mysql_insert_id()) ;
        return $user_inserted_info;
	}
}
?>
