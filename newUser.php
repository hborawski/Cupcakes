<?php
	//Inserts a new user into the database as unconfirmed and sends the confirmation email
	include "CONST.php";
	mysql_connect($mysql_host, $mysql_user, $mysql_password);
	@mysql_select_db($mysql_database);
	$email=mysql_real_escape_string($_POST["email"]);
	$password=mysql_real_escape_string($_POST["password"]);
	$time = date("H:i:s");
	$hash = hash("md5", $email . $time);

	$query = "SELECT * FROM users WHERE Email='$email'";
	$users = mysql_num_rows(mysql_query($query));

	//Returns failure or success
	$returnVal = "success";
	if($users ==0){
		$query = "INSERT INTO users (Email, Password, Time, Confirmed, Hash), VALUES('$email', '$password', '$time', '0', '$hash')";
		mysql_query($query);
		$message = "Confirmation link: " . $confirmationUrl . $hash;
		mail($email, "Cupcakes Confirmation", $message, "Cupcakes");
	}else{
		//Failure indicates that the email already exists in the database
		$returnVal = "failure";
	}

	echo "$returnVal";
?>