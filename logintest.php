<?php
session_start();
error_reporting(0);
// die ("inside the page");
include("dbconnection.php");


$ud=$_POST["username"];
$ps=$_POST["pass"];


//var_dump("");

$rs = mysqli_query($con, "SELECT * FROM userloginfor where username='$ud' and password='$ps'");
  if(mysqli_num_rows($rs)>0)
  {
	  $_SESSION['id']=1;
	  $_SESSION['name']=$ud;

	  $rs = mysqli_query($con, "select FirstName,Last,extra1 from studentprofile where userid='$ud'");
		// print_r($rs);
		if(mysqli_num_rows($rs)>0)
		{
			while($data=mysqli_fetch_array($rs))
			{

				$_SESSION['nm']=$data["FirstName"]." ".$data["Last"];
			
				if ($data['extra1']=='a') {
					$_SESSION['auth']='a';
					echo "<script>alert('Login Success');window.location.href = 'adhome.php'; </script>";
				}
				elseif ($data['extra1']=='s'){
					echo "<script>alert('Login Success');window.location.href = 'studenthome.php'; </script>";
					$_SESSION['auth']='s';
				}
				else{
					echo "<script>alert('Login Success');window.location.href = 'teacherhome.php'; </script>";
					$_SESSION['auth']='t';
					}
				}
			}		
  }
  else
  {
	  echo "<script>alert('You have entered wrong Username/Password , try with right Username/Password');window.location.href = 'home.php';</script>";
  }
?>