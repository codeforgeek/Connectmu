<?php
		include("dbconfig.php");
		function getuserid($email)
		{
			$c = connect_to_db();
			mysql_select_db("connectmu", $c);
			$q = mysql_query("select user_id FROM user_info WHERE email='$email'");
			$data = mysql_fetch_row($q);
			$id = $data[0];	
			return $id;
		}
		function connect_to_db()
		{
			include("dbconfig.php");
			$con = mysql_connect($host, $username, $password);
			return $con;
		}
        function getstreamofuser($stream)
        {
            $c=connect_to_db();
            mysql_select_db("connectmu",$c);
            $q=mysql_query("select branch_id from branch where branch_name='$stream'");
            $res=mysql_fetch_row($q);
            return $res[0];
        }
		function return_user_type($type)
		{
			switch($type)
			{
				case 'student':
								return 0;
								break;
				case 'teacher':	
								return 1;
								break;
				case 'alumni':
								return 2;
								break;
			}
		}
        function return_user_type_2($type)
		{
			switch($type)
			{
				case 0:
								return 'student';
								break;
				case 1:	
								return 'Teacher';
								break;
				case 2:
								return 'Alumni';
								break;
			}
		}
		function get_name_of_user($email)
		{
				include("dbconfig.php");
				$con = connect_to_db();
				$q = mysql_query("select name FROM user_info WHERE email='$email'");
				$data = mysql_fetch_row($q);
				$name = $data[0];	
				return $name;
		}	
		function getusertype($email)
		{
			$id = getuserid($email);
			$c = connect_to_db();
			$q = mysql_query("select type FROM user_type WHERE user_id='$id'");
			$data = mysql_fetch_row($q);
			$user_type = $data[0];	
			return $user_type;
		}
		function selfURL() {
			$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
			$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
			$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
			return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
	}
	function strleft($s1, $s2) {
		return substr($s1, 0, strpos($s1, $s2));
	}
	function getuseridfromurl($url)
	{	
		$postid;
		$postid=parse_url($url, PHP_URL_QUERY); //Fetch the Query if any
		$postid=substr($postid,3);
		return $postid;
	}
	function getemail($id)
	{
		$con = connect_to_db();
		$db = mysql_select_db("connectmu", $con);
		$query = mysql_query("select email FROM user_info WHERE user_id='$id'");
		$res = mysql_fetch_row($query);
		return $res[0];
	}
	function checkidexist($id)
    {
        $con = connect_to_db();
		$db = mysql_select_db("connectmu", $con);
        $query=mysql_query("select * from user_info where user_id='$id'");
        if(mysql_num_rows($query)==1)
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
	function getcollegeofuser($id)
	{
		$con = connect_to_db();
		$db = mysql_select_db("connectmu", $con);
		$query = mysql_query("select college FROM user_type WHERE user_id='$id'");
		if(mysql_num_rows($query) > 0)
		{
			$d = mysql_fetch_row($query);
			return $d[0];
		}
		else
		{
			return false;
		}
	}
    function getbranchofuser($id)
    {
		$con = connect_to_db();
		$db = mysql_select_db("connectmu", $con);
        $q=mysql_query("select stream from user_type where user_id='$id'");
        if(mysql_num_rows($q) > 0)
		{
			$d = mysql_fetch_row($q);
			return $d[0];
		}
		else
		{
			return false;
		}
    }
	function  getuserpublicinfo($id)
	{
		$con = connect_to_db();
		$db = mysql_select_db("connectmu", $con);
		$query = mysql_query("select user_id,name,gender FROM user_info WHERE user_id='$id'");
		return mysql_fetch_array($query);
	}
	function validate_email($email)
	{
			if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
  			{
  					return false;
  			}
			else
			{
					return true;
			}
	}
	function validate_password($password)
	{
			//case 1: check for lenght , not more than 12 char
		if(strlen($password) <=12)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
     function getExtension($str) 
    {
         $i = strrpos($str,".");
         if (!$i) 
		 {
			return ""; 
		}
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
    }
    function getprofilepic($id)
    {
        $con=connect_to_db();
        $db=mysql_select_db("connectmu",$con);
        $q=mysql_query("select profile_pic from user_detail where user_id='$id'");
        $def="content/icon/default_profile_picture.png";
        if(mysql_num_rows($q)==1)
        {
            $res=mysql_fetch_array($q);
            return($res['profile_pic']);
        }
        else
        {
            return $def;
        }
    }
    function check_exist_mail($email)
    {
         $con=connect_to_db();
         $db=mysql_select_db("connectmu",$con);
         $q=mysql_query("select * from user_info where email='$email'");
         if(mysql_num_rows($q)>0)
         {
             return FALSE;
         }
         else
         {
             return TRUE;
         }
    }
?>