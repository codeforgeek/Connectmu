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
<title>Welcome to Connectmu - Educational Network for Mumbai University</title>
 <link href="css/home.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>
 <script>
 $(document).ready(function(){
	
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
<div id="logo"><span id="main_head">ConnectMu</span>
<span id="search"><input type="text" id="searchbox" name="searchbox" placeholder="Looking for something, type here !"></span>
<span id="account_option">
</span>
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
    <h1 style="font-family: 'Segoe UI';font-size: 32px;font-weight: bold">Hey Buddy, You are doing something wrong ! Or may be page you are looking for is not available, Try finder or Search to fulfill your request</h1>
</div>
</div>
</body>
</html>