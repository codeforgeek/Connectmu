<?php
session_start();
include("core-function.php");
$id=getuserid($_SESSION['email']);
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
$c=getcollegeofuser($id);
$query = mysql_query("select * FROM user_type WHERE user_id!='$id' AND college='$c'");
if(mysql_num_rows($query)>0)
{
	while($res=mysql_fetch_array($query))
	{
		$res2 = getuserpublicinfo($res['user_id']);
		echo '<div id="show_public_detail">';
       
		echo '<div id="profile_pic">';
         
		echo '<img src="'.getprofilepic($res2['user_id']).'" height="140px" width="140px">';
        
		echo '</div>';
       
		echo '<div id="details">';
         echo '<b>Name: </b><a href="profile.php?id='.$res2['user_id'].'">'.$res2['name'].'</a><br>';
		echo '<b>Gender: </b>' . $res2['gender'] . '<br>';
        echo '<b>College: </b>' . $res['college'] . '<br>';
		echo '</div>';
		echo '</div>';
		echo '<hr>';
	}
}
else
{
    echo '<h1>We find no one from your college ! Please search using name or try Finder</h1>';
}
?>
<html>
<head>
    <style>
        #details
        {
             width: 500px;
             margin-top: -130px;
             margin-left: 150px;
             position: absolute;
             font-family: 'Segoe UI';
        }
        #details a
        {
            text-decoration: none;
            color: #0184cd;
        }
</style>
</head>
</html>
