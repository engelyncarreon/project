 <?php

	require('../database/db.php');

		if($_GET["stud_status"] == "Activate"){

              $query = "UPDATE student set stud_status = 'Activate' WHERE stud_username = '".$_GET['stud_username']."'";

		}else {

			$query = "UPDATE student set stud_status = 'Deactivate' WHERE stud_username = '".$_GET['stud_username']."'";

		}


		$stmt = $con->prepare($query);

		$stmt->execute();

		header("Location: manageStud.php");

		$con->close();                         
?>