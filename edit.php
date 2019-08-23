<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$listid = $_SESSION['listid']; 
$medid = $_GET["id"]; 

include_once("../../mymedlist_dbconfig.php");	

// select the record to edit
$stmt = $pdo->prepare("
						SELECT `name`, `dose`, `units`, `date`, `healthCareProvider`, `comment`, `instructions`, `f`.`value` AS frequency, `t`.`value` AS type 
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
				<?php 
				include_once("nav.php");	
				?>
			</header>
			<main>
				<form action="process-update.php" method="POST">  
					<h1>Update Medication</h1>			
					<input type="hidden" value="<?php echo($medid);?>" name="id"/>
					<label for="name">Name:</label>
					<input type='text' id="name" name='name' value="<?php echo($row1["name"]); ?>"/>
					<label for="units">Units:</label>
					<input type='text' id="units" name='units' value="<?php echo($row1["units"]); ?>"/>
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
		</div>
		
		<?php
		include_once("footer.php");
		?>
		
		<script src="js/script.js"></script>
	</body>
</html>