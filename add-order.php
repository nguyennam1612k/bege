<?php 
// error_reporting(1);
// ini_set('display_errors', 1);
	require_once "commons/db.php";
    require_once 'commons/constants.php';
    require_once './commons/helpers.php';
    require_once './libs/Faker/autoload.php';
    require('libs/stripepayment/stripe/init.php');
    $faker = Faker\Factory::create('vi_VN');

    $cart = $_SESSION[CART];
    //thực hiện thêm order
    if(isset($_POST['btn_order']) || (isset($_POST['stripeToken']) && !empty($_POST['stripeToken'])) ){
    	extract($_REQUEST);
        $total_price = $_POST['total_all'];
        $points = $total_price/10000;
        $code = strtoupper(uniqid());

        //kiểm tra checkbox tạo tài khoản
        $check_create_account = isset($_POST['cbox_create_account']) ? $_POST['cbox_create_account'] : null;

        //Thực hiện tạo tài khoản nếu click vào tạo tài khoản                
        if($check_create_account == 1){

            $password = password_hash($password, PASSWORD_DEFAULT);
            $sqlCreateAcc = "INSERT into users
                                (name, username, password, email, phone_number, address)
                            values
                                ('$name', '$username', '$password', '$email', '$phone_number', '$address')";

            //kiểm tra username đã tồn tại chưa
            $sqlCheckAcc = "SELECT username from users where username='$username'";
            $check = executeQuery($sqlCheckAcc, false);

            if($check != null){//Nếu tài khoản đã tồn tại hủy tạo tài khoản
                setcookie('mess_ac', 'Tạo tài khoản không thành công do username đã tồn tại', time()+3);
            }else{//nếu tài khoản chưa tồn tại thực hiện tạo tài khoản
                executeQuery($sqlCreateAcc);
                setcookie('mess_ac', 'Tạo tài khoản thành công', time()+3);
                $sqlQueryUser = "SELECT * from users where username='$username'";
                $user = executeQuery($sqlQueryUser, false);
                $user_id = $user['id'];
                //Cộng điểm points
                $sqlUpdatePoints = "UPDATE users
                                        set points=points+$points
                                    where id=$user_id";
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

        //Kiểm tra đăng nhập
        $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
        $user_id = $user['id'];

        //kiểm tra phương thức thanh toán và đặt value
        if ($payment_method == "offline") {
            $value_payment_method = "Thanh toán khi nhận hàng";
            $value_status_payment = 0;
        } else if ($payment_method == "stripe"){
            $value_payment_method = "Thanh toán Stripe";
            $value_status_payment = 1;
        }


    	//Viết câu lệnh sql thêm order và cập nhật points
    	if($user != null){//nếu đã đăng nhập thêm user_id và update points
    		$sqlInsert = "  INSERT into orders
    						  (name, code,  email, phone_number, user_id, address, message, total_price, payment_method, status_payment)
    					   values
    						  ('$name', '$code', '$email', '$phone_number', $user_id, '$address', '$message', $total_price, '$value_payment_method',$value_status_payment)";

            //Cộng điểm points
            $sqlUpdatePoints = "UPDATE users
                                    set points=points+$points
                                where id=$user_id";

            //Cập nhật point đăng nhập
            $_SESSION[AUTH]['points'] = $_SESSION[AUTH]['points'] + $points;

    	}else{//Nếu không đăng nhập chỉ tạo order không có user_id
    		$sqlInsert = "  INSERT into orders
    						  (name, code, email, phone_number, address, message, total_price, payment_method, status_payment)
    					   values
    					       ('$name', '$code', '$email', '$phone_number', '$address', '$message', $total_price, $'value_payment_method', $value_status_payment)";
    	}


        //Thực hiện thanh toán theo phương thức
        if($payment_method == "offline"){//Nếu là thanh toán khi nhận hàng

            //tạo order
            executeQuery($sqlInsert);

            //lấy ID order
            $sqlIdOrder = " SELECT id FROM `orders` 
                                where code='$code'";

            $checkCode = executeQuery($sqlIdOrder, false);
            $order_id = $checkCode['id'];

            //foreach thêm hóa đơn chi tiết
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

            //set cookie order đặt hàng thành công
            setcookie('mess_or', '<b>Đặt hàng thành công</b>', time()+30);

            //xóa session cart
            unset($_SESSION[CART]);

            //Kiểm tra đăng nhập và chuyển trang
            if($user == null){
                header('location: '. BASE_URL .'cart.php');
                die;
            }else{//Nếu đăng nhập chuyển trang tài khoản
                //Cập nhật points nếu đã đăng nhập
                executeQuery($sqlUpdatePoints);

                header('location: '. BASE_URL . 'my-account.php');
                die;
            }
        } elseif ($payment_method == 'stripe'){//Nếu phương thức thanh toán là stripe

            //Đặt giá là tổng giá
            $amount = round($total_price, 0);
            \Stripe\Stripe::setApiKey("sk_test_LZBU7ogG4jfChfaJMQKRlIG7004VVfqASy");
            try {
                if (!isset($_POST['stripeToken'])) throw new Exception("Stripe Token không được tạo chính xác");
                $token = $_POST['stripeToken'];
                $charge = \Stripe\Charge::create([
                    'amount' => $amount,
                    'currency' => 'vnd',
                    'description' => 'Thanh toán đơn hàng trên trang BeGe',
                    'source' => $token,
                // 'metadata' => ['name' => $_POST['name'], 'email' => $_POST['email']]
                ]);

                //Nếu thanh toán thành công
                if ($charge->id) $success = '<h1>Thank You!</h1><h3>Your payment has been processed successfully.</h3>
                                        <br><a href="'.BASE_URL.'">Home</a>';

                //Thực hiện câu lệnh sql tạo order
                executeQuery($sqlInsert);

                //set cookie order
                setcookie('mess_or', '<b>Đặt hàng thành công</b>', time()+30);

                //lấy id hóa đơn
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

                //xóa session cart
                unset($_SESSION[CART]);

                if($user != null){//nếu đã đăng nhập
                    executeQuery($sqlUpdatePoints);

                    //chuyển trang
                    header('location: '.BASE_URL.'my-account.php');
                }else{
                    header('location: '.BASE_URL);
                }

            }

            //Nếu lỗi, chuyển trang checkout và hiện thị
            catch (\Stripe\Error\Base $e) {
                // header('location: checkout.php');
                setcookie('mess_or', "Stripe: ".$e->getMessage(), time()+30);
            }catch (Exception $e) {
                setcookie('mess_or', "Lỗi: ".$e->getMessage(), time()+30);
            }        
            
        }

    }
 ?>