<?php
include("core-function.php");
$id =  mysql_real_escape_string($_POST["id"]);  //3
$conn_id =  mysql_real_escape_string($_POST["conn_id"]);  //2
$email_con=getemail($id);
$type=getusertype($email_con);
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
$status=0;
$query_2 = mysql_query("INSERT INTO connection(user_id,conn_id,type,status,reqd) VALUES ('$id','$conn_id','$type','$status',CURDATE())");
if($query_2 == 1)
{
    $query = mysql_query("update connection SET status=1 WHERE (user_id='$conn_id' and conn_id='$id') OR (user_id='$id' and conn_id='$conn_id') ");
    if($query==1)
    {
	echo 'its done';
    }
}
?>