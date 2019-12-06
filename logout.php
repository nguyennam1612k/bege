<?php 
	session_start();
	require_once './commons/constants.php';
    require_once './commons/db.php';
    require_once './commons/helpers.php';
    unset($_SESSION[AUTH]);
    header('location: ' . BASE_URL);
    
 ?>