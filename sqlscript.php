<?php
	//YOU NEED TO FILL IN THE CONNECT INFO
	//also im not sure if this will work
	mysql_connect();

	$dbname = "cupcakes_db";
	mysql_create_db($dbname);
	
	@mysql_select_db($dbname);
	$users = "CREATE TABLE users (ID int NOT NULL AUTO_INCREMENT,Email varchar(15), Password varchar(100), Time timestamp, Confirmed bool, Hash varchar(32))";

	$items = "CREATE TABLE items (ID int NOT NULL AUTO_INCREMENT, Name varchar(100), Price int, Available int,SaleType int, Quantity int, URL varchar(500) )";

	mysql_query($users);
	mysql_query($items);



?>