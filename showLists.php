<?php

session_start();

// if user is not logged in, redirect back to home
if ($_SESSION["logged-in"] == false) {
	header("Location: home.php");
	exit();
}

// get the information from SESSION
$role = $_SESSION['role']; 
$userid = $_SESSION['userid'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];

include_once("mymedlist_dbconfig.php");	


// set title of caregiver 
$title = $firstName . " " . $lastName . "'s Patients List"; 

// SELECT all caregiver's patients 
$stmt = $pdo->prepare("
						SELECT `patientlist`.`userid`, `user`.`firstName`, `user`.`lastName`, `caregiverpatientlist`.`listid`
						FROM `caregiverpatientlist` 
						INNER JOIN `patientlist` ON `caregiverpatientlist`.`listid` = `patientlist`.`listid`
						INNER JOIN `user` ON `patientlist`.`userid` = `user`.`userid`");

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
				<h1><?php echo($title); ?></h1>
				<label>Search:</label><input type="search" name="search" id="myInput" class="myInput" />
				<table id="myList">
					<tr>
						<th>Patients</th>
					</tr>
					<?php 
					$numRows = 0;
					while ($row = $stmt->fetch()) { 
						$numRows++; 
					?>		
						<tr>
							<td>
								<a href="displayList.php?id=<?php echo($row["userid"]); ?>&&list=<?php echo($row["listid"]); ?>&&fname=<?php echo($row["firstName"]); ?>&&lname=<?php echo($row["lastName"]); ?>&&page=showList"><?php echo($row["firstName"] . " " . $row["lastName"]); ?></a> 
							</td>
						</tr>
					<?php 
					} 
					if ($numRows == 0) {
					?>
					<tr>
						<td colspan="2">Empty List. Add Patients</td>
					</tr>
				<?php 
				} 
				?>
				</table>
				<a class="btn" href="menu2.php">Back</a>
				<a class="btn" href="patients.php">Add</a>
			</main>
		</div>
		
		<?php
		include_once("footer.php");
		?>
		
		<script src="js/script.js"></script>
		<script src="js/filter.js"></script>
	</body>
</html>