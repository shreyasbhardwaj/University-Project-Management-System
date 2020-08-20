<!DOCTYPE html>
<?php 
  include("checksess.php");
  $auth=$_SESSION['auth'];
  if ($auth!='s'){
    echo "<script>alert('You have to login first');window.location.href = 'home.php';</script>";
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
  </head>
<body style="background-image: linear-gradient(to right,yellow, #b06ab3);">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Welcome Student</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="studenthomehome.php">Home</a></li>
      <li class=""><a href="viewtasklist.php">View task list </a></li>
      <li class=""><a href="viewstatus.php">View status </a></li>
    </ul>
        
        
    <ul class="nav navbar-nav navbar-right">
   <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </ul>
</div>
</nav>

</body>
</html>