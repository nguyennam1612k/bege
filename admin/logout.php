<?php 
	session_start();
	
	if(isset($_SESSION['user']) || isset($_COOKIE['user'])){
		unset($_SESSION['user']);
		setcookie("user", "", time()-3600,"/" );
		unset($_SESSION['vai_tro']);
		setcookie("vai_tro", "", time()-3600,"/" );
		header('location: login.php');
	}
 ?>