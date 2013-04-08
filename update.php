<?php

include "CONST.php";


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
	$query = "UPDATE items SET Available='$checkbox', Quantity='$num', SaleType='$offer' WHERE Name='$toUpdate' AND key='$key'";
	//echo $query;
}else if ($action == 'Remove'){
	$query = "DELETE FROM items WHERE Name='$toUpdate' AND key='$key'";
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
//header("location:management.html");

?>