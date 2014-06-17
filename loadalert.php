<?php
session_start();
include("core-function.php");
$id=getuserid($_SESSION['email']);
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
$query = mysql_query("select * FROM connection WHERE conn_id='$id' AND status=0");
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
		 echo 'Name:'.$res2['name'].'<br>';
		echo 'Gender: ' . $res2['gender'] . '<br>';
		echo 'Date:' . $res['reqd'].'<br>';
		echo '<input type="button" id="accept" value="accept Connection">';
		echo '<input type="hidden" id="conn_id" value="'.$res['user_id'].'">';
		echo '</div>';
		echo '</div>';
		echo '<hr>';
	}
}
else
{
    echo '<h1>There is no alerts !</h1>';
}
?>
<html>
<head>
<script src="js/jquery.js"></script>
<script>
$(document).ready(function(){
	$("#accept").click(function(){
		var id='<?php echo $id;?>';
		var conn_id=$("#conn_id").val();
		$.post("accept_request.php",{id:id,conn_id:conn_id},function(data){
            $("#accept").text("Added as connection");
			});
		});
	});
</script>
</head>
</html>
