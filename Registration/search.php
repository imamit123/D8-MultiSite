<?php

session_start();
include 'basic.php';

if (isset($_REQUEST['details_another_form'])) {
	if (!empty($_REQUEST['searchcmpny'])) {
            $comp = addslashes($_REQUEST['searchcmpny']);          
		list($company,$name) = explode('(',$comp);
                $company =  substr($comp, 0, strrpos( $comp, '(') );                
                $name = str_replace($company, "", $comp);
                $name = str_replace("(", "", $name);
                $name = str_replace(")", "", $name);
		$query = get_details_using_name_company($name,$company);
		
	}
	elseif (!empty($_REQUEST['searchid'])) {
		$id = $_REQUEST['searchid'];
		$query = get_details("id",$id);
	}
	elseif (!empty($_REQUEST['searchmail'])) {
		$mail = $_REQUEST['searchmail'];
		$query = get_details("email_id",$mail);
	} elseif(!empty($_REQUEST['searchmobile'])) {
		$mob = $_REQUEST['searchmobile'];
		$query = get_details("mobile_number",$mob);
	} elseif(!empty($_REQUEST['searchbox'])) {
		$name = addslashes($_REQUEST['searchbox']);
		list($name,$cmp) = explode('(',$name);
		$cmp = rtrim($cmp,')');
		$query = get_details_using_name1($name,$cmp);
	}
	
	echo json_encode($query);
} elseif (isset($_REQUEST['form_sub'])) {
	if (!isset($_REQUEST['chkbox'])) {
		echo "Please click on register";
	} else {
            $visit_card = 0;
            if (isset($_REQUEST['chkbox13'])) {
            $visit_card  = $_REQUEST['chkbox13'];}
            
		$query = update_record($_REQUEST['id'],$visit_card);
		echo $query;
	}

} else {
	if (isset($_REQUEST['name'])) {
		$query = search_name($_REQUEST['name']);
	}else if (isset($_REQUEST['company'])) {
		$query = search_company($_REQUEST['company']);
	}else if (isset($_REQUEST['email'])) {
		$query = search_email($_REQUEST['email']);
	}else if (isset($_REQUEST['mobile'])) {
		$query = search_mobile($_REQUEST['mobile']);
	}else if (isset($_REQUEST['id'])) {
		$query = search_id($_REQUEST['id']);
	}

echo $query;
}
?>