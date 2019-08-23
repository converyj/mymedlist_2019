<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

include_once("../../mymedlist_dbconfig.php");	

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
				<?php 
				include_once("nav.php");	
				?>
			</header>
			<main>
				<form action="process-insert.php" method="POST">  
					<h1>Add Medication</h1>
					<p>Fill out this form to add to your medication list</p>		
					<label for="name">Name:</label>
					<input type='text' id="name" name='name' required autofocus />
					<label for="units">Units:</label>
					<input type='text' id="units" name='units' required />
					<label for="dosage">Dosage:</label>
					<input type='text' id="dosage" name='dosage' required />	
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
					<input type='text' id="provider" name='provider' required />
					<label for="comment">Comments:</label>
					<textarea id="comment" name='comment' cols="100" required></textarea>
					<label for="instructions">Instructions:</label>
					<textarea id="instructions" name='instruction' cols="100" required></textarea>
					<input type='submit' value="Add" /> 
					<a class="btn" href="menu.php">Back</a>
				</form>	
			</main>
		</div>
		
		<?php
		include_once("footer.php");
		?>
		
		<script src="js/script.js"></script>
		<script src="js/date.js"></script>
	</body>
</html>