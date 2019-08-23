<?php

include_once('mymedlist_dbconfig.php'); 

// $document = $_POST['doc'];
$mailTo = $_POST['mailTo'];  
$subject = $_POST['subject']; 

// require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'C:\xampp\htdocs\mymedlist_2019\PHPMailer-master\src\Exception.php';

/* The main PHPMailer class. */
require 'C:\xampp\htdocs\mymedlist_2019\PHPMailer-master\src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'C:\xampp\htdocs\mymedlist_2019\PHPMailer-master\src\SMTP.php';

$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
try {
    /* Set the mail sender. */
    $mail->setFrom($mailTo);
 
    /* Add a recipient. */
    $mail->addAddress($mailTo);
 
    /* Set the subject. */
    $mail->Subject = $subject;
 
    /* Set the mail message body. */
    $mail->Body = file_get_contents("sendForm.php");
 
    /* Finally send the mail. */
    $mail->send();

    echo($mailTo);
    echo($subject);
    echo($list);


 }
 catch (Exception $e)
 {
    /* PHPMailer exception. */
    echo $e->errorMessage();
 }
 catch (\Exception $e)
 {
    /* PHP exception (note the backslash to select the global namespace Exception class). */
    echo $e->getMessage();
 }
?>