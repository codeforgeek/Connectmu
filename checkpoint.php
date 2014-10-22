<?php
    include("core-function.php");
session_start();
if(!isset($_SESSION['email']))
{
		header("location:login.php");
}
?>
<html>
<head><title>Checkpoint : Complete your Registration</title>
<script src="js/jquery.js" type="text/javascript"></script>
 <link href="checkpoint.css" rel="stylesheet" type="text/css">
<script>
    function nextstep(t, s, c, y) {
          $.post("update-college-details.php", { t: t, s: s, c: c, y: y }, function (data) {
            document.write(data);
         });
    }
    $(document).ready(function () {
        $("#engineering").hide();
        $("#sac").hide();
        $("#sc").hide();
        $("#science").hide();
        $("#bsch").hide();
        $("#management").hide();
        $("#law").hide();
        $("#pharmacy").hide();
        $("#ns").hide();
        $("#shipping").hide();
        $("#aviation").hide();
        $("#artsonly").hide();
        $("#bed").hide();
        $("#decce").hide();
        $("#physicalbed").hide();
        $("#mca").hide();
        $("#year_of_passing").hide();
        var type = null;
        var college_name = null;
        var valueSelected = null;
        var year_of_passing = null;
        $("#college").hide();
        $("#user_type").click(function () {
            type = $('input:radio[name=type]:checked').val();
            if (type == null) {
                $("#error").text("Please choose something");
            }
            else {
                $("#usertype").hide();
                $("#college").show();
                if (type == 'alumni') {
                    $("#year_of_passing").show();
                }
            }
        });
        $('#stream').change(function () {
            var optionSelected = $(this).find("option:selected");
            valueSelected = optionSelected.val();
            switch (valueSelected) {
                case 'engineering':
                    $("#engineering").show();
                    $("#sac").hide();
                    $("#sc").hide();
                    $("#science").hide();
                    $("#bsch").hide();
                    $("#management").hide();
                    $("#law").hide();
                    $("#pharmacy").hide();
                    $("#ns").hide();
                    $("#shipping").hide();
                    $("#aviation").hide();
                    $("#artsonly").hide();
                    $("#bed").hide();
                    $("#decce").hide();
                    $("#physicalbed").hide();
                    $("#mca").hide();
                    break;
                case 'asc':
                    $("#engineering").hide();
                    $("#sac").show();
                    $("#sc").hide();
                    $("#science").hide();
                    $("#bsch").hide();
                    $("#management").hide();
                    $("#law").hide();
                    $("#pharmacy").hide();
                    $("#ns").hide();
                    $("#shipping").hide();
                    $("#aviation").hide();
                    $("#artsonly").hide();
                    $("#bed").hide();
                    $("#decce").hide();
                    $("#physicalbed").hide();
                    $("#mca").hide();
                    break;
                case 'sc':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").show();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 's':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").show();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'hm':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").show();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'm':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").show();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'law':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").show();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'pharmacy':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").show();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'marine':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").show();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'shipping':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").show();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'aviation':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").show();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'arts':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").show();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'bed':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").show();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                    }
                case 'special':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").show();
                        $("#physicalbed").hide();
                        $("#mca").hide();
                        break;
                    }
                case 'physical':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").show();
                        $("#mca").hide();
                        break;
                    }
                case 'mca':
                    {
                        $("#engineering").hide();
                        $("#sac").hide();
                        $("#sc").hide();
                        $("#science").hide();
                        $("#bsch").hide();
                        $("#management").hide();
                        $("#law").hide();
                        $("#pharmacy").hide();
                        $("#ns").hide();
                        $("#shipping").hide();
                        $("#aviation").hide();
                        $("#artsonly").hide();
                        $("#bed").hide();
                        $("#decce").hide();
                        $("#physicalbed").hide();
                        $("#mca").show();
                        break;
                    }

            }
        });
        $("#year_of_passing").change(function () {
            var optionSelected = $(this).find("option:selected");
            year_of_passing = optionSelected.val();
        });

        $("#final_setup").click(function () {
            var st = $("#stream").val();
            switch (st) {
                case 'engineering':
                    {
                        var eng = $("#engineering").val();
                        nextstep(type, "engineering", eng, year_of_passing);
                        break;
                    }
                case 'asc':
                    {
                        var asc = $("#sac").val();
                        nextstep(type,"Arts,Science,Commerce", asc,year_of_passing);
                        break;
                    }
                case 'sc':
                    {
                        var sc = $("#sc").val();
                        nextstep(type,"Science and Commerce",sc, year_of_passing);
                        break;
                    }
                case 's':
                    {
                        var s = $("#science").val();
                        nextstep(type,"Science", s,year_of_passing);
                        break;
                    }
                case 'hm':
                    {
                        var hm = $("#bsch").val();
                        nextstep(type,"Hotel Management", hm,year_of_passing);
                        break;
                    }
                case 'm':
                    {
                        var m = $("#management").val();
                        nextstep(type,"Management",m, year_of_passing);
                        break;
                    }
                case 'law':
                    {
                        var lc = $("#law").val();
                        nextstep(type,"Law", lc,year_of_passing);
                        break;
                    }
                case 'pharmacy':
                    {
                        var ph = $("#pharmacy").val();
                        nextstep(type,"Pharmacy",ph,year_of_passing);
                        break;
                    }
                case 'marine':
                    {
                        var m = $("#ns").val();
                        nextstep(type,"Marine",m, year_of_passing);
                        break;
                    }
                case 'shipping':
                    {
                        var sp = $("#shipping").val();
                        nextstep(type,"Shipping",sp, year_of_passing);
                        break;
                    }
                case 'arts':
                    {
                        var ao = $("#artsonly").val();
                        nextstep(type,"Arts",ao,year_of_passing);
                        break;
                    }
                case 'bed':
                    {
                        var bd = $("#decce").val();
                        nextstep(type,"BED", bd,year_of_passing);
                        break;
                    }
                case 'mca':
                    {
                        var m = $("#mca").val();
                        nextstep(type,"MCA",m, year_of_passing);
                        break;
                    }
            }

        });
    });
</script>
</head>
<body>
<div id="container">
<div id="usertype">
<h1>Tell us what are you ?</h1>
<input type="radio" name="type" value="student">Student
<input type ="radio" name="type" value="teacher">Teacher
<input type ="radio" name="type" value="alumni">Alumni
<input type ="button" id="user_type" value="Next"><br>
<span id="error" style="color: red;"></span>
</div>
<div id="college">
<select id="year_of_passing">
    <option value="2014">2008</option>
<option value="2015">2009</option>
    <option value="2014">2010</option>
<option value="2015">2011</option>
    <option value="2014">2012</option>
<option value="2015">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
</select><br>
<select id="stream">
<option value="dummy">SELECT YOUR STREAM</option>
<option value="engineering">Engineering</option>
<option value="asc">Arts,Science,commerce</option>
<option value="sc">Science and Commerce</option>
<option value="s">Science</option>
<option value="hm">Hotel Management</option>
<option value="m">Management</option>
<option value="law">Law</option>
<option value="pharmacy">Pharmacy</option>
<option value="marine">Marine</option>
<option value="shipping">Shipping</option>
<option value="arts">Arts</option>
<option value="bed">BED</option>
<option value="mca">MCA</option>
</select><br><br><br>

<select id="engineering">
    <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='18'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>

<select id="sac">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='19'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>

</select>

<select id="sc">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='20'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>

</select>

<select id="science">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='21'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>


<select id="bsch">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='22'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>                                                                                                                                                                                                                     
<select id="management">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='23'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>
<select id="law">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='24'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>
<select id="pharmacy">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='25'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>                                                                                                                                                                                                                                                   
<select id="ns">

   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='26'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>


<select id="shipping">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='27'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>


<select id="artsonly">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='29'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>
                                                                                                                                                                                                                                                            
<select id="bed">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='30'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>
                                                                                                                                                                                     
<select id="decce">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='31'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>

<select id="mca">
   <?php
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $query=mysql_query("select * from college where branch_id='33'");
        while($res=mysql_fetch_array($query))
        {
            echo '<option value="'.$res['college_name'].'">'.$res['college_name'].'</option>';
        }
    ?>
</select>
    <input type="button" value="Complete the Setup" id="final_setup">
</div>
</div>
</body>
</html>