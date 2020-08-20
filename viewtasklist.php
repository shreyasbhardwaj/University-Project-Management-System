<!DOCTYPE html>
<?php 
error_reporting(0);
include('checksess.php');
$auth=$_SESSION['auth'];
  if ($auth!='s'){
    echo "<script>alert('Invalid Access');window.location.href = 'Logout.php';</script>";
  }
?>

<html lang="en">
<head>
  <title>Student home page</title>
  <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="./assets/css/main.css">

  <link rel="stylesheet" href="./assets/materialize.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
      <li class=""><a href="studenthome.php">Home</a></li>
      <li class="active"><a href="viewtasklist.php">View task list </a></li>
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
<html>
<body>
<div class="container">
  <form name="upf" action="upload.php" method="post" enctype="multipart/form-data">
     <table style="width: 80%">
        <thead>
          <tr>
              <th>TID</th>
              <th>Last Date</th>
              <th>Task Description</th>
              <th>Upload file</th>
              <th>&nbsp;</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $uid=$_SESSION["name"];
          include("dbconnection.php");
          $query="select b.*,c.* FROM projectconfig b, projectdetail c WHERE b.`studentID`='".$uid."' and c.projectID=b.projectid";
//$query="select a.projectID,a.projectName,a.projectDescription,b.teacherid,a.LastDate,b.status from projectdetail a, projectconfig b where a.projectid=b.projectid and b.studentid='".$uid."'";
$rs=mysqli_query($con,$query);
if(mysqli_num_rows($rs)>0)
    {
while($data=mysqli_fetch_array($rs))
{

  ?>
  <tr>
    <td style="width: 10%"><?php echo $data['projectID'];?></td>
    <td style="width: 30%"><?php echo $data['LastDate'];?></td>
    <td style="width: 40%"><?php echo $data['projectName']."<br>".$data['ProjectDescription'];?></td>
    <?php
       $query1="select * from tskattch where projectid=".$data['projectID']." and studentid='".$uid."'";
       $rs1=mysqli_query($con,$query1);
      if(mysqli_num_rows($rs1)<1){
       
    ?>
    
      <td><input type="file" name="file<?php echo $data['projectID'];?>[]" multiple="true"></td>
      <td><input type="submit" name="btnsub" value="Upload Files" onclick="document.upf.pid.value='<?php echo $data['projectID'];?>';"></td>    
    <?php
      }
      else
      {
        while($data2=mysqli_fetch_array($rs1))
        {
          $ud=$data2["date"];
        }
        if($ud>$data['LastDate'])
        {
          $cc="progress-bar progress-bar-danger";
        }
        else
        {
          $cc="progress-bar progress-bar-success";
        } 
    ?>
      <td><center>Submitted</center></td>
      <td>
          <div class="progress" style="height: 40px;width: 100%">
            <div class="<?php echo $cc;?>" role="progressbar" style="width:<?php echo $data["status"];?>%">
              <?php echo $data["status"];?>%
            </div>
          </div>
      </td>
    <?php
      }
    ?>
    </tr>
      <?php
    }
  }
  ?>

</tbody>
</table>
<input type="hidden" name="pid">
</form>
</div>
</body>
</html>
