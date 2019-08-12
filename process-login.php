<?php

session_start();

// check if the inputs are set and not null, else redirect to login form
if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['role'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];
} else {
	header("Location: login.php");
	exit();
}

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// check if user exists in the user table
$stmt = $pdo->prepare("
						SELECT * FROM `user` 
						WHERE `user`.`username` = '$username' 
						AND `user`.`password` = '$password' ");

$stmt->execute();

// if the user exists in the table, save information to SESSION
if($row = $stmt->fetch()) {
	$userid = $row['userid'];
	$firstName = $row['firstName'];
	$lastName = $row['lastName'];

	$_SESSION['userid'] = $userid;
	$_SESSION['firstName'] = $firstName;
	$_SESSION['lastName'] = $lastName;

	// check to see if they registered as the same role in the userrole table  
	$stmt = $pdo->prepare("
							SELECT * 
							FROM `userrole` 
							WHERE `userrole`.`userid` = $userid
							AND `userrole`.`role` = $role ");

	$stmt->execute();
	
	// if row found, save information to SESSION
	if($row = $stmt->fetch()) {
		$_SESSION['logged-in'] = true;
		$_SESSION['role'] = $role;

		// if role is patient, get their list 
		if ($role == 1) {
			$stmt = $pdo->prepare("
									SELECT `listid` 
									FROM `patientlist` 
									WHERE `patientlist`.`userid` = $userid ");

			$stmt->execute();

			if ($row = $stmt->fetch()) {
				$_SESSION['listid'] = $row['listid']; 

				// save patient information to new SESSION variable to distinguish patient against caregiver
				$_SESSION['patientid'] = $userid; 
				$_SESSION['patientfName'] = $firstName;
				$_SESSION['patientlName'] = $lastName;
				header("Location: menu.php");
				exit();
			} else {
				$message = "Error: Do not have a list";
				header("Location: error.php?message= " . $message);
				exit();
			}
		}
			// if role is caregiver, redirect to menu2
		if ($role == 2) {
			header("Location: menu2.php");
			exit();
		}

	// role does not match user
	} else {
		$stmt = $pdo->prepare("
								SELECT `value` 
								FROM `medvalue` 
								WHERE `medvalue`.`code` = $role ");

		$stmt->execute();

		if ($row = $stmt->fetch()) {
			echo("<p>Sorry, you are not registered as " . $row['value'] . ".</p>");
			?>
			<a href="login.php">Go to login</a>
		<?php
		}
	}

} else {
	echo("Username or password not found in user table. Please try again."); ?>
	<a href="login.php">Go back to login</a>
<?php 
} 
?>