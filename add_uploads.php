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
<title>Upload and Share files !</title>
 <link href="css/home.css" rel="stylesheet" type="text/css">
 <link href="css/uploadfile.min.css" rel="stylesheet">
 <script src="js/jquery.js" type="text/javascript"></script>
 <script src="js/jquery.uploadfile.min.js"></script>
 <script>
 $(document).ready(function(){
var file_path;
	$("#get_file_info").hide();
     $("#result").hide();
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
$("#fileuploader").uploadFile({
	url:"upload_files.php",
	fileName:"myfile",
	onSuccess:function(files,data,xhr)
	{
	//files: list of files
	//data: response from server
	//xhr : jquer xhr object
	file_path=data;
	$("#get_file_info").show();
	$("#file_title").val(files);
	}
	});
	
	$("#share_it").click(function(){
		var id='<?php echo $id;?>';
		var title=$("#file_title").val();
		var branch=null;
		var college=null;
		var fp=file_path;
		if ($('#branch').is(":checked"))
		{
  			branch=$("#branch").val();
		}
		if ($('#college').is(":checked"))
		{
  			college=$("#college").val();
		}
		$.post("upload_addition.php",{id:id,title:title,fp:fp,branch:branch,college:college},function(data){
	
				if(data.yes==1)
				{
					$("#successalert").html("<h3>Your file is uploaded and shared.</h3>");
				}
			
			});
		});
	
});
</script>
</head>
<body>
<div id="container"><div id="result"></div>
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
<a href="alert.php">Alerts</a><br>
<a href="mycollege.php">My College</a><br>
<a href="finder.php">Finder</a><br>
<a href="editprofile.php">Account Setting</a><br>
<a href="logout.php">Logout</a>
</span>
</div>
</div>
<div id="content">
<div id="fileuploader">Upload</div>
<div id="get_file_info">
<span>Please Enter Title of File <input type="text" size="50" placeholder="keep it blank if title is same as file name" id="file_title" style="font-family: 'Segoe UI';font-size: 16px;"></span><br>
<span>
<p style="font-family: 'Segoe UI';font-size: 16px;"><b>Please tell us to whom you want to share it ?</b></p><br><br>
<span><input type="checkbox" name="share" value="branch" id="branch">Your branch<input type="checkbox" name="share" value="college" id="college">Your college</span><br>
 <span style="color: red;font-family: 'Segoe UI';font-size: 16px;"> It will share  to your connection by default</span><br>
<input type="button" value="Share it !" id="share_it" style="width: 120px;height: 50px;font-family: 'Segoe UI';font-weight: bold;border-radius: 5px;">
<span id="successalert" style="font-family: 'Segoe Script';font-size: 16px;color: green;"></span>
</span>
</div>
</div>
</div>
</body>
</html>