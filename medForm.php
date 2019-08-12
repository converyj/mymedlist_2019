<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// populate the type dropdown list with different types of medication
$type = $pdo->prepare("
						SELECT *
						FROM `medvalue` 
						WHERE `medvalue`.`type` = 'type'");

$type->execute();

// populate the frequency dropdown list with different frequences
$stmt = $pdo->prepare("
						SELECT *
						FROM `medvalue` 
						WHERE `medvalue`.`type` = 'freq'");

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
				<form action="process-insert.php" method="POST">  
					<h1>Add Medication</h1>
					<p>Fill out this form to add to your medication list</p>		
					<label for="name">Name:</label>
					<input type='text' id="name" name='name'/>
					<label for="dosage">Dosage:</label>
					<input type='text' id="dosage" name='dosage'/>	
					<label class="side" for="type">Type:</label>
					<select id="type" class="side" name='type'>
					<?php
					while ($row = $type->fetch()) {
					?>
						<option value=<?php echo($row['code']);?>><?php echo($row['value']);?></option>
						<?php 
						} 
						?>
					</select>
					<div id="input"></div>
					<label class="side" for="freq">Frequency:</label>
					<select class="side" id="freq" name='freq'>
					<?php
					while ($row = $stmt->fetch()) {
					?>
						<option value=<?php echo($row['code']);?>><?php echo($row['value']);?></option>
						<?php 
						} 
						?>
					</select>
					<label for="date">Presciption Date:</label>
					<input id="date" type='date' id="date" name='date' />
					<label for='provider'>Health Care Provider:</label>
					<input type='text' id="provider" name='provider'/>
					<label for="comment">Comments:</label>
					<textarea id="comment" name='comment' cols="100"></textarea>
					<label for="instructions">Instructions:</label>
					<textarea id="instructions" name='instruction' cols="100"></textarea>
					<input type='submit' value="Add" /> 
					<a class="btn" href="menu.php">Back</a>
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
		<script src="js/date.js"></script>
	</body>
</html>