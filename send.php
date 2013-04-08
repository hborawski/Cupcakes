<?php
$from = $_POST['from'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$to = "harrisborawski@me.com";
$from = "From: ".$from;
mail($to, $subject,$message,$from);
header("location:main.html");



?>