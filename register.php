<?php
include('dbconfig.php');
include("core-function.php");
session_start();
header('Content-Type: application/json');
$con = mysql_connect($host, $username, $password);
if(!$con)
{
		echo 'something wrong';
}
else
{
	$name = $_POST['name'];
	$email = $_POST['email'];
    //check existance of email
    $checkbit=check_exist_mail($email);
    if($checkbit==TRUE)
    {
        $error=0;
    }
    else
    {
        $error=1;
    }
	$gender = $_POST['gender'];
	$dob = $_POST['dob'];
	$password = $_POST['pass'];
	mysql_select_db("connectmu",$con);
    if($error==0)
    {
	$runquery = mysql_query("insert INTO user_info(email,name,gender,password) VALUES ('$email','$name','$gender',md5('$password'))");
	if($runquery == 1)
	{
		$query = mysql_query("select user_id FROM user_info WHERE email='$email'");
		$data = mysql_fetch_row($query);
		$id = $data[0];	
		mysql_query("insert INTO user_detail(user_id,DOB,DOJ) VALUES ('$id','$dob',CURDATE())");
        $_SESSION['email'] = $email;
		$success = array('yes' => 1);
		echo json_encode($success);
	}
    }
    else
    {
        echo 'Email Already there !';
    }
}
?>