<?php 

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// populate the role dropdown list with different roles (patient or caregiver)
$stmt = $pdo->prepare("
						SELECT * FROM `medvalue` 
						WHERE `medvalue`.`type` = 'role'");

$stmt->execute();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" media="screen and (min-width:768px)" href="css/tablet.css">
		<link rel="stylesheet" media="screen and (min-width:1024px)" href="css/desktop.css">
		<link rel="shortcut icon" type="image/jpg" href="images/logo.jpg" />
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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
						<li>
							<a href="login.php">Sign In</a>
						</li>
						<li>
							<a href="register.php">Register</a>
						</li>						
	 				</ul>
				</nav>
			</header>
			<main>
				<h1>Register</h1>
				<p>Create an account if new, if not <span><a href="login.php">sign in</a></span></p>
					<form method='POST' action='process-registration.php'>     
						<label>First Name:</label><input type='text' name='firstName'/>     
						<label>Last Name:</label><input type='text' name='lastName'/>   
						<label>Email:</label><input type='email' name='email'/> 
						<label>Username:</label><input type='text' name='username'/> 
						<label>Password:</label><input type='text' name='password'/>  
						<label>Role:</label><select name="role">
						<?php
						while ($row = $stmt->fetch()) {
						?>
							<option value=<?php echo($row['code']);?>><?php echo($row['value']);?></option>
						<?php 
						} 
						?>
						</select>
						<input type='submit' value="Sign In" /> 
					</form>		
			</main>
			<footer>
				<ul>
					<li><a href="#">Contact Us</a></li>
				</ul>
				<p>&copy; Copyright 2018 | All rights</p>
			</footer>
			<script src="js/script.js"></script>
		</div>			
	</body>
</html>