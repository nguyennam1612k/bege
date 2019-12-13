<?php
    require_once './commons/db.php';
    require_once './commons/constants.php';
    require_once './commons/helpers.php';

    //Kiểm tra đăng nhập
    $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
    if($user == null){
        header('location: ' . BASE_URL . 'login.php');
    }
    //select all đơn hàng tài khoản
    $user_id = $user['id'];
    $sqlQuery = "SELECT 
                    ROW_NUMBER() OVER (ORDER BY id) AS stt,orders.*
                from orders
                where user_id=$user_id";
    $orders = executeQuery($sqlQuery, true);
    // echo "ngày ".date("d-m-Y") . " lúc " . date(" H:i:s");
    // dd($_SESSION[AUTH]);
    //Cập nhật chi tiết tài khoản
    if(isset($_POST['btn_update_detail'])){
        extract($_REQUEST);
        //Kiểm tra địa chỉ và số điện thoại nếu trống
        
        if(empty($address)){
            $address = "";
        }
        if(empty($phone_number)){
            $phone_number = "";
        }
        if(is_int($phone_number) == true){
            echo "<script>alert('Định dạng sai số điện thoại')</script>";
        }else{
            //Thực hiện update
            $sqlUpdateDetail = "UPDATE users set
                                    name='$name',
                                    email='$email',
                                    address='$address',
                                    phone_number='$phone_number' 
                                where id=$user_id";
            executeQuery($sqlUpdateDetail);

            $_SESSION[AUTH]['name'] = $name;
            $_SESSION[AUTH]['email'] = $email;
            $_SESSION[AUTH]['address'] = $address;
            $_SESSION[AUTH]['phone_number'] = $phone_number;

            setcookie('mess', 'Cập nhật tài khoản thành công', time()+60);
            header('location: ' . BASE_URL . 'my-account.php');
        }
    }

    //Đổi mật khẩu
    if(isset($_POST['btn_update_password'])){
        extract($_REQUEST);
        if($new_password == $confirm){

            $sqlQuery = "SELECT password from users where id=$user_id";
            $cf = executeQuery($sqlQuery, false);
            $confirm_psw = $cf['password'];

            if(password_verify($now_password, $confirm_psw)){
                //Chuyển đổi mật khẩu mới sang password hand
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);

                //Thực hiện update
                $sqlUpdatePass = "UPDATE users set password='$new_password' where id=$user_id";
                executeQuery($sqlUpdatePass);
                header('location: ' . BASE_URL . 'my-account.php');
                setcookie('mess', 'Cập nhật mật khẩu thành công, dùng mật khẩu mới đăng nhập vào lần tiếp theo', time()+30);
            }else{
                echo "<script>alert('Mật khẩu hiện tại bạn nhập không đúng')</script>";
            }
        }else{
            echo "<script>alert('Xác thực mật khẩu không trùng khớp')</script>";
        }
        // dd($sqlUpdatePass);
    }

    //update avatar
    if( isset($_POST['btn_update_avatar']) ){
        if( $_FILES['avatar_update']['name'] == "" ){
            $avatar = $user['avatar'];
        }else{
            $avatar = 'images/user/'.$_FILES['avatar_update']['name'];
            move_uploaded_file($_FILES['avatar_update']['tmp_name'], $avatar);
        }
        //Thực hiện update
        $sqlUpdateAvatar = "UPDATE users set avatar='$avatar' where id=$user_id";
        executeQuery($sqlUpdateAvatar);
        //set session
        $_SESSION[AUTH]['avatar'] = $avatar;
    }

    
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:16 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Tài khoản</title>
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
                                <a href="index.html">Trang chủ</a>
                                <span class="separator">/</span> Bảng điều khiển
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
                            <h1 class="entry-title">Tài khoản của tôi</h1>
                            <?php if (isset($_COOKIE['mess'])): ?>
                                <center style="color: #D24F07; margin-top: 30px; font-size: 20px"><?php echo $_COOKIE['mess'] ?></center>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title end -->
            
            <!-- My Account page content Start -->
            <div id="myaccount-page-content">
                <div class="container">
                    <div class="account-text-wrapper">
                        <div class="row">
                        <div class="col-md-3">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Bảng điều khiển</a>

                                <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Đơn hàng</a>

                                <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> địa chỉ</a>

                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> chi tiết tài khoản</a>

                                <a href="?action=logout"><i class="fa fa-sign-out"></i> đăng xuất</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-md-9 mt-15 mt-lg-0">
                            <div class="tab-content" id="myaccountContent">
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Bảng điều khiển</h3>

                                        <div class="welcome">
                                            <p>Xin chào, <strong><?= $user['name']?></strong> (Nếu không phải <strong><?= $user['name']?> !</strong><a
                                                    href="?action=logout" class="logout"> Đăng xuất</a>)</p>
                                        </div>

                                        <p class="mb-0" style="width: 70%;">Từ bảng điều khiển tài khoản của bạn. bạn có thể dễ dàng kiểm tra và xem các đơn đặt hàng gần đây, quản lý địa chỉ giao hàng và thanh toán cũng như chỉnh sửa mật khẩu và chi tiết tài khoản của bạn.</p><br>
                                        <p>Point: <?php echo $user['points'] ?> <i class="fa fa-star"></i></p>
                                        <form method="post" enctype="multipart/form-data">
                                            <div style="text-align: center ;float: right; width: 15%;height: 200px; margin-top: -100px; display: block;">
                                                <label for="img" onclick="myFunction()">
                                                    <img style="width: 100px;" src="<?php echo $user['avatar'] ?>" alt="">
                                                </label>
                                                <input type="file" id="img" name="avatar_update" style="display: none;">
                                                <button style="display: none; margin: 0 50px 0 50px" class="btn" id="show_btn" name="btn_update_avatar">Update</button>
                                                <script>
                                                    function myFunction() {
                                                        var x = document.getElementById("show_btn");
                                                        if (x.style.display === "none") {
                                                            x.style.display = "block";
                                                        } else {
                                                            x.style.display = "none";
                                                        }
                                                    }
                                                </script>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>

                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Products</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php if ($orders == null): ?>
                                                    Bạn chưa có đơn đặt hàng nào
                                                <?php endif ?>
                                                <?php if ($orders != null): ?>
                                                    <?php foreach ($orders as $value): ?>
                                                        <tr>
                                                            <td><?php echo $value['stt'] ?></td>
                                                            <td>
                                                                <!-- select ra những sản phẩm trong order này -->
                                                                <?php
                                                                $order_id = $value['id'];
                                                                $sqlQuery = "SELECT image
                                                                                from order_detail
                                                                            where order_id=$order_id";
                                                                $imagePro = executeQuery($sqlQuery, true);
                                                                ?>
                                                                <?php if ($imagePro != null): ?>
                                                                    <?php foreach ($imagePro as $ima): ?>
                                                                        <a href="<?php echo $ima['image'] ?>"><img style="width: 50px" src="<?php echo $ima['image'] ?>" alt=""></a>
                                                                    <?php endforeach ?>
                                                                <?php endif ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $value['created_date'] ?>
                                                            </td>
                                                            <td><?php echo $value['status'] ?></td>
                                                            <td><?php echo number_format($value['total_price'], 0, '', ','); ?> vnđ</td>
                                                            <td>
                                                                <?php
                                                                if($value['status'] == "1 - chờ xử lý"){
                                                                    ?>
                                                                    <form action="update-order.php" method="post" style="margin-top: 5px">
                                                                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                                                                        <button class="btn" onclick="return confirm('Bạn có chắc hủy đơn hàng ?')">Hủy</button>
                                                                    </form>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <a href="javascript:void(0)" class="btn_disable"><button  onclick="return alert('Đơn hàng đã xác nhận không thể hủy')" class="btn disabled">Hủy</button></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                <?php endif ?>                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="download" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Downloads</h3>

                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Date</th>
                                                    <th>Expire</th>
                                                    <th>Download</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <tr>
                                                    <td>Haven - Free Real Estate PSD Template</td>
                                                    <td>Aug 22, 2018</td>
                                                    <td>Yes</td>
                                                    <td><a href="#" class="btn">Download File</a></td>
                                                </tr>
                                                <tr>
                                                    <td>HasTech - Profolio Business Template</td>
                                                    <td>Sep 12, 2018</td>
                                                    <td>Never</td>
                                                    <td><a href="#" class="btn">Download File</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Payment Method</h3>

                                        <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Địa chỉ thanh toán</h3>
                        
                                        <address>
                                            <p><strong><?= $user['name']?></strong></p>
                                            <?php
                                            if ($user['address'] != ""){
                                                ?>
                                                <p><?php echo $user['address'] ?></p>
                                                <?php
                                            }else{
                                                ?>
                                                <p>Địa chỉ trống ...</p>
                                                <?php
                                            }
                                            ?>
                                            
                                            <?php
                                            if ($user['phone_number'] != ""){
                                                ?>
                                                <p><?php echo $user['phone_number'] ?></p>
                                                <?php
                                            }else{
                                                ?>
                                                <p>Số điện thoại: ...</p>
                                                <?php
                                            }
                                            ?>
                                            <div><?= $user['address']?></div>
                                        </address>
                                        <a href="#" class="btn d-inline-block"><i class="fa fa-edit"></i> Chỉnh sửa</a>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Chi Tiết Tài Khoản</h3>
                                        <div class="account-details-form checkout-form-list">
                                            <form method="post">
                                                <div class="single-input-item">
                                                    <label for="first-name" class="required">Họ Tên</label>
                                                    <input required="" type="text" id="first-name"
                                                    placeholder="First Name" name="name" value="<?= $user['name']?>" />
                                                </div>

                                                <div class="single-input-item">
                                                    <label for="email" class="required">Email</label>
                                                    <input required="" type="email" id="email" placeholder="Email Address" name="email" value="<?= $user['email']?>"/>
                                                </div>
                                                
                                                <div class="single-input-item">
                                                    <label for="email" class="required">Địa chỉ</label>
                                                    <input type="text" id="address" placeholder="Address" name="address" value="<?= $user['address']?>"/>
                                                </div>

                                                <div class="single-input-item">
                                                    <label for="phone_number" class="required">Số điện thoại</label>
                                                    <input type="text" maxlength="10" id="phone_number" placeholder="Phone Number" name="phone_number" value="<?= $user['phone_number']?>"/>
                                                </div>
                                                <div class="single-input-item">
                                                    <button class="btn" name="btn_update_detail">Cập nhật</button>
                                                </div>
                                            </form>
                                        </div>
                                            <div class="account-details-form checkout-form-list">
                                                <form method="post">
                                                    <fieldset>
                                                        <legend>Đổi mật khẩu</legend>
                                                        <div class="single-input-item">
                                                            <label for="current-pwd" class="required">Mật khẩu cũ</label>
                                                            <input required="" type="password" id="current-pwd"
                                                            name="now_password" placeholder="Current Password"/>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">Mật khẩu mới</label>
                                                                    <input required="" type="password" id="new-pwd"
                                                                    name="new_password"   placeholder="New Password"/>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Nhập lại mật khẩu mới</label>
                                                                    <input required="" type="password" id="confirm-pwd"
                                                                    name="confirm"   placeholder="Confirm Password"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item" style="margin-top: 20px">
                                                        <button class="btn" name="btn_update_password">Đổi mật khẩu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                            </div>
                        </div>
                        <!-- My Account Tab Content End -->
                    </div>
                    </div>
                </div>
            </div>
            <!-- My Account page content end -->
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
                                                            <a class="add-cart" href="cart.html">add to cart</a>
                                                        </div>
                                                        <div class="wishlist-compear-area">
                                                            <a href="wishlist.html"><i class="ion-ios-heart-outline"></i> Add to Wishlist</a>
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

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:16 GMT -->
</html>
