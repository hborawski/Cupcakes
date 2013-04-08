<?php
session_start();
if(isset($_SESSION['permission'])){
	unset($_SESSION['permission']);
}

session_destroy();



header("location:main.html");
?>