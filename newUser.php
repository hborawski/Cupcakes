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
	
	/*
	 * Return Types
	 * ------------
	 * 0 - indicates account creation success and email sent successfully
	 * 1 - indicates account already created
	 * 2 - indicates email fields don't match
	 * 3 - indicates password fields don't match
	 * 4 - indicates email and password fields both don't match (may not need this, idk)
	 * 5 - indicates non-RIT email (use some regex to determine this?)
	 * n - any other possible issue you can think of that we need to handle
	 */
	//Returns failure or success
	$returnVal = "success";
	if($users ==0){
		$query = "INSERT INTO users (Email, Password, Time, Confirmed, Hash) VALUES('$email', '$password', '$time', '0', '$hash')";
		mysql_query($query);
		$message = "Confirmation link: " . $confirmationUrl . $hash;
		mail($email, "Cupcakes Confirmation", $message, "Cupcakes");
	}else{
		//Failure indicates that the email already exists in the database
		$returnVal = "failure";
	}

	echo "$returnVal";
?>