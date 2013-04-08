<?php

include 'CONST.php';
$user = $_POST['email'];
$pass = $_POST['password'];
$loginType = $_POST['type'];

mysql_connect($mysql_host,$mysql_user,$mysql_password);
if ($loginType == 1){}
	@mysql_select_db($mysql_database);
	$query = "SELECT * FROM managers WHERE Username='$user' AND Password='$pass'";
	$result = mysql_query($query) or die("No such user");

	$count = mysql_num_rows($result);

	if($count == 1){
		session_start();
		$perm = true;
		$_SESSION['permission'] = $perm;
	}
}elseif($loginType==0){
	@mysql_select_db($mysql_database);
	$query = "SELECT * FROM users WHERE Email='$user' AND Password='$pass' and Confirmed='1'";
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