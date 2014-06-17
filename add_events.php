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
<title>Share Event information !</title>
<link href="css/home.css" rel="stylesheet" type="text/css">
<script src="js/jquery.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $("#show_college").hide();
        $("#some_where_else").hide();
        $("#branch").hide();
        $("#result").hide();
        var college_venue = $("#show_coll").val();
        var other_venue = "";
        var branch = $("#branch").val();
        var all = "";
        $("#c").click(function () {
            venue = $('input:radio[name=college]:checked').val();
            if (venue == null) {
                alert("You must choose Venue");
            }
            $("#show_college").show();
            $("#some_where_else").hide();
        });
        $("#show_coll").change(function () {
            var optionSelected = $(this).find("option:selected");
            if (optionSelected != null) {
                college_venue = optionSelected.val();
            }
            else
            { college_venue = ""; }
        });
        $("#o").click(function () {
            venue = $('input:radio[name=college]:checked').val();
            if (venue == null) {
                alert("You must choose Venue");
            }
            $("#show_college").hide();
            $("#some_where_else").show();
            college_venue = "";
        });
        $("#yes").click(function () {
            $("#branch").show();
            all = "";
        });
        $("#branch").change(function () {
            var optionSelected = $(this).find("option:selected");
            branch = optionSelected.val();
        });
        $("#no").click(function () {
            $("#branch").hide();
            all = "all";
            branch = "";
        });
        $("#add_event").click(function () {
            //check if anything is blank
            var title;
            var desc;
            var start_date, end_date;
            var venue;
            var br;
            title = $("#title_event").val();
            desc = $("#desc").val();
            start_date = $("#start_date").val();
            end_date = $("#end_date").val();
            if (college_venue != "") {
                venue = college_venue;
            }
            else {
                venue = $("#venue_place").val();
            }
            if (branch != "") {
                br = branch;
            }
            else {
                br = all;
            }
            if (title == "" || desc == "" || start_date == "" || end_date == "" || venue == "" || br == "") {
                alert("Please fill the form");
            }
            else {
                $.post("event_addition.php", { title: title, desc: desc, start_date: start_date, end_date: end_date, venue: venue, br: br }, function (data) {
                    if (data.yes == 1) {
                        alert("Event information is been added");
                    }
                });
            }
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
<style>
select
{
	width: 400px;
}
</style>
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
<div id="event_wrapper">
<span><span><input type="text" size="50" placeholder="Enter Name of Event" id="title_event" style="font-family: 'Segoe UI';font-size: 16px;"></span></span><br><br>
<span><textarea id="desc" cols="30" rows="4" placeholder="Put description of Event" style="font-family: 'Segoe UI';font-size: 16px;"></textarea></span><br><br>
<span>Start Date:<span><input type="date" id="start_date" style="font-family: 'Segoe UI';font-size: 16px;"></span><span>End Date:</span><input type="date" id="end_date" style="font-family: 'Segoe UI';font-size: 16px;"></span><br>
<span>Venue: <input type="radio" id="c" name="college" value="coll">If it is in any college in Mumbai university Or <input type="radio" name="college" value="nocoll" id="o">somewhere else</span><br>	
<span id="show_college">
    <select id="show_coll" style="font-family: 'Segoe UI';font-size: 16px">
<?php
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
$query = mysql_query("select college_name FROM college");
echo '<option value="">Please Select College</option>';
while($res = mysql_fetch_row($query))
{
		echo '<option value="' . $res[0] . '">' . $res[0] . '</option>';
}
?>
</select><br>
</span>
<span id="some_where_else">
<textarea rows="2" cols="60" id="venue_place" style="font-family: 'Segoe UI';font-size: 16px;" placeholder="Type Venue details"></textarea><br>
</span>
<span>Is it for Specific branch </span><span><input type="radio" name="choice" id="yes">Yes<input type="radio" name="choice" id="no">No, Invite every branch</span><br>
<span id="show_branch">
    <select id="branch" style="font-family: 'Segoe UI';font-size: 16px;">
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
</select>
</span><br>
<span style="margin-left: 150px;"><input type="button" id="add_event" value="Add this Event"></span>
</div>
</div>
</div>
</body>
</html>