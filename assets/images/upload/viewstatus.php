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

  $query="select status from assign where studentid='".$_SESSION["name"]."'";
  $rs=mysqli_query($con,$query);
  if(mysqli_num_rows($rs)>0)
    {
      while($data=mysqli_fetch_array($rs))
      {
        $per= $data["status"];
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
    <div id="myProgress">
      <div id="myBar">
        <?php echo $per;?>%
      </div>
    </div>
</body>
</html>