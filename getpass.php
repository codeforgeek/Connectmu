<?php
session_start();	
if(isset($_SESSION['email']))
{
	$oauth = $_SESSION['oauth'];
	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$gender = $_SESSION['gender'];
		if($oauth == 'facebook')
		{
			$birthday = $_SESSION['birthday'];
		}
	$_SESSION['email'] = $email;
}
else
{
    header("location: login.php");
}
?>
<html>
    <head>
        <title>Complete Your registration</title>
        <link href="css/steps.css" rel="stylesheet" type="text/css">
        <script src="js/jquery.js"></script>
	<script>
     $(document).ready(function () {

         var oauth = $("#oauth").val();
         var day, month, year;
         if (oauth == 'google') {
             day = $("#day").val().concat('-');
             month = $("#month").val().concat('-');
             year = $("#year").val();
         }
         $('#pass').keyup(function () {
             $('#result').html(checkStrength($('#pass').val()));
         });
         function checkStrength(password) {
             var strength = 0;
             if (password.length < 6) {
                 $('#result').removeClass();
                 $('#result').addClass('short');
                 return 'Too short';
             }
             if (password.length > 7) {
                 strength++;
                 if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
                     strength++;

                 if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
                     strength++;

             }
             if (strength < 2) {
                 $('#result').removeClass();
                 $('#result').addClass('weak');
                 return 'Weak';
             } else if (strength == 2) {
                 $('#result').removeClass();
                 $('#result').addClass('good');
                 return 'Good';
             } else {
                 $('#result').removeClass();
                 $('#result').addClass('strong');
                 return 'Strong';
             }
         }
         $("#register").click(function () {
             var error = 0;
             var name = $("#name").text();
             var email = $("#email").text();
             var gender = $("#gender").text();
             var dob = $("#birthday").text();
             var oauth = $("#oauth").val();
             var pass = $("#pass").val();
             if (pass == "") {
                 error = 1;
             }
             if (pass.length > 12) {
                 error = 2;
             }
             var dob;
             if (oauth == 'google') {
                 dob = (day + month + year);
             }
             //ok all checks now add the user
             if (error == 0) {
                 $.post("register.php", { name: name, email: email, gender: gender, dob: dob, pass: pass }, function (data) {
                     if (data.yes == 1) {
                         window.location = "checkpoint.php";
                     }
                     else {
                         document.write("<h1>" + data + "</h1>");
                     }
                 });
             }
             else if (error == 1) {
                 alert("Password Field is blank");
             }
             else if (error == 2) {
                 alert("Password lenght should not exceed 12 characters");
             }
         });
     });
	</script>
    </head>
    <body>
	<div id="container">
	<div id="header"><span style="font-family: 'Segoe UI';color: white;font-size: 28px;">CONNECTMU</span></div>
	<div id="main_body">
	<span>
	<?php	
	if($oauth == 'google')
	{
	 	echo "<img src=\"/connectmu/content/register/google+.png\">";
	}	
	else
	{
		echo "<img src=\"/connectmu/content/register/facebook.png\">";
	}
	?></span><br>
	<span><strong>Name: </strong><?php echo '<span id="name">'.$name.'</span>';?></span><br>
	<span><strong>Email:  </strong><?php echo '<span id="email">'.$email.'</span>'; ?></span><br>
	<span><strong>Gender: </strong><?php echo '<span id="gender">' . $gender . '</span>'; ?></span><br>
	<input type="hidden" id="oauth" value="<?php echo $oauth;?>">
	<?php 
	if(isset($birthday))
	{
			echo '<span><strong>Your Birthday :</strong><span id="birthday">' . $birthday . '</span></span><br>';
	}
	if($oauth == 'google')
	{
		echo '<span>Please Provide Your birthday.</span>';
		echo '<select id="day">';
		for($i = 1; $i <= 31; $i++)
		{
			echo "<option value='$i'>$i</option>";
		}
		echo '</select>';
		echo '
		<select  id="month">
		<option value="Jan">January</option>
		<option value="Feb">February</option>
		<option value="Mar">March</option>
		<option value="April">April</option>
		<option value="May">May</option>
		<option value="June">June</option>
		<option value="July">July</option>
		<option value="Aug">August</option>
		<option value="Sep">September</option>
		<option value="Oct">October</option>
		<option value="Nov">November</option>
		<option value="Dec">December</option>
		</select>';
		
	echo '<select id="year" style="margin-top:5px;">';
	for($x=2014;$x>1949;$x--)
	{
		echo "<option value='$x'>$x</option>";
	}
	echo '</select>'.'<br>';
	}
	?>
	<span><strong>Please Provide Your Password:</strong></span><input type="password" id="pass" size="30"><br><span id="result"></span><br>
	<br>
	 <a href="#" class="button1" id="register">Register</a><br><br>
	 <span id="alert" style="margin-left:1%;">Note: Use Your Email and the password combination you have provided above to login again. No need to connect to Facebook or Google Again</span>
	</div>
	<div id="footer"></div>
	</div>
    </body>
</html>