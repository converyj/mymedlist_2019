<?php 

session_start();

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
				<section id="banner">
				</section>
				<section id="desc">
					<h2>Join Today!</h2>
					<p>MyMedList is designed to help patients manage their 
					medications to make it easier for themselves to track and help
					healthcare providers treat them better</p>
				</section>
				<section id="features">
					<div id="tracking">
						<div class="separator">
							 &nbsp;
						</div>
						<div>
							<p class="subtitle">Medication Tracking</p>
							<p class="heading">Medication Management Made Easy</p>
							<p>Managing all your medications is important. MyMedList helps you keep track of your medications by storing it all in one list. The app also goes above and beyond and tracks your history of the medications you've taken. So when things change, you will always have a record of it.</p>
						</div>
						<div>
							<img src="images/medications.jpg" alt="image">
						</div>
					</div>
					<div id="sharing">
						<div class="separator">
							 &nbsp;
						</div>
						<div>
							<p class="subtitle">Sharing and Communication</p>
							<p class="heading">Sharing with others</p>
							<p>It is important to keep your health care providers and caregivers up to date with your latest medications especially when things change. MyMedList makes it easy allowing you to share your list via email or by printing it out.</p>
						</div>
						<div>
							<img src="images/sharing.jpg" alt="image">
						</div>
					</div>
				</section>
			</main>
		</div>
		
		<?php
		include_once("footer.php");
		?>
		
		<script src="js/script.js"></script>
	</body> 
</html>