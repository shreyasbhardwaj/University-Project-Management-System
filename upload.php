<?php
$i = 0;
$j = 1;
include('checksess.php');
include("dbconnection.php");
$uid=$_SESSION["name"];
$pid=$_POST["pid"];
$fn="file".$pid;
echo "<pre>";
/*var_dump($_FILES);
exit;*/
foreach ($_FILES[$fn]['name'] as $key => $value) {
	//$query =array();
	if ($value != '') {

	
	$path ="assets/images/upload/";
	$fileName = $path.$value;
	$tmpName = $_FILES[$fn]['tmp_name'][$i];
	move_uploaded_file($tmpName, $fileName);
	$fileName1[] = $fileName;
	$query="insert into tskattch(projectid,studentid,atfilen) values('".$pid."','".$uid."','".$fileName."')";
	$resultlogin = mysqli_query($con,$query);
  	
}
	$j++;
	$i++;
	
}
	$query="update projectconfig SET status=(SELECT pot from projectdetail WHERE projectid=".$pid.") WHERE projectid=".$pid." and studentid='".$uid."'";
	$resultlogin = mysqli_query($con,$query);
echo "<script>window.location.href = 'viewtasklist.php';</script>";
?>