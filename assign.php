<!DOCTYPE html>
<?php 
error_reporting(0);
  include("checksess.php");
  $auth=$_SESSION['auth'];
  if ($auth!='a'){
    echo "<script>alert('Invalid Access');window.location.href = 'home.php';</script>";
  }
?>
<html lang="en">
<head>
<?php
include("dbconnection.php");

if(isset($_POST["sub"])){
  $query="select * from assign where teacherID='".$_REQUEST["tecID"]."' and studentID='".$_REQUEST["stuID"]."'";
  $rs = mysqli_query($con,$query);
  if(mysqli_num_rows($rs)>0)
  {
    echo "<script>alert('Already Exist, Try Different');</script>";
  }
  else
  {
    $query="insert into assign(teacherID,studentid) values('".$_REQUEST["tecID"]."','".$_REQUEST["stuID"]."')";
  $resultlogin = mysqli_query($con,$query);
  $query="update studentprofile set active=0 where userid='".$_REQUEST["stuID"]."'";
  $resultlogin = mysqli_query($con,$query);
    $query="select * from projectconfig where teacherID='".$_REQUEST["tecID"]."' and studentid='".$_REQUEST["stuID"]."'";
    $resultlogin = mysqli_query($con,$query);
    if(mysqli_num_rows($rs)<1)
    {
      $query1="select * from projectdetail where teacherID='".$_REQUEST["tecID"]."'";
      echo "<script>alert('".$query1."');</script>";
      $rs1 = mysqli_query($con,$query1);
      if(mysqli_num_rows($rs1)>0){
        while($data1=mysqli_fetch_array($rs1))
          {
            $query="insert into projectconfig values('".$data1["projectID"]."','".$_REQUEST["tecID"]."','".$_REQUEST["stuID"]."',0)";
            $resultlogin = mysqli_query($con,$query);
        }
      }
      }
      
    }
  }

  if(isset($_POST["delbtn"])){
    $query="update studentprofile set active=1 where userid='".$_POST["uid"]."'";
    $resultlogin = mysqli_query($con,$query);
    echo "<script>alert('Assignment Removed');</script>";    
    $query="delete from assign where studentid='".$_POST["uid"]."'";
    $resultlogin = mysqli_query($con,$query);
    $query="delete from projectconfig where studentid='".$_POST["uid"]."'";
    $resultlogin = mysqli_query($con,$query);
    $query="delete from tskattch where studentid='".$_POST["uid"]."'";
    $resultlogin = mysqli_query($con,$query);
  }
?>
  <title>Assign Students</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <style type="text/css">
    table button
  {
    height:40px;
    width: 180px;
    text-align: center;
    border :none;
    outline: none;
    border : 2px solid black;
    border-radius: 15px;
    margin-left: 30%;
  }
</style>
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
           <li><a href="">View teacher</a></li>
         
        </ul>
      </li>
      <li class="active"><a href="assign.php">Assign </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      
      <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<form method="post" name="assn">
      <div class="container">      
  <table class="table table-hover table-bordered table-condensed">
    <thead>
      <tr style="width:30%">
        <th style="width:12%">Select Teacher name</th>
        <th style="width:12%">Select Student name</th>
        <th style="width:12%">&nbsp;</th>
      </tr>
    </thead>
<tbody>
      <tr>
        <td>
        <select id="tecID" name="tecID" onchange="document.assn.submit();">
<option value=0>Select Teacher</option>
          <?php
            $record=mysqli_query($con,"SELECT * FROM `studentprofile` where extra1='t'");
            while($data=mysqli_fetch_array($record))
            {
          ?>
          <option value='<?php echo $data['UserID'];?>' <?php if($data['UserID']==$_POST["tecID"]) { echo "selected"; } ?> > <?php echo $data['FirstName'];?>&nbsp;<?php echo $data['Last'];?></option>
          <?php
            }
          ?>
        </select>
      </td>
        <td>
        <select id="stuID" name="stuID">
          <?php
		if(isset($_POST["tecID"])){
		
            $record=mysqli_query($con,"SELECT * FROM `studentprofile` where active=1 and extra1='s' and department=(select department from studentprofile where userid='".$_POST["tecID"]."')");
            while($data=mysqli_fetch_array($record))
            {
          ?>
          <option value=<?php echo $data['UserID'];?>><?php echo $data['FirstName'];?>&nbsp;<?php echo $data['Last'];?></option>
          <?php
            }
	}
          ?>
        </select>
      </td>
       
      </tr>
      <tr>
    <td colspan="3" align="center">
      <input type="SUBMIT" id="sub" name="sub" value="Assign">
    </td>
    </tr>
   </table>
<table class="table table-hover table-bordered table-condensed">
        <tr>
        <th align="center">&nbsp;</th>
        <th align="center">Teachers Name</th>
        <th align="center">Students Name</th>
      </tr>
      <?php

      $record=mysqli_query($con,"SELECT DISTINCT(a.teacherID),b.firstname,b.last from assign a,studentprofile b WHERE a.teacherID=b.userID");
      while($data=mysqli_fetch_array($record)){

        $rec=mysqli_query($con,"SELECT a.studentID,b.firstname,b.last from assign a,studentprofile b WHERE a.studentID=b.userID and a.teacherID='".$data["teacherID"]."'");
      ?>
      <tr>
      <td rowspan=<?php echo mysqli_num_rows($rec)?>>&nbsp;</td>
      <td rowspan=<?php echo mysqli_num_rows($rec)?>><?php echo $data['firstname']." ".$data['last']; ?></td>
      <?php 
        while($data1=mysqli_fetch_array($rec)){
        ?>
      <td><?php echo $data1['firstname']." ".$data1['last']; ?></td>
      <td><input type="submit" name="delbtn" value="Delete" onclick="document.assn.uid.value='<?php echo($data1['studentID'])?>';document.assn.submit();"></td>
      <?php
      if (mysqli_num_rows($rec)>1) {
        ?>
        <tr>
          <?php
      }
      }
      ?>
            
      <?php
      }
      ?>
</table>
<input type="hidden" name="uid" id="uid">
</form>

</body>
</html>
