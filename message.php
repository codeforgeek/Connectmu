<?php
session_start();
include("core-function.php");
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
else
{
	//Most important stuff in the whole system, fetch email and user id 
	$email = $_SESSION['email'];
	$id = getuserid($email);
	$name = get_name_of_user($email);
	$type = getusertype($email);
}
?>
<html>
<head>
<title>Messages</title>
 <link href="css/home.css" rel="stylesheet" type="text/css">
 <link href="css/message.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>
 <script>
 $(document).ready(function(){
	 var conn_id;
	 var user_id;
     $("#result").hide();
     $("#send_message_section").hide();
	$(".msgretr").click(function(event){
		event.preventDefault();
	    conn_id=$(this).attr('href'); //2
		$("#send_message_section").show();
	    user_id='<?php echo $id;?>'; 
			var autorefresh=setInterval(
		function()
		{
		$.post("load_message_ajax.php",{user_id:user_id,conn_id:conn_id},function(data){
			$("#chat_section").html(data);
			});
			},1000)
		});
		
		$("#send_message").click(function(){
			var msg=$("#msg").val()
			if(msg=='')
			{
				alert("Add Some Message First");
			}
			else
			{
				$.post("add_message_ajax.php",{conn_id:conn_id,user_id:user_id,msg:msg},function(data){
					$("#msg").val("");
					});
			}
			});
	$("#searchbox").keyup(function()
  {
    var kw = $("#searchbox").val();
	if(kw != '')  
	 {
		 $.ajax
	  ({
	     type: "POST",
		 url: "ajax_search.php",
		 data: "kw="+ kw,
		 success: function(option)
		 {
		   $("#result").html(option);
		 }
	  });
	 }
	 else
	 {
	   $("#result").html("");
	 }
	return false;
  });
  $("#content").click(function()
   {
	 $("#result").css('display','none');
   });
   $("#searchbox").focus(function()
   {
       $("#result").show();
	   $("#result").text("");
	   $("#result").css('display','block');
   });

});
</script>
</head>
<body>
<div id="result"></div>
<div id="container">
<div id="header">
<div id="logo"><span id="main_head"><a href="home.php">ConnectMu</a></span>
<span id="search"><input type="text" id="searchbox" name="searchbox" placeholder="Looking for something, type here !"></span>
</div>
</div>
<div id="sidebar">
<div id="side_main">
<span id="user_profile_pic"><img src='<?php echo getprofilepic($id);?>' height="220px" width="200px"></span><br><br>
<span id="options">
<a href="profile.php?id=<?php echo $id;?>" ><?php echo 'Your Profile'?></a><br>
<a href="message.php">Messages</a><br>
<a href="share.php">Share </a><br>
<a href="alert.php">Alerts </a><br>
<a href="mycollege.php">My College</a><br>
<a href="finder.php">Finder</a><br>
<a href="editprofile.php">Account Setting</a><br>
<a href="logout.php">Logout</a>
</span>
</div>
</div>
<div id="content">
<div id="load_users">
<?php
	$con = connect_to_db();
	$db = mysql_select_db("connectmu", $con);
	$query = mysql_query("select distinct conn_id FROM connection WHERE user_id='$id' and status=1");
    if(mysql_num_rows($query)==0)
    {
        echo 'You have no connection to chat';
    }
while($arr = mysql_fetch_row($query))
{
	$q2 = mysql_query("select * FROM user_info WHERE user_id='$arr[0]'");
	while($arr2=mysql_fetch_array($q2))
	{
			echo '<a href="'.$arr2['user_id'].'" class="msgretr" style="text-decoration:none;">'.$arr2['name'].'</a>';
            echo '<hr>';
	}
}
?>
</div>
<div id="message">
<div id="chat_section"></div>
<div id="send_message_section"><input type="text" id="msg"><br><input type="button" value="send" id="send_message"></div>
</div>
</div>
</div>
</body>
</html>