<?php

    require_once('../otherFiles/database/db.php');
	session_start();

	if(session_destroy()){  // Destroying All Sessions

		header("Location: ../homepage.php");

	}
?>