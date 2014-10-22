<?php
include("core-function.php");
session_start();
if(isset($_SESSION['email']))
{
	$connection_id = $_POST['conn_id'];  //1
	$login_user_id = $_POST['user_id'];  //2
	$email1=getemail($login_user_id);
	$email2=getemail($connection_id);
	//fetch messages if any
	$con = connect_to_db();
	$db = mysql_select_db("connectmu", $con);
	$query = mysql_query("select * FROM message WHERE user_id='$login_user_id' AND reciever_id='$connection_id' OR user_id='$connection_id' AND reciever_id='$login_user_id'");
	if(mysql_num_rows($query) > 0)
	{
		while($arr=mysql_fetch_array($query))
		{
			if($arr['user_id'] == $login_user_id)
			{
				echo '<b>'.get_name_of_user($email1) . '</b><br><hr>' . $arr['message'].'<br><hr>';
			}
			else
			{
				echo '<b>'.get_name_of_user($email2) . '</b><br><hr>' . $arr['message'].'<br><hr>';
			}
		}
	}
	else
	{
		echo 'There is no message to Show ';
	}
}
else
{
	header("location: index.php");
}
?>