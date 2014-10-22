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
<title>Find People in University</title>
 <link href="css/home.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>
 <script>
     $(document).ready(function () {
         $("#notice").hide();
         $("#result").hide();
         $("#search_user").click(function (data) {
             var branch = $("#branch").val();
             var college = $("#college").val();
             var year = $("#passout_year").val();
             $("#notice").empty().html('<img src="content/icon/loading.gif" height="80px" width="90px">').show();
             $.post("find.php", { branch: branch, college: college, year: year }, function (data) {
                 $("#load_search_result").html(data);
                 $("#notice").empty().hide();
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

     });
</script>
</head>
<body>
 <div id="result"></div>
<div id="container">
<div id="header">
<div id="logo"><span id="main_head"><a href="home.php" style="text-decoration: none;color: white;">ConnectMu</a></span>
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
    
<div id="content" style="overflow-y: hidden;">
    <span>
    <select id="branch" style="font-family: 'Segoe UI';font-size: 18px;">
        <?php
            $c=connect_to_db();
            $db=mysql_select_db("connectmu",$c);
            $query=mysql_query("select * from branch");
            while($res=mysql_fetch_array($query))
            {
                 echo '<option value="'.$res['branch_name'].'">'.$res['branch_name'].'</option>';
            }
        ?>
            </select>
        <select id="college" style="width: 400px;font-family: 'Segoe UI';font-size: 18px;">
               <?php
            $c=connect_to_db();
            $db=mysql_select_db("connectmu",$c);
            $query=mysql_query("select * from college");
            while($res=mysql_fetch_array($query))
            {
                echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
            }
        ?>
                </select>
        <select id="passout_year" style="font-family: 'Segoe UI';font-size: 18px;">
            <option value="dummy">Select Pass out year</option>
            <option value="2008">2008</option>
            <option value="2009">2009</option>
           <option value="2010">2010</option>
            <option value="2011">2011</option>
            <option value="2012">2012</option>
            <option value="2013">2013</option>
            <option value="2014">2014   </option>
                </select>
        <input type="button" id="search_user" value="Search" style="height: 32px; width: 100px;font-family: 'Segoe UI';font-weight: bold;">
        </span>
    <hr>
    <div id="load_search_result" style="height: 550px;overflow-y: auto;">
            <span id="notice" style="margin-left:400px;"></span>
    </div>

</div>
</div>
</body>
</html>