<?php 

session_start(); 

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

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
				<?php 
				include_once("nav.php");	
				?>
			</header>
			<main>
				<h1>Add Patient</h1>
				<p>Enter Patient Information</p>
				<form method='POST' action='process-patient.php'>  
					<label>First Name:</label><input type='text' name='firstName'/>     
					<label>Last Name:</label><input type='text' name='lastName'/>
					<label>Email:</label><input type='text' name='email'/>    
					<input type='submit' value="Add"/> 
					<a href="menu2.php" class="btn">Cancel</a>
				</form>
			</main>
		</div>
		
		<?php
		include_once("footer.php");
		?>
		
		<script src="js/script.js"></script>
	</body>
</html>