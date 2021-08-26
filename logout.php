<?php
	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['email']);
	setcookie("userId", "");
	setcookie("password", "");
	setcookie("email", "");
	header("Location:http://localhost/login.php");
?>
