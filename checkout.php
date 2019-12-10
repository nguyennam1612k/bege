<?php
    require_once "commons/db.php";
    require_once 'commons/constants.php';

    $cart = isset($_SESSION[CART]) ? $_SESSION[CART] : null;
    $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
    //Kiểm tra giỏ hàng
    if($cart == null){
        header('location: cart.php');
    }

    //đăng nhập
    if(isset($_POST['btn_login']) && $user == null){
        $username = isset($_POST['username']) ? $_POST['username'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";
        // $remember = isset($_POST['remember']) ? $_POST['remember'] : "";
        if($username != "" && $password != ""){
            // lấy dữ liệu từ csdl bảng users dựa vào email
            $sqlUserQuery = "SELECT * from users where username = '$username'";
            $user = executeQuery($sqlUserQuery, false);

            if($user && password_verify($password, $user['password'])){
                //Kiểm tra status
                if($user['status'] == 0){
                    echo "<script>alert('Tài khoản đang bị khóa')</script>";
                }else{
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
                    $id_u = $user['id'];
                    $sqlUpdateUser = "UPDATE users set onlines=onlines+1 where id=$id_u";
                    executeQuery($sqlUpdateUser);

                    header('Refresh: 0');
                }
            }else{
                echo "<script>alert('Tài khoản hoặc mật khẩu không đúng')</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || checkout</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/icons/icon_logo.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/ionicons.min.css">
        <link rel="stylesheet" href="css/css-plugins-call.css">
        <link rel="stylesheet" href="css/bundle.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/colors.css">
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->

        <!-- Body main wrapper start -->
        <div class="wrapper home-one home-two">
            <!-- HEADER AREA START -->
            <?php include "includes/header.php" ?>
            <!-- HRADER AREA END -->
            <!-- Breadcrumbs -->
            <div class="breadcrumbs-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <nav class="woocommerce-breadcrumb">
                                <a href="index.html">Home</a>
                                <span class="separator">/</span> Checkout
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumbs End -->
            <!-- Page title -->
            <div class="entry-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="entry-title">Checkout</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title end -->
            <!-- checkout page content -->
            <div class="checkout-page-area">
                <!-- coupon area -->
                <div class="coupon-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="coupon-accordion">
                                    <!-- ACCORDION START -->
                                    <?php if ($user == null): ?>
                                        <h3 role="button" data-toggle="collapse" data-parent="#checkout-login" href="#checkout-login" aria-expanded="true" aria-controls="collapseOne">Returning customer? <span id="showlogin">Click here to login</span></h3>

                                        <div id="checkout-login" class="coupon-content">
                                            <div class="coupon-info">
                                                <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>
                                                <form method="post">
                                                    <p class="form-row-first">
                                                        <label>Username <span class="required">*</span></label>
                                                        <input type="text" name="username">
                                                    </p>
                                                    <p class="form-row-last">
                                                        <label>Password  <span class="required">*</span></label>
                                                        <input type="text" name="password">
                                                    </p>
                                                    <p class="form-row">
                                                        <input type="submit" value="Login" name="btn_login">
                                                        <label>
                                                        <input type="checkbox">
                                                         Remember me 
                                                    </label>
                                                    </p>
                                                    <p class="lost-password">
                                                        <a href="forgot-password.php">Lost your password?</a>
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <!-- ACCORDION END -->
                                    <!-- ACCORDION START -->
                                    <h3 role="button" data-toggle="collapse" data-parent="#checkout_coupon" href="#checkout_coupon" aria-expanded="true" aria-controls="collapseOne">Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                                    <!-- <div id="checkout_coupon" class="coupon-checkout-content">
                                        <div class="coupon-info"> -->
                                            <form >
                                                <p class="checkout-coupon">
                                                    <input type="text" class="code" placeholder="Coupon code" class="voucher-code-input">
                                                    <!-- <input type="submit" value="Apply Coupon" class="btn-voucher"> -->
                                                    
                                                    <button type="button" class="btn-voucher btn btn-small btn-dark-solid">Apply Voucher Code</button>
                                                </p>
                                            </form>
                                        <!-- </div>
                                    </div> -->
                                    <!-- ACCORDION END -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- coupon area end -->
                <!-- checkout area -->
                <div class="checkout-area">
                    <div class="container">
                        <form action="add-order.php" method="post">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="checkbox-form">
                                        <h3>Billing Details</h3>
                                        <!-- nếu không đăng nhập -->
                                            <?php if ($user == null): ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Full Name <span class="required">*</span></label>
                                                            <input type="text" required="" name="name" placeholder="Your name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Address <span class="required">*</span></label>
                                                            <input type="text" required="" name="address" placeholder="Street address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list mb-30">
                                                            <label>Email Address <span class="required">*</span></label>
                                                            <input type="email" required="" name="email" placeholder="Your email address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list mb-30">
                                                            <label>Phone  <span class="required">*</span></label>
                                                            <input type="number" style="height: 45px" required="" name="phone_number" placeholder="Phone number contact">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list create-acc mb-30">
                                                            <input id="cbox" type="checkbox" role="button" data-toggle="collapse" data-parent="#cbox_info" href="#cbox_info" aria-expanded="true" aria-controls="collapseOne" name="cbox_create_account" value="1">
                                                            <label for="cbox">Create an account?</label>
                                                        </div>
                                                        <div id="cbox_info" class="checkout-form-list create-accounts mb-25">
                                                            <p class="mb-10">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                                            <label>Account password  <span class="required">*</span></label>
                                                            <input type="text" name="username" placeholder="username" style="height: 30px">
                                                            <input type="text" name="password" placeholder="password" style="height: 30px">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                            <!-- Nếu đăng nhập -->
                                            <?php if ($user != null): ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Full Name <span class="required">*</span></label>
                                                            <input type="text" required="" name="name" placeholder="Your name" value="<?php echo $user['name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Address <span class="required">*</span></label>
                                                            <input type="text" required="" name="address" placeholder="Street address" value="<?php echo $user['address'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list mb-30">
                                                            <label>Email Address <span class="required">*</span></label>
                                                            <input type="email" required="" name="email" placeholder="Your email address" value="<?php echo $user['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list mb-30">
                                                            <label>Phone  <span class="required">*</span></label>
                                                            <input type="number" style="height: 45px" required="" name="phone_number" placeholder="Phone number contact" value="<?php echo $user['phone_number'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                        <div class="different-address">
                                            <div class="order-notes">
                                                <div class="checkout-form-list">
                                                    <label>Order Notes</label>
                                                    <textarea id="checkout-mess" name="message" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="your-order">
                                        <h3>Your order</h3>
                                        <div class="your-order-table table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">Product</th>
                                                        <th class="product-total">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if ($cart != null): ?>
                                                        <?php foreach ($cart as $value): ?>
                                                         <tr class="cart_item">
                                                            <td class="product-name">
                                                                <?php echo $value['name'] ?> <strong class="product-quantity"> × <?php echo $value['quantity'] ?></strong>
                                                            </td>
                                                            <td class="product-total">
                                                                <span class="amount">
                                                                    <?php $itemTotal = $value['sale_price']*$value['quantity']; ?>
                                                                    <?php echo number_format($itemTotal, 0, '', ','); ?> vnđ
                                                                </span>
                                                            </td>
                                                        </tr> 
                                                        <?php endforeach ?>                                 
                                                    <?php endif ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="cart-subtotal">
                                                        <th>Cart Subtotal</th>
                                                        <td><span class="amount"><?php echo number_format($totalPrice, 0, '', ','); ?> đ</span></td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Order Total</th>
                                                        <td><strong><span class="amount" class="cart-total"><?php echo number_format($totalPrice, 0, '', ','); ?> đ</span></strong>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="payment-method">
                                            <div class="payment-accordion">
                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingOne">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Direct Bank Transfer
                                                            </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                            <div class="panel-body">
                                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingTwo">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Cheque Payment
                                                            </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                            <div class="panel-body">
                                                                <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingThree">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            PayPal
                                                            </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="panel-body">
                                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-button-payment">
                                                    <input type="hidden" name="total_price" value="<?php echo $totalPrice ?>">
                                                    <input type="submit" name="btn_order" value="Place order" onclick="return confirm('Xác nhận thanh toán đơn hàng?')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- checkout area end -->
            </div>
            <!-- checkout page content end -->
            <?php include "includes/footer.php" ?>
            <!-- QUICKVIEW PRODUCT START -->
            <?php include "includes/quickview.php" ?>
            <!-- QUICKVIEW PRODUCT END -->
        </div>
        <!-- Body main wrapper end -->


        <!-- jQuery CDN -->
        <script src="../../../code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <!-- jQuery Local -->
        <script>window.jQuery || document.write('<script src="js/jquery-3.2.1.min.js"><\/script>')</script>

        <!-- Popper min js -->
        <script src="js/popper.min.js"></script>
        <!-- Bootstrap min js  -->
        <script src="js/bootstrap.min.js"></script>
        <!-- All plugins here -->
        <script src="js/plugins.js"></script>
        <!-- Main js  -->
        <script src="js/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <input type="hidden" id="total-price" value="<?php echo $totalPrice ?>">
        <script>
            $("input[name='demo0']").TouchSpin({});

            var buttonApplyVoucher = document.querySelector(".btn-voucher"); //button
            buttonApplyVoucher.onclick = function(){
                var voucherCode = document.querySelector('.voucher-code-input').value; //value text input

                var url = "checkVoucherCode.php?code=" + voucherCode;
                fetch(url, {method: 'GET'})
                .then((resp) => resp.json())
                .then(function(data){
                    if(data == null){
                        alert('Mã Voucher không tồn tại/hết hạn');
                    }else{
                        var totalPrice = document.querySelector('#total-price').value;
                        totalPrice = parseInt(totalPrice)-parseInt(data.discount_price);
                        totalPrice = totalPrice.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                        document.querySelector('.cart-total').innerText = totalPrice; //Hiện thị tổng tiền

                    }
                });

            }
        </script>

        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="../../../www.google-analytics.com/analytics.js" async defer></script>
    </body>

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/checkout.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
</html>
