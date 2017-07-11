 <?php

	require('../database/db.php');

		if($_GET["instr_status"] == "Activate"){

              $query = "UPDATE instructor set instr_status = 'Activate' WHERE instr_username = '".$_GET['instr_username']."'";

		}else {

			$query = "UPDATE instructor set instr_status = 'Deactivate' WHERE instr_username = '".$_GET['instr_username']."'";

		}


		$stmt = $con->prepare($query);

		$stmt->execute();

		header("Location: manageInstr.php");

		$con->close();                         
?>