<?php

session_start(); 

 // get userid from SESSION 
$userid = $_SESSION['userid'];

// check if the inputs are set and not null, else redirect to patients form
if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email'])) {
	$patientFirstName = $_POST['firstName'];
	$patientLastName = $_POST['lastName'];
	$patientEmail = $_POST['email'];

} else {
	header("Location: patients.php");
	exit();
}

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// check if patient exists in user table 
$stmt = $pdo->prepare("
						SELECT *
						FROM  `user`
						INNER JOIN `patientlist` ON `user`.`userid` = `patientlist`.`userid`
						WHERE `user`.`firstName` = '$patientFirstName'
						AND `user`.`lastName` = '$patientLastName'
						AND `user`.`email` = '$patientEmail'");

$stmt->execute();

// check if the insert was successful or not 
if ($row = $stmt->fetch()) {
	// save user information 
	$listid = $row['listid']; 
	$patientid = $row['userid'];
	
	// INSERT field inputs into caregiverpatientlist table (add patient to caregiver)
	$stmt = $pdo->prepare("
							INSERT INTO `caregiverpatientlist` 
								(`userid`, `listid`)
								VALUES ($userid, $listid); ");
	$i = $stmt->execute();

	// check if the insert was successful or not 
	if ($i == 1) {
	 	$_SESSION['patientid'] = $patientid;
	 	$_SESSION['listid'] = $listid;
		$_SESSION['patientFirstName'] = $patientFirstName;
		$_SESSION['patientLastName'] = $patientLastName;
			
		header("Location: showLists.php");
		exit();

	} else {
		$message = "Error: Could not insert the record into caregiverpatientlist";
		header("Location: error.php?message= " . $message);
		exit();
	}	

} else {
	$message = "Error: User not found in user table";
	header("Location: error.php?message= " . $message);
	exit();
}	
?>