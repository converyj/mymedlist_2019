<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

$listid = $_SESSION['listid'];
$role = $_SESSION['role']; 
$userid = $_SESSION['userid'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$patientFirstName = $_SESSION['patientfName']; 
$patientLastName = $_SESSION['patientlName']; 

include_once("mymedlist_dbconfig.php");	


// SELECT and save user's email to be able to send their medlist to them 
$stmt = $pdo->prepare("
						SELECT `email`
						FROM `user`
						WHERE `user`.`userid` = $userid");

$stmt->execute();

$row = $stmt->fetch();

// save user's email 
$email = $row['email'];

// set title of patient
$title = $patientFirstName . " " . $patientLastName . "'s Medication List";

// set subject of email
$subject = "Medication List for" . " " . $patientFirstName . " " . $patientLastName;

// select user's medications ordering by type 
$stmt = $pdo->prepare("
						SELECT `name`, `dose`, `units`, `date`, `f`.`value` AS frequency, `t`.`value` AS type 
						FROM `medlist`
						LEFT OUTER JOIN `medvalue` f ON `medlist`.`frequency` = `f`.`code` 
						LEFT OUTER JOIN `medvalue` t ON `medlist`.`type` = `t`.`code` 
						WHERE `medlist`.`listid` = $listid
						ORDER BY `medlist`.`type`");
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
		<link rel="stylesheet" type="text/css" media="print" href="css/print.css">
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
				<div id="toPDF">
					<h1><?php echo($title); ?></h1><hr>

					<!-- if user has any medications, display them  -->
					<?php 
					$numRows = 0;
					$subtitle = ""; 
					while ($row = $stmt->fetch()) { 
						if ($subtitle != $row['type']) {
						?>
						<table id="myList">
							<h2><?php echo($row['type']);?></h2>
							
								<tr>
									<th>Name</th>
									<th>Units</th>
									<th>Dosage</th>
									<th>Frequency</th>
									<th>Prescription Date</th>
								</tr>
						<?php
						}
						$numRows++;
						$subtitle = $row['type'];		 
						?>
						<tr>
							<td data-label="Name"><?php echo($row['name']);?></td>
							<td data-label="Units"><?php echo($row['units']);?></td>
							<td data-label="Dosage"><?php echo($row['dose']);?></td>
							<td data-label="Frequency"><?php echo($row['frequency']);?></td>
							<td data-label="Prescription Date"><?php echo($row['date']);?></td>
						</tr>
					<?php 
					}
					?>
				</table>
			</div>
				<a class="btn" href="displayList.php">Back</a>
				<button class="btn" id="mail" onclick="mailTo('<?php echo($email); ?>', '<?php echo($subject); ?>');">Email</button>
				<button id="print" class="btn">Print</button>
				<!-- <button type="button" onclick="printJS('toPDF', 'html')"> 
    Print PDF
 </button> -->
			</main>
		</div>
		
		<?php
		include_once("footer.php");
		?>
	
		<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>		
		<script src="js/script.js"></script>
		<script src="js/print.js"></script>
		<script src="js/email.js"></script>
	</body>
</html>