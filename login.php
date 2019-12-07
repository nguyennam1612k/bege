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
                    header('location: '. BASE_URL . 'my-account.php');
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
            
            <header class="header-area">
                <!-- Header top area start -->
                <div class="header-top-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-md-12">
                                <div class="top-bar-left">
                                    <!-- main-menu -->
                                    <div class="main-menu">
                                        <nav>
                                            <ul>
                                                <li class="current"><a href="index.php">trang chủ</a>

                                                </li>
                                                <li><a href="shop.php">cửa hàng</a></li>
                                                <li><a href="about-us.php">giới thiệu</a></li>
                                                <li><a href="contact-us.php">liên hệ</a></li>
                                                <li><a href="#">Danh mục <i class="fa fa-angle-down"></i></a>
                                                    <!-- Hiện thị danh mục cha và danh mục con -->
                                                    <ul class="megamenu-3-column">
                                                        <li><a href="#">Pages</a>
                                                            <ul>
                                                                <li><a href="about-us.php">About Us</a></li>
                                                                <li><a href="contact-us.php">Contact Us</a></li>
                                                                <li><a href="service.php">Services</a></li>
                                                                <li><a href="portfolio.php">Portfolio</a></li>
                                                                <li><a href="faq.php">Frequently Questins</a></li>
                                                                <li><a href="404.php">Error 404</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">Blog</a>
                                                            <ul>
                                                                <li><a href="blog-no-sidebar.php">None Sidebar</a></li>
                                                                <li><a href="blog.php">Sidebar right</a></li>
                                                                <li><a href="single-blog.php">Image Format</a></li>
                                                                <li><a href="single-blog-gallery.php">Gallery Format</a></li>
                                                                <li><a href="single-blog-audio.php">Audio Format</a></li>
                                                                <li><a href="single-blog-video.php">Video Format</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">Shop</a>
                                                            <ul>
                                                                <li><a href="shop.php">Shop</a></li>
                                                                <li><a href="shop-list.php">Shop List View</a></li>
                                                                <li><a href="shop-right.php">Shop Right</a></li>
                                                                <li><a href="single-product.php">Shop Single</a></li>
                                                                <li><a href="cart.php">Shoping Cart</a></li>
                                                                <li><a href="checkout.php">Checkout</a></li>
                                                                <li><a href="my-account.php">My Account</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="mobile-menu-area">
                                        <div class="mobile-menu">
                                            <nav id="mobile-menu-active">
                                                <ul class="menu-overflow">
                                                    <li><a href="index.php">Trang chủ</a></li>
                                                    <li><a href="shop.php">cửa hàng</a></li>
                                                    <li><a href="blog.php">tin tức</a></li>
                                                    <li><a href="about-us.php">giới thiệu</a></li>
                                                    <li><a href="contact-us.php">liên hệ</a></li>
                                                    <li><a href="#">Danh mục</a>
                                                        <ul>
                                                            <li><a href="#">Pages</a>
                                                                <ul>
                                                                    <li><a href="about-us.php">About Us</a></li>
                                                                    <li><a href="service.php">Services</a></li>
                                                                    <li><a href="portfolio.php">Portfolio</a></li>
                                                                    <li><a href="faq.php">Frequently Questins</a></li>
                                                                    <li><a href="404.php">Error 404</a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a href="#">Blog</a>
                                                                <ul>
                                                                    <li><a href="blog-no-sidebar.php">None Sidebar</a></li>
                                                                    <li><a href="blog.php">Sidebar right</a></li>
                                                                    <li><a href="single-blog.php">Image Format</a></li>
                                                                    <li><a href="single-blog-gallery.php">Gallery Format</a></li>
                                                                    <li><a href="single-blog-audio.php">Audio Format</a></li>
                                                                    <li><a href="single-blog-video.php">Video Format</a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a href="#">Shop</a>
                                                                <ul>
                                                                    <li><a href="shop.php">Shop</a></li>
                                                                    <li><a href="shop-list.php">Shop List View</a></li>
                                                                    <li><a href="shop-right.php">Shop Right</a></li>
                                                                    <li><a href="single-product.php">Shop Single</a></li>
                                                                    <li><a href="cart.php">Shoping Cart</a></li>
                                                                    <li><a href="checkout.php">Checkout</a></li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-12">
                                <div class="topbar-nav">
                                    <div class="wpb_wrapper">
                                        <!-- my account -->
                                        <div class="menu-my-account-container">
                                            <?php
                                            if(isset($_SESSION['user'])){
                                                if($_SESSION['role'] == 1){
                                                //Nếu vai trò bằng 1 thì hiện link admin
                                                    ?>
                                                    <a href="#"><?= $taikhoan['name']?> <i class="ion-ios-arrow-down"></i></a>
                                                    <ul>
                                                        <li><a href="admin" style="color: red">Quản trị</a></li>
                                                        <li><a href="my-account.php">Tài khoản</a></li>
                                                        <li><a href="checkout.php">Thanh toán</a></li>
                                                        <li><a href="logout.php">Đăng xuất</a></li>
                                                    </ul>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <a href="#"><?= $taikhoan['name']?> <i class="ion-ios-arrow-down"></i></a>
                                                    <ul>
                                                        <li><a href="my-account.php">Tài khoản</a></li>
                                                        <li><a href="checkout.php">Thanh toán</a></li>
                                                        <li><a href="logout.php">Đăng xuất</a></li>
                                                    </ul>
                                                    <?php
                                                }

                                            }else if(isset($_COOKIE['user'])){
                                                if($_COOKIE['role'] == 1){
                                                //Nếu vai trò bằng 1 thì hiện link admin
                                                    ?>
                                                    <a href="#"><?= $taikhoan['name']?> <i class="ion-ios-arrow-down"></i></a>
                                                    <ul>
                                                        <li><a href="admin" style="color: red">Quản trị</a></li>
                                                        <li><a href="my-account.php">Tài khoản</a></li>
                                                        <li><a href="checkout.php">Thanh toán</a></li>
                                                        <li><a href="logout.php">Đăng xuất</a></li>
                                                    </ul>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <a href="#"><?= $taikhoan['name']?> <i class="ion-ios-arrow-down"></i></a>
                                                    <ul>
                                                        <li><a href="my-account.php">Tài khoản</a></li>
                                                        <li><a href="checkout.php">Thanh toán</a></li>
                                                        <li><a href="logout.php">Đăng xuất</a></li>
                                                    </ul>
                                                    <?php
                                                }

                                            }else{
                                                ?>
                                                <a href="#">Tài khoản <i class="ion-ios-arrow-down"></i></a>
                                                <ul>
                                                    <li><a href="login.php">Đăng nhập</a></li>
                                                    <li><a href="register.php">Đăng ký</a></li>
                                                </ul>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="switcher">
                                            <!-- language-menu -->
                                            <div class="language">
                                                <a href="#">
                                                    <img src="images/icons/en.png" alt="language-selector">English
                                                    <i class="ion-ios-arrow-down"></i>
                                                </a>
                                                <ul>
                                                    <li>
                                                        <a href="#">
                                                            <img src="images/icons/fr.png" alt="French">
                                                            <span>French</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- currency-menu -->
                                            <div class="currency">
                                                <a href="#">$ USD<i class="ion-ios-arrow-down"></i></a>
                                                <ul>
                                                    <li><a href="#">€ EUR</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Top bar area end -->
                <!-- Header middle area start -->
                <div class="header-middle-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-2 col-md-12">
                                <!-- site-logo -->
                                <div class="site-logo">
                                    <a href="index.php"><img src="images/logo/logo-white.png" alt="Nikado"></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-12">
                                <!-- header-search -->
                                <div class="header-search clearfix">
                                    <div class="category-select pull-right">
                                        <!-- Tìm kiếm theo danh mục cha -->
                                        <select class="nice-select-menu">
                                            <option value="all" data-display="Tất cả danh mục">Tất cả danh mục</option>
                                            <option value="1">Decor & Furniture</option>
                                            <option value="2">Electronics</option>
                                            <option value="3">Fashion & clothings</option>
                                            <option value="4" disabled>Sport & Outdoors</option>
                                            <option value="5">Toy, Kids & Baby</option>
                                        </select>
                                    </div>
                                    <div class="header-search-form">
                                        <form action="#">
                                            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm ...">
                                            <input type="submit" name="submit" value="Search">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-12">
                                <!-- shop-cart-menu -->
                                <div class="shop-cart-menu pull-right">
                                    <ul>
                                        <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                        <li><a href="wishlist.php"><i class="ion-android-favorite-outline"></i></a></li>
                                        <li><a href="#">
                                            <span class="cart-icon">
                                                <i class="ion-bag"></i><sup>3</sup>
                                            </span>
                                            <span class="cart-text">
                                                <span class="cart-text-title">My cart <br> <strong>$ 145.00</strong> </span>
                                            </span>
                                        </a>
                                        <ul>
                                            <li>
                                                <!-- single-shop-cart-wrapper -->
                                                <div class="single-shop-cart-wrapper">
                                                    <div class="shop-cart-img">
                                                        <a href="#"><img src="images/product/1.jpg" alt="Image of Product"></a>
                                                    </div>
                                                    <div class="shop-cart-info">
                                                        <h5><a href="cart.php">sport t-shirt men</a></h5>
                                                        <span class="price">£515.00</span>
                                                        <span class="quantaty">Qty: 1</span>
                                                        <span class="cart-remove"><a href="#"><i class="fa fa-times"></i></a></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <!-- single-shop-cart-wrapper -->
                                                <div class="single-shop-cart-wrapper">
                                                    <div class="shop-cart-img">
                                                        <a href="#"><img src="images/product/2.jpg" alt="Image of Product"></a>
                                                    </div>
                                                    <div class="shop-cart-info">
                                                        <h5><a href="cart.php">sport coat amet</a></h5>
                                                        <span class="price">£100.00</span>
                                                        <span class="quantaty">Qty: 1</span>
                                                        <span class="cart-remove"><a href="#"><i class="fa fa-times"></i></a></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <!-- single-shop-cart-wrapper -->
                                                <div class="single-shop-cart-wrapper">
                                                    <div class="shop-cart-img">
                                                        <a href="#"><img src="images/product/3.jpg" alt="Image of Product"></a>
                                                    </div>
                                                    <div class="shop-cart-info">
                                                        <h5><a href="cart.php">Pellentesque men</a></h5>
                                                        <span class="price">£265.00</span>
                                                        <span class="quantaty">Qty: 1</span>
                                                        <span class="cart-remove"><a href="#"><i class="fa fa-times"></i></a></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <!-- shop-cart-total -->
                                                <div class="shop-cart-total">
                                                    <p>Subtotal: <span class="pull-right">£880.00</span></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="shop-cart-btn">
                                                    <a href="checkout.php">Checkout</a>
                                                    <a href="cart.php" class="pull-right">View Cart</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- cart end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header middle area end -->
        </header>
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
                                                <input type="text" name="password" placeholder="Mật khẩu ..." id="input-password" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <input id="remember" type="checkbox" name="remember" value="ok">
                                                <label for="remember">Remember me</label>
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
            <!-- QUICKVIEW PRODUCT START -->
            <div id="quickview-wrapper">
                <!-- Modal -->
                <div class="modal fade" id="product_modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-close-btn">
                                <button class="close" data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                               <!-- Single product area -->
                               <div class="single-product-area">
                                   <div class="container-fullwidth">
                                       <div class="single-product-wrapper">
                                           <div class="row">
                                               <div class="col-xs-12 col-md-7 col-lg-7">
                                                    <div class="product-details-img-content">
                                                        <div class="product-details-tab mr-40">
                                                            <div class="product-details-large tab-content">
                                                                <div class="tab-pane active" id="pro-details1">
                                                                    <div class="product-popup">
                                                                        <a href="images/product/single/product4.jpg">
                                                                            <img src="images/product/single/product4.jpg" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="pro-details2">
                                                                    <div class="product-popup">
                                                                        <a href="images/product/single/product5.jpg">
                                                                            <img src="images/product/single/product5.jpg" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="pro-details3">
                                                                    <div class="product-popup">
                                                                        <a href="images/product/single/product6.jpg">
                                                                            <img src="images/product/single/product6.jpg" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="pro-details4">
                                                                    <div class="product-popup">
                                                                        <a href="images/product/single/product7.jpg">
                                                                            <img src="images/product/single/product7.jpg" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <div class="tab-pane" id="pro-details5">
                                                                    <div class="product-popup">
                                                                        <a href="images/product/single/product8.jpg">
                                                                            <img src="images/product/single/product8.jpg" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-details-small nav product-dec-slider-qui owl-carousel">
                                                                <a class="active" href="#pro-details1">
                                                                    <img src="images/product/thumbnails/product4.jpg" alt="">
                                                                </a>
                                                                <a href="#pro-details2">
                                                                    <img src="images/product/thumbnails/product5.jpg" alt="">
                                                                </a>
                                                                <a href="#pro-details3">
                                                                    <img src="images/product/thumbnails/product6.jpg" alt="">
                                                                </a>
                                                                <a href="#pro-details4">
                                                                    <img src="images/product/thumbnails/product7.jpg" alt="">
                                                                </a>
                                                                <a href="#pro-details5">
                                                                    <img src="images/product/thumbnails/product8.jpg" alt="">
                                                                </a>
                                                                <a class="active" href="#pro-details1">
                                                                    <img src="images/product/thumbnails/product4.jpg" alt="">
                                                                </a>
                                                                <a href="#pro-details2">
                                                                    <img src="images/product/thumbnails/product5.jpg" alt="">
                                                                </a>
                                                                <a href="#pro-details3">
                                                                    <img src="images/product/thumbnails/product6.jpg" alt="">
                                                                </a>
                                                                <a href="#pro-details4">
                                                                    <img src="images/product/thumbnails/product7.jpg" alt="">
                                                                </a>
                                                                <a href="#pro-details5">
                                                                    <img src="images/product/thumbnails/product8.jpg" alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                               </div>
                                               <div class="col-xs-12 col-md-5 col-lg-5">
                                                   <div class="single-product-info">
                                                       <h1>Sit voluptatem</h1>
                                                       <div class="product-rattings">
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star"></i></span>
                                                            <span><i class="fa fa-star-half-o"></i></span>
                                                            <span><i class="fa fa-star-o"></i></span>
                                                        </div>
                                                        <span class="price">
                                                            <del>$ 77.00</del> $ 66.00
                                                        </span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco,Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus</p>
                                                        <div class="box-quantity d-flex">
                                                            <form action="#">
                                                                <input class="quantity mr-40" min="1" value="1" type="number">
                                                            </form>
                                                            <a class="add-cart" href="cart.php">add to cart</a>
                                                        </div>
                                                        <div class="wishlist-compear-area">
                                                            <a href="wishlist.php"><i class="ion-ios-heart-outline"></i> Add to Wishlist</a>
                                                            <a href="#"><i class="ion-ios-loop-strong"></i> Compare</a>
                                                        </div>
                                                        <div class="product_meta">
                                                            <span class="posted_in">Categories: <a href="#" rel="tag">Accessories</a>, <a href="#" rel="tag">Clothings</a></span>
                                                        </div>
                                                        <div class="single-product-sharing">
                                                            <div class="widget widget_socialsharing_widget">
                                                                <h3 class="widget-title">Share this product</h3>
                                                                <ul class="social-icons">
                                                                    <li><a class="facebook social-icon" href="#"><i class="fa fa-facebook"></i></a></li>
                                                                    <li><a class="twitter social-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                                                                    <li><a class="pinterest social-icon" href="#"><i class="fa fa-pinterest"></i></a></li>
                                                                    <li><a class="gplus social-icon" href="#"><i class="fa fa-google-plus"></i></a></li>
                                                                    <li><a class="linkedin social-icon" href="#"><i class="fa fa-linkedin"></i></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                                <!-- Single product area end -->
                            </div>
                        </div><!-- .modal-content -->
                    </div><!-- .modal-dialog -->
                </div><!-- END Modal -->
            </div>
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



        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="../../../www.google-analytics.com/analytics.js" async defer></script>
    </body>

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
</html>
