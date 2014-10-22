<?php
session_start();
include("core-function.php");
header('Content-Type: application/json');
$id = getuserid($_SESSION['email']);
$title = $_POST['title'];
$desc = $_POST['desc'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$venue = $_POST['venue'];
$branch = $_POST['br'];
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
$query = mysql_query("insert INTO festival (user_id,title,description,venue,branch,startd,endd) VALUES ('$id','$title','$desc','$venue','$branch','$start_date','$end_date')");
if($query == 1)
{
	$success = array('yes' => 1);
	echo json_encode($success);
}
?>