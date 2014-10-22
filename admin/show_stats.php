<?php
$con=mysql_connect("localhost","root","");
$db=mysql_select_db("connectmu",$con);
$query=mysql_query("select * from user_info");
$query_2=mysql_query("select * from uploads");
$query_3=mysql_query("select * from job_offcampus");
$query_4=mysql_query("select * from job_oncampus");
$query_5=mysql_query("select * from festival");
$no_of_users=mysql_num_rows($query);
$no_of_uploads=mysql_num_rows($query_2);
$no_of_off_campus=mysql_num_rows($query_3);
$no_of_on_campus=mysql_num_rows($query_4);
$no_of_event=mysql_num_rows($query_5);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <header><h1>Welcome Admin</h1></header>
        <span style="font-family: 'Segoe UI';font-size: 18px;">No of users: <?php echo $no_of_users;?></span><br>
        <span style="font-family: 'Segoe UI';font-size: 18px;">Uploads: <?php echo $no_of_uploads;?></span><br>
        <span style="font-family: 'Segoe UI';font-size: 18px;">Off campus Jobs: <?php echo $no_of_off_campus;?></span><br>
        <span style="font-family: 'Segoe UI';font-size: 18px;">On campus Jobs: <?php echo $no_of_on_campus;?></span><br>
        <span style="font-family: 'Segoe UI';font-size: 18px;">Event Shared: <?php echo $no_of_event;?></span><br>
    </body>
</html>
