<!DOCTYPE html>
<?php 
error_reporting(0);
include('checksess.php');
$auth=$_SESSION['auth'];
  if ($auth!='a'){
    echo "<script>alert('Invalid Access');window.location.href = 'Logout.php';</script>";
  }
  include("dbconnection.php");
  if($_POST['uid']!="")
  {
    $query="select * from `assign` where teacherID='".$_POST["uid"]."'";
    $rs = mysqli_query($con,$query);
    while($data=mysqli_fetch_array($rs))
	{
		$query="update studentprofile set Active=1 where userid='".$data["studentID"]."'";
    	$rs = mysqli_query($con,$query);
	}

    $query="delete from `projectconfig` where teacherID='".$_POST["uid"]."'";
    $rs = mysqli_query($con,$query);
    $query="delete from `projectdetail` where teacherID='".$_POST["uid"]."'";
    $rs = mysqli_query($con,$query);
    $query="delete from `assign` where teacherID='".$_POST["uid"]."'";
    $rs = mysqli_query($con,$query);
    $query="delete from `studentprofile` where userid='".$_POST["uid"]."'";
    $rs = mysqli_query($con,$query);
    $query="DELETE FROM `userloginfor` WHERE `username`='".$_POST["uid"]."'";
    $rs = mysqli_query($con,$query);
    $rs = mysqli_query($con,"DELETE FROM `assign` WHERE `teacherID`='".$_POST["uid"]."'");
    echo "<script>alert('The record is deleted completely');</script>";
    
  }
?>
<html lang="en">
<head>
  <title>Admin home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  </head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Welcome Admin</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="adHome.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Student <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="student_regi.php">Add student</a></li>
          <li><a href="viewstu.php">View student</a></li>
                 </ul>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Teacher <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="teacher_regi.php">Add teacher</a></li>
           <li class="active"><a href="viewtecher.php">View teacher</a></li>
          
        </ul>
      </li>
      <li><a href="assign.php">Assign </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      
      <li><a href="Login_v3/index.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
</li>
</ul>
</div>
</nav>
<form name="tectb" method="post">
  <input type="hidden" name="eid" id="eid">
<input type="hidden" name="uid" id="uid">
<table border="2">
	<tr>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Gender</th>
		<th>Department</th>
		<th>Designation</th>
		<th>Mobile number</th>
		<th>Salary</th>
    <th>UserID</th>
    <th colspan="2">Action</th>
		

	</tr>


<?php

$record=mysqli_query($con,"SELECT * FROM `studentprofile` where extra1='t'");
while($data=mysqli_fetch_array($record))
{
	?>
	<tr>
		<td><?php echo $data['FirstName'];?></td>
		<td><?php echo $data['Last'];?></td>
		<td><?php echo $data['Gender'];?></td>
		<td><?php echo $data['Department'];?></td>
		<td><?php echo $data['extra2'];?></td>
		<td><?php echo $data['mobile'];?></td>
    <td><?php echo $data['Semester'];?></td>
    <td><?php echo $data['UserID'];?></td>
		<td><input type="button" id="tedit" name="tedit" value="Edit" onclick="document.tectb.eid.value='<?php echo($data['UserID'])?>';document.tectb.action='teacher_regi.php';document.tectb.submit();"></td>
    <td><input type="button" name="delbtn" value="Delete" onclick="document.tectb.uid.value='<?php echo($data['UserID'])?>';document.tectb.submit();"></td>
		</tr>
			<?php
		}
	?>
</table>

</form>
</body>
</html>