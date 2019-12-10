<?php 
	require_once "commons/db.php";
    require_once 'commons/constants.php';
    require_once './commons/helpers.php';
    require_once './libs/Faker/autoload.php';
    $faker = Faker\Factory::create('vi_VN');

    $cart = $_SESSION[CART];
    //thực hiện thêm order
    if(isset($_POST['btn_order'])){
    	extract($_REQUEST);
        $code = strtoupper(uniqid());
        //Thực hiện tạo tài khoản nếu click create acount
        $check_create_account = isset($_POST['cbox_create_account']) ? $_POST['cbox_create_account'] : null;

        //nếu cbox value = 1                   
        if($check_create_account == 1){

            $password = password_hash($password, PASSWORD_DEFAULT);
            $sqlCreateAcc = "INSERT into users
                                (name, username, password, email, phone_number, address)
                            values
                                ('$name', '$username', '$password', '$email', '$phone_number', '$address')";

            //kiểm tra username đã tồn tại chưa
            $sqlCheckAcc = "SELECT username from users where username='$username'";
            $check = executeQuery($sqlCheckAcc, false);

            if($check != null){
                setcookie('mess_or', '<b>Đặt hàng thành công</b>', time()+30);
                setcookie('mess_ac', 'Tạo tài khoản không thành công do username đã tồn tại', time()+3);
            }else{
                executeQuery($sqlCreateAcc);
                setcookie('mess_ac', 'Tạo tài khoản thành công', time()+3);
                $sqlQueryUser = "SELECT * from users where username='$username'";
                $user = executeQuery($sqlQueryUser, false);
                $_SESSION[AUTH] = [
                    "id" => $user['id'],
                    "username" => $user['username'],
                    "name" => $user['name'],
                    "status" => $user['status'],
                    "avatar" => $user['avatar'],
                    "email" => $user['email'],
                    "phone_number" => $user['phone_number'],
                    "address" => $user['address'],
                    "points" => $user['points'],
                    "role" => $user['role']
                ];
            }
        }


    	if(empty($message)){
    		$message = "";
    	}
    	$payment = rand(1, 3);

        $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
        $user_id = $user['id'];

    	//Viết câu lệnh sql
    	if($user != null){
    		$sqlInsert = "INSERT into orders
    						(name, code,  email, phone_number, user_id, address, message, total_price, payment)
    					values
    						('$name', '$code', '$email', '$phone_number', $user_id, '$address', '$message', $total_price, $payment)";
    	}else{
    		$sqlInsert = "INSERT into orders
    						(name, code, email, phone_number, address, message, total_price, payment)
    					values
    						('$name', '$code', '$email', '$phone_number', '$address', '$message', $total_price, $payment)";
    	}

        executeQuery($sqlInsert);


        $sqlIdOrder = "SELECT id FROM `orders` 
                        where code='$code'";
        $checkCode = executeQuery($sqlIdOrder, false);
        $order_id = $checkCode['id'];

        //Thêm hóa đơn chi tiết
        foreach ($cart as $key => $value) {
            $product_id = $cart[$key]['id'];
            $sku        = $cart[$key]['sku'];
            $image      = $cart[$key]['feature_image'];
            $sale_price = $cart[$key]['sale_price'];
            $quantity   = $cart[$key]['quantity'];
            $total_product = $sale_price*$quantity;

            $sqlInsertOrderDetail = "INSERT into order_detail
                                        (order_id, product_id, sku, image, quantity, sale_price, total_product)
                                    values
                                        ($order_id, $product_id, '$sku', '$image', $quantity, $sale_price, $total_product)";
            executeQuery($sqlInsertOrderDetail);
        }		

		//Chuyển trang
		unset($_SESSION[CART]);
	    if($user == null){
	    	header('location: '. BASE_URL .'cart.php');
			die;
	    }else{
	    	header('location: '. BASE_URL . 'my-account.php');
	    	setcookie('mess', 'Đặt hàng thành công, mời bạn xem ở mục Orders', time()+30);
	    	die;
	    }
    }
 ?>