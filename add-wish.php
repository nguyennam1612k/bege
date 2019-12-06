<?php 
	require_once './commons/db.php';
    require_once './commons/constants.php';
    require_once './commons/helpers.php';

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
    if ($user != null && $id != null) {
    	$user_id = $user['id'];
    	$sqlQuery = "SELECT * from wish_lists where product_id=$id";
    	$check = executeQuery($sqlQuery, false);
    	$checkPro = $check['product_id'];
    	//Nếu tồn tại thì không thêm vào wish list 
    	//nếu chưa tồn tại thì thêm vào wish list
    	if($id != $checkPro){
    		$sqlInsert = 	"INSERT into wish_lists
	    						(product_id, user_id)
    						values
	    						($id, $user_id)";
	    	executeQuery($sqlInsert);
	    	header('location: '.$_SERVER['HTTP_REFERER']);
	    	die;
    	}else{
    		header('location: '.$_SERVER['HTTP_REFERER']);
	    	die;
    	}

    }
	// dd($sqlInsert);
 ?>