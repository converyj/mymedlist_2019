<?php

// destroy the session and redirect to home
session_start();
session_destroy();

header("Location: home.php");
exit();
?>