<?php
include 'CONST.php';
$user = $_POST['email'];
$pass = $_POST['password'];
$loginType = $_POST['type'];

$login = "incorrect";
mysql_connect($mysql_host,$mysql_user,$mysql_password);
if ($loginType == 1){
	@mysql_select_db($mysql_database);
	$query = "SELECT * FROM managers WHERE Username='$user' AND Password='$pass'";
	$result = mysql_query($query) or die("No such user");

	$count = mysql_num_rows($result);

	if($count == 1){
		session_start();
		$perm = true;
		$login = "correct";
		$_SESSION['permission'] = $perm;
	}
}elseif($loginType==0){
	@mysql_select_db($mysql_database);
	$query = "SELECT * FROM users WHERE Email='$user' AND Password='$pass' AND Confirmed='1'";
	$result = mysql_query($query) or die("No such user");

	$count = mysql_num_rows($result);
	if($count ==1){
		session_start();
		$perm = true;
		$login = "correct";
		$_SESSION['user']= $perm;
	}
}

echo "$login";



?>