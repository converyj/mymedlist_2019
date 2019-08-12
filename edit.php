<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$listid = $_SESSION['listid']; 
$medid = $_GET["id"]; 

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// select the record to edit
$stmt = $pdo->prepare("
						SELECT `name`, `dose`, `date`, `healthCareProvider`, `comment`, `instructions`, `f`.`value` AS frequency, `t`.`value` AS type 
						FROM `medlist`
						LEFT OUTER JOIN `medvalue` f ON `medlist`.`frequency` = `f`.`code` 
						LEFT OUTER JOIN `medvalue` t ON `medlist`.`type` = `t`.`code` 
						WHERE `medlist`.`listid` = $listid
						AND `medlist`.`medid` = $medid");

$stmt->execute();

$row1 = $stmt->fetch(); 

// populate the type dropdown list with different types of medication
$type = $pdo->prepare("
						SELECT *
						FROM `medvalue` 
						WHERE `medvalue`.`type` = 'type'");

$type->execute();

// populate the frequency dropdown list with different frequences
$freq = $pdo->prepare("
						SELECT *
						FROM `medvalue` 
						WHERE `medvalue`.`type` = 'freq'");

$freq->execute();

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
				<form action="process-update.php" method="POST">  
					<h1>Update Medication</h1>			
					<input type="hidden" value="<?php echo($medid);?>" name="id"/>
					<label for="name">Name:</label>
					<input type='text' id="name" name='name' value="<?php echo($row1["name"]); ?>"/>
					<label for="dosage">Dosage:</label>
					<input type='text' id="dosage" name='dosage' value="<?php echo($row1["dose"]); ?>"/>	
					<label class="side" for="type">Type:</label>
					<select id="type" class="side" name='type'>
					<?php
					while ($t = $type->fetch()) {
					?>
						<option value=<?php echo($t['code']);?>><?php echo($t['value']);?></option>
						<?php 
						} 
						?>
					</select>
					<label class="side" for="freq">Frequency:</label>
					<select class="side" id="freq" name='freq'>
					<?php
					while ($f = $freq->fetch()) {
					?>
						<option value=<?php echo($f['code']);?>><?php echo($f['value']);?></option>
						<?php 
						} 
						?>
					</select>
					<label>Presciption Date:</label>
					<input type='date' name='date' value="<?php echo($row1["date"]); ?>"/>
					<label for="provider">Health Care Provider:</label>
					<input type='text' id="provider" name='provider' value="<?php echo($row1["healthCareProvider"]); ?>"/>
					<label for="comment">Comments:</label>
					<textarea id="comment" name='comment' cols="100"><?php echo($row1["comment"]); ?></textarea>
					<label for="instructions">Instructions:</label>
					<textarea id="instructions" name='instruction' cols="100"><?php echo($row1["instructions"]); ?></textarea>
					<a class="btn" href="displayList.php">Back</a>
					<input type='submit' value="Update" /> 
				</form>
			</main>
			<footer>
				<ul>
					<li><a href="#">Contact Us</a></li>
				</ul>
				<p>&copy; Copyright 2018 | All rights</p>
			</footer>
		</div>
		<script src="js/script.js"></script>
	</body>
</html>