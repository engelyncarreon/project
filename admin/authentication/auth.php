<?php

    require('../database/db.php');
    session_start();
    $user = $_SESSION['username'];
    $pass = md5($_SESSION['password']);
    $query = "SELECT * from adminlogin where username = '$user' and password = '$pass'";
    $result = mysqli_query($con , $query);
    $row = mysqli_fetch_assoc($result);

    if(!$user){
    	header("Location: ../adminLogin.php");
    	$con->close();
    }

?>