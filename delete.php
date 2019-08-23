<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$listid = $_SESSION['listid']; 
$medid = $_GET['id']; 

include_once("../../mymedlist_dbconfig.php");

// select the record to delete
$stmt = $pdo->prepare("
						SELECT `name`, `dose`, `units`, `date`, `healthCareProvider`, `comment`, `instructions`, `f`.`value` AS frequency, `t`.`value` AS type 
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
				<?php
				include_once("nav.php");
				?> 
			</header>
			<main>
				<h1>Delete Medication</h1>	
				<p>Are you sure you want to delete this medication?</p>	
				<p>Name: <input type='text' name='name' value="<?php echo($row["name"]);?>"/></p>
				<p>Dosage: <input type='text' name='dosage' value="<?php echo($row["dose"]);?>"/></p>
				<p>Units: <input type='text' name='units' value="<?php echo($row["units"]);?>"/></p>
				<p class="side">Type: <input type='text' name='type' value="<?php echo($row["type"]);?>"/></p>
				<p clss="side">Frequency: <input type='text' name='freq' value="<?php echo($row["frequency"]);?>"/></p>
				<p>Presciption Data: <input type='date' name='date' value="<?php echo($row["date"]);?>"/></p> 	
				<p>Comments: <textarea name='comment' cols="100"><?php echo($row["comment"]); ?></textarea></p>
				<p>Instructions: <textarea name='instruction' cols="100"><?php echo($row["instructions"]); ?></textarea></p>
				<a class="btn" href="displayList.php">Back</a>
				<a class="btn" href="process-delete.php?func=1&id=<?php echo($medid); ?>">Move to History</a>
				<a class="btn" href="process-delete.php?func=2&id=<?php echo($medid); ?>">Move to Trash</a>
			</main>
		</div>

		<?php
		include_once("footer.php");
		?>
		
		<script src="js/script.js"></script>
	</body>
</html>