<?php
include("core-function.php");
session_start();
if(isset($_POST['kw']) && $_POST['kw'] != '')
{
  $c = connect_to_db();
  $db = mysql_select_db("connectmu", $c);
  $kws = $_POST['kw'];
  $kws = mysql_real_escape_string($kws); 
  $q="SELECT * FROM user_info WHERE name like '%".$kws."%'";
  $res = mysql_query($q);
  $count = mysql_num_rows($res);
  $i = 0;
  
  if($count > 0)
  {
    echo "<ul>";
    while($row = mysql_fetch_array($res))
	{
	  echo "<div id='rest'>";
      $pic=getprofilepic($row['user_id']);
      echo '<span><img src="'.$pic.'" width="50px" height="50px">'.'<a href="profile.php?id='.$row['user_id'].'">'.$row['name'].'</a></span>';
	  echo "<br />";
	  //echo "<div style='clear:both;'></div></li></a>";
	  $i++;
	  if($i == 5) break;
	}
	echo "</ul>";
	if($count > 5)
	{
	  echo "<div id='view_more'><a href='#'>View more results</a></div>";
	}
  }
  else
  {
    echo "<div id='no_result'>No result found !</div>";
  }
}
?>
