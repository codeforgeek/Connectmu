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
<title>Add Job Information</title>
 <script type="text/javascript" src="js/jquery.js"></script>
  <link href="css/home.css" rel="stylesheet" type="text/css">
 <script type="text/javascript">
     $(document).ready(function () {
         var type = null
         var branch;
         var title, title_on, desc, desc_on, url, position, position_on, ctc, ctc_on, venue;
         var type_of_user = null;
         $("#result").hide();
         $("#off_campus").hide();
         $("#on_campus").hide();
         $("#show_success_message_off").hide();
         $("#show_success_message_on").hide();
         $("#next").click(function () {
             type = $('input:radio[name=jobtype]:checked').val();
             if (type == null) {
                 alert('YOu havent choosen the type of JOB');
             }
             else {
                 if (type == 'off') {
                     $("#showhead").hide();
                     $("#off_campus").show();
                     $("#on_campus").hide();
                     $("#choose_type").hide();
                 }
                 if (type == 'on') {
                     $("#showhead").hide();
                     $("#off_campus").hide();
                     $("#on_campus").show();
                     $("#choose_type").hide();
                 }
             }
         });

         $("#add_off_job").click(function () {
             title = $("#title-job-off").val();
             desc = $("#desc-job-off").val();
             url = $("#url-job-off").val();
             position = $("#off-positon").val();
             ctc = $("#off-ctc").val();
             venue = $("#off-venue").val();
             branch = $("#off-branch").val();
             type_of_user = $('input:radio[name=typeofuser]:checked').val();
             if (title == "" || desc == "" || url == "" || position == "" || venue == "" || branch == "" || type_of_user == null) {
                 alert("Please Provide all info");
             }
             else {
                 $.post("add_job.php", { type: type, title: title, desc: desc, url: url, position: position, ctc: ctc, venue: venue, branch: branch, type_of_user: type_of_user }, function (data) {
                     if (data.yes == 1) {
                         $("#show_success_message_off").show();
                         $("#show_success_message_off").html("<p>Job is Been Added</p>");
                     }
                 });
             }
         });

         $("#add_on_job").click(function () {
             title_on = $("#title-job-on").val();
             desc_on = $("#desc-job-on").val();
             position_on = $("#on-positon").val();
             ctc_on = $("#on-ctc").val();
             $.post("add_job.php", { type: type, title_on: title_on, desc_on: desc_on, position_on: position_on, ctc_on: ctc_on }, function (data) {
                 $("#show_success_message_on").show();
                 $("#show_success_message_on").html("<p>Job is Been Added</p>");
             });
         });

         $("#searchbox").keyup(function () {
             var kw = $("#searchbox").val();
             if (kw != '') {
                 $.ajax
           ({
               type: "POST",
               url: "ajax_search.php",
               data: "kw=" + kw,
               success: function (option) {
                   $("#result").html(option);
               }
           });
             }
             else {
                 $("#result").html("");
             }
             return false;
         });
         $("#content").click(function () {
             $("#result").css('display', 'none');
         });
         $("#searchbox").focus(function () {
             $("#result").show();
             $("#result").text("");
             $("#result").css('display', 'block');
         });
         $('#off-campus').change(function () {
             var optionSelected = $(this).find("option:selected");
             branch = optionSelected.val();
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
<div id="job">
<span id="showhead"><h1 style="font-family: 'Segoe UI';font-size: 17px;color: black;">Please Choose the JOB type:</h1></span>
<div id="choose_type" style="border: 2px solid grey;border-radius: 3px;width: 300px;height: 150px;padding: 40px;font-family: 'Segoe UI'">
<input type="radio" id="off" name="jobtype" value="off">Off Campus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="on" name="jobtype" value="on">On Campus<br><br>
<input type="button" value="Next" id="next" style="width: 100px;height: 30px;font-family: 'Segoe UI';font-size:15px;margin-left: 80px;">
</div>
</div>
<div id="off_campus">
<span style="color:Red">*</span><input type="text" size="75" placeholder="Enter Job Title" id="title-job-off" style="font-family: 'Segoe UI';font-size: 16px;"><br>
<span style="color:Red">*</span><textarea rows="10" cols=76" placeholder="Enter Description. Max 150 words" id="desc-job-off" style="font-family: 'Segoe UI';font-size: 16px;"></textarea><br>
<span style="color:Red">*</span><input type="text" size="75" placeholder="Enter Website Reference" id="url-job-off" style="font-family: 'Segoe UI';font-size: 16px;"><br>
<span style="color:Red">*</span><input type="text" size="75" placeholder="Enter Position of Job" id="off-positon" style="font-family: 'Segoe UI';font-size: 16px;"><br>
<span style="color:white">*</span><input type="text" size="75" placeholder="Enter CTC ( Expected Salary)" id="off-ctc" style="font-family: 'Segoe UI';font-size: 16px;"><br>
<span style="color:white">*</span><span style="font-family: 'Segoe UI';font-size: 18px;"><b>Branch:</b></span><select id="off-branch" style="font-family: 'Segoe UI';font-size: 16px;">
                <option value="engineering">Engineering</option>
                <option value="Arts,Science,Commerce">Arts,Science,commerce</option>
                <option value="Science and Commerce">Science and Commerce</option>
                <option value="Science">Science</option>
                <option value="Hotel Management">Hotel Management</option>
                <option value="Management">Management</option>
                <option value="Law">Law</option>
                <option value="Pharmacy">Pharmacy</option>
                <option value="Marine">Marine</option>
                <option value="Shipping">Shipping</option>
                <option value="Arts">Arts</option>
                <option value="BED">BED</option>
                <option value="MCA">MCA</option>
</select><br>
<span style="color:Red">*</span><input type="text" size="75" placeholder="Enter Venue detail" id="off-venue" style="font-family: 'Segoe UI';font-size: 16px;"><br>
<span style="color:Red">*</span>
<span style="font-family: 'Segoe UI';font-size: 18px;">Whom to invite for this JOB !</span><br>Student<input type="radio" value="student" name="typeofuser">Teacher<input type="radio" value="teacher" name="typeofuser">Alumni<input type="radio" value="alumni" name="typeofuser"><br>
<input type="button" id="add_off_job" value="Add this Job !" style="font-family: 'Segoe UI';font-size: 16px;">
     <span id="show_success_message_off"></span>
</div>


<div id="on_campus">

<span style="color:Red">*</span><input type="text" size="75" placeholder="Enter Job Title" id="title-job-on" style="font-family: 'Segoe UI';font-size: 16px;"><br>
<span style="color:Red">*</span><textarea rows="10" cols=76" placeholder="Enter Description. Max 150 words" id="desc-job-on" style="font-family: 'Segoe UI';font-size: 16px;"></textarea><br>
<span style="color:Red">*</span><input type="text" size="75" placeholder="Enter Position of Job" id="on-positon" style="font-family: 'Segoe UI';font-size: 16px;"><br>
<span style="color:white">*</span><input type="text" size="75" placeholder="Enter CTC ( Expected Salary)" id="on-ctc" style="font-family: 'Segoe UI';font-size: 16px;"><br>

<input type="button" value="Add this Job !" id="add_on_job" style="font-family: 'Segoe UI';font-size: 16px;">
    <span id="show_success_message_on"></span>

</div>

</div>
</div>
</body>
</html>