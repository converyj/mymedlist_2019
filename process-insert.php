<?php

session_start(); 

 // get userid from SESSION 
$userid = $_SESSION['userid'];
$listid = $_SESSION['listid'];

// check if the inputs are set and not null, else redirect to medication form
if(!empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['dosage']) && !empty($_POST['freq']) && !empty($_POST['date']) && !empty($_POST['provider']) && !empty($_POST['comment']) && !empty($_POST['instruction'])) {
	$name = $_POST['name'];
	$type = $_POST['type'];
	$dose = $_POST['dosage'];
	$frequency = $_POST['freq'];
	$date = $_POST['date'];
	$provider = $_POST['provider'];
	$comments = $_POST['comment'];
	$instructions = $_POST['instruction'];
} else {
	header("Location: menu.php");
	exit();
}

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// INSERT field inputs into medlist table 
$stmt = $pdo->prepare("
						INSERT INTO `medlist` 
							(`listid`, `name`, `dose`, `frequency`, `type`, `date`, `healthCareProvider`, `comment`, `instructions`, `userid`)
							VALUES ($listid, '$name', '$dose', '$frequency', '$type', '$date', '$provider', '$comments', '$instructions', $userid); ");
$i = $stmt->execute();

// check if the insert was successful or not 
if ($i == 1) {
	header("Location: displayList.php");
	exit();
} else { 
	$message = "Error: Could not insert the record";
	header("Location: error.php?message= " . $message);
	exit();
}	
  
?>