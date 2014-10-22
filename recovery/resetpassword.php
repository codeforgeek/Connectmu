<?php
	session_start();
	$id=$_SESSION['resetid'];
?>
<html>
<head>
<title>Reset Password</title>
<script src="jquery.js"></script>
<script>
$(document).ready(function(){
		var url= window.location.href;
		var n = url.indexOf("id=");
		if(n!=0)
		{
			var id=url.substr(62,url.length);
			var actual_id="<?php echo $id;?>";
			if(id==actual_id)
			{
               
				window.location.href="takepassword.php";
			}
			else
			{
				document.write("<h1>Fatal Error: Some issue is here</h1>");
			}
		}
});
</script>
</head>
<body>
</body>
</html>
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
    </body>
</html>
