<?php
    header('Content-Type: application/json');
    $name=$_POST['name'];
    $email=$_POST['email'];
    $msg=$_POST['msg'];
    mail("shahid@koding.info","Feedback By".$name,$msg,"From:".$email);
    $success = array('yes' => 1);
    echo json_encode($success);
?>

