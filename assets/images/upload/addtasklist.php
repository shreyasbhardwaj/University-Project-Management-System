<!DOCTYPE html>
<?php 
include('checksess.php');
$auth=$_SESSION['auth'];
$uid=$_SESSION['name'];
$unm=$_SESSION['nm'];

$tskn="";
$tskl="";
$tskd="";
$tskb="Assign";
$pid="";
$pid="0";
$tskpr=100;
  if ($auth!='t'){
    echo "<script>alert('Invalid Access');window.location.href = 'Logout.php';</script>";
  }
  include("dbconnection.php");
if(isset($_POST["sub"]) && $_POST["sub"]=="Assign"){
  $i=1;
  $query="select a.`teacherid`,b.* FROM `projectconfig`a, projectdetail b WHERE a.`projectid`=b.projectID and a.teacherid='".$uid."'";
  $rs1=mysqli_query($con,$query);
  if(mysqli_num_rows($rs1)<1)
  {
    $i=1;
  }
  else
  {
    while($data=mysqli_fetch_array($rs1))
    {
      if($data["projectName"]==$_REQUEST["projname"])
      {
        //echo "<script>alert('".mysqli_num_rows($rs1)."');</script>";
        $i=0;
        $er="Task Name already assigned.";
      }
      elseif($data["LastDate"]>=$_REQUEST["Ldate"])
      {
        //echo "<script>alert('".mysqli_num_rows($rs1)."');</script>";
        $i=0;
        $er="date already assigned.";
      }
    }
  }
$s=0;

  $qu1="SELECT DISTINCT(projectid) from projectconfig WHERE teacherid='".$uid."'";
  $rn1=mysqli_query($con,$qu1);
  if(mysqli_num_rows($rn1)>0)
  {
     while($dx1=mysqli_fetch_array($rn1))
      {

  $qu="SELECT SUM(pot) as pot FROM projectdetail WHERE projectid=".$dx1["projectid"];
  $rn=mysqli_query($con,$qu);
  if(mysqli_num_rows($rn)>0)
  {
     while($dx=mysqli_fetch_array($rn))
      {
	$s=$s+$dx["pot"];
      }
  }
}
}
if(($s+$_REQUEST["projper"])>100)
	{
		$i=0;
		$er="teacher already assigned 100% task,unable to insert new task";
	}
  if($i==1){
    $query="INSERT INTO `projectdetail`(`projectName`, `ProjectDescription`, teacherid,`LastDate`,pot) VALUES ('".$_REQUEST["projname"]."','".$_REQUEST["desc"]."','".$uid."','".$_REQUEST["Ldate"]."',".$_REQUEST["projper"].")";
    $rs=mysqli_query($con,$query);
    $ds=mysqli_insert_id($con);

    $query="select * from assign where teacherid='".$uid."'";
    $rs1=mysqli_query($con,$query);
    if(mysqli_num_rows($rn)>0){
	while($dt=mysqli_fetch_array($rs1))
        {
    $que="insert into projectconfig(`projectid`,`teacherid`,studentid,status) VALUES(".$ds.",'".$uid."','".$dt["studentID"]."',0)";
    $res=mysqli_query($con,$que);
}
}
    echo "<script>alert('Task Assigen to students');</script>";
  }
  else
  {
    echo "<script>alert('$er');</script>"; 
  }
 }

if(isset($_POST["delbtn"])){
   $query="delete from projectdetail where projectid='".$_POST["eid"]."'";
   $rs=mysqli_query($con,$query);
   $query="delete from projectconfig where projectid='".$_POST["eid"]."'";
   $rs=mysqli_query($con,$query);
}

if(isset($_POST["tedit"])){
  $query="select * from projectdetail where projectid='".$_POST["eid"]."'";
  $rs=mysqli_query($con,$query);
   while($dt=mysqli_fetch_array($rs)){
      $tskn=$dt["projectName"];
      $tskl=$dt["LastDate"];
      $tskd=$dt["ProjectDescription"];
      $tskpr=$dt["pot"];
      $tskb="Update";
      $pid=$_POST["eid"];
   }
}

if(isset($_POST["sub"]) && $_POST["sub"]=="Update"){
    $query="update projectdetail set projectname='".$_REQUEST["projname"]."', ProjectDescription='".$_REQUEST["desc"]."', LastDate='".$_REQUEST["Ldate"]."',pot=".$_REQUEST["projper"]." where projectid='".$_POST["eid"]."'";
    $rs=mysqli_query($con,$query);
    echo "<script>alert('".$_REQUEST["Ldate"]."');</script>";
  }
?>
   <html lang="en">
<head>
  <title>Teacher home page</title>
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
            <a class="navbar-brand" href="#">Welcome <?php echo $unm;?></a>
          </div>
        <ul class="nav navbar-nav">
          <li class=""><a href="teacherhome.php">Home</a></li>
          <li class="active"><a href="addtasklist.php">Add task list </a></li>
          <li class=""><a href="viewtasks.php">View students</a></li>
        </ul>
            
        <ul class="nav navbar-nav navbar-right">
       <li><a href="Logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
    </div>
  </nav>
			<form role="form" method="post" name="tbltsk">
				<div class="form-group"><br><br><br>
					<label for="exampleInputEmail1">
						Task Name
					</label>
					<input type="text" class="form-control" id="taskid" name="projname" value="<?php echo $tskn?>">
				</div>
				<div class="form-group">
					 
					<label for="exampleInputPassword1">
						Last Date
					</label>
					<input type="Date" class="form-control" id="Ldate" name="Ldate"  value="<?php echo $tskl?>">
				</div>
				<div class="form-group">
					 
					<label for="exampleInputFile">
						Description
					</label>
					<textarea class="form-control-file" id="desc" name="desc">
					<?php echo $tskd ?>
					</textarea>
				</div>

				<div class="form-group">
					 
					<label for="exampleInputFile">
						Percentage of Project for this task:
					</label>
					<input type="number" class="form-control" id="taskper" name="projper" value="<?php echo $tskpr?>">				</div>				<input type="submit" class="btn btn-primary" name="sub"  value="<?php echo $tskb?>">
		

      <center>
   
        <div style="width: 80%;">
        <table style="width: 100%" border="1">
          <thead><tr>
            <th>Task ID</th>
            <th>Task Name</th>
            <th>Description</th>
            <th>Last Date</th>
            <th>%</th>
            <th>&nbsp;</th>
            </tr>
          </thead>
              <?php
                $query="select * from projectdetail  WHERE teacherid='".$uid."'";
                //echo "<script>alert('".$uid."');</script>";
                  $rs=mysqli_query($con,$query);
                  while($dt=mysqli_fetch_array($rs))
                  {?><tr>
                    <td><?php echo $dt["projectID"];?></td>
                    <td><?php echo $dt["projectName"];?></td>
                    <td><?php echo $dt["ProjectDescription"];?></td>
                    <td><?php echo $dt["LastDate"];?></td>
		    <td><?php echo $dt["pot"];?></td>
                    <td><input type="submit" id="tedit" name="tedit" value="Edit" onclick="document.tbltsk.eid.value='<?php echo($dt['projectID'])?>';document.tbltsk.submit();">
                      <input type="submit" name="delbtn" id="delbtn" value="Delete" onclick="document.tbltsk.eid.value='<?php echo($dt['projectID'])?>';document.tbltsk.submit();">
                    </td></tr>
                    <?php
                  }
              ?>
        </table>
      </div>

      </center>
      <input type="hidden" name="eid" id="eid" value="<?php echo $pid?>">
        </form>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>