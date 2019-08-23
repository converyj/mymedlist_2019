<?php 

include_once("mymedlist_dbconfig.php");

// populate the role dropdown list with different roles (patient or caregiver)
$stmt = $pdo->prepare("
						SELECT * 
						FROM `medvalue` 
						WHERE `medvalue`.`type` = 'role'");

$stmt->execute();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
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
				<h1>Sign In</h1>
				<p>Sign In if you already have an account, if not <span><a href="register.php">join</a></span> today!</p>
				<form method='POST' action='process-login.php'>  
					<label>Email:</label><input type='email' name='email' required autofocus />     
					<label>Password:</label><input type='text' name='password' required />
					<label>Role:</label><select name="role">
					<?php
					while ($row = $stmt->fetch()) {
					?>
						<option value=<?php echo($row['code']);?>><?php echo($row['value']);?></option>
					<?php 
					} 
					?>
					</select>     
					<input type='submit' value="Sign In"/> 
				</form>
			</main>	
			
			<?php
			include_once("footer.php");
			?>
			
			<script src="js/script.js"></script>
		</div>		
	</body>
</html>