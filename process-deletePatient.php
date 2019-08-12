<?php

session_start(); 

 // get userid from SESSION and listid
$userid = $_SESSION['userid']; 
$listid = $_GET['list']; 

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// DELETE patient row from caregiverpatientlist
$stmt = $pdo->prepare("
						DELETE FROM `caregiverpatientlist` 
						WHERE `caregiverpatientlist`.`userid` = $userid 
						AND `caregiverpatientlist`.`listid` = $listid");

$i = $stmt->execute();

// check whether the delete was successful or not
if ($i == 1) {
	header("Location: maintainPatients.php");
	exit();
} else {
	$message = "Error: Could not delete the record";
	header("Location: error.php?message= " . $message);
	exit();
}
  
?>