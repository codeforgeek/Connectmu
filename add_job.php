<?php
include("core-function.php");
session_start();
header('Content-Type: application/json');
$type = $_POST['type'];
$id=getuserid($_SESSION['email']);
switch($type)
{
	case 'off':
		{
            $con = connect_to_db();
            $db = mysql_select_db("connectmu", $con);
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $url = $_POST['url'];
            $position = $_POST['position'];
            $ctc=$_POST['ctc'];
            $venue = $_POST['venue'];
            $branch = $_POST['branch'];
            $type_of_user = $_POST['type_of_user'];
            $actual_type=return_user_type($type_of_user);
            $query=mysql_query("insert into job_offcampus(user_id,title,description,URL,branch,ctc,venue,type_of_user,position) VALUES ('$id','$title','$desc','$url','$branch','$ctc','$venue','$actual_type','$position')");
            if($query==1)
            {
                $success = array('yes' => 1);
	            echo json_encode($success);
            }
			break;
		}
	case 'on':
		{
            $con = connect_to_db();
            $db = mysql_select_db("connectmu", $con);
            $title = $_POST['title_on'];
            $desc = $_POST['desc_on'];
            $position=$_POST['position_on'];
            $ctc=$_POST['ctc_on'];
            $college=getcollegeofuser($id);
            $query=mysql_query("insert into job_oncampus(user_id,title,description,position,CTC,college) VALUES ('$id','$title','$desc','$position','$ctc','$college')");
            if($query==1)
            {
                $success = array('yes' => 1);
	            echo json_encode($success);
            }
			break;
		}
}
?>