<?php 

include_once("../../mymedlist_dbconfig.php");

// populate the role dropdown list with different roles (patient or caregiver)
$stmt = $pdo->prepare("
						SELECT * FROM `medvalue` 
						WHERE `medvalue`.`type` = 'role'");

$stmt->execute();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" media="screen and (min-width:768px)" href="css/tablet.css">
		<link rel="stylesheet" media="screen and (min-width:1024px)" href="css/desktop.css">
		<link rel="shortcut icon" type="image/jpg" href="images/logo.jpg" />
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<header>
				<?php 
				include_once("nav.php");	
				?>
			</header>
			<main class="cred">
				<h1>Join</h1>
				<p>Create an account if you are a new user</p>
					<form class="register" method='POST' action='process-registration.php'>     
						<label>First Name:<input class="fname" type='text' name='firstName' required autofocus />  </label>   
						<label>Last Name:<input class="lname" type='text' name='lastName' required /> </label>  
						<label>Email:<input class="email" type='email' name='email' required /> </label>
						<label>Password:<input class="pass" type='text' name='password' required /> </label> 
						<label>Role:<select class="role" name="role"></label>
						<?php
						while ($row = $stmt->fetch()) {
						?>
							<option value=<?php echo($row['code']);?>><?php echo($row['value']);?></option>
						<?php 
						} 
						?>
						</select>
						<input class="button" type='submit' value="Join" /> 
					</form>		
			</main>
			
			<?php
			include_once("footer.php");
			?>

			<script src="js/script.js"></script>
		</div>			
	</body>
</html>