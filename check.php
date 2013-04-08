<?php

$mysql_host = "mysql4.000webhost.com";
$mysql_databaseAdmin = "a7821088_items";
$mysql_databaseUsers = "";
$mysql_user = "a7821088_manager";
$mysql_password = "cupcakes1";

$user = $_POST['email'];
$pass = $_POST['password'];
$loginType = $_POST['type'];

mysql_connect($mysql_host,$mysql_user,$mysql_password);
if ($loginType == 1){}
	@mysql_select_db($mysql_databaseAdmin);
	$query = "SELECT * FROM managers WHERE Username='$user' AND Password='$pass'";
	$result = mysql_query($query) or die("No such user");

	$count = mysql_num_rows($result);

	if($count == 1){
		session_start();
		$perm = true;
		$_SESSION['permission'] = $perm;
	}
}elseif($loginType==0){
	@mysql_select_db($mysql_databaseUsers);
	$query = "SELECT * FROM users WHERE Email='$email' AND Password='$pass'";
	$result = mysql_query($query) or die("No such user");

	$count = mysql_num_rows($result);

	if($count ==1){
		session_start();
		$perm = true;
		$_SESSION['user']= $perm;
	}
}

header("location:main.html");

?>