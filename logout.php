<?php 
    //Include constant.php for SITEURL
    include('../config/constant.php');
    //1. Destroy the session
    session_destroy(); //unsets $_SESSION['user]

    //2. Redirect to Login Page
    header('location:'.SITEURL.'admin/login.php');


?>