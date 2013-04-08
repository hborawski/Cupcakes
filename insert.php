<?php


$mysql_host = "mysql4.000webhost.com";
$mysql_database = "a7821088_items";
$mysql_user = "a7821088_manager";
$mysql_password = "cupcakes1";

$name =$_POST['name'];
$price =$_POST['price'];
$avail =$_POST['avail'];
$num = $_POST['quantity'];
$uploadedFile = $_FILES['upload']['tmp_name'];
$filename =  $_FILES['upload']['name'];
$url = $filename;

move_uploaded_file($_FILES["upload"]["tmp_name"],
      "images/" . $filename );
      echo "Stored in: " . "images/" . $_FILES["upload"]["name"];


mysql_connect($mysql_host,$mysql_user,$mysql_password);
@mysql_select_db($mysql_database);
$query = "INSERT INTO forSale (Name, Price, Available, SaleType, Quantity,  URL) VALUES('$name','$price','$avail',1,'$num','$url')";
echo $avail;
mysql_query($query);

$result = mysql_query("SELECT * FROM forSale");
$num = mysql_num_rows($result);

mysql_close();
header("location:management.html");

?>