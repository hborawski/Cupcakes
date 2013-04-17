<?php
//api.php
include "CONST.php";

$func = $_POST['function'];
mysql_connect($mysql_host, $mysql_user, $mysql_password);
@mysql_select_db($mysql_database);
switch ($func) {
	case 'newUser':
		$email = mysql_real_escape_string($_POST['email']);
		$verifyEmail = mysql_real_escape_string($_POST['verifyEmail']);
		$password = mysql_real_escape_string($_POST ['password']);
		$verifyPassword = mysql_real_escape_string($_POST['verifyPassword']);
		newUser($email, $verifyEmail,$password,$verifyPassword);
		break;
	case 'newItem':
		$name = mysql_real_escape_string($_POST['email']);
		$description = mysql_real_escape_string($_POST['description']);
		$price = mysql_real_escape_string($_POST['price']);
		$available = mysql_real_escape_string($_POST['available']);
		$quantity = mysql_real_escape_string($_POST['quantity']);
		$uploadedFile = mysql_real_escape_string($_POST['uploadedFile']);
		$filename = mysql_real_escape_string($_POST['filename']);
		newItem($name,$description,$price,$available,$quantity,$uploadedFile,$filename);
		break;
	case 'logout':
		logout();
		break;
	case 'sendMail':
		$from = mysql_real_escape_string($_POST['from']);
		$subject = mysql_real_escape_string($_POST['subject']);
		$message = mysql_real_escape_string($_POST['message']);
		sendMail($from, $subject, $message);
		break;
	case 'login':
		$email = mysql_real_escape_string($_POST['email']);
		$password = mysql_real_escape_string($_POST['password']);
		login($email,$password);
		break;
	case 'changePassword':
		session_start();
		$email = $_SESSION['email'];
		$oldPassword = mysql_real_escape_string($_POST['oldPassword']);
		$newPassword = mysql_real_escape_string($_POST['newPassword']);
		$verifyNewPassword = mysql_real_escape_string($_POST['verifyNewPassword']);
		changePassword($email,$oldPassword,$newPassword, $verifyNewPassword);
		break;
	default:
		//if sent an unknown function name
		echo '-1';
}

function newUser($email,$verifyEmail,$password, $verifyPassword) {
	include "CONST.php";		#Seems necessary as of now
	/*
	 * Return Types
	 * ------------
	 * -1 - indicates unknown error encountered
	 *  0 - indicates account creation success and email sent successfully
	 *  1 - indicates account already created
	 *  2 - indicates email fields don't match
	 *  3 - indicates password fields don't match
	 *  4 - indicates email and password fields both don't match (may not need this, idk)
	 *  5 - indicates non-RIT email (use some regex to determine this?)
	 *  n - any other possible issue you can think of that we need to handle
	 */
	$return = -1;
	mysql_connect($mysql_host, $mysql_user, $mysql_password);
	@mysql_select_db($mysql_database);
	$query = "SELECT * FROM users WHERE Email='$email'";
	$numUsers = mysql_num_rows(mysql_query($query));

	if($numUsers > 0) {
		$return = 1;
	} elseif(strcmp($email, $verifyEmail) != 0) {
		$return = 2;
	} elseif(strcmp($password, $verifyPassword) != 0) {
		$return = 3;
	} elseif((strcmp($email, $verifyEmail) != 0) && (strcmp($password, $verifyPassword) != 0)) {
		$return = 4;
	} elseif(!preg_match('/^[a-zA-Z]{3}\d{4}[@]rit.edu$/', $email)) {
		$return = 5;
	} elseif((strcmp($email,$verifyEmail) == 0) && (strcmp($password,$verifyPassword) == 0)) {
		// crypt($password, '$6$rounds=5000$' . mt_rand() . '$'); -- for future hashing
		$time = date("H:i:s");
		$hash = hash("md5",$email . $time);
		$query = "INSERT INTO users (Email, Password, Time, Confirmed, Hash) VALUES('$email', '$password', '$time', '0', '$hash')";
		mysql_query($query);
		$message = "Confirmation link: " . $confirmationUrl . $hash;
		mail($email, "Cupcakes Confirmation", $message, "Cupcakes");
		mysql_close();
		$return = 0;
	}

	echo "$return";
}

function newItem($name, $description, $price, $available, $quantity, $uploadedFile, $filename) {
	include "CONST.php";
	$url = $filename;
	$return = 0;
	$user = $_SESSION['email'];
	if(strlen($description) > 500) {
		$return = -1;
	} else {
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

function logout() {
	session_start();
	if(isset($_SESSION['permission'])) {
		unset($_SESSION['permission']);
		unset($_SESSION['email']);
	}
	session_destroy();
}

function sendMail($from, $subject, $message) {
	//Sends mail to us for item requests
	$from = "From: " . $from;
	mail($ourEmail, $subject, $message, $from);
}

function login($email, $password) {
	include "CONST.php";
	/* Return values
	* -1 indicates the user could not log in
	*  0 - 2 indicates the permission type
	*/
	$return = -1;
	/*
	 * For future hashing
	 * $output = array();
	 * if (preg_match('/^\$6\$rounds=5000\$\d+\$/', $hash, $output)) {
	 *     $newHash = crypt($password, $output[0]);
	 *     if (strcmp($hash, $newHash) == 0) {
	 *         the usual crap goes here
	 *	   } else {
	 *         $return = -1;
	 *     }
	 * }
	 */
	mysql_connect($mysql_host, $mysql_user, $mysql_password);
	@mysql_select_db($mysql_database);
	$confirm = 0;
	$query = "SELECT * FROM users WHERE Email='$email' AND Password='$password'";
	$result = mysql_query($query);
	$count = mysql_num_rows($result);

	if($count == 1) {
		$permission = mysql_result($result, 0,"Confirmed");
		$email = mysql_result($result, 0, "Email");
		if($permission > 0) {
			session_start();
			$_SESSION['permission'] = $permission;
			$_SESSION['email'] = $email;
			$return = $permission;
		} else {
			$return = $permission;
		}
	}
	mysql_close();
	echo "$return";
}


	function changePassword($email, $oldPassword, $newPassword, $verifyNewPassword){
		include "CONST.php";
		/* Return Values
		 * -1 - Error
		 *  0 - New passwords did not match
		 *  1 - Old password was wrong
		 *  2 - Password was changed
 		 *
		 */
		mysql_connect($mysql_host,$mysql_user,$mysql_password);
		@mysql_select_db($mysql_database);
		$currentPassword = "";
		$result = mysql_query("SELECT * FROM users WHERE Email='$email'");
		$currentPassword = mysql_result($result, 0, "Password");
		mysql_close();
		$return = -1;
		if((strcmp($verifyNewPassword,$newPassword)) != 0){
			$return = 0;
		}elseif((strcmp($oldPassword,$currentPassword)) != 0){
			$return = 1;
		}else{
			mysql_connect($mysql_host, $mysql_user, $mysql_password);
			@mysql_select_db($mysql_database);

			$query = "UPDATE users SET Password='$newPassword' WHERE Email='$email' AND Password='$oldPassword'";
			mysql_query($query);
			mysql_close();
			$return = 2;
		}

		echo "$return";
	}
?>
