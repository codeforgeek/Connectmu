<?php

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin Panel</title>
        <script src="jquery.js"></script>
        <script>
            $(document).ready(function (data) {
                $("#check").click(function () {
                    var name = $("#user_name").val();
                    var pass = $("#pass").val();
                    if (name == "shahid_connectmu" && pass == "s2v.programmer") {
                        location.href = "show_stats.php";
                    }
                    else {
                        alert("Wrong User");
                    }
                });
            });
</script>
    </head>
    <body>
        <div id="takecred">
            <input type="text" id="user_name" size="40" style="font-family: 'Segoe UI';font-size: 16px;" placeholder="User Name"><br>
            <input type="password" id="pass" size="40" style="font-family: 'Segoe UI';font-size: 16px;" placeholder="Password"><br>
            <input type="button" id="check" style="font-family: 'Segoe UI';font-size: 16px;" value="Login">
        </div>
    </body>
</html>
