<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$listid = $_SESSION['listid']; 
$medid = $_GET['id']; 
$func = $_GET['func'];

include_once("mymedlist_dbconfig.php");	


// from displayList
if ($func == 1) {
	// select medication record 
	$stmt = $pdo->prepare("
							SELECT `name`, `dose`, `units`, `date`, `healthCareProvider`, `comment`, `instructions`, `f`.`value` AS frequency, `t`.`value` AS type 
							FROM `medlist`
							LEFT OUTER JOIN `medvalue` f ON `medlist`.`frequency` = `f`.`code` 
							LEFT OUTER JOIN `medvalue` t ON `medlist`.`type` = `t`.`code` 
							WHERE `medlist`.`listid` = $listid
							AND `medlist`.`medid` = $medid");

	$stmt->execute();

	$row = $stmt->fetch(); 
// from history
} else {
	// select medication record 
	$stmt = $pdo->prepare("
							SELECT `name`, `dose`, `units`, `date`, `healthCareProvider`, `comment`, `instructions`, `f`.`value` AS frequency, `t`.`value` AS type 
							FROM `history`
							LEFT OUTER JOIN `medvalue` f ON `history`.`frequency` = `f`.`code` 
							LEFT OUTER JOIN `medvalue` t ON `history`.`type` = `t`.`code` 
							WHERE `history`.`listid` = $listid
							AND `history`.`medid` = $medid");

	$stmt->execute();

	$row = $stmt->fetch(); 
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
				<h1>More Details</h1>			
				<p>Name: <input type='text' name='name' value="<?php echo($row["name"]);?>"/></p>
				<p>Units: <input type='text' name='units' value="<?php echo($row["units"]);?>"/></p>
				<p>Dosage: <input type='text' name='dosage' value="<?php echo($row["dose"]);?>"/></p>
				<p class="side">Type: <input type='text' name='type' value="<?php echo($row["type"]);?>"/></p>
				<p clss="side">Frequency: <input type='text' name='freq' value="<?php echo($row["frequency"]);?>"/></p>
				<p>Presciption Data: <input type='date' name='date' value="<?php echo($row["date"]);?>"/></p>
				<p>Comments: <textarea name='comment' cols="100"><?php echo($row["comment"]); ?></textarea></p>
				<p>Instructions: <textarea name='instruction' cols="100"><?php echo($row["instructions"]); ?></textarea></p>
				<?php
				if ($func == 1) {
				?>
					<a class="btn" href="displayList.php">Back</a>
				<?php
				} else {
				?>
					<a class="btn" href="medHistory.php">Back</a>
				<?php
				}
				?>				
			</main>
		</div>
		
		<?php
		include_once("footer.php");
		?>
		
		<script src=js/script.js></script>
	</body>
</html>