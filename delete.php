<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$listid = $_SESSION['listid']; 
$medid = $_GET['id']; 

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// select the record to delete
$stmt = $pdo->prepare("
						SELECT `name`, `dose`, `date`, `healthCareProvider`, `comment`, `instructions`, `f`.`value` AS frequency, `t`.`value` AS type 
						FROM `medlist`
						LEFT OUTER JOIN `medvalue` f ON `medlist`.`frequency` = `f`.`code` 
						LEFT OUTER JOIN `medvalue` t ON `medlist`.`type` = `t`.`code` 
						WHERE `medlist`.`listid` = $listid
						AND `medlist`.`medid` = $medid");

$stmt->execute();

$row = $stmt->fetch(); 

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
				<h1>Delete Medication</h1>	
				<p>Are you sure you want to delete this medication?</p>	
				<p>Name: <input type='text' name='name' value="<?php echo($row["name"]);?>"/></p>
				<p>Dosage: <input type='text' name='dosage' value="<?php echo($row["dose"]);?>"/></p>
				<p class="side">Type: <input type='text' name='type' value="<?php echo($row["type"]);?>"/></p>
				<p clss="side">Frequency: <input type='text' name='freq' value="<?php echo($row["frequency"]);?>"/></p>
				<p>Presciption Data: <input type='date' name='date' value="<?php echo($row["date"]);?>"/></p> 	
				<p>Comments: <textarea name='comment' cols="100"><?php echo($row["comment"]); ?></textarea></p>
				<p>Instructions: <textarea name='instruction' cols="100"><?php echo($row["instructions"]); ?></textarea></p>
				<a class="btn" href="displayList.php">Back</a>
				<a class="btn" href="process-delete.php?func=1&id=<?php echo($medid); ?>">Move to History</a>
				<a class="btn" href="process-delete.php?func=2&id=<?php echo($medid); ?>">Move to Trash</a>
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