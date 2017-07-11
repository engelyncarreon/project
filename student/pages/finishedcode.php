<?php 
	require('../database/db.php');
	$stuid = $_POST['stid'];
	$coid = $_POST['coid'];
	$leid = $_POST['leid'];

	echo $stuid."<br>". $coid ."<br>".$leid;
	$fin = "UPDATE studentcourse SET lessonstatus = 'Finished' where student_id  = '$stuid' and lesson_id= '$leid' and course_id = '$coid'";
	$finres = mysqli_query($con,$fin);
	header("Location: FinishedCourse.php");

?>