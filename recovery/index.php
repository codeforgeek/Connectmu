<?php

?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Recover Your Password - Connectmu</title>
        <script src="jquery.js"></script>
        <script>
            $(document).ready(function () {
                $("#show_message").hide();
                $("#notice").hide();
                $("#check_email").click(function (data) {
                    var error = 0;
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    var email = $("#getemail").val();
                    if (email == "") {
                        error = 1;
                    }
                    if (!emailReg.test(email)) {
                        error = 2;
                    }
                    if (error == 0) {
                        $("#notice").empty().html('<img src="loading.gif" height="80px" width="80px">').show();
                        $.post("check_email.php", { email: email }, function (data) {
                            if (data.yes == 1) {
                                $("#notice").empty().hide();
                                $("#getdetail").hide();
                                $("#show_message").show();
                            }
                            else {
                                $("#notice").empty().html("<h1>There is no user with such email !");
                            }
                        });
                    }
                    else if (error == 1) {
                        $("#notice").empty().html("<h2>Please type an email</h2>").show();
                    }
                    else if (error == 2) {
                        $("#notice").empty().html("<h2>Email is not valid</h2>").show();
                    }
                });
            });
        </script>
        <style>
            body
            {
                margin: 0px;
            }
        #header
        {
        	    width:100%;
                min-width: 1360px;
	            height:6%;
                min-height: 40px;
	            border:1px solid #0184cd;
	            position:fixed;
	            background-color:#0184cd;
                font-family: 'Segoe UI';
                font-size: 28px;
                color: white;
                position: absolute;
        }
            #content
            {
                border: 1px solid gray;
                border-radius: 5px;
                width: 900px;
                height: 320px;
                margin-left: 220px;
                margin-top: 100px;
                position: absolute;
                padding: 10px;
                font-family: 'Segoe UI';
            }
            #content h1
            {
                font-size: 20px;
                color: #333333;
            }
            #content a
            {
                text-decoration:none;
                font-family: 'Segoe UI';
                color:red;
            }
        </style>
    </head>
    <body>
        <div id="header"><a href="http://connectmu.com/login.php" style="text-decoration:none;color:white;">Connectmu</a></div>
        <div id="content">
            <section id="getdetail">
            <h1>Sorry for inconvenience ! Please Type your email below and we'll see what we can do for you. </h1><hr><br>
            <input type="email" size="40" id="getemail" placeholder="Type in your email" style="font-family: 'Segoe UI';font-size: 18px;height: 50px;width: 400px;padding-left: 20px;margin-left: 210px;"><br><br>
            <input type="submit" id="check_email" style="font-family: 'Segoe UI';font-size: 18px;width: 120px;margin-left: 345px;">
            </section>
            <section id="show_message">
                <h1>We have sent you an recovery email ! Please check your inbox.</h1><br>
                <a href="http://connectmu.com/login.php">Back to Homepage</a>
            </section>
             <div style="margin-left:350px;"><span id="notice"></span></div>
        </div>
    </body>
</html>
