<?php 

session_start();

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
							if (isset($_SESSION['logged-in'])) {
							?>
								<li>
									<a href="menu.php">Menu</a>
								</li>
								<li>
									<a href="logout.php">Logout</a>
								</li>
							<?php 
							} else { 
							?>
								<li>
									<a href="login.php">Sign In</a>
								</li>
								<li>
									<a href="register.php">Register</a>
								</li>
							<?php
							}
						?>							
	 				</ul>
				</nav>
			</header>
			<main>
				<section id="banner">
				</section>
				<section id="desc">
					<h2>Try Our App Now</h2>
					<p>MyMedList is designed to help patients manage their 
					medications to make it easier for themselves and 
					healthcare providers</p>
				</section>
				<section id="features">
					<div id="tracking">
						<div class="separator">
							 &nbsp;
						</div>
						<div>
							<p class="subtitle">Medication Tracking</p>
							<p class="heading">Medication Management Made Easy</p>
							<p>Managing all your medications is important. MyMedList helps you by only having one list to keep track of your medications.  The app goes beyond and tracks your history of the medications you've taken. So when things change, you will always have a record of it.</p>
						</div>
						<div>
							<img src="images/medications.jpg" alt="image">
						</div>
					</div>
					<div id="sharing">
						<div class="separator">
							 &nbsp;
						</div>
						<div>
							<p class="subtitle">Sharing and Communication</p>
							<p class="heading">Sharing with others</p>
							<p>It is important to keep your health care providers and caregivers up to date with your latest medications especially when things change. MyMedList makes it easy allowing you to share your list.</p>
						</div>
						<div>
							<img src="images/sharing.jpg" alt="image">
						</div>
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
		<script src="js/script.js"></script>
	</body> 
</html>