<?php   
    // var_dump(password_hash("123456", PASSWORD_DEFAULT));die;
    require_once "commons/db.php";
    require_once 'commons/constants.php';
    
    $mess = isset($_COOKIE['mess']) ? $_COOKIE['mess'] : null;
    //Chuyển trang nếu đã đăng nhập
    if(isset($_SESSION[AUTH])){
        header('location: '. BASE_URL);
    }

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

                if($user['role'] == 1){
                    header('location: '. BASE_URL . 'admin/');
                    die;
                }else{
                    // header('location: '. BASE_URL . 'my-account.php');
                    header('location: '.$_SERVER['HTTP_REFERER']);
                    die;
                }
            }
        }else{
            echo "<script>alert('Tài khoản hoặc mật khẩu không đúng')</script>";
        }
    }
    
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:16 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Đăng nhập</title>
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
                                <a href="index.php">Trang chủ</a>
                                <span class="separator">/</span> Đăng nhập
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
                            <h1 class="entry-title">Login</h1>
                            <?php if ($mess != null): ?>
                                <center style="font-size: 20px; color: #CE580A; margin-top: 30px"><?php echo $mess ?></center>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title end -->
            <!-- cart page content -->
            <div class="login-page-area">
                <div class="container">
                    <div class="login-area">
                        <!-- New Customer Start -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="well mb-sm-30">
                                    <div class="new-customer">
                                        <h3 class="custom-title">Khách hàng mới</h3>
                                        <p class="mtb-10"><strong>Đăng ký</strong></p>
                                        <p>Bằng cách tạo tài khoản, bạn sẽ có thể mua sắm nhanh hơn, cập nhật trạng thái của đơn hàng và theo dõi các đơn hàng bạn đã thực hiện trước đó</p>
                                        <a class="customer-btn" href="register.php">tiếp tục</a>
                                    </div>
                                </div>
                            </div>
                            <!-- New Customer End -->
                            <!-- Returning Customer Start -->
                            <div class="col-md-6">
                                <div class="well">
                                    <div class="return-customer">
                                        <h3 class="mb-10 custom-title">Khách hàng</h3>
                                        <p class="mb-10"><strong>Bạn đã đăng ký tài khoản ?</strong></p>
                                        <form method="post">
                                            <div class="form-group">
                                                <label>Tài khoản</label>
                                                <input type="text" name="username" placeholder="Tên đăng nhập ..." id="input-email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu</label>
                                                <input type="password" name="password" placeholder="Mật khẩu ..." id="input-password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input id="remember" type="checkbox" name="remember" value="ok">
                                                <label for="remember">Nhớ tài khoản</label>
                                            </div>
                                            <p class="lost-password"><a href="forgot-password.php">Quên mật khẩu ?</a></p>
                                            <input name="btn_login" type="submit" value="Đăng nhập" class="return-customer-btn">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Returning Customer End -->
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

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
</html>
