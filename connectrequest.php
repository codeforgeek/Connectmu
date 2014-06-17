<?php
include("core-function.php");
header('Content-Type: application/json');
session_start();
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
$userid = $_POST['userid'];
$connid = $_POST['connid'];
$emailoffriend = getemail($connid);
$type = getusertype($emailoffriend);
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
$query = mysql_query("insert INTO connection(user_id,conn_id,type,status,reqd) VALUES('$userid','$connid','$type',0,CURDATE())");
if($query == 1)
{
	$success = array('yes' => 1);
	echo json_encode($success);
}
else
{
	echo 'Something is wrong';
}
?>