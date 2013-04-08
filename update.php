<?php

$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a7821088_items";
$mysql_user = "a7821088_manager";
$mysql_password = "cupcakes1";


$toUpdate=$_POST['toUpdate'];
$checkbox=$_POST['checkbox'];
$action = $_POST['button'];
$offer = $_POST['offer'];
$num = $_POST['quantity'];
$url = $_POST['url'];
$key = $_POST['key'];
echo $checkbox;
if($checkbox =="on"){
	$forSale =  "";
}else{
	$forSale = "on";
}
if($offer=='on'){
	$offer = 1;
}else{
	$offer = 0;
}

mysql_connect($mysql_host,$mysql_user,$mysql_password);
@mysql_select_db($mysql_database);
if($action == 'Update'){
	$query = "UPDATE forSale SET Available='$checkbox', Quantity='$num', SaleType='$offer' WHERE Name='$toUpdate' AND ID='$key'";
	//echo $query;
}else if ($action == 'Remove'){
	$query = "DELETE FROM forSale WHERE Name='$toUpdate' AND ID='$key'";
	unlink('images/'.$url);
	echo "Deleted " . $url;
}else{
	echo "Query encountered an error.";
}
echo $query;
echo '<br>';
echo $action;
mysql_query($query);

mysql_close();
header("location:management.html");

?>