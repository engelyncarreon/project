<?php

    require('../database/db.php');
    session_start();
    $user = $_SESSION['instr_username'];
    $pass = md5($_SESSION['instr_password']);
    $query = "SELECT * from instructor where instr_username = '$user' and instr_password = '$pass'";
    $result = mysqli_query($con , $query);
    $row = mysqli_fetch_assoc($result);

    if(!$user){
        header("Location: ../instrLogin.php");
        $con->close();
    }

?>