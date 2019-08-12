<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$firstName = $_SESSION['firstName']; 
$lastName = $_SESSION['lastName'];
$userid = $_SESSION['userid'];
$listid = $_SESSION['listid'];
$patientFirstName = $_SESSION['patientfName']; 
$patientLastName = $_SESSION['patientlName']; 

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// select the user's medications from history and set the title of user
$stmt = $pdo->prepare("
						SELECT `medid`, `name`, `dose`, `date`, `f`.`value` AS frequency, `t`.`value` AS type 
						FROM `history`
						LEFT OUTER JOIN `medvalue` f ON `history`.`frequency` = `f`.`code` 
						LEFT OUTER JOIN `medvalue` t ON `history`.`type` = `t`.`code` 
						WHERE `history`.`listid` = $listid");

$stmt->execute();

// set patient title 
$title = $patientFirstName . " " . $patientLastName . "'s Medication History"; 

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
				<h1><?php echo($title); ?></h1>
				<label>Search:</label><input type="search" name="search" id="myInput" class="myInput" />	
				<table id="myList">
					<tr>
						<th>Name</th>
						<th>Dosage</th>
						<th>Frequency</th>
						<th>Type</th>
						<th>Prescription Date</th>
						<th colspan="3">Action</th>
					</tr>
					<?php
					$numRows = 0; 
					while ($row = $stmt->fetch()) { 
						$numRows++;
					?>		
						<tr>
							<td><?php echo($row['name']);?></td>
							<td><?php echo($row['dose']);?></td>
							<td><?php echo($row['frequency']);?></td>
							<td><?php echo($row['type']);?></td>
							<td><?php echo($row['date']);?></td>
							<td><span><a href="showMore.php?func=2&id=<?php echo($row['medid'])?>">More</a></span></td>
						</tr>
					<?php 
					} 
					if ($numRows == 0) {
					?>
						<tr>
							<td colspan="6">No History Found</span></td>
						</tr>
					<?php
					}
					?>
				</table>
				<a class="btn" href="displayList.php">Back To List</a>
			</main>
			<footer>
				<ul>
					<li><a href="#">Contact Us</a></li>
				</ul>
				<p>&copy; Copyright 2018 | All rights</p>
			</footer>
		</div>
		<script src="js/script.js"></script>
		<script src="js/filter.js"></script>
	</body>
</html>