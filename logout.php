<?php
session_start();
if(isset($_SESSION['permission'])){
	unset($_SESSION['permission']);
}elseif(isset($_SESSION['user'])){
	unset($_SESSION['user']);
}

session_destroy();



header("location:main.html");
?>