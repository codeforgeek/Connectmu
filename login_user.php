<?php
session_start();
header('Content-Type: application/json');
include("core-function.php");
if(isset($_SESSION['email']))
{
	unset($_SESSION['email']);
	//header("location: login.php");
}
else
{
	$email = $_POST['email'];
	$password = $_POST['pass'];
	$con = connect_to_db();
	$db = mysql_select_db("connectmu", $con);
	$q = mysql_query("select * FROM user_info WHERE email='$email' AND password=md5('$password')");
	if(mysql_num_rows($q) == 1)
	{
		$success = array('yes' => 1);
		echo json_encode($success);
		$_SESSION['email'] = $email;
	}
	else
	{
		$failure = array('no' => 1);
		echo json_encode($failure);
	}
}
?>