<?php
session_start();
include("core-function.php");
$id=getuserid($_SESSION['email']);
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
$branch=$_POST['branch'];
$college=$_POST['college'];
$year=$_POST['year'];
if($year=="dummy")
{
    $query=mysql_query("select * from user_type where stream like '$branch' and college like '$college' and user_id!='$id'");
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
         echo '<b>Type : </b>'.return_user_type_2($res['type']);
		echo '</div>';
		echo '</div>';
		echo '<hr>';
        }
    }
    else
    {
        echo '<h1>Sorry We can not find what you are looking for</h1>';
    }
}
else
{
    $query=mysql_query("select * from user_type where stream='$branch' and college='$college' and year='$year' and user_id!='$id'");
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
        echo '<b>Type : </b>'.return_user_type_2($res['type']);
		echo '</div>';
		echo '</div>';
		echo '<hr>';
        }
    }
    else
    {
        echo '<h1>Sorry We can not find what you are looking for</h1>';
    }
}
?>
<html>
<head>
    <style>
        #details
        {
             width: 500px;
             height: 130px;
             margin-top: -120px;
             margin-left: 150px;
             position: relative;
             font-family: 'Segoe UI';
        }
        #details a
        {
            text-decoration: none;
            color: #0184cd;
        }
        #details a:hover
        {
            cursor: pointer;
        }
</style>
</head>
</html>