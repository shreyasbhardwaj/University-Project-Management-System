<?php
session_start();
if (isset($_SESSION['name']) && $_SESSION['name']!='') {
  
}
else{
  echo "<script>alert('You have to login first');window.location.href = 'home.php';</script>";
}
?>