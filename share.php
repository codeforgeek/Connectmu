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
<title>Share the information</title>
 <link href="css/home.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>
 <script>
 $(document).ready(function(){
	var type='<?php echo $type?>';
     $("#result").hide();
     if(type==2)//change it later
     {
      $("#share_files").show();
      $("#share_event").show();
      $("#share_job").show();
     }
     else
     {
         $("#share_job").hide();
     }
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
<a href="logout.php">Logout</a><br>
</span>
</div>
</div>
<div id="content">
    <span id="share_files"><a href="add_uploads.php"><img src="content/icon/files.png" height="130" width="130"></a></span><span id="share_event"><a href="add_events.php"><img src="content/icon/event.png" height="130" width="130"></a></span><span id="share_job"><a href="jobs.php"><img src="content/icon/job.jpg" height="130" width="130"></a></span><br>
    <div style="font-family: 'Segoe UI';font-size: 16px;line-height: 30px;margin-top: 10px;">Hello there ! In this page you can share following information:
        <ul>
            <li><b>Files</b></li>
            <li><b>Event related information</b></li>
            <li><b>Jobs related information (if is available to you)</b></li>
        </ul>
        While sharing any of the resources make sure you have check the proper sharing criteria such as Share to your college or Share to your branch.<p>Our System will take care of sharing those information to the people.</p>

    </div>
</div>
</div>
</body>
</html>