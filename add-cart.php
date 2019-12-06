<?php 
require_once './commons/helpers.php';
require_once './commons/constants.php';
require_once './commons/db.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$sqlQuery = "select * from products where id = $id";
$product = executeQuery($sqlQuery);

if(!isset($_SESSION[CART]) || $_SESSION[CART] == null){
	$_SESSION[CART] = [];
	$_SESSION[CART][] = [
		'id' => $product['id'],
		'name' => $product['name'],
		'sku' => $product['sku'],
		'price' => $product['price'],
		'sale_price' => $product['sale_price'],
		'feature_image' => $product['feature_image'],
		'quantity' => 1
	];
}else{
	$cart = $_SESSION[CART];
	$existed = -1;
	foreach ($cart as $index => $item) {
		if($item['id'] == $product['id']){
			$existed = $index;
			break;
		}
	}

	if($existed == -1){
		$cart[] = [
			'id' => $product['id'],
			'name' => $product['name'],
			'sku' => $product['sku'],
			'price' => $product['price'],
			'sale_price' => $product['sale_price'],
			'feature_image' => $product['feature_image'],
			'quantity' => 1
		];
	}else{
		$cart[$existed]['quantity']++;
	}
	$_SESSION[CART] = $cart;

}

	//Chuyển trang
    header('location: '.$_SERVER['HTTP_REFERER']);
	die;

// dd($cart);
 ?>