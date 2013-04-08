<?php

$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a7821088_items";
$mysql_user = "a7821088_manager";
$mysql_password = "cupcakes1";

$user = $_POST['username'];
$pass = $_POST['password'];

mysql_connect($mysql_host,$mysql_user,$mysql_password);
@mysql_select_db($mysql_database);
$query = "SELECT * FROM managers WHERE Username='$user' AND Password='$pass'";
$result = mysql_query($query) or die("No such user");

$count = mysql_num_rows($result);

if($count == 1){
	session_start();
	$perm = true;
	$_SESSION['permission'] = $perm;
}

header("location:main.html");

?>