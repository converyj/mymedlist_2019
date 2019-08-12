<?php 

session_start(); 

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

// if user is patient, redirect to menu
if ($_SESSION['role'] == 1) {
	header("Location: menu.php"); 
}

// get values from SESSION
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$role = $_SESSION['role'];

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
				<h1>Hello, <?php echo($firstName . " " . $lastName); ?></h1>
				<section id="menu">
					<div id="one">
						<img src="images/patientlist.png" alt="lists" />
						<h2><a href="showLists.php">See Patients' List</a></h2>
						<p>Manage your patients' list of medications</p>
					</div>
					<div id="two">
						<img src="images/maintainpatients.jpg" alt="patients" />
						<h2><a href="maintainPatients.php">Maintain Patients</a></h2>
						<p>Manage your patients' contact information</p>
					</div>
				</section>
			</main>
			<footer>
				<ul>
					<li><a href="#">Contact Us</a></li>
				</ul>
				<p>&copy; Copyright 2018 | All rights</p>
			</footer>
		</div>
		<script src=js/script.js></script>
	</body>
</html>