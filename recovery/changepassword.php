<?php
session_start();
header('Content-Type: application/json');
$email=$_SESSION['recover_email'];
$pass=$_POST['pass1'];
$con=mysql_connect("localhost","root","");
$db=mysql_select_db("connectmu",$con);
$query=mysql_query("update user_info set password=md5('$pass') where email='$email'");
if($query==1)
{
     $success = array('yes' => 1);
     if(isset($_SESSION['email']))
     {
            $_SESSION=array();
            session_regenerate_id(); 
            session_destroy();
    }
    echo json_encode($success);
}
?>
