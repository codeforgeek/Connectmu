<?php
session_start();
include("core-function.php");
header('Content-Type: application/json');
$id = $_POST['id'];
$title = $_POST['title'];
$download_path =  str_replace('"', '', $_POST['fp']);
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
if($_POST['branch'] != null)
{
	//get the branch of user
	$query = mysql_query("select branch FROM user_type WHERE user_id='$id'");
	if(mysql_num_rows($query) == 1)
	{
		$res = mysql_fetch_row($query);
		$branch = $res[0];
	}
	else
	{
		$branch = null;
	}
}
else
{
	$branch = null;
}
if($_POST['college'] != null)
{
	//get the college details
	$query = mysql_query("select college FROM user_type WHERE user_id='$id'");
	if(mysql_num_rows($query) == 1)
	{
		$res = mysql_fetch_row($query);
		$college = $res[0];
	}
}
else
{
	$college = null;
}
//Add the upload to the uploads table
$c = connect_to_db();
$db = mysql_select_db("connectmu", $c);
$q=mysql_query("insert INTO uploads (user_id,upload_path,title,branch,college) VALUES ('$id','$download_path','$title','$branch','$college')");
if($q == 1)
{
	$success = array('yes' => 1);
	echo json_encode($success);
}
?>