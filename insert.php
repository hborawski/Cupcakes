<?php


include "CONST.php";

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
$query = "INSERT INTO items (Name, Price, Available, SaleType, Quantity,  URL) VALUES('$name','$price','$avail',1,'$num','$url')";
echo $avail;
mysql_query($query);

$result = mysql_query("SELECT * FROM items");
$num = mysql_num_rows($result);

mysql_close();
header("location:management.html");

?>