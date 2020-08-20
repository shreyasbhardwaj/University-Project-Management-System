<!DOCTYPE html>
<?php 
error_reporting(0);
include('checksess.php');
$auth=$_SESSION['auth'];
  if ($auth!='a'){
    echo "<script>alert('Invalid Access');window.location.href = 'Logout.php';</script>";
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
      <li class="active"><a href="adHome.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Student <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="student_regi.php">Add student</a></li>
          <li><a href="viewstu.php">View student</a></li>
        </ul>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Teacher <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="teacher_regi.php">Add teacher</a></li>
           <li><a href="viewteacher.php">View teacher</a></li>
         
        </ul>
      </li>
      <li><a href="assign.php">Assign </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      
      <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>

</body>
</html>
