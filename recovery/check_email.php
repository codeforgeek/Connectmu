<?php
        session_start();
        header('Content-Type: application/json');
        $email=$_POST['email'];
        //check email is in DB or not
        $con=mysql_connect("localhost","root","");
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from user_info where email='$email'");
        if(mysql_num_rows($query)==1)
        {
            $number=rand();
            $message="Hello ,"."\n"."We have recieved password reset request from you , please click on following given link to reset your password\n"."http://connectmu.com/recovery/resetpassword.php?id=".$number."\n\nRegards,\nConnectmu Team.";
            $_SESSION['resetid']=$number;
            $_SESSION['recover_email']=$email;
            mail($email,"Connectmu Password reset",$message,"From: Shahid");
            $success = array('yes' => 1);
	        echo json_encode($success);
        }
        else
        {
            $success = array('yes' => 0);
	        echo json_encode($success);
        }
?>
