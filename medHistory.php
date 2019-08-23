<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$firstName = $_SESSION['firstName']; 
$lastName = $_SESSION['lastName'];
$userid = $_SESSION['userid'];
$listid = $_SESSION['listid'];
$patientFirstName = $_SESSION['patientfName']; 
$patientLastName = $_SESSION['patientlName']; 

include_once("../../mymedlist_dbconfig.php");	

// select the user's medications from history and set the title of user
$stmt = $pdo->prepare("
						SELECT `medid`, `name`, `dose`, `units`, `date`, `f`.`value` AS frequency, `t`.`value` AS type 
						FROM `history`
						LEFT OUTER JOIN `medvalue` f ON `history`.`frequency` = `f`.`code` 
						LEFT OUTER JOIN `medvalue` t ON `history`.`type` = `t`.`code` 
						WHERE `history`.`listid` = $listid");

$stmt->execute();

// set patient title 
$title = $patientFirstName . " " . $patientLastName . "'s Medication History"; 

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
				<h1><?php echo($title); ?></h1>
				<label>Search:</label><input type="search" name="search" id="myInput" class="myInput" />	
				<table id="myList">
					<tr>
						<th>Name</th>
						<th>Units</th>
						<th>Dosage</th>
						<th>Frequency</th>
						<th>Type</th>
						<th>Prescription Date</th>
						<th colspan="3">Action</th>
					</tr>
					<?php
					$numRows = 0; 
					while ($row = $stmt->fetch()) { 
						$numRows++;
					?>		
						<tr>
							<td data-label="Name"><?php echo($row['name']);?></td>
							<td data-label="Units"><?php echo($row['units']);?></td>
							<td data-label="Dosage"><?php echo($row['dose']);?></td>
							<td data-label="Frequency"><?php echo($row['frequency']);?></td>
							<td data-label="Type"><?php echo($row['type']);?></td>
							<td data-label="Prescription"><?php echo($row['date']);?></td>
							<td><span><a href="showMore.php?func=2&id=<?php echo($row['medid'])?>">More</a></span></td>
						</tr>
					<?php 
					} 
					if ($numRows == 0) {
					?>
						<tr>
							<td colspan="6">No History Found</span></td>
						</tr>
					<?php
					}
					?>
				</table>
				<a class="btn" href="displayList.php">Back To List</a>
				<span><a href="#" onclick="pdf();return false;">Download PDF Version</a><span>
			</main>
		</div>
		
		<?php
		include_once("footer.php");
		?>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>		
		<script src="js/script.js"></script>
		<script src="js/filter.js"></script>
		<script src="js/email.js"></script>
	</body>
</html>