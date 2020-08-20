<!DOCTYPE html>
<?php
error_reporting(0);
include('checksess.php');
$auth=$_SESSION['auth'];
  if ($auth!='t'){
    echo "<script>alert('Invalid Access');window.location.href = 'Logout.php';</script>";
  }
  include("dbconnection.php");
  if($_POST["selro"]!="")
  {
    $sid="a".$_POST["selro"];
    $query="update assign set status=".$_POST[$sid]." where assignid='".$_POST["selro"]."'";
    $rs = mysqli_query($con,$query);
  }
?>
<html lang="en">
  <head>
   <html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Teacher home page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

  <link rel="stylesheet" href="./assets/css/main.css">

  <link rel="stylesheet" href="./assets/materialize.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  </head>
<body style="background-image: linear-gradient(to right,yellow, #b06ab3);">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Welcome Teacher</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="teacherhome.php">Home</a></li>
      <li class=""><a href="addtasklist.php">Add task list </a></li>
      <li class="active"><a href="viewtasks.php">View students</a></li>
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
<form method="post" name="tskst">
     <table>
        <thead>
          <tr>
              <th>Student Name</th>
              <th>Task</th>
              <th>Snapshoot</th>
              <th>Status</th>
              <th>&nbsp;</th>
  <th></th>
          </tr>
        </thead>
        <?php
         $uid=$_SESSION["name"];
            include("dbconnection.php");
            $query="select a.*,b.FirstName,b.Last from `assign` a,studentprofile b WHERE a.`studentID`=b.userid and teacherID='".$uid."'";

        $rs=mysqli_query($con,$query);
        if(mysqli_num_rows($rs)>0)
            {
          while($data=mysqli_fetch_array($rs))
          {
            $query1="select DISTINCT(b.projectID), b.projectName,b.`ProjectDescription` from `projectconfig` a, projectdetail b WHERE a.`projectid`=b.projectID and a.teacherid='".$uid."'";
            $rs1=mysqli_query($con,$query1);
            if(mysqli_num_rows($rs1)>0)
              {
                $i=1;
              while($data1=mysqli_fetch_array($rs1))
              {
                $x=1;
                if($i==1){
          ?>

              <tr>
                <td rowspan=<?php echo mysqli_num_rows($rs1)?>><?php echo $data["FirstName"]." ".$data["Last"]?></td>
                <td><?php echo $data1["projectName"]?><br><?php echo $data1["ProjectDescription"]?><br><?php echo $data1["LastDate"]?></td>
                <td><?php
                      $query2="select * from tskattch where projectid=".$data1["projectID"]." and studentid='".$data["studentID"]."'";
                        $rs2=mysqli_query($con,$query2);
                        if(mysqli_num_rows($rs2)>0)
                          {
                            while($data2=mysqli_fetch_array($rs2))
                            {
                              
                            ?>
                            <a href="<?php echo $data2["atfilen"];?>">Snapshot <?php echo $x;?></a>

                            <?php
                            $x=$x+1;
                            }
                          }
                          else
                            echo "Not Submitted";
                            ?>
                </td>
                <td rowspan=<?php echo mysqli_num_rows($rs1)?>>
                  <?php
                      $qup="select sum(status) as status, sum(pot) as pot from `projectconfig` a, projectdetail b WHERE a.`projectid`=b.projectID and a.studentid='".$data["studentID"]."'";
                        $rsp=mysqli_query($con,$qup);
                        if(mysqli_num_rows($rsp)>0)
                          {
                            while($dtp=mysqli_fetch_array($rsp))
                            {
                              
                              $nn=0;
                              $qnt="SELECT DISTINCT(a.projectID),b.pot FROM tskattch a,projectdetail b WHERE a.projectid=b.projectid and date(a.date)>date(b.lastdate) and a.studentid='".$data["studentID"]."'";
                              $rst=mysqli_query($con,$qnt);
                              if(mysqli_num_rows($rst)>0)
                                {
                                  while($dtt=mysqli_fetch_array($rst))
                                  {
                                    $nn=$nn+$dtt["pot"];
                                  }
                                }
                                $nr=$nn;
                            $pr=$dtp["status"]-$nr;
                            $pd=$dtp["pot"]-$dtp["status"];
                            }
                          }

                        
                          ?>
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
                  </td>
              </tr>
              <?php
          }
          else
          {
            ?>
          <tr>
                <td><?php echo $data1["projectName"]?><br><?php echo $data1["ProjectDescription"]?><br><?php echo $data1["LastDate"]?></td>
                <td>
                  <?php
                    $query3="select * from tskattch where projectid=".$data1["projectID"]." and studentid='".$data["studentID"]."'";
                      $rs3=mysqli_query($con,$query3);
                      if(mysqli_num_rows($rs3)>0)
                        {
                          $m=1;
                          while($data3=mysqli_fetch_array($rs3))
                          {
                            
                  ?>
                  <a href="<?php echo $data3["atfilen"];?>">Snapshot <?php echo $x;?></a>

                  <?php
                  $x=$x+1;
                  }
                }
                else
                  echo "Not Submitted";
                
                  ?>
                
                </td>
              </tr>

          <?php
          }
          $i=$i+1;
          }
          }
          }
        }
    ?>
      </table>

      <input type="hidden" id="selro" name="selro">
      <input type="hidden" id="prono" name="prono">
      <input type="hidden" id="roper" name="roper">
</form>
 </div>
</body>
</html>