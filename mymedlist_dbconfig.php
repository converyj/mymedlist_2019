<?php

// $dsn = "mysql:host=gator3001.hostgator.com;dbname=jaimecon_portfolio;charset=utf8mb4";
// $dbusername = "jaimecon_db";
// $dbpassword = "HUgT86Fga#97";

// $pdo = new PDO($dsn, $dbusername, $dbpassword);

$user = 'root';
$pass = '';

$db = 'jaimecon_mymedlist_2019';

$dsn = "mysql:host=localhost;dbname=" . $db  . ";charset=utf8mb4";
// $dbusername = "converyj";
// $dbpassword = "HUgT86Fga#97";

$pdo = new PDO($dsn, $user, $pass); 
