<?php
include("core-function.php");
session_start();
	$type1 = $_POST['t'];
	$type = return_user_type($type1);
	$stream = $_POST['s'];
	$college = $_POST['c'];
    $year = $_POST['y'];

		$id = getuserid($_SESSION['email']);
        $c = connect_to_db();
        $db=mysql_select_db("connectmu",$c);
		$q=mysql_query("insert INTO user_type (user_id,type,college,stream,year) VALUES ('$id','$type','$college','$stream','$year')");
		if($q == 1)
		{
				header("location: home.php");
		}
		else
		{
			die("<h1>Some issue is there..! We apologised for that :(</h1>");
		}
?>