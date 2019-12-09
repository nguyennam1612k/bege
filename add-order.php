<?php 
	require_once "commons/db.php";
    require_once 'commons/constants.php';
    require_once './commons/helpers.php';
    require_once './libs/Faker/autoload.php';
    $faker = Faker\Factory::create('vi_VN');

    $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
    $user_id = $user['id'];
    //thực hiện thêm order
    if(isset($_POST['btn_order'])){
    	extract($_REQUEST);
    	if(isset($address_extra)){
    		$address = $address.' / chi tiết: '.$address_extra;
    	}

    	if(empty($message)){
    		$message = "";
    	}
    	$payment = rand(1, 3);
    	//Viết câu lệnh sql
    	if($user != null){
    		$sqlInsert = "INSERT into orders
    						(name, email, phone_number, user_id, address, message, total_price, payment)
    					values
    						('$name', '$email', '$phone_number', $user_id, '$address', '$message', $total_price, $payment)";
    	}else{
    		$sqlInsert = "INSERT into orders
    						(name, email, phone_number, address, message, total_price, payment)
    					values
    						('$name', '$email', '$phone_number', '$address', '$message', $total_price, $payment)";
    	}

		executeQuery($sqlInsert);
		// dd($sqlInsert);
		//Chuyển trang
		unset($_SESSION[CART]);
	    if($user == null){
	    	header('location: '. BASE_URL);
			die;
	    }else{
	    	header('location: '. BASE_URL . 'my-account.php');
	    	setcookie('mess', 'Đặt hàng thành công, mời bạn xem ở mục Orders', time()+30);
	    	die;
	    }
    }
	
 ?>