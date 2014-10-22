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

 define ("MAX_SIZE","400");
if($_SERVER["REQUEST_METHOD"] == "POST")
 {
 	$image =$_FILES["file"]["name"];
	$uploadedfile = $_FILES['file']['tmp_name'];
 	if ($image) 
 	{
 		$filename = stripslashes($_FILES['file']['name']);
  		$extension = getExtension($filename);
 		$extension = strtolower($extension);
		/*Checking for extension of an image*/
	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{	
 		   echo '<h1>Are you trying to upload image?!</h1><br><h2>Try to uploade PNG,JPG or GIF format only.</h2><br><a href="editprofile.php">Click here to go back and try again</a> ';
 			exit;
 		}
 		else
 		{
			$size=filesize($_FILES['file']['tmp_name']);
			if ($size > MAX_SIZE*1024)
			{
					echo '<h1>You have exceeded the size limit!</h1><br><h2>Sorry due to Server size issue we have restrict size of image</h2><br><a href="editprofile.php">Click here to go back and try again</a> ';
					exit;
			}
		if($extension=="jpg" || $extension=="jpeg" )
		{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefromjpeg($uploadedfile);
		}
		else if($extension=="png")
		{
				$uploadedfile = $_FILES['file']['tmp_name'];
				$src = imagecreatefrompng($uploadedfile);
		}
	else 
	{
			$src = imagecreatefromgif($uploadedfile);
	}
	list($width,$height)=getimagesize($uploadedfile);
	$newwidth=200;
	$newheight=($height/$width)*$newwidth;
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	$newwidth1=200;
	$newheight1=($height/$width)*$newwidth1;
	$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
    if (!file_exists('uploads/'.$id)) {
            mkdir('uploads/'.$id, 0777, true);
    }
	$filename = "uploads/".$id."/". $_FILES['file']['name'];
	$filename1 = "uploads/".$id."/"."small_". $_FILES['file']['name'];
    $con=connect_to_db();
    $db=mysql_select_db("connectmu",$con);
    $pic_query=mysql_query("select profile_pic from user_detail where user_id='$id'");
    while($res=mysql_fetch_array($pic_query))
    {
        if($res['profile_pic']=="")
        {
            $query_add=mysql_query("update user_detail set profile_pic='$filename' where user_id='$id'");
            if($query_add!=1)
            {
               echo '<h1>Profile Pic is not uploaded!</h1><br><h2>Sorry for inconvenience</h2><br><a href="editprofile.php">Click here to go back and try again</a> ';
                exit;
            }
        }
        else
        {
           unlink($res['profile_pic']);
            $query_add=mysql_query("update user_detail set profile_pic='$filename' where user_id='$id'");
            if($query_add!=1)
            {
               	  echo '<h1>Profile Pic is not uploaded!</h1><br><h2>Sorry for inconvenience</h2><br><a href="editprofile.php">Click here to go back and try again</a> ';
                exit;
            }
        }
    }
    }
	imagejpeg($tmp,$filename,100);
	imagejpeg($tmp1,$filename1,100);
	imagedestroy($src);
	imagedestroy($tmp);
	imagedestroy($tmp1);
	}
}
?>
<html>
<head>
<title>Edit Profile</title>
 <link href="css/home.css" rel="stylesheet" type="text/css">
    <link href="css/editprofile.css" rel="stylesheet" type="text/css">
 <script src="js/jquery.js" type="text/javascript"></script>
 <script>
     $(document).ready(function () {

         $("#edit_profile_pic").show();
         $("#edit_personal_info").hide();
         $("#edit_academic_info").hide();
         $("#edit_contact_info").hide();
         $("#showmessage").hide();
         $("#result").hide();
         $("#pic").click(function () {
             $("#edit_profile_pic").show();
             $("#edit_personal_info").hide();
             $("#edit_academic_info").hide();
             $("#edit_contact_info").hide();
             $("#showmessage").hide();
         });

         $("#personal").click(function () {
             $("#edit_profile_pic").hide();
             $("#edit_personal_info").show();
             $("#edit_academic_info").hide();
             $("#edit_contact_info").hide();
         });
         $("#update_personal").click(function () {
             var name, gender, interest;
             name = $("#update_name").val();
             gender = $("#update_gender").val();
             interest = $("#update_interest").val();
             var update_type = "personal";
             var error = 0;
             if (name == "") {
                 error = 1;
             }
             if (error == 0) {
                 $.post("update_profile.php", { update_type: update_type, name: name, gender: gender, interest: interest }, function (data) {
                     if (data.yes == 1) {
                         $("#showmessage").empty().html("Your Personal information is updated").show();
                     }
                 });
             }
             else if (error == 1) {
                 alert("Name cannot be blank");
             }
         });
         $("#update_academic").click(function () {
             var branch, college;
             branch = $("#branch").val();
             college = $("#update_college").val();
             var update_type = "academic";
             $.post("update_profile.php", { update_type: update_type, branch: branch, college: college }, function (data) {
                 if (data.yes == 1) {
                     $("#showmessage").empty().html("Your Academic Information is updated").show();
                 }
             });

         });
         $("#academic").click(function () {
             $("#edit_profile_pic").hide();
             $("#edit_personal_info").hide();
             $("#edit_academic_info").show();
             $("#edit_contact_info").hide();
             $("#showmessage").hide();
         });

         $("#contact").click(function () {
             $("#edit_profile_pic").hide();
             $("#edit_personal_info").hide();
             $("#edit_academic_info").hide();
             $("#edit_contact_info").show();
             $("#showmessage").hide();
         });


         $("#update_contact").click(function () {
             var address, mob, web;
             address = $("#address").val();
             mob = $("#mobile_number").val();
             web = $("#website").val();
             var error = 0;
             if (mob.length > 10) {
                 error = 1;
             }
             if ($.isNumeric(mob) == false) {
                 error = 2;
             }
             var update_type = "contact";
             if (error == 0) {
                 $.post("update_profile.php", { update_type: update_type, address: address, mob: mob, web: web }, function (data) {
                     if (data.yes == 1) {
                         $("#showmessage").empty().html("Your Contact Information is updated").show();
                     }
                 });
             }
             else if (error == 1) {
                 $("#showmessage").empty().html("Phone number should not exceed 10 digits").show();
             }
             else if(error==2)
             {
                 $("#showmessage").empty().html("Phone number should contain digits only").show();
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
    <div id="upper_dock">
        <a href="#profilepic" id="pic">Profile Picture /</a>
        <a href="#personalinfo" id="personal">Personal information /</a>
        <a href="#academicinfo" id="academic">Academic information /</a>
        <a href="#contactinfo" id="contact">Contact information /</a>         
    </div>
    <div id="load_edit">
        <div id="edit_profile_pic" style="margin-top: 20px;">
        
        <br><div id="show_profile_pic">
            <?php
                $con=connect_to_db();
                $db=mysql_select_db("connectmu",$con);
                $query=mysql_query("select profile_pic from user_detail where user_id='$id'");
                $res=mysql_fetch_array($query);
                if($res['profile_pic']!="")
                {
                    $pic=$res['profile_pic'];
                }
                else
                {
                    $pic="";
                }
            ?>
            <form action="" method="post" name="form1" enctype="multipart/form-data">
            <span style="font-family: 'Segoe UI';font-size: 18px;font-weight: bold;">Your Current Pic:</span><br><br>
            <img src='<?php echo $pic;?>' id="show_profile_pic" alt="Profile Picture"><br /><br />
            <input type="file" name="file" style="font-family: 'Segoe UI';font-size: 18px;"><br>
            <input type="submit" value="Update profile Pic" id="upload_profile_pic" style="font-family: 'Segoe UI';font-size: 18px;">
                </form>
        </div>
        
  
        </div>
        <div id="edit_personal_info" style="margin-top: 20px;">
            <?php
               $con=connect_to_db();
               $db=mysql_select_db("connectmu",$con);
               $query=mysql_query("select * from user_info where user_id='$id'");
               $query_2=mysql_query("select * from user_detail where user_id='$id'");
               $res=mysql_fetch_array($query);
               $res2=mysql_fetch_array($query_2);
            ?>
            <span style="font-family: 'Segoe UI';font-size: 18px;font-weight: bold;">Update Name:</span><input type="text" id="update_name" size="40" style="margin-left:5px;font-family: 'Segoe UI';font-size: 18px;" value='<?php echo $res['name']?>'><br>
           <span style="font-family: 'Segoe UI';font-size: 18px;font-weight: bold;">Gender: </span><select id="update_gender" style="margin-left:53px;font-family: 'Segoe UI';font-size: 18px;">
               <option value="male">Male</option>
               <option value="female">Female</option>
           </select><br>
            <span style="font-family: 'Segoe UI';font-size: 18px;font-weight: bold;">Interest: </span>
            <input type="text" id="update_interest" value='<?php echo $res2['interest'];?>' placeholder="Enter some detail" style="margin-left:50px;font-family: 'Segoe UI';font-size: 18px;"><br><br>
            <input type="button" id="update_personal" value="Update Personal Information" style="font-family: 'Segoe UI';font-size: 18px;">
        </div>
        <div id="edit_academic_info" style="margin-top: 20px;">
            <span style="font-family: 'Segoe UI';font-size: 18px;font-weight: bold;">Choose Branch:</span><br>
            <select id="branch" style="font-family: 'Segoe UI';font-size: 18px;">
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
            <span style="font-family: 'Segoe UI';font-size: 18px;font-weight: bold;">Choose College:</span><br>
            <select id="update_college" style="width: 400px;font-family: 'Segoe UI';font-size: 18px;">
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
            </select><br><br>
            <input type="button" id="update_academic" value="Update Academic Information" style="font-family: 'Segoe UI';font-size: 18px;">
        </div>
        <div id="edit_contact_info" style="margin-top: 20px;">
            <?php
                $con = connect_to_db();
                $db = mysql_select_db("connectmu", $con);
                $query=mysql_query("select * from user_detail where user_id='$id'");
                $res=mysql_fetch_array($query);
            ?>
            <textarea rows="5" cols="40" id="address" placeholder="Enter Address" style="font-family: 'Segoe UI';font-size: 16px;"><?php echo $res['address'];?></textarea><br>
            <input type="number" id="mobile_number" placeholder="Enter Mobile number" style="font-family: 'Segoe UI';font-size: 16px;" value='<?php echo $res['mobile_number'];?>'><br>
            <textarea rows="5" cols="40" id="website" placeholder="Enter Website's or Blog" style="font-family: 'Segoe UI';font-size: 16px;"><?php echo $res['website'];?></textarea><br><br>
            <input type="button" id="update_contact" value="Update Contact Information" style="font-family: 'Segoe UI';font-size: 18px;">
        </div>
        <span id="showmessage" style="font-family: 'Segoe UI';color: #0184cd;font-weight: bolder;font-size: 20px;"></span>
    </div>
</div>
</div>
</body>
</html>