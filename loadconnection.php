<?php
include("core-function.php");
session_start();
$email=$_SESSION['email'];
$id=getuserid($email);
//load friends
$con=connect_to_db();
$db=mysql_select_db("connectmu",$con);
$query=mysql_query("select distinct conn_id from connection where user_id='$id' and conn_id!='$id' and status=1");
while($res=mysql_fetch_array($query))
{
  $d=getuserpublicinfo($res['conn_id']);
  echo '<span>';
  $pic=getprofilepic($d['user_id']);
  echo '<a href=profile.php?id='.$d['user_id'].' target="_blank">'.'<img src="'.$pic.'" width="100px" height="100px" alt="'.$d['name'].'"></a>';
  echo '</span>';

}
?>
