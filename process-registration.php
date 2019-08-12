<?php

session_start();

// check if the inputs are set and not null, else redirect to registration form
if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) 
	&& !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['role'])) {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];
} else {
	header("Location: register.php");
	exit();
}

$dsn = "mysql:host=localhost;dbname=converyj_mymedlist;charset=utf8mb4";
$dbusername = "converyj";
$dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $dbusername, $dbpassword); 

// check if user is already in user table 
$stmt = $pdo->prepare("
						SELECT * FROM `user`
						WHERE `user`.`username` = '$username' 
						AND `user`.`email` = '$email' ");
$stmt->execute();

// if user exists, display message, otherwise insert user
if ($row = $stmt->fetch()) {
	echo("User already exists"); ?>
	<a href="login.html">Go to login</a>
<?php 
} else {
	$stmt = $pdo->prepare("
							INSERT INTO `user` 
							(`firstName`, `lastName`, `email`, `username`, `password`)
							VALUES ('$firstName', '$lastName', '$email', '$username', '$password'); ");
	$i = $stmt->execute();

	// check if the insert was successful or not 
	if ($i == 1) {

		// get the userid that was inserted
		$userid = $pdo->lastInsertId();

		// save information to SESSION
		$_SESSION['userid'] = $userid;
		$_SESSION['firstName'] = $firstName;
		$_SESSION['lastName'] = $lastName;

		// insert user role in userrole table 
		$stmt = $pdo->prepare("
								INSERT INTO `userrole` 
								(`userid`, `role`)
								VALUES ($userid, $role); ");
		$i = $stmt->execute();

		// check if the insert was successful or not 
		if ($i == 1) {

			// if user is a patient 
			if ($role == 1) {

				// insert user into patientlist 
				$stmt = $pdo->prepare("
										INSERT INTO `patientlist` 
										(`userid`)
										VALUES ($userid); ");
				$i = $stmt->execute();

				if ($i == 1) {

					// get the listid that was inserted
					$listid = $pdo->lastInsertId();

					$_SESSION['listid'] = $listid;

					// save patient information to new SESSION variable to distinguish patient against caregiver
					$_SESSION['patientid'] = $userid; 
					$_SESSION['patientfName'] = $firstName;
					$_SESSION['patientlName'] = $lastName;
					$_SESSION['logged-in'] = true;
					$_SESSION['role'] = $role;
					header("Location: menu.php");
					exit();
				} else {
					$message = "Error: Could not insert the record into patientlist";
					header("Location: error.php?message= " . $message);
					exit();
				}
			}			

			// if caregiver, redirect to menu2
			if ($role == 2) {
				$_SESSION['logged-in'] = true;
				$_SESSION['role'] = $role;
				header("Location: menu2.php");
				exit();
			} 
		
		} else {
			$message = "Error: Could not insert the record into userrole";
			header("Location: error.php?message= " . $message);
			exit();
		}	
	} else {
		$message = "Error: Could not insert the record into user";
		header("Location: error.php?message= " . $message);
		exit();
	}
}
  
?>