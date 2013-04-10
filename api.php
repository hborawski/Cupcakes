<?php

	//api.php
	include "CONST.php";


	$func = $_POST['function'];



	function newUser($email,$verifyEmail,$password, $verifyPassword){
		/*
		 * Return Types
		 * ------------
		 *-1 - indicates unknown error encountered
		 * 0 - indicates account creation success and email sent successfully
		 * 1 - indicates account already created
		 * 2 - indicates email fields don't match
		 * 3 - indicates password fields don't match
		 * 4 - indicates email and password fields both don't match (may not need this, idk)
		 * 5 - indicates non-RIT email (use some regex to determine this?)
		 * n - any other possible issue you can think of that we need to handle
		 */
		//$query = "INSERT INTO users (Email, Password, Time, Confirmed, Hash) VALUES('$email', '$password', '$time', '0', '$hash')";
		$return = -1;
		mysql_connect($mysql_host, $mysql_user, $mysql_password);
		@mysql_select_db($mysql_database);
		$query = "SELECT * FROM users WHERE Email='$email'";
		$numUsers = mysql_num_rows(mysql_query($query));
		if($numUsers>0){
			$return = 1;
		}elseif((strcmp($email,$verifyEmail)==0) && (strcmp($password,$verifyPassword)==0)){
			$time = date("H:i:s");
			$hash = hash("md5",$email . $time);
			$query = "INSERT INTO users (Email, Password, Time, Confirmed, Hash) VALUES('$email', '$password', '$time', '0', '$hash')";
			mysql_query($query);
			$message = "Confirmation link: " . $confirmationUrl . $hash;
			mail($email, "Cupcakes Confirmation", $message, "Cupcakes");
			mysql_close();
			$return = 0;
		}elseif((strcmp($email,$verifyEmail)!= 0 && (strcmp($password,$verifyPassword)!=0)){
			$return = 4;
		}elseif((strcmp($email,$verifyEmail)!=0)){
			$return = 2;
		}elseif((strcmp($password,$verifyPassword)!=0)){
			$return = 3;
		}elseif(){
			
		}


		echo "$return";
	}
?>