<?php
include("dbconnection.php");
if(isset($_POST["stubtn"]))
	  {
		$auth="s";
		$rd="student_regi.php";
	  }
	  else
	  {
		$auth="t";
		$rd="teacher_regi.php";
	  }

if(EMPTY($_REQUEST["sid"]) || !preg_match('/^[a-zA-Z]*$/', $_REQUEST['fname']) || !preg_match('/^[a-zA-Z]*$/', $_REQUEST['fname']) || !preg_match('/^\d{10}$/', $_REQUEST['mno']))
{
	echo "<script>alert('Please complete the form properly.');
	window.location.href = '".$rd."'; </script>";
}
else
{
	if($_REQUEST["prs"]=="")
	{
		if($_REQUEST['passwd']==$_REQUEST['rpasswd']){
	$sid=$_REQUEST['sid'];
	$rs = mysqli_query($con,"SELECT * FROM userloginfor where username='$sid'");
		  if(mysqli_num_rows($rs)>0)
		  {
			echo "<script>alert('UserName Already Exist, Try Different UserName');window.location.href = '".$rd."'; </script>";
		  }
		  else
		  {
			  $query="insert into studentprofile values('".$_REQUEST["fname"]."','".$_REQUEST["lname"]."','".$_REQUEST["gender"]."','".$_REQUEST["saddress"]."','".$_REQUEST["stuimg"]."','".$_REQUEST["mno"]."','".$_REQUEST["fathername"]."','".$_REQUEST["sid"]."','".$_REQUEST["depart"]."','".$_REQUEST["sem"]."',1,'".$auth."','".$_REQUEST["desig"]."')";
			  $resultlogin = mysqli_query($con,$query);
			  $query="insert into userloginfor values('".$_REQUEST["sid"]."','".$_REQUEST["passwd"]."')";
			  $resultlogin = mysqli_query($con,$query);
			  echo "<script>alert('Record Updated.');window.location.href = '".$rd."'; </script>";
		  }
		}
		else{
			echo "<script>alert('password and confirm password should be same.');
			window.location.href = '".$rd."'; </script>";
		}

	}
	else{
		if($auth=="s")
			$rd="viewstu.php";
		else
			$rd="Viewteacher.php";
		$query="UPDATE `studentprofile` SET `FirstName`='".$_REQUEST["fname"]."',`Last`='".$_REQUEST["lname"]."',`Address`='".$_REQUEST["saddress"]."',`Photo`='".$_REQUEST["stuimg"]."',`mobile`='".$_REQUEST["mno"]."',`Father`='".$_REQUEST["fathername"]."',`Department`='".$_REQUEST["depart"]."',`Semester`='".$_REQUEST["sem"]."',`Active`=1,`extra2`='".$_REQUEST["desig"]."' WHERE `UserID`='".$_REQUEST["sid"]."'";
		  $resultlogin = mysqli_query($con,$query);
		  $query="UPDATE userloginfor set password='".$_REQUEST["passwd"]."' where username='".$_REQUEST["sid"]."'";
		  $resultlogin = mysqli_query($con,$query);
		  echo "<script>alert('Record Updated.');window.location.href = '".$rd."'; </script>";
	}
}

?>