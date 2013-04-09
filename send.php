<?php
include "CONST.php";
$from = $_POST['from'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$from = "From: ".$from;
mail($ourEmail, $subject,$message,$from);
header("location:main.html");



?>