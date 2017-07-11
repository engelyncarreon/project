<?php 
    require('../database/db.php');
    if($_POST['status'] == "Paid"){
           
        $padid = $_POST['pad'];
        echo $padid;
        $up = "Update studentcourse SET paymentStatus = 'Paid' where student_courseid = '$padid' ";
        $update = mysqli_query($con,$up);
        header("Location: enroll.php");
    }
?>
