<?php
$con = mysqli_connect("localhost","root","","taskmgmt");
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }

// mysqli_select_db("taskmgmt", $con);
?>