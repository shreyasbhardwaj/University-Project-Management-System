<!DOCTYPE html>
<?php 
error_reporting(0);
include('checksess.php');
$auth=$_SESSION['auth'];
  if ($auth!='a'){
    echo "<script>alert('Invalid Access');window.location.href = 'Logout.php';</script>";
  }

  include("dbconnection.php");
	if ($_REQUEST["eid"]!="") {
		$query="select * from studentprofile where userid='".$_REQUEST["eid"]."'";
		$rs=mysqli_query($con,$query);
		while($data=mysqli_fetch_array($rs))
		{
			$fname=$data["FirstName"];
			$lname=$data["Last"];
			$faname=$data["Father"];
			$adds=$data["Address"];
			$mno=$data["mobile"];
			$sid=$data["UserID"];
			$desig=$data["Department"];
			$sem=$data["Semester"];
			$prs=$data["UserID"];

		}	
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
  <style type="text/css">
  	h3
  	{
  		text-align: center;

 	}
 	table td
 	{
 		padding: 10px 30px;
 		text-align: 20px;
 		font-size: 18px;
 	}
 	table input[type="text"]
 	{
 		height:40px;
 		width: 240px;
 		text-align: center;
 		border :none;
 		outline: none;
 		border : 2px solid black;
 		border-radius: 10px;
 	}
 	table input[type="password"]
 	{
 		height:40px;
 		width: 240px;
 		text-align: center;
 		border :none;
 		outline: none;
 		border : 2px solid black;
 		border-radius: 10px;
 	}
 	table textarea
 	{
 		height:150px;
 		width: 150px;
 		text-align: center;
 		border :none;
 		outline: none;
 		border : 2px solid black;
 		border-radius: 10px;
 	}
 	table input[type="number"]
 	{
 		height:40px;
 		width: 240px;
 		text-align: center;
 		border :none;
 		outline: none;
 		border : 2px solid black;
 		border-radius: 10px;
 	}
 	table button
 	{
 		height:40px;
 		width: 180px;
 		text-align: center;
 		border :none;
 		outline: none;
 		border : 2px solid black;
 		border-radius: 15px;
 		margin-left: 60%;
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
          <li class="active"><a href="student_regi.php">Add student</a></li>
          <li><a href="viewstu.php">View student</a></li>
          
        </ul>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Teacher <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="teacher_regi.php">Add teacher</a></li>
           <li><a href="Viewteacher.php">View teacher</a></li>
              </ul>
      </li>
      <li><a href="assign.php">Assign </a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      
      <li><a href="Login_v3/index.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
	<h3>Student registration form</h3>
	<div class="tregister">
		
<form action="entry.php" method="post" id="register" action="">
	<table>
		<tr>
			<td>
				<label>First Name:</label><br>
			</td>
			<td>
				<input type="text" name="fname" id="name" placeholder="Enter your first name"  value="<?php echo $fname;?>">
			</td>
			<td>
				<label>Last Name:</label>
			</td>
			<td>
				<input type="text" name="lname" id="name" placeholder="Enter your last name" value="<?php echo $lname;?>">
			</td>
		</tr>
		<tr>
			<td>
				<label>Sex:</label>
			</td>
			<td>
				<input type="radio" name="gender" id="male" value="male" ><span id="male"> Male</span>
                <input type="radio" name="gender" id="female" value="female" ><span id="female"> Female</span>
				<input type="radio" name="gender" id="others" value="other" ><span id="others"> Others</span>
			</td>
			<td>
				<label>Address:</label>
			</td>
			<td>
				 <textarea name="saddress" rows="5" cols="20" required><?php echo $adds;?></textarea>
			</td>
		</tr>
	<tr>
		<td>
           <label> Upload a picture:</label>
       </td>
       <td>
       		<input type="file" name="stuimg" id="f1" required>
       </td>
       <td>
       		<label>Mobile Number:</label>
       </td>
       <td>
			<select id="ph">
				<option>+91</option>
				<option>+92</option>
				<option>+93</option>
				<option>+94</option>
				<option>+95</option>
			</select>
			<input type="number" name="mno" id="mno" placeholder="Enter your mobile number" value="<?php echo $mno;?>" >
		</td>


</tr>
<tr>
	<td>
		<label>Father's Name:</label>
	</td>
	<td>
		<input type="text" name="fathername" id="name" placeholder="Enter Father's name"  value="<?php echo $faname;?>" requireds>
	</td>
	<td>
		<label>Username:</label>
	</td>
	<td>
		<input type="text" name="sid" id="tid" placeholder="Enter userid"  value="<?php echo $sid;?>">
	</td>
</tr>
<tr>
	<td>
		<label>Password:</label>
	</td>
	<td>
		<input type="password" name="passwd" id="pass" placeholder="Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
	</td>
	<td>
		<label>Re-enter Password:</label>
	</td>
	<td>
		<input type="password" name="rpasswd" id="passd" placeholder="Re-Enter Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

</td>
</tr>
<tr>
	<td>
		<label>Department:</label>
	</td>
	<td>
		<select id="dept" name="depart" value="<?php echo $depart;?>">
				<option>MCA</option>
				<option>Agriculture and Life Sciences.</option>
				<option>MBA</option>
				<option>Engineering.</option>
				<option>Graduate</option>
				<option>Human Sciences</option>
				<option>Architecture</option>
				<option>Medical</option>
			</select></td>
		<td>
			<label>Semester:</label>
		</td>

		<td>
			<input type="number" name="sem" id="sem" placeholder="Enter Semester" min="1" max="6" value="<?php echo $sem;?>" required>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<button id="stubtn" name="stubtn">SUBMIT</button>
		</td>
		</tr>
	</table>
<input type="hidden" name="prs" id="prs" value="<?php echo $prs;?>">	
		</div>
		</form>
	</div>
</body>
</html>
