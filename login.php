<?php
       
       session_start();
       if (isset($_SESSION['email'])) {
                header("location: home.php");
        }

        if (array_key_exists("signup", $_GET)) {
              $oauth_provider = $_GET['oauth_provider'];
         if ($oauth_provider == 'gplus') {
              header("Location: login-google.php");
         } else if ($oauth_provider == 'fb') {
               header("Location: login-facebook.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Connectmu : Login</title>
        <meta name="description" content="Connectmu.com is an online social community for academic network in mumbai university.">
        <meta name="keywords" content="Mumbai university alumni association, alumnus connection, Connectmu.com,connectmu,connecting mumbai university">
        <meta name="author" content="Shahid Shaikh">
        <script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.onepage-scroll.js"></script>
        <link href="css/homestyle.css" rel="stylesheet" type="text/css">
        <link href="css/socialbutton.css" rel="stylesheet" type="text/css">
		<link href="css/onepage-scroll.css" rel="stylesheet" type="text/css">
        <script>
            $(document).ready(function () {
                $("#registerform").hide();
                $("#regbutton2").hide();
                $("#loginbutton2").hide();
                $(".main").onepage_scroll({
                    sectionContainer: "section",
                    responsiveFallback: 800
                });
                $("#regbutton").click(function () {
                    $("#loginform").hide();
                    $("#loginbutton").hide();
                    $("#recover").hide();
                    $("#lead-to-reg").hide();
                    $("#registerform").slideToggle(function () {
                        $("#regbutton").hide();
                        $("#regbutton2").show();
                        $("#loginbutton2").show();

                    });
                });
                $("#regbutton2").click(function () {
                    var name = $("#fname").val() + $("#lname").val();
                    var email = $("#email_reg").val();
                    var pass = $("#pass").val();
                    var error_bit = null;
                    var pass_verify = $("#pass_verify").val();
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if (name == "" || email == "" || pass == "" || pass_verify == "") {
                        alert("Fields are empty !");
                        error_bit = false;
                    }
                    else if (pass != pass_verify) {
                        alert("Password do not match");
                        error_bit = false;
                    }
                    if (!emailReg.test(email)) {
                        error_bit = false;
                    }

                    var day = $("#day").val().concat('-');

                    var month = $("#month").val().concat('-');
                    var year = $("#year").val();
                    var dob = day + month + year;

                    var gender = $("#gender").val();
                    if (error_bit == null) {
                        $.post("register.php", { name: name, email: email, gender: gender, dob: dob, pass: pass }, function (data) {
                            if (data.yes == 1) {
                                location.href = "checkpoint.php";
                            }
                            else {
                                alert("Email already in use !");
                            }
                        });
                    }
                    else if (error_bit == false) {
                        alert("Please Check Again ! Something is wrong !");
                    }

                });
                $("#loginbutton2").click(function () {
                    $("#registerform").hide();
                    $("#regbutton2").hide();
                    $("#loginform").show();
                    $("#regbutton").show();
                    $("#loginbutton2").hide();
                    $("#loginbutton").show();
                    $("#recover").show();
                    $("#lead-to-reg").show();
                });
                $("#loginbutton").click(function () {
                    var email = $("#login_email").val();
                    var pass = $("#login_password").val();
                    $.post("login_user.php", { email: email, pass: pass }, function (data) {
                        if (data.yes == 1) {
                            location.href = "home.php";
                        }
                        else {
                            alert("Credential is wrong !");
                        }
                    });
                });
                $("#c_button").click(function () {
                    var error = 0;
                    var name = $("#c_name").val();
                    var email = $("#c_email").val();
                    var msg = $("#c_message").val();
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if (name == "" || email == "" || msg == "") {
                        error = 1;
                    }
                    if ($.isNumeric(name)) {
                        error = 2;
                    }
                    if (!emailReg.test(email)) {
                        error = 3;
                    }
                    if (error == 0) {
                         $("#notice").empty().html('<img src="content/icon/loading.gif" height="80px" width="80px">').show();
                        $.post("send_email.php", { name: name, email: email, msg: msg }, function (data) { 
                        if(data.yes==1)
                        {
                             $("#notice").empty().html('Email is Sent ! Thank you for contacting us.').show();
                        }
                        });
                    }
                    else if(error==1)
                    {
                          $("#notice").empty().html('Either all or some fields are blank.').show();
                    }
                    else if(error==2)
                    {
                          $("#notice").empty().html('Name should not contain number').show();
                    }
                    else if(error==3)
                    {
                          $("#notice").empty().html('Email is not valid').show();
                    }
                });
            });
        </script>
        </head>
    <body>
        <div class="main">
            <section id="login-register">
            <div id="login">
             <div id="upperbar">
<center><p style="font-size:55px;font-family:Segoe UI;color:#0184cd;">Connectmu</p><span style="margin-left:120px;font-size:16px;font-family:Segoe UI;color:#0184cd;">...Connecting Mumbai University</span></center>
</div>
<div id="bodycontent">
<div id="logo"><div id="lightbox">
<img src="content/logo.png" alt="Logo of Connectmu">
</div>
    <div style="margin-left: -350px;margin-top: 50px;"><img src="content/icon/scrolldownblue.png"></div>
</div>
<div id="line"><div id="register">

<div id="buttoncollection" style="padding:5px;">

<fieldset id="registerform">
      <div class="social-wrap a">
       
    <button id="facebook"><a href="?signup&oauth_provider=fb">Sign up using Facebook</a></button>
    <button id="googleplus"><a href="?signup&oauth_provider=gplus">Sign up using Google</a></button>
     </div>
    <span  style="font-family: 'Segoe UI';font-size: 16px;color: #f00;">Don't have above account ? Try filling form.</span>
<input type="text"  id="fname" style="width:320px;height:25px;padding:5px;border:1px solid #0184cd;" placeholder="Type in your First Name e.g: Shahid">
<input type="text"  id="lname" style="width:320px;height:25px;padding:5px;border:1px solid #0184cd;margin-top:5px;" placeholder="Type in your Last Name e.g: Shaikh">
<input type="email"  id="email_reg" style="width:320px;height:25px;padding:5px;border:1px solid #0184cd;margin-top:5px;" placeholder="Your in your Email e.g: abc@xyz.com">
<input type="password"  id="pass" style="width:320px;height:25px;padding:5px;border:1px solid #0184cd;margin-top:5px;" placeholder="Type Your Password">
<input type="password"  id="pass_verify" style="width:320px;height:25px;padding:5px;border:1px solid #0184cd;margin-top:5px;" placeholder="Type Password Again">
	<span style="font-family: 'Segoe UI';font-size: 16px;">Birthday:</span></span>
    <select id="day" style="margin-top:5px;">
	<option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
	<option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option>
	<option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
	<option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>
	<option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
	<option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option>
	<option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option>
	<option value="29">29</option><option value="30">30</option><option value="31">31</option>
	</select>
	<select id="month" style="margin-top:5px;">
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
	</select>
	<select id="year" style="margin-top:5px;">
	<?php
	for($x=1900;$x<2001;$x++)
	{
		echo "<option value='$x'>$x</option>";
	}
	?>
	</select><br><span style="font-family: 'Segoe UI';font-size: 16px;">Gender:</span>
	<select id="gender">
	<option value="male">Male</option>
	<option value="female">Female</option>
	<option value="other">Other</option>
	</select>
    &nbsp;
    <a href="#" class="button1" id="regbutton2">Register</a>

    <span style="font-family: 'Segoe UI'">Already have an account?</span><a href="#" id="loginbutton2" style="font-family: 'Segoe UI';text-decoration: none;color: #2672EC;cursor: pointer;">Log in here</a>
</fieldset>
<fieldset id="loginform">
<input type="text"  id="login_email" style="width:320px;height:25px;padding:5px;border:1px solid #0184cd;font-size:16px;" placeholder="Type Email">
<input type="password"  id="login_password" style="width:320px;height:25px;padding:5px;border:1px solid #0184cd;margin-top:13px;font-size: 16px;" placeholder="Type Your Password">
</fieldset><br /><a href="#" class="button1" id="loginbutton">Login&nbsp;&nbsp;</a><br><br><br><br>
    <a href="recovery/" style="font-family:'Segoe UI'; inherit;text-decoration: none;color: #2672EC;cursor: pointer;" id="recover">Can't access your account ?</a><br>
<br><span style="font-family: 'Segoe UI'" id="lead-to-reg">Don't have a Connectmu Account?</span><p></p><a href="#" id="regbutton" style="font-family: 'Segoe UI';
    font-weight: inherit;text-decoration: none;color: #2672EC;cursor: pointer;">Sign up now</a></p>
</div>
</div></div>
</div>
            </div>
            </section>
            <section id="for-you">
                <div>
                   <span style="font-family: 'Segoe UI';font-size: 40px;color: #211d1d">Connectmu for Students</span><br>
                    <span>
                        <p style="font-family: 'Segoe UI';font-size: 16px;">Connectmu is an online social and education network for Mumbai University. By using Connectmu student can share the resources like notes,ebooks to their college or their branch and connect to other domino of different college.</p><br>
                        <p style="font-family: 'Segoe UI';font-size: 28px;color: #c21825;">What is the difference between us and social network sites ?</p><br>
                        <p style="font-family: 'Segoe UI';font-size: 16px;">In order to reach the information to you , other social media sites have dependncy on <b>people</b> where as Connectmu finds and display the correct information to you if it was intended for you <b>automatically.</b><br>
                            <img src="content/doc/for-stud.png" height="400px" style="margin-left: 300px;">
                    </span>
                </div>
            </section>
            <section id="for-teachers">
                <div>
                    <span style="font-family: 'Segoe UI';font-size: 40px;color: #211d1d">Connectmu for Teachers</span><br>
                    <span style="font-family: 'Segoe UI';font-size: 16px;">
                        Teacher's can use Connectmu to connect to Students and teachers of different facilities and share the Notes, docs or Jobs information and if it match to student profile it will be syndicated to them automatically.
                    </span>
                    <br>
                    <img src="content/doc/for-teacher.png" height="400px" style="margin-left: 300px;">
                </div>
             </section>
            <section id="for-alumni">
                   <div>
                    <span style="font-family: 'Segoe UI';font-size: 40px;color: #211d1d">Connectmu for Alumnus</span><br>
                    <span style="font-family: 'Segoe UI';font-size: 16px;">
                        Alumnus of different colleges in Mumbai University can use it to share the resources they have for the students who are currently in college. Some special feature like <b>"My College"</b> and <b>"Finder"</b> is developed by keeping the alumnus requiremnet in mind.Join to explore more.
                    </span>
                    <br>
                    <img src="content/doc/for-alumnus.png"  style="margin-left: 200px;">
                </div>
            </section>
            <section id="about">
               <div id="contact-form" style="margin-left: 100px;margin-top: 50px;position: absolute;">
                   <span><h1 style="font-family: 'Segoe UI';font-size: 28px;">Contact Us:</h1></span>
                   <input type="text" id="c_name" size="30" style="font-family: 'Segoe UI';font-size: 18px;" placeholder="Please Type your Name"><br><br>
                   <input type="email" id="c_email" size="30" style="font-family: 'Segoe UI';font-size: 18px;" placeholder="Please Type your Email"><br><br>
                   <textarea id="c_message" rows="10" cols="31" style="font-family: 'Segoe UI';font-size: 18px;" placeholder="Type your Message"></textarea><br>
                   <a href="#" class="button1" id="c_button">Send Email</a><br>
                   <span id="notice" style="font-family: 'Segoe UI';font-size: 16px;margin-left: 100px;"></span>
               </div>
                <div id="our-team" style="position: absolute;margin-left: 600px;margin-top: 90px;">
                    <span>
                        <img src="content/team/shahid.jpg" height="150" width="150">
                    </span>
                    <div style="margin-top: -160px;margin-left: 180px;">
                        <h3 style="font-family: 'Segoe UI';font-size: 18px;font-weight: 100;">Shahid Shaikh</h3><br>
                        <p style="font-family: 'Segoe UI';font-size: 16px;">Creator of connectmu.com.<p><p style="font-family: 'Segoe UI';font-size: 16px;"> Student, Blogger and Developer from Mumbai.</p>
                        <p style="font-family: 'Segoe UI';font-size: 16px;">Contact him at:</p>
                        <span><a href="http://facebook.com/s2v92"><img src="content/icon/contact/fb.png" height="40" width="50"></a><a href="https://twitter.com/thekoding"><img src="content/icon/contact/twitter.png" height="40" width="50"></a><a href="http://in.linkedin.com/in/skshahid"><img src="content/icon/contact/linkedin.png" height="40" width="50"></a><a href="https://www.youtube.com/user/koding4u"><img src="content/icon/contact/youtube.png" height="40" width="50"></a><a href="mailto:shahid@koding.info"><img src="content/icon/contact/email.png" height="40" width="50"></a></span>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
