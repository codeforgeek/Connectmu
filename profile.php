<?php
include("core-function.php");
session_start();
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
//Read URL and validate it
//it should not be other than profile.php?id=somenumber
//if it is then it may be XSS injection, redirect in that case to 404.php
$url = selfURL();
$id = getuseridfromurl($url);
if(!is_numeric($id))
{
	echo 'there is some problem';
	header("location:404.php");
}
if(checkidexist($id)==FALSE)
{
    header("location:404.php");
}
if($id=="")
{
  header("location:404.php");   
}
//Check whether the user who is login is checking his/her profile or someone else
$loginuserid = getuserid($_SESSION['email']);
$checkloginuserbit = false;
$friend_check = false;
if($id == $loginuserid)
{
	$checkloginuserbit = true;
}
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
?>
<html>
<head><title>Your Profile</title>
<script src="js/jquery.js" type="text/javascript"></script>
<link href="css/profile.css" rel="stylesheet" type="text/css">
<script>
$(document).ready(function(){
	$("#connect").click(function(){
		    var connid='<?php echo $id;?>';
			var userid='<?php echo $loginuserid;?>';
			$.post("connectrequest.php",{userid:userid,connid:connid},function(data){
				if(data.yes==1)
					{
						$("#connect").prop('value','Request Sent !');
					}
				});
		});
	});
</script>
    <script>
        $(document).ready(function () {
            $("#result").hide();
            $.post("loadconnection.php", function (data) {
                $("#show_contact_information").html(data);
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
            $("#profile_container").click(function () {
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
<div id="container">
<div id="header">
<div id="result"></div>
<div id="logo"><span id="main_head"><a href="home.php" style="text-decoration: none;color: white;">ConnectMu</a></span>
<span id="search"><input type="text" id="searchbox" name="searchbox" placeholder="Looking for something, type here !"></span>
</div>
</div>
<div id="profile_container">
<?php
switch($checkloginuserbit)
{
	case true:
		{
			//it means log on user is viewing their profile, so bring every information from database and show to it	
			$query = mysql_query("select email,name,gender,DOB,DOJ,address,interest,profile_pic,type,college,stream,mobile_number,website FROM user_info u,user_detail p,user_type t WHERE u.user_id='$id' AND p.user_id='$id' and t.user_id='$id'");
			$data = mysql_fetch_row($query);
			echo '<div id="abstract_bar">';
			echo '<span id="show_profile_pic"><img src="'.$data[7].'" height="200px" width="200px"></span>';
			echo '<div id="show_abstract">';
            echo '<span><h1 style="font-size:35px;font-family:Segoe UI;">'.$data[1].' Profile</h1></span>';
            echo '<span><b>'.return_user_type_2($data[8]).'</b> At '.$data[9].'</span><br>';
            echo '<span><b>Major</b> in '.$data[10].'</span>';
			echo '</div>';
			echo '</div>';			
			echo '<div id="show_public_info">';
            echo '<span id="show_personal">Personal Information:</span><br>';
			echo '<span><b>Name          :</b> ' . $data[1] . '</span><br>';
			echo '<span><b>Member Since  :</b>' . $data[4] . '</span><br>';	
            echo '<span><b>Birthday      :</b>' . $data[3] . '</span><br>';	
            echo '<span><b>Interest      :</b> ' . $data[5] . '</span><br>';	
            echo '<span><b>Stream        :</b> ' . $data[10] . '</span><br>';	
            echo '<span><b>College       :</b> ' . $data[9] . '</span><br><br>';	
            echo '<span id="show_personal">Contact Information:</span><br>';
            echo '<span><b>Email : </b>' . $data[0] . '</span><br>';
			echo '<span><b>Address :</b> ' . $data[5] . '</span><br>';	
            echo '<span><b>Mobile :</b> ' . $data[11] . '</span><br>';	
            echo '<span><b>Website : </b>' . $data[12] . '</span><br>';	
			echo '</div>';
			echo '<div id="show_contact_information">';
			echo '</div>';
			break;
		}
	case false:
		{
			//if current login user is not viewing his/her profile then might be a chance he is viewing other profile which can be friend 
			//or not friend, if friend then user can view his DOB,interest, email etc , if not then he cant view it
			$query = mysql_query("select * FROM connection WHERE user_id='$loginuserid' AND conn_id='$id' or user_id='$id' AND conn_id='$loginuserid' LIMIT 1");
			$res = mysql_fetch_row($query);
			if(mysql_num_rows($query) == 1)
			{
				//Check whether they are friend or not
				$status = $res[3];
				switch($status)
				{
					case 0:
						{
							$friend_check = false;
						 $query = mysql_query("select * from user_info where user_id='$id'");
                                $data = mysql_fetch_row($query);
                                $pic=getprofilepic($data[0]);
                                $query_2=mysql_query("select * from user_type where user_id='$data[0]'");
                                $data_2=mysql_fetch_array($query_2);
                                $query_3=mysql_query("select * from user_detail where user_id='$data[0]'");
                                $data_3=mysql_fetch_row($query_3);
				                echo '<div id="show_profile_info_option">';
				                echo '<img src="'.$pic.'" height="200px" width="200px"><br><br>';
				                echo '<input type ="button" value ="Request is Sent !" id="connectionsent" style="color:#0184cd;font-weight:bold;">';
				                echo '</div>';
				                echo '<div id="show_public_user_info">';
				                echo '<div id="tooltip">User Bio</div>';
                                echo '<span id="show_personal">Personal Information:</span><br>';
                                echo '<span><b>Name          :</b> ' . $data[2] . '</span><br>';
                                echo '<span><b>Gender          :</b> ' . $data[3] . '</span><br>';
                                 echo '<span><b>Interest          :</b> ' . $data_3[4] . '</span><br>';
                                echo '<span id="show_personal">Academic Information:</span><br>';
                                echo '<span><b>College          :</b> ' . $data_2['college'] . '</span><br>';
                                echo '<span><b>Stream          :</b> ' . $data_2['stream'] . '</span><br>';
                                echo '<span><b>Type          :</b> ' . return_user_type_2($data_2['type']) . '</span><br>';
                                echo '<span id="show_personal">Contact Information:</span><br>';
                                echo '<span><b>Email          :</b> ' . $data[1] . '</span><br>';
                                echo '<span><b>Address          :</b> ' . $data_3[3] . '</span><br>';
                                echo '<span><b>Websites          :</b> ' . $data_3[7] . '</span><br>';
							//Request is sent but not accepted
							break;
						}
					case 1:
						{
								$friend_check = true;
								$friend_check = false;
							    $con=mysql_connect("localhost","root","");
                                $db=mysql_select_db("connectmu",$con);
			                    $query = mysql_query("select * from user_info where user_id='$id'");
                                $data = mysql_fetch_row($query);
                                $pic=getprofilepic($data[0]);
                                $query_2=mysql_query("select * from user_type where user_id='$data[0]'");
                                $data_2=mysql_fetch_array($query_2);
                                $query_3=mysql_query("select * from user_detail where user_id='$data[0]'");
                                $data_3=mysql_fetch_row($query_3);
				                echo '<div id="show_profile_info_option">';
				                echo '<img src="'.$pic.'" height="200px" width="200px"><br><br>';
				                echo '<input type ="button" value ="Connected !" id="alreadyconnected" style="color:green;font-weight:bold;">';
				                echo '</div>';
				                echo '<div id="show_public_user_info">';
				                echo '<div id="tooltip">User Bio</div>';
                                echo '<span id="show_personal">Personal Information:</span><br>';
                                echo '<span><b>Name          :</b> ' . $data[2] . '</span><br>';
                                echo '<span><b>Gender          :</b> ' . $data[3] . '</span><br>';
                                 echo '<span><b>Interest          :</b> ' . $data_3[4] . '</span><br>';
                                echo '<span id="show_personal">Academic Information:</span><br>';
                                echo '<span><b>College          :</b> ' . $data_2['college'] . '</span><br>';
                                echo '<span><b>Stream          :</b> ' . $data_2['stream'] . '</span><br>';
                                echo '<span><b>Type          :</b> ' . return_user_type_2($data_2['type']) . '</span><br>';
                                echo '<span id="show_personal">Contact Information:</span><br>';
                                echo '<span><b>Email          :</b> ' . $data[1] . '</span><br>';
                                echo '<span><b>Address          :</b> ' . $data_3[3] . '</span><br>';
                                echo '<span><b>Websites          :</b> ' . $data_3[7] . '</span><br>';
				                echo '</div>';
							    //Connecton
								break;
						}
				}
				
			}
			else
			{
				$friend_check = false;
				//fetch data like name, DOJ, collegename, branch, interest and others and show a button to add them as a friend/teacher
				//depending upon the type of user
                $con=mysql_connect("localhost","root","");
                $db=mysql_select_db("connectmu",$con);
			    $query = mysql_query("select * from user_info where user_id='$id'");
                $data = mysql_fetch_row($query);
                $pic=getprofilepic($data[0]);
                $query_2=mysql_query("select * from user_type where user_id='$data[0]'");
                $data_2=mysql_fetch_array($query_2);
                $query_3=mysql_query("select website from user_detail where user_id='$data[0]'");
                $data_3=mysql_fetch_row($query_3);
				echo '<div id="show_profile_info_option">';
				echo '<img src="'.$pic.'" height="200px" width="200px"><br>';
				echo '<input type ="button" value ="Request to Connect" id="connect">';
				echo '</div>';
				echo '<div id="show_public_user_info">';
				echo '<div id="tooltip">User Bio</div>';
                echo '<span id="show_personal">Personal Information:</span><br>';
                echo '<span><b>Name          :</b> ' . $data[2] . '</span><br>';
                echo '<span><b>Gender          :</b> ' . $data[3] . '</span><br>';
                echo '<span id="show_personal">Academic Information:</span><br>';
                echo '<span><b>College          :</b> ' . $data_2['college'] . '</span><br>';
                echo '<span><b>Stream          :</b> ' . $data_2['stream'] . '</span><br>';
                echo '<span id="show_personal">Contact Information:</span><br>';
                echo '<span><b>Email          :</b> ' . $data[1] . '</span><br>';
                echo '<span><b>Websites          :</b> ' . $data_3[0] . '</span><br>';
				echo '</div>';
			}
			break;
		}
}
?>
</div>
</div>
</body>
</html>