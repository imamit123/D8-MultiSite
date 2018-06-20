<?php
session_start();
include 'basic.php';
$user_login_info = $_REQUEST;
//$user_login_info = array_map('strtoupper',$user_login_info);
$username = $user_login_info['Username'];
$password = $user_login_info['Password'];

$query = "select * from user where email ='$username'  and password = '$password' and Active = 1";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result, MYSQLI_NUM);
//echo "<pre>"; print_r($row);
$rowcount=mysqli_num_rows($result);
  //printf("Result set has %d rows.\n",$rowcount);

//$row_cnt  = mysqli_num_rows($result);
//echo "count".$row_cnt;

if ($rowcount == 1) {
    $_SESSION['userid'] = $row[0];
    $_SESSION['username'] = $row[3];
    $_SESSION['email'] = $row[3];
    $_SESSION['usertype'] = $row[5];
    $_SESSION['supervisor'] = $row[6];
    $_SESSION['firstname'] = $row[1];
    header('Location: dashboard.php');
} else {
    header('Location: index.php');
}
?>

