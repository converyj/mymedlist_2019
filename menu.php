<?php 

session_start(); 

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

// if user is caregiver, redirect to menu
if ($_SESSION["role"] == 2) {
	header("Location: menu2.php");
	exit();
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
				<h1>Hello, <?php echo($firstName . " " . $lastName); ?></h1>
				<section id="menu">
					<div id="one">
						<img src="images/addmed.jpg" alt="medications" />
						<h2><a href="medForm.php">Add Medications</a></h2>
						<p>Add Medications to your list</p>
					</div>
					<div id="two">
						<img src="images/list.jpg" alt="list" />
						<h2><a href="displayList.php">Go to Medication List</a></h2>
						<p>Go to your Medication List to see all your medications</p>
					</div>
					<div id="three">
						<img src="images/medicalrecord.jpg" alt="history" />
						<h2><a href="medHistory.php">See Medication History</a></h2>
						<p>Go to your Medication History to see what you have taken before</p>
					</div>
				</section>
				<?php 
					if ($role == 2) {
					?>
						<a href="menu2.php" class="btn">Back</a>
					<?php 
					}
					?>
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