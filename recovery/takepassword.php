<?php

?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Recover Your Password - Connectmu</title>
        <script src="jquery.js"></script>
        <script>
            $(document).ready(function () {
                $("#notice").hide();
                $("#reset_pass").click(function () {
                    var pass1, pass2, error = 0;
                    pass1 = $("#pass1").val();
                    pass2 = $("#pass2").val();
                    if (pass1.length > 12) {
                        error = 1;
                    }
                    if (pass1 !== pass2) {
                        error = 2;
                    }
                    if (pass1 == "" || pass2 == "") {
                        error = 3;
                    }
                    if (error == 0) {
                        $("#notice").empty().html('<img src="loading.gif" height="80px" width="80px">').show();
                        $.post("changepassword.php", { pass1: pass1 }, function (data) {
                            if (data.yes == 1) {
                                $("#notice").empty().html("Your Password is successfully changed. Try login.").show();
                            }
                            else {
                                $("#notice").empty().html("Password is not updated ! Please come back later.").show();
                            }
                        });
                    }
                    else if(error==1)
                    {
                         $("#notice").empty().html("Password Length should not exceed 12 characters").show();
                    }
                    else if(error==2)
                    {
                         $("#notice").empty().html("Password did not match ! Check again.").show();
                    }
                    else if(error==3)
                    {
                         $("#notice").empty().html("Fields are blank ! Please Type password.").show();
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
        <div id="header">Connectmu</div>
        <div id="content">
            <section id="getdetail">
            <h1>Please Type your New Password:</h1><hr><br>
            <input type="password" size="40" id="pass1" placeholder="Type in your password" style="font-family: 'Segoe UI';font-size: 18px;height: 50px;width: 400px;padding-left: 20px;margin-left: 210px;"><br><br>
            <input type="password" size="40" id="pass2" placeholder="Type in your password Again" style="font-family: 'Segoe UI';font-size: 18px;height: 50px;width: 400px;padding-left: 20px;margin-left: 210px;"><br><br>
            <input type="submit" id="reset_pass" style="font-family: 'Segoe UI';font-size: 18px;width: 120px;margin-left: 345px;">
                 <div style="margin-left:350px;"><span id="notice"></span></div>
            </section>
            
        </div>
    </body>
</html>
