<?php
    require_once "commons/db.php";
    require_once 'commons/constants.php';
    require('libs/stripepayment/stripe/init.php');
    $error = '';
    $success = '';
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
        <title>Bege || Thanh toán</title>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>

          .rowP {
              display: -ms-flexbox; /* IE10 */
              display: flex;
              -ms-flex-wrap: wrap; /* IE10 */
              flex-wrap: wrap;
              margin: 0 -16px;
          }

          .col-50 {
              -ms-flex: 50%; /* IE10 */
              flex: 50%;
          }

          .col-75 {
              -ms-flex: 75%; /* IE10 */
              flex: 75%;
          }

          label {
              margin-bottom: 10px;
              display: block;
          }

          .icon-container {
              margin-bottom: 20px;
              padding: 7px 0;
              font-size: 24px;
          }
    </style>
    <style type="text/css">
        .payment-errors {    
            color: red;
            margin: 20px auto;
            display: block;
            font-size: 14px;
        }
    </style>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <!-- jQuery is used only for this example; it isn't required to use Stripe -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript">
        // this identifies your website in the createToken call below
        Stripe.setPublishableKey('pk_test_51fPtf262Z9p11AQqmZGZK4J003SfLH077');
        function stripeResponseHandler(status, response) {
            var valueRadio = $("input[name='payment_method']:checked").val();
            // alert(valueRadio);
            // document.write(valueRadio);
            // alert(valueRadio);
            if (response.error && valueRadio == "stripe" ) {
                // re-enable the submit button
                $('.submit-button').removeAttr("disabled");
                // show the errors on the form
                $(".payment-errors").html(response.error.message);
            } else {
                var form$ = $("#payment-form");
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                // and submit
                form$.get(0).submit();
            }
        }
        $(document).ready(function() {
            $("#payment-form").submit(function(event) {
                // disable the submit button to prevent repeated clicks
                $('.submit-button').attr("disabled", "disabled");
                // createToken returns immediately - the supplied callback submits the form if there are no errors
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
                return false; // submit from callback
            });

            $("#pm2-label").click(function(){
                $("#collapseOne-stripe").hide('slow');
            });
            $("#pm1-label").click(function(){
                if($("#pm1").prop("checked")){
                    $("#collapseOne-stripe").show('slow');
                }else{
                    $("#collapseOne-stripe").hide('slow');
                }
            });
        });
    </script>
    <script>
        
    </script>
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
                                <a href="index.html">Trang chủ</a>
                                <span class="separator">/</span> Thanh toán
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
                            <h1 class="entry-title">Thanh toán</h1>
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
                                        <h3 role="button" data-toggle="collapse" data-parent="#checkout-login" href="#checkout-login" aria-expanded="true" aria-controls="collapseOne">Bạn có tài khoản ? <span id="showlogin">Bấm vào đây để đăng nhập</span></h3>

                                        <div id="checkout-login" class="coupon-content">
                                            <div class="coupon-info">
                                                <p class="coupon-text">Nếu bạn đã đăng ký tài khoản, nhập thông tin và đăng nhập để lấy dữ liệu nhanh hơn.</p>
                                                <form method="post">
                                                    <p class="form-row-first">
                                                        <label>Tài khoản <span class="required">*</span></label>
                                                        <input type="text" name="username">
                                                    </p>
                                                    <p class="form-row-last">
                                                        <label>Mật khẩu  <span class="required">*</span></label>
                                                        <input type="text" name="password">
                                                    </p>
                                                    <p class="form-row">
                                                        <input type="submit" value="Login" name="btn_login">
                                                        <label>
                                                        <input type="checkbox">
                                                         Ghi nhớ
                                                    </label>
                                                    </p>
                                                    <p class="lost-password">
                                                        <a href="forgot-password.php">Quên mật khẩu ?</a>
                                                    </p>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <!-- ACCORDION END -->
                                    <!-- ACCORDION START -->
                                    <h3 role="button" data-toggle="collapse" data-parent="#checkout_coupon" href="#checkout_coupon" aria-expanded="true" aria-controls="collapseOne">Có mã giảm giá ? <span id="showcoupon">Bấm vào đây để nhập mã giảm giá</span></h3>
                                    <div id="checkout_coupon" class="coupon-checkout-content">
                                        <div class="coupon-info">
                                            <form class="form-row">
                                                <p class="checkout-coupon">
                                                    <input type="text" name="demo0" placeholder="Coupon code" class="voucher-code-input">
                                                    <input type="button" value="Apply Coupon" class="btn-voucher">
                                                    
                                                    <!-- <button type="button" class="btn-voucher submit-button">Áp dụng</button> -->
                                                </p>
                                            </form>
                                        </div>
                                    </div>
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
                        <form action="add-order.php" method="post" id="payment-form">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="checkbox-form">
                                        <h3>Chi Tiết Thanh Toán</h3>
                                        <!-- nếu không đăng nhập -->
                                            <?php if ($user == null): ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Họ tên <span class="required">*</span></label>
                                                            <input type="text" required="" name="name" placeholder="Your name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Địa chỉ <span class="required">*</span></label>
                                                            <input type="text" required="" name="address" placeholder="Street address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list mb-30">
                                                            <label>Địa chỉ Email <span class="required">*</span></label>
                                                            <input type="email" required="" name="email" placeholder="Your email address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list mb-30">
                                                            <label>Số điện thoại <span class="required">*</span></label>
                                                            <input type="number" style="height: 45px" required="" name="phone_number" placeholder="Phone number contact">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list create-acc mb-30">
                                                            <input id="cbox" type="checkbox" role="button" data-toggle="collapse" data-parent="#cbox_info" href="#cbox_info" aria-expanded="true" aria-controls="collapseOne" name="cbox_create_account" value="1">
                                                            <label for="cbox">Tạo tài khoản ?</label>
                                                        </div>
                                                        <div id="cbox_info" class="checkout-form-list create-accounts mb-25">
                                                            <p class="mb-10">Tạo một tài khoản bằng cách nhập thông tin dưới đây. Nếu bạn là khách hàng cũ, vui lòng đăng nhập ở đầu trang.</p>
                                                            <label>Mật khẩu tài khoản  <span class="required">*</span></label>
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
                                                            <label>Họ tên <span class="required">*</span></label>
                                                            <input type="text" required="" name="name" placeholder="Your name" value="<?php echo $user['name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="checkout-form-list">
                                                            <label>Địa chỉ <span class="required">*</span></label>
                                                            <input type="text" required="" name="address" placeholder="Street address" value="<?php echo $user['address'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list mb-30">
                                                            <label>Địa chỉ Email <span class="required">*</span></label>
                                                            <input type="email" required="" name="email" placeholder="Your email address" value="<?php echo $user['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkout-form-list mb-30">
                                                            <label>Số điện thoại <span class="required">*</span></label>
                                                            <input type="number" style="height: 45px" required="" name="phone_number" placeholder="Phone number contact" value="<?php echo $user['phone_number'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                        <div class="different-address">
                                            <div class="order-notes">
                                                <div class="checkout-form-list">
                                                    <label>Ghi chú đơn hàng</label>
                                                    <textarea id="checkout-mess" name="message" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="your-order">
                                        <h3>Đơn hàng của bạn</h3>
                                        <div class="your-order-table table-responsive">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">Sản phẩm</th>
                                                        <th class="product-total">Tổng</th>
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
                                                        <th>Tổng giỏ hàng</th>
                                                        <td><span class="amount"><?php echo number_format($totalPrice, 0, '', ','); ?> vnđ</span></td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Tổng đơn hàng</th>
                                                        <td><strong><span class="amount" id="cart-total"><?php echo number_format($totalPrice, 0, '', ','); ?> vnđ</span></strong>
                                                        </td>
                                                    </tr>
                                                    <input type="text" id="total-price" name="total_all" value="<?php echo $totalPrice ?>">
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="payment-method">
                                            <div class="payment-accordion">
                                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingOne">
                                                            <h4 class="panel-title">
                                                                <label for="pm1" id="pm1-label" style="font-weight: bold; font-size: 1em">
                                                                    <input type="radio" id="pm1" required="" name="payment_method" value="stripe">
                                                                        Thanh toán qua Stripe
                                                                </label>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseOne-stripe" style="display: none;">
                                                            <div class="panel-body">
                                                                <!-- <p>abcxyz</p> -->
                                                                <span class="payment-errors"><?= $error ?></span>
                                                                    <div class="form-group">
                                                                        <label>Thanh toán qua dịch vụ Stripe: <font size="3"><strong>&nbsp;<?php echo vnd($totalPrice) ?> VNĐ</strong></font></label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label style="font-weight: bold;">Số thẻ</label>
                                                                        <input type="text" size="20" autocomplete="off" class="card-number form-control" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label style="font-weight: bold;">CVC</label>
                                                                        <input type="text" style="width: 70px;" size="4" autocomplete="off" class="card-cvc form-control" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label style="width: 100%;float: left; font-weight: bold;">Hết hạn (MM/YYYY)</label>
                                                                        <input type="text" size="2" style="width: 70px;float: left;" class="card-expiry-month form-control"/>
                                                                        <span style="width: 30px;float: left;text-align: center"> / </span>
                                                                        <input type="text" size="4" style="width: 90px;float: left;" class="card-expiry-year form-control"/>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingTwo">
                                                            <h4 class="panel-title">
                                                                <label id="pm2-label" for="pm2" style="font-weight: bold; font-size: 1em">
                                                                <input type="radio" required="" name="payment_method" value="offline" id="pm2">
                                                                    Thanh toán khi nhận hàng
                                                                </label>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                            <div class="panel-body">
                                                                <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="panel-body">
                                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-button-payment">
                                                    <input type="hidden" name="total_price" value="<?php echo $totalPrice ?>">
                                                    <input type="submit" name="btn_order" class="submit-button" value="Xác nhận thanh toán" onclick="return confirm('Xác nhận thanh toán đơn hàng?')">
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
        </div>
        <!-- Body main wrapper end -->
        
        <?php include "includes/script.php" ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>

            var buttonApplyVoucher = document.querySelector(".btn-voucher"); //button
            buttonApplyVoucher.onclick = function(){
                // alert("ok");
                var voucherCode = document.querySelector('.voucher-code-input').value; //value text input

                var url = "checkVoucherCode.php?code=" + voucherCode;
                fetch(url, {method: 'GET'})
                .then((resp) => resp.json())
                .then(function(data){
                    if(data == null){
                        alert('Mã Voucher không tồn tại/hết hạn');
                        $(".btn-voucher").attr("disabled", false);
                    }else{
                        var totalPrice = document.querySelector('#total-price').value;
                        totalPrice = parseInt(totalPrice)-parseInt(data.discount);
                        intPrice = totalPrice;
                        totalPrice = totalPrice.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                        document.querySelector('#cart-total').innerText = totalPrice; //Hiện thị tổng tiền
                        document.querySelector('#total-price').value = intPrice; //Hiện thị tổng tiền
                        $(".btn-voucher").attr("disabled", true);//disabled button
                    }
                });

            }
        </script>
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
    </body>
</html>
