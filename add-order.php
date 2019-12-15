<?php 
	require_once "commons/db.php";
    require_once 'commons/constants.php';
    require_once './commons/helpers.php';
    require_once './libs/Faker/autoload.php';
    require      './libs/stripepayment/stripe/init.php';
    $faker = Faker\Factory::create('vi_VN');

    $cart = $_SESSION[CART];
    //thực hiện thêm order
    if(isset($_POST['btn_order'])){
    	extract($_REQUEST);
        $points = $total_price/10000;
        $code = strtoupper(uniqid());
        $_SESSION['code'] = $code;
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
                
                setcookie('mess_ac', 'Tạo tài khoản không thành công do username đã tồn tại', time()+3);
            }else{
                executeQuery($sqlCreateAcc);
                setcookie('mess_ac', 'Tạo tài khoản thành công', time()+3);
                $sqlQueryUser = "SELECT * from users where username='$username'";
                $user = executeQuery($sqlQueryUser, false);
                $user_id = $user['id'];
                //Cộng điểm points
                $sqlUpdatePoints = "UPDATE users set points=points+$points where id=$user_id";
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

        $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
        $user_id = $user['id'];

    	if(empty($message)){
    		$message = "";
    	}

        // dd($payment_method);
    	//Viết câu lệnh sql
    	if($user != null){
    		$sqlInsert = "INSERT into orders
    						(name, code,  email, phone_number, user_id, address, message, total_price, payment_method)
    					values
    						('$name', '$code', '$email', '$phone_number', $user_id, '$address', '$message', $total_price, '$payment_method')";
            //Cộng điểm points
            $sqlUpdatePoints = "UPDATE users set points=points+$points where id=$user_id";
            
            $_SESSION[AUTH]['points'] = $_SESSION[AUTH]['points'] + $points;
    	}else{
    		$sqlInsert = "INSERT into orders
    						(name, code, email, phone_number, address, message, total_price, payment_method)
    					values
    						('$name', '$code', '$email', '$phone_number', '$address', '$message', $total_price, $'payment_method')";
    	}
        // dd($sqlInsert);



        
        


        //thuc hien cau lenh

        if($payment_method == "Thanh toán khi nhận hàng"){
            //insert order
            executeQuery($sqlInsert);

            //lay id hoa don
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

            //insert points
            if($user != null){
                executeQuery($sqlUpdatePoints);
            }

            //set cookie message
            setcookie('mess_or', '<b>Đặt hàng thành công</b>', time()+30);

            // Chuyển trang
            unset($_SESSION[CART]);
            if($user == null){
                header('location: '. BASE_URL .'cart.php');
                die;
            }else{
                header('location: '. BASE_URL . 'my-account.php');
                setcookie('mess', 'Đặt hàng thành công, mời bạn xem ở mục Orders', time()+30);
                die;
            }
        }else{

            if($user != null){
                 $sqlPoint = $sqlUpdatePoints;
            }else{
                $sqlPoint = "";
            }
            $_SESSION['total'] = $total_price;
            $_SESSION['sqlOrder']  = $sqlInsert;
            $_SESSION['sqlPoint']  = $sqlPoint;
            header('location: onetime.php');
            dd($_SESSION['sqlPoint']);
        }

    }
 ?>