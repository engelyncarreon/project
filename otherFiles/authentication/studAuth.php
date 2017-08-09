<?php

    require('../otherFiles/database/db.php');
    session_start();
    $user =  $_SESSION['stud_username'];
    $pass = md5($_SESSION['stud_password']);
    $query = "Select * from student where stud_username = '$user' ";
    $result = mysqli_query($con , $query);
    $row = mysqli_fetch_assoc($result);
    
    if(!$user){
       header("location:../homepage.php");
       die;
    }

?>