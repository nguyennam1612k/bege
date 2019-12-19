<?php 
    require_once './commons/db.php';
    require_once './commons/constants.php';
    require_once './commons/helpers.php';
    

    //convert name
    function convert_name($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
        $str = preg_replace("/( )/", '-', $str);
        return $str;
    }

    if(isset($_POST['btn_register'])){
        extract($_REQUEST);

        //chuyển username thành viết thường không dấu
        $username = strtolower(convert_name($username));
        
        //Kiem tra tài khoản tồn tại
        $sqlQuery = "SELECT * from users where username='$username'";
        $check = executeQuery($sqlQuery, false);

        if ($check != null){
            echo "<script>alert('Tài khoản đã tồn tại')</script>";
        }else if($password != $confirm_password){
            echo "<script>alert('Xác thực mật khẩu không trùng khớp')</script>";
        }else{
            //Chuyển đổi mật khẩu
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sqlInsert =     "INSERT into users
                                (username, name, email, phone_number, password)
                            values
                                ('$username', '$name', '$email', '$phone_number', '$password')";
            executeQuery($sqlInsert);
            setcookie("mess", 'Đăng ký thành công, mời đăng nhập', time()+90);
            header('location: ' . BASE_URL . 'login.php');
        }
    }
 ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Đăng ký tài khoản</title>
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
                                <a href="index.php">Trang Chủ</a>
                                <span class="separator">/</span> Đăng Ký
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
                            <h1 class="entry-title">Đăng Ký</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title end -->
            <!-- cart page content -->
            <div class="register-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <form class="form-register" method="post">
                                <fieldset>
                                    <legend>Thông Tin Cá Nhân Của Bạn</legend>
                                    <div class="form-group d-md-flex align-items-md-center">
                                        <label class="control-label col-md-2" for="f-name"><span class="require">*</span>Tên tài khoản</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="f-name" placeholder="Username" name="username" required="">
                                        </div>
                                    </div>
                                    <div class="form-group d-md-flex align-items-md-center">
                                        <label class="control-label col-md-2" for="l-name"><span class="require">*</span>Họ tên</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="l-name" placeholder="Full Name" name="name" required="">
                                        </div>
                                    </div>
                                    <div class="form-group d-md-flex align-items-md-center">
                                        <label class="control-label col-md-2" for="email"><span class="require">*</span>Địa chỉ Email</label>
                                        <div class="col-md-10">
                                            <input type="email" class="form-control" id="email" placeholder="Enter you email address here..." name="email" required="">
                                        </div>
                                    </div>
                                    <div class="form-group d-md-flex align-items-md-center">
                                        <label class="control-label col-md-2" for="number"><span class="require">*</span>Số điện thoại</label>
                                        <div class="col-md-10">
                                            <input style="height: 45px; border: 1px solid #E2E2E2" type="nummber" class="form-control" id="number" placeholder="Telephone" name="phone_number" required="">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Mật khẩu</legend>
                                    <div class="form-group d-md-flex align-items-md-center">
                                        <label class="control-label col-md-2" for="pwd"><span class="require">*</span>Mật khẩu:</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" id="pwd" placeholder="Password" name="password" required="">
                                        </div>
                                    </div>
                                    <div class="form-group d-md-flex align-items-md-center">
                                        <label class="control-label col-md-2" for="pwd-confirm"><span class="require">*</span>Xác thực mật khẩu</label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" id="pwd-confirm" placeholder="Confirm password" name="confirm_password" required="">
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- <fieldset class="newsletter-input">
                                    <legend>Đăng ký nhận thông tin</legend>
                                    <div class="form-group d-md-flex align-items-md-center">
                                        <label class="col-md-2 control-label">Đăng ký</label>
                                        <div class="col-md-10 radio-button">
                                             <label class="radio-inline"><input type="radio" name="optradio">Đồng ý</label>
                                             <label class="radio-inline"><input type="radio" name="optradio">Từ chối</label>
                                        </div>
                                    </div>
                                </fieldset> -->
                                <div class="terms">
                                    <div class="float-md-right">
                                        <label for="agree">
                                            <span>Tôi đồng ý với <a href="#" class="agree"><b>Chính sách bảo mật</b></a></span>
                                        </label>
                                        <input type="checkbox" name="agree" value="1" required="" id="agree"> &nbsp;
                                        <input type="submit" value="Tiếp tục" class="return-customer-btn" name="btn_register">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- cart page content end -->
            <?php include "includes/footer.php" ?>
        </div>
        <!-- Body main wrapper end -->

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



        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
    </body>

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
</html>
