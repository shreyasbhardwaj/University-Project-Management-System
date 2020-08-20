<?php
session_start();
                if(isset($_SESSION['name']))
                {
                unset($_SESSION['name']);
                }
                echo "<script>alert('You have been successfully logout');window.location.href = 'home.php';</script>";
?>