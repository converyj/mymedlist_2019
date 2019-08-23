<?php

session_start();


// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

// get the information from SESSION
$role = $_SESSION['role']; 
$userid = $_SESSION['userid'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// set title of caregiver 
$title = $firstName . " " . $lastName . "'s Patients"; 

// SELECT all caregiver's patients 
$stmt = $pdo->prepare("
						SELECT `user`.`firstName`, `user`.`lastName`, `email`, `caregiverpatientlist`.`listid`
						FROM `caregiverpatientlist` 
						INNER JOIN `patientlist` ON `caregiverpatientlist`.`listid` = `patientlist`.`listid`
						INNER JOIN `user` ON `patientlist`.`userid` = `user`.`userid`");

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
								<a href="menu2.php">Menu</a>
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
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
					<?php 
					$numRows = 0;
					while ($row = $stmt->fetch()) {  
						$numRows++;
					?>		
						<tr>
							<td><?php echo($row['firstName']);?></td>
							<td><?php echo($row['lastName']);?></td>
							<td><?php echo($row['email']);?></td>
							<td><span><a class="deletePatient" href="process-deletePatient.php?list=<?php echo($row['listid']); ?>">Delete</a></span></td>
						</tr>
					<?php 
					}
					if ($numRows == 0) {
					?>
					<tr>
						<td colspan="4">Empty List. Add Patients</td>
					</tr>
				<?php 
				} 
				?>
				</table>
				<a class="btn" href="menu2.php">Back</a>
				<a class="btn" href="patients.php">Add</a>
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