<?php

session_start(); 

 // get variables from SESSION 
$userid = $_SESSION['userid'];
$listid = $_SESSION['listid'];
$medid = $_POST['id']; 

// check if the inputs are set and not null, else redirect to medication form
if(!empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['dosage']) && !empty($_POST['units']) && !empty($_POST['freq']) && !empty($_POST['date']) && !empty($_POST['provider']) && !empty($_POST['comment']) && !empty($_POST['instruction'])) {
	$name = $_POST['name'];
	$type = $_POST['type'];
	$dose = $_POST['dosage'];
	$units = $_POST['units'];
	$frequency = $_POST['freq'];
	$date = $_POST['date'];
	$provider = $_POST['provider'];
	$comments = $_POST['comment'];
	$instructions = $_POST['instruction'];
} else {
	header("Location: edit.php");
	exit();
}

include_once("../../mymedlist_dbconfig.php");	


// UPDATE field inputs into medlist table 
$stmt = $pdo->prepare("
						UPDATE `medlist` 
						SET `name` = '$name', 
							`dose` = '$dose',
						    `units` = '$units',							
				      		`frequency` = $frequency, 
					      	`type` = $type,
					       	`date` = '$date', 
					       	`healthCareProvider` = '$provider',
					       	`comment` = '$comments',
					       	`instructions` = '$instructions', 
					       	`userid` = $userid
					    WHERE `medlist`.`listid` = $listid
					    AND `medlist`.`medid` = $medid");
$i = $stmt->execute();

// check if the update was successful or not 
if ($i == 1) {
	header("Location: displayList.php");
	exit();
} else {
	$message = "Error: Could not update the record";
	header("Location: error.php?message= " . $message);
	exit();
}	
  
?>