<!DOCTYPE html>
<?php
error_reporting(0);
include('checksess.php');
$auth=$_SESSION['auth'];
  if ($auth!='s'){
    echo "<script>alert('Invalid Access');window.location.href = 'Logout.php';</script>";
  }

  $uid=$_SESSION["name"];
  include("dbconnection.php");

  $query="select sum(status) as status, sum(pot) as pot from `projectconfig` a, projectdetail b WHERE a.`projectid`=b.projectID and a.studentid='".$_SESSION["name"]."'";
  $rs=mysqli_query($con,$query);
  if(mysqli_num_rows($rs)>0)
    {
      while($data=mysqli_fetch_array($rs))
      {
        
        $nn=0;
        $qn="SELECT DISTINCT(a.projectID),b.pot FROM tskattch a,projectdetail b WHERE a.projectid=b.projectid and date(a.date)>date(b.lastdate) and a.studentid='".$_SESSION["name"]."'";
        $rs1=mysqli_query($con,$qn);
        if(mysqli_num_rows($rs1)>0)
          {
            while($dt=mysqli_fetch_array($rs1))
            {
              $nn=$nn+$dt["pot"];
            }
          }
          $nr=$nn;
      $pr=$data["status"]-$nr;
      $pd=$data["pot"]-$data["status"];
      }
    }
      
?>
<html lang="en">
  <head>
   <html lang="en">
<head>
  <title>Student home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: <?php echo $per;?>%;
  height: 30px;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  color: white;
}
</style>
  </head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Welcome Student</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="studenthome.php">Home</a></li>
      <li class=""><a href="viewtasklist.php">View task list </a></li>
      <li class="active"><a href="viewstatus.php">View status </a></li>
    </ul>
        
        
    <ul class="nav navbar-nav navbar-right">
   <li><a href="Login_v3/index.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </ul>
</div>
</nav>


<body>
  <h1>Your status is </h1>
    <div class="container" style="width: 100%">
      <div class="progress" style="height: 40px;width: 100%">
        <div class="progress-bar progress-bar-warning" role="progressbar" style="width:<?php echo $pd?>%;">
          Pending <?php echo $pd?>%
        </div>
        <div class="progress-bar progress-bar-success" role="progressbar" style="width:<?php echo $pr?>%">
          Complete <?php echo $pr?>%
        </div>
        <div class="progress-bar progress-bar-danger" role="progressbar" style="width:<?php echo $nr?>%">
          Submitted after due date <?php echo $nr?>%
        </div>
      </div>
    </div>
</body>
</html>