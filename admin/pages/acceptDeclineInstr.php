 <?php

	require('../database/db.php');

		if($_GET["user_status"] == "Accepted"){

		 	$query1 = "UPDATE registration set user_status = 'Accepted' WHERE user_username = '".$_GET['user_username']."'";

                 $result1 = $con -> query($query1);

            $query = "INSERT INTO instructor (instr_lastName, instr_firstName, instr_username, instr_password , instr_email , instr_address, instr_contactno, instr_gender, instr_age, instr_status) SELECT user_lastName, user_firstName, user_username, user_password, user_email, user_address, user_contactno, user_gender, user_age, 'Activate' FROM registration where user_status = 'Accepted' and typeOfuser = 'Instructor' and user_username = '".$_GET['user_username']."'";



		// if ($result1->num_rows > 0 && $_GET["user_status"] == "Accepted"){

		// $query2 = "INSERT INTO instructor (instr_lastName, instr_firstName, instr_username, instr_password , instr_email , instr_address, instr_contactno, instr_gender, instr_age, instr_status) SELECT user_lastName, user_firstName, user_username, user_password, user_email, user_address, user_contactno, user_gender, user_age, 'Activate' FROM registration where user_status = 'Accepted' and typeOfuser = 'Instructor'";

  //              $result = $con -> query($query2);

		// } else{

		//  	echo "0 resutl";

		//  }
	}else {

			$query = "UPDATE registration set user_status = 'Declined' WHERE user_username = '".$_GET['user_username']."'";

		}


		$stmt = $con->prepare($query);

		$stmt->execute();

		header("Location: manageInstr.php");

		$con->close();                         
?>