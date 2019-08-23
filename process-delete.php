<?php

session_start(); 

 // get userid from SESSION 
$userid = $_SESSION['userid']; 
$listid = $_SESSION['listid'];
$func = $_GET['func']; 
$medid = $_GET['id']; 

include_once("mymedlist_dbconfig.php");	

// if user chose move to history, INSERT row to history
if ($func == '1') {
	$stmt = $pdo->prepare("
							INSERT INTO `history` (`listid`, `medid`, `name`, `dose`, `units`, `frequency`, `type`, `date`, `healthCareProvider`, `comment`, `instructions`, `timestamp`, `userid`)
								SELECT *
								FROM `medlist`
								WHERE `medlist`.`listid` = $listid 
								AND `medlist`.`medid` = $medid"); 

	$i = $stmt->execute();

	// if successful, UPDATE the row with the user who is logged in
	if ($i == 1) {
		$stmt = $pdo->prepare("
								UPDATE `history` SET `updatedUserid` = $userid 
								WHERE `history`.`listid` = $listid 
								AND `history`.`medid` = $medid"); 

		$i = $stmt->execute();

		if ($i == 0) {
			$message = "Error: Could not update the record";
			header("Location: error.php?message= " . $message);
			exit();
		}
	} else {
		$message = "Error: Could not insert the record";
		header("Location: error.php?message= " . $message);
		exit();
	}

}

// DELETE medication row from medlist
$stmt = $pdo->prepare("
						DELETE FROM `medlist` 
						WHERE `medlist`.`listid` = $listid 
						AND `medlist`.`medid` = $medid");

$i = $stmt->execute();

if ($i == 1) {
	header("Location: displayList.php");
	exit();
} else {
	$message = "Error: Could not delete the record";
	header("Location: error.php?message= " . $message);
	exit();
}
  
?>