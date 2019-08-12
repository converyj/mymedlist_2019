<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$listid = $_SESSION['listid'];
$role = $_SESSION['role']; 
$userid = $_SESSION['userid'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$patientFirstName = $_SESSION['patientfName']; 
$patientLastName = $_SESSION['patientlName']; 

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// SELECT and save user's email to be able to send their medlist to them 
$stmt = $pdo->prepare("
						SELECT `email`
						FROM `user`
						WHERE `user`.`userid` = $userid");

$stmt->execute();

$row = $stmt->fetch();

// save user's email 
$email = $row['email'];

// set title of patient
$title = $patientFirstName . " " . $patientLastName . "'s Medication List";

// set subject of email
$subject = "Medication List for" . " " . $patientFirstName . " " . $patientLastName;

// select user's medications ordering by type 
$stmt = $pdo->prepare("
						SELECT `name`, `dose`, `date`, `f`.`value` AS frequency, `t`.`value` AS type 
						FROM `medlist`
						LEFT OUTER JOIN `medvalue` f ON `medlist`.`frequency` = `f`.`code` 
						LEFT OUTER JOIN `medvalue` t ON `medlist`.`type` = `t`.`code` 
						WHERE `medlist`.`listid` = $listid
						ORDER BY `medlist`.`type`");
$stmt->execute();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Jaime Convery - Individual Project</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" media="screen and (min-width:768px)" href="css/tablet.css">
		<link rel="stylesheet" media="screen and (min-width:1024px)" href="css/desktop.css">
		<link rel="shortcut icon" type="image/jpg" href="images/logo.jpg" />
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body> 
		<div id="wrapper">
			<header>
				<a href="home.php">
					<img class="logo" src="images/logo.jpg" alt="mymedlist" />
				</a>
				<nav id="navBar" class="nav">
					<a href="#navBar" class="hamburger_btn" id="icon">
						<span class="fa fa-bars"></span>
					</a>
					<ul>
						<li>
							<a href="home.php">Home</a>
						</li>
						<li>
							<a href="contact.php">Contact</a>
						</li>
						
						<!-- if already logged in, change navigation  -->
						<?php 
						if ($_SESSION["logged-in"] == true) {
						?>
							<li>
								<a href="menu.php">Menu</a>
							</li>
							<li>
								<a href="logout.php">Logout</a>
							</li>
						<?php 
						}
						?> 
					</ul>
				</nav>
			</header>
			<main>
				<div id="toPDF">
					<h1><?php echo($title); ?></h1><hr>

					<!-- if user has any medications, display them  -->
					<?php 
					$numRows = 0;
					$subtitle = ""; 
					while ($row = $stmt->fetch()) { 
						if ($subtitle != $row['type']) {
						?>
						<table id="myList">
							<h2><?php echo($row['type']);?></h2>
							
								<tr>
									<th>Name</th>
									<th>Dosage</th>
									<th>Frequency</th>
									<th>Prescription Date</th>
								</tr>
						<?php
						}
						$numRows++;
						$subtitle = $row['type'];		 
						?>
						<tr>
							<td><?php echo($row['name']);?></td>
							<td><?php echo($row['dose']);?></td>
							<td><?php echo($row['frequency']);?></td>
							<td><?php echo($row['date']);?></td>
						</tr>
					<?php 
					}
					?>
				</table>
			</div>
				<a class="btn" href="displayList.php">Back</a>
				<a class="btn" id="mail" onclick="mailTo('<?php echo($email); ?>', '<?php echo($subject); ?>');">Email</a>
				<button id="print" class="btn">Print</button>
			</main>
			<footer>
				<ul>
					<li><a href="#">Contact Us</a></li>
				</ul>
				<p>&copy; Copyright 2018 | All rights</p>
			</footer>
		</div>
	<script src="js/script.js"></script>
	<script src="js/print.js"></script>
	</body>
</html>