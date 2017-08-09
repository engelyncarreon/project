 <?php

	require('../otherFiles/database/db.php');

		if($_GET["user_status"] == "Accepted"){

		 	$query1 = "UPDATE registration set user_status = 'Accepted' WHERE user_username = '".$_GET['user_username']."'";

                 $result1 = $con -> query($query1);

            $query = "INSERT INTO student (stud_lastName, stud_firstName, stud_username, stud_password , stud_email , stud_address, stud_contactno, stud_gender, stud_age, stud_status) SELECT user_lastName, user_firstName, user_username, user_password, user_email, user_address, user_contactno, user_gender, user_age, 'Activate' FROM registration where user_status = 'Accepted' and typeOfuser = 'Student' and user_username = '".$_GET['user_username']."'";

            $stmt = $con->prepare($query);

			$stmt->execute();

            header("Location: manageStud.php");

		}else {

			$query = "UPDATE registration set user_status = 'Declined' WHERE user_username = '".$_GET['user_username']."'";

			$stmt = $con->prepare($query);

			$stmt->execute();

			header("Location: student.php");

		}

		$con->close();                         
?>