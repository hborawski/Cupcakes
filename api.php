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


	function newItem($user,$name,$description, $price,$available,$quantity,$uploadedFile,$filename){
		$url = $filename;
		$return = 0;
		if(strlen($description)>500){
			$return = -1;
		}else{
			move_uploaded_file($_FILES["upload"]["tmp_name"],"images/" . $filename );
			echo "Stored in: " . "images/" . $_FILES["upload"]["name"];
			mysql_connect($mysql_host,$mysql_user,$mysql_password);
			@mysql_select_db($mysql_database);
			$query = "INSERT INTO items (Name, Description, Price, Available, SaleType, Quantity,  URL, User) VALUES('$name','$description','$price','$avail',0,'$num','$url','$user')";

			mysql_query($query);

			mysql_close();
		}
		echo "$return";


	}

	function logout(){
		session_start();
		if(isset($_SESSION['permission'])){
			unset($_SESSION['permission']);
		}


		session_destroy();
	}

	function sendMail($from, $subject, $message){
		$from = "From: ".$from;
		mail($ourEmail, $subject,$message,$from);
	}


	function login($userName, $password){
		$return = 0;

		mysql_connect($mysql_host,$mysql_user,$mysql_password);
		@mysql_select_db($mysql_database);
		$confirm = 0;
		$query = "SELECT * FROM users WHERE Email='$userName' AND Password='$password' AND Confirmed>'$confirm'";
		$result = mysql_query($query);
		$count = mysql_num_rows($result);

		if($count ==1){
			$permission = mysql_result($result, 0,"Confirmed");
			session_start();
			$_SESSION['permission']= $permission;
		}else{
			$return = -1;
		}

		echo "$return";
	}
?>