<?php
include("core-function.php");
session_start();
$id = getuserid($_SESSION['email']);
if (!file_exists('uploads/'.$id)) {
    mkdir('uploads/'.$id, 0777, true);
}
$output_dir = "uploads/".$id."/";
if(isset($_FILES["myfile"]))
{
	$ret = array();

	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];
 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
    	$ret= $output_dir.$fileName;
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
	  $ret[]= $output_dir.$fileName;
	  }
	
	}
    echo json_encode($ret);
 }
 ?>