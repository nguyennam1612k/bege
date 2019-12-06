<?php
	require_once './commons/db.php';
	require_once './commons/constants.php';
	require_once './commons/helpers.php';

	$cart = isset($_SESSION[CART]) ? $_SESSION[CART] : null;
	$quantity = $_POST['quantity'];
	if($cart != null){
		foreach ($cart as $key => $value) {
			$cart[$key]['quantity'] = $quantity[$key];
		}
		$_SESSION[CART] = $cart;
		header('location: '.$_SERVER['HTTP_REFERER']);
		die;
	}
?>