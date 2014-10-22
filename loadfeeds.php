<?php
include("core-function.php");
session_start();
if(!isset($_SESSION['email']))
{
	header("location:index.php");
}
$email = $_SESSION['email'];
$news_type = $_POST['news_option'];
$id = getuserid($email); //this is user id who is login 
$con = connect_to_db();
$db = mysql_select_db("connectmu", $con);
//make switch case here and according to the option selected show the feeds
switch($news_type)
{
	case 'uploads':
		{
			//First show updates from connection if any
			$query = mysql_query("select  distinct conn_id from connection where user_id='$id' and status=1"); //changes sttaus later
            $count_of_con=mysql_num_rows($query);
            $connection=array();
            if($count_of_con>0)
            {
                    while($res=mysql_fetch_array($query))
                    {
                        array_push($connection,$res['conn_id']);
                    }
            }
            $len=count($connection);
            for($i=0;$i<$len;$i++)
            {
                $q1 = mysql_query("select * FROM uploads WHERE user_id='$connection[$i]'");
                if(mysql_num_rows($q1)>0)
                {
                   while($res=mysql_fetch_array($q1))
                   {
                       $uid=$res['user_id'];
                       $info = getuserpublicinfo($uid);
                        echo '<div id="show_feed_info">';
						echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share a file with you:';
						echo '<hr>';
						echo '<b>File Name: </b>' . $res['title'].'<br>';
						echo '<b>Download Link:</b>' . '<a href="' . $res['upload_path'] . '">Download Here</a>';
						echo '</div>';
						echo '<br>';
                   }
                }
                $i++;
            }
            //Updates from connection is done 
  
			//Case 2: how uploads from college if any
			$c = getcollegeofuser($id);
			if($c != false)
			{
                $query=mysql_query("select * from uploads where college='$c' and user_id!='$id' and user_id not in (select distinct conn_id from connection where user_id='$id')");
                if(mysql_num_rows($query)>0)
                {
                   while($res=mysql_fetch_array($query))
                   {
                        $uid=$res['user_id'];
                        $info = getuserpublicinfo($uid);
                        echo '<div id="show_feed_info">';
						echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share a file with you:';
						echo '<hr>';
						echo '<b>File Name: </b>' . $res['title'].'<br>';
						echo '<b>Download Link:</b>' . '<a href="' . $res['upload_path'] . '">Download Here</a>';
						echo '</div>';
						echo '<br>';
                   }
                }
			}
			break;
		}
	case 'event':
		{
            $query = mysql_query("select  distinct conn_id from connection where user_id='$id' and status=1"); //changes sttaus later
            $count_of_con=mysql_num_rows($query);
            $connection=array();
            if($count_of_con>0)
            {
                    while($res=mysql_fetch_array($query))
                    {
                        array_push($connection,$res['conn_id']);
                    }
            }
            $len=count($connection);
            for($i=0;$i<$len;$i++)
            {
                $q1 = mysql_query("select * FROM festival WHERE user_id='$connection[$i]'");
                if(mysql_num_rows($q1)>0)
                {
                   while($res2=mysql_fetch_array($q1))
                   {
                       $uid=$res2['user_id'];
                       $info = getuserpublicinfo($uid);
                        echo '<div id="show_feed_info">';
						echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share an Event information:';
						echo '<hr>';
						echo '<b>Event Name: </b>' . $res2['title'].'<br>';
						echo '<b>Description:</b>'.$res2['description'].'<br>';
						echo '<b>Venue: </b>' . $res2['venue'].'<br>';
						echo '<b>Start Date </b>:' . $res2['startd'] . '  ' . '<b>End Date:</b> ' . $res2['endd'].'<br>';
						echo '</div>';
						echo '<br>';
                   }
                }
                $i++;
            }
            //Updates from connection is done 
            $c = getcollegeofuser($id);
            if($c != false)
			{
                $query=mysql_query("select * from festival where venue like '$c' and user_id!='$id' and user_id not in (select conn_id from connection where user_id='$id')");
                if(mysql_num_rows($query)>0)
                {
                   while($res2=mysql_fetch_array($query))
                   {
                        $uid=$res2['user_id'];
                        $info = getuserpublicinfo($uid);
                        echo '<div id="show_feed_info">';
						echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share an Event information:';
						echo '<hr>';
						echo '<b>Event Name: </b>' . $res2['title'].'<br>';
						echo '<b>Description:</b>'.$res2['description'].'<br>';
						echo '<b>Venue: </b>' . $res2['venue'].'<br>';
						echo '<b>Start Date </b>:' . $res2['startd'] . '  ' . '<b>End Date:</b> ' . $res2['endd'].'<br>';
						echo '</div>';
						echo '<br>';
                   }
                }
			}
            //get event update from branch
            $b=getbranchofuser($id);
            if($b!=FALSE)
            {
                 $query=mysql_query("select * from festival where branch like '$b' and user_id!='$id' and user_id not in (select conn_id from connection where user_id='$id')");
                 if(mysql_num_rows($query)>0)
                 {
                   while($res2=mysql_fetch_array($query))
                   {
                        $uid=$res2['user_id'];
                        $info = getuserpublicinfo($uid);
                        echo '<div id="show_feed_info">';
						echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share an Event information:';
						echo '<hr>';
						echo '<b>Event Name: </b>' . $res2['title'].'<br>';
						echo '<b>Description:</b>'.$res2['description'].'<br>';
						echo '<b>Venue: </b>' . $res2['venue'].'<br>';
						echo '<b>Start Date </b>:' . $res2['startd'] . '  ' . '<b>End Date:</b> ' . $res2['endd'].'<br>';
						echo '</div>';
						echo '<br>';
                   }
                }
            }
            //Branch update done
            $all="all";
            $query_all=mysql_query("select * from festival where branch='$all' and user_id!='$id' and user_id not in (select conn_id from connection where user_id='$id')");
            if(mysql_num_rows($query_all)>0)
            {
                  while($res2=mysql_fetch_array($query_all))
                   {
                        $uid=$res2['user_id'];
                        $info = getuserpublicinfo($uid);
                        echo '<div id="show_feed_info">';
						echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share an Event information:';
						echo '<hr>';
						echo '<b>Event Name: </b>' . $res2['title'].'<br>';
						echo '<b>Description:</b>'.$res2['description'].'<br>';
						echo '<b>Venue: </b>' . $res2['venue'].'<br>';
						echo '<b>Start Date </b>:' . $res2['startd'] . '  ' . '<b>End Date:</b> ' . $res2['endd'].'<br>';
						echo '</div>';
						echo '<br>';
                   }
            }
            break;
		}
    case 'job':
    {
        //look for user type, college, branch and go for the other stuff
        //if user is student, will see on campus detail first and college , then go for off campus
        //for alumni and teacher check off campus only
        $user_type=getusertype($_SESSION['email']);
        switch($user_type)
        {
            case 0:
                    {
                        //He is student, look for his college detail
                        $c=getcollegeofuser($id);
                        $stream=getbranchofuser($id);
                        $getstream=getstreamofuser($stream);
                        //check on campus detail
                        $con=connect_to_db();
                        $db=mysql_select_db("connectmu",$con);
                        $query=mysql_query("select * from job_oncampus where college='$c'");
                        if(mysql_num_rows($query)>0)
                        {
                            while($res2=mysql_fetch_array($query))
                            {
                                    $info = getuserpublicinfo($res2['user_id']);
						            echo '<div id="show_feed_info">';
						            echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share Job information:';
						            echo '<hr>';
						            echo '<b>Job title:</b> ' . $res2['title'].'<br>';
						            echo '<b>Description:</b>'.$res2['description'].'<br>';
						            echo '<b>Position :</b>' . $res2['position'].'<br>';
						            echo '<b>CTC :</b>'.$res2['CTC'];
						            echo '</div>';
						            echo '<br>';
                            }
                        }
                        //find some jobs in off campus table
                        $query_2=mysql_query("select * from job_offcampus where user_id!='$id' and branch='$getstream' and type_of_user=0");
                        if(mysql_num_rows($query_2)>0)
                        {
                            while($res2=mysql_fetch_array($query_2))
                            {
                                    $info = getuserpublicinfo($res2['user_id']);
						            echo '<div id="show_feed_info">';
						            echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share Job information:';
						            echo '<hr>';
						            echo '<b>Job title:</b> ' . $res2['title'].'<br>';
						            echo '<b>Description:</b>'.$res2['description'].'<br>';
                                    echo '<b>URL:</b>'.$res2['URL'].'<br>';
						            echo '<b>Position :</b>' . $res2['position'].'<br>';
						            echo '<b>CTC :</b>'.$res2['ctc'];
                                    echo '<b>Venue :</b>'.$res2['venue'];
						            echo '</div>';
						            echo '<br>';
                            }
                        }
                        break;
                    }
            case 1:
                    {
                        $con=connect_to_db();
                        $db=mysql_select_db("connectmu",$con);
                        $stream=getbranchofuser($id);
                        $getstream=getstreamofuser($stream);
                        $query_2=mysql_query("select * from job_offcampus where user_id!='$id' and branch='$stream' and type_of_user=1");
                        if(mysql_num_rows($query_2)>0)
                        {
                            while($res2=mysql_fetch_array($query_2))
                            {
                                    $info = getuserpublicinfo($res2['user_id']);
						            echo '<div id="show_feed_info">';
						            echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share Job information:';
						            echo '<hr>';
						            echo '<b>Job title: </b>' . $res2['title'].'<br>';
						            echo '<b>Description:</b>'.$res2['description'].'<br>';
                                    echo '<b>URL:</b>'.$res2['URL'].'<br>';
						            echo '<b>Position :</b>' . $res2['position'].'<br>';
						            echo '<b>CTC :</b>'.$res2['ctc'];
                                    echo '<b>Venue :</b>'.$res2['venue'];
						            echo '</div>';
						            echo '<br>';
                            }
                        }
                         break;
                    }
            case 2:
                    {
                        $con=connect_to_db();
                        $db=mysql_select_db("connectmu",$con);
                        $stream=getbranchofuser($id);
                        $getstream=getstreamofuser($stream);
                        $query_2=mysql_query("select * from job_offcampus where user_id!='$id' and branch='$stream' and type_of_user=2");
                        if(mysql_num_rows($query_2)>0)
                        {
                            while($res2=mysql_fetch_array($query_2))
                            {
                                    $info = getuserpublicinfo($res2['user_id']);
						            echo '<div id="show_feed_info">';
						            echo '<a href="profile.php?id='.$info['user_id'].'">'.$info['name'].'</a> Has Share Job information:';
						            echo '<hr>';
						            echo '<b>Job title:</b> ' . $res2['title'].'<br>';
						            echo '<b>Description:</b>'.$res2['description'].'<br>';
                                    echo '<b>URL:</b>'.$res2['URL'].'<br>';
						            echo '<b>Position :</b>' . $res2['position'].'<br>';
						            echo '<b>CTC :</b>'.$res2['ctc'];
                                    echo '<b>Venue :</b>'.$res2['venue'];
						            echo '</div>';
						            echo '<br>';
                            }
                        }
                        break;
                    }
        }
        break;
    }
}

?>
<html>
<head>
<style>
#show_feed_info
{
	width: 500px;
	height: auto;
	min-height: 120px;
	border: 1.5px solid gray;
    border-radius: 3px;
	font-family: "Segoe UI";
    padding: 9px;
}
#show_feed_info>a
{
    text-decoration: none;
    color: #0184cd;
}
#show_feed_info>a:hover
{
    text-decoration: none;
    color: orange;
}
#show_feed_info>b
    {
        color: #808080;
        font-size: 17px;
        font-family: Shruti;
        font-variant: normal;
    }
</style>
</head>
</html>
