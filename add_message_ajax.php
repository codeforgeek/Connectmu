<?php
include("core-function.php");
session_start();
if(isset($_SESSION['email']))
{
	$connection_id = $_POST['user_id'];
	$login_user_id = $_POST['conn_id'];
	$msg=$_POST['msg'];
	$con = connect_to_db();
	$db = mysql_select_db("connectmu", $con);
	$query = mysql_query("insert INTO message (user_id,reciever_id,message,status) VALUES ('$connection_id','$login_user_id','$msg',0)");
}
else
{
	header("location: index.php");
}
?>