<?php
	//Confirms a user within the system

	include "CONST.php";

	$hash = $_GET['hash'];

	mysql_connect($mysql_host, $mysql_user, $mysql_password);
	@mysql_select_db($mysql_database);

	$query = "UPDATE users SET Confirmed='1' WHERE Hash='$hash'";
	$result = mysql_query($query) or die("No Such User");




?>