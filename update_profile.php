<?php
session_start();
header('Content-Type: application/json');
include("core-function.php");
$update_type=$_POST['update_type'];
$con=connect_to_db();
$db=mysql_select_db("connectmu",$con);
$id=getuserid($_SESSION['email']);
switch($update_type)
{
    case 'personal':
    {
        $name=$_POST['name'];
        $gender=$_POST['gender'];
        $interest=$_POST['interest'];
        $query=mysql_query("update user_info set name='$name',gender='$gender' where user_id='$id'");
        $query_2=mysql_query("update user_detail set interest='$interest' where user_id='$id'");
        if($query==1 and $query_2==1)
        {
             $success = array('yes' => 1);
             echo json_encode($success);
            //send back JSON
        }
        break;
    }
    case 'academic':
    {
        $branch=$_POST['branch'];
        $college=$_POST['college'];
        $query=mysql_query("update user_type set stream='$branch',college='$college' where user_id='$id'");
        if($query==1)
        {
             $success = array('yes' => 1);
             echo json_encode($success);
            //Send back JSON
        }
        break;
    }
    case 'contact':
    {
        $address=$_POST['address'];
        $mob=$_POST['mob'];
        $web=$_POST['web'];
        $query=mysql_query("update user_detail set address='$address',mobile_number='$mob',website='$web' where user_id='$id'");
        if($query==1)
        {
                    $success = array('yes' => 1);
                    echo json_encode($success);
        }
        break;
    }
}
?>
