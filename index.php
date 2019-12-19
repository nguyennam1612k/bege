<?php
    require_once './commons/db.php';
    require_once './commons/constants.php';
    require_once './commons/helpers.php';

    //Select menu category
    $sqlQuery = "SELECT * from categories limit 6";
    $cate = executeQuery($sqlQuery, true);

    //SELECT slide
    $sqlSlide = "SELECT * FROM `slides` WHERE status=1 ORDER BY `sort_order` ASC";
    $slide = executeQuery($sqlSlide, true);

    //Select deals banner
    $sqlQuery = "SELECT * from deals limit 3";
    $deals = executeQuery($sqlQuery, true);

    //Lượt mua nhiều nhất
    $sqlDealProduct = " SELECT* from products
                        order by sold DESC LIMIT 8";
    $topDealProducts = executeQuery($sqlDealProduct, true);

    //Sản phẩm nổi bật
    $sqlQuery = "SELECT * from products where especially=1 limit 16";
    $hotProducts = executeQuery($sqlQuery, true);

    //Sản phẩm top đánh giá
    $sqlQuery = "SELECT * from products order by rate desc limit 16";
    $rateProducts = executeQuery($sqlQuery, true);

    //Sản phẩm mới nằm trong sidebar
    $sqlNewProduct = "SELECT * from products order by id desc limit 16";
    $new_products = executeQuery($sqlNewProduct, true);
    //Sản phẩm thuộc 3 danh mục ngẫu nhiên
    $sqlQuery = "SELECT * from categories limit 3";
    $cate_group = executeQuery($sqlQuery, true);
?>
<!DOCTYPE html>
<html class="no-js" lang="en">


<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:19 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bege || Trang chủ</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="wrapper home-one home-two">
        <!-- HEADER AREA START -->
        <?php include "includes/header.php"?>
        <!-- HRADER AREA END -->
        <!-- Slider area -->
        <div class="slider-area">
            <div class="container">
                <div class="row">
                    <div class="slider col-xl-12">
                        <!-- slider-area start -->
                        <div class="slider-area-inner">
                            <!-- slider start -->
                            <div class="slider-inner">
                                <div id="mainSlider" class="nivoSlider nevo-slider">
                                    <!-- Ảnh slide -->
                                    <?php foreach($slide as $ima): ?>
                                    <img style="max-height: 540px" src="<?php echo $ima['image'] ?>" alt="main slider" title="#<?php echo $ima['id'] ?>" />
                                    <?php endforeach ?>
                                    <!-- Ảnh slide end -->
                                </div>
                                <!-- Caption slide -->
                                <?php foreach($slide as $cap): ?>
                                <div id="<?php echo $cap['id'] ?>" class="nivo-html-caption slider-caption">
                                    <div class="slider-progress"></div>
                                    <div class="col-md-9">
                                        <div class="slider-content slider-content-1 slider-animated-1">
                                            <?php $title = explode('/', $cap['title'], 3) ?>
                                            <h1 class="hone"><?php echo $title[0] ?></h1>
                                            <h1 class="htwo"><?php echo $title[1] = isset($title[1]) ? $title[1] : null ?></h1>
                                            <h1 class="hthree"><?php echo $title[2] = isset($title[2]) ? $title[2] : null ?></h1>
                                            <h3><?php echo $cap['content'] ?></h3>
                                            <div class="button-1 hover-btn-2">
                                                <a href="<?php echo $cap['url'] ?>">XEM NGAY</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach ?>                                
                                <!-- Caption slide end -->
                            </div>
                            <!-- slider end -->
                        </div>
                        <!-- slider-area end -->
                    </div>
                    <div class="slider-banner-area col-sm-12">
                        <?php foreach ($deals as $value): ?>
                         <div class="slider-banner">
                            <div class="slider-single-banner">
                                <a href="<?php echo $value['url'] ?>">
                                    <img src="<?php echo $value['image'] ?>" alt="Banner">
                                </a>
                            </div>
                        </div> 
                        <?php endforeach ?>                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider area end -->
        <!-- Product categori area -->
        <div class="product-categori-area">
            <div class="container">
                <div class="row">
                    <!-- Single categori -->
                    <?php foreach($cate as $meca): ?>
                    <div class="col-sm-6 col-md-4 col-lg-2 col-xl-2">
                        <div class="single-categori">
                            <div class="categori-images">
                                <a href="shop.php?cate_id=<?php echo $meca['id'] ?>">
                                    <img src="<?php echo $meca['image'] ?>" alt="categori images">
                                </a>
                            </div>
                            <div class="categori-text">
                                <a href="shop.php?cate_id=<?php echo $meca['id'] ?>" style="text-overflow: ellipsis;overflow: hidden; width: 100px;"><?php echo $meca['title'] ?></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <!-- Single categori end -->
                    
                </div>
            </div>
        </div>
        <!-- Product categori area end -->
        <!-- sidebar and content area -->
        <div class="sidebar-and-content-area">
            <div class="container">
                <div class="row">
                    <?php include "includes/sidebar.php" ?>
                    <div class="home-two-main-column col-sm-12 col-lg-9 col-md-12">
                        <!-- Best sellers -->
                        <div class="product-area">
                            <div class="container">
                                <div class="row">
                                    <div class="section-title">
                                        <h3>top giảm giá</h3>
                                    </div>
                                </div>
                                <div class="product-area-inner">
                                    <div class="row">
                                        <div class="product-carousel-active-h2 carosel-next-prive owl-carousel">
                                            <?php foreach($topDealProducts as $deal): ?>
                                            <div class="col-sm-12">
                                                <!-- single product -->
                                                <div class="single-product-area">
                                                    <div class="product-wrapper gridview">
                                                        <div class="list-col4">
                                                            <div class="product-image style-img">
                                                                <a href="single-product.php?product_id=<?php echo $deal['id'] ?>">
                                                                    <?php if($deal['price'] - $deal['sale_price'] >= 1000000 ){
                                                                        ?>
                                                                        <span class="onsale">Sale!</span>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                    <img src="<?php echo $deal['feature_image'] ?>" alt="">
                                                                </a>
                                                                <div class="quickviewbtn">

                                                                    <a href="#" data-proId="<?php echo $deal['id'] ?>" data-toggle="modal" data-target="#<?php echo $deal['id'] ?>" data-original-title="Quick View"><i class="ion-eye"></i></a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-col8">
                                                            <div class="product-info">
                                                                <h2><a href="single-product.php?product_id=<?php echo $deal['id'] ?>"><?php echo $deal['name'] ?></a></h2>
                                                                <span class="price">
                                                                    <del><?php echo vnd($deal['price']) ?> ₫</del> <?php echo vnd($deal['sale_price']) ?> ₫
                                                                </span>
                                                            </div>
                                                            <div class="product-hidden">
                                                                <div class="add-to-cart">
                                                                    <a href="add-cart.php?id=<?php echo $deal['id'] ?>&page=index">Thêm vào giỏ</a>
                                                                </div>
                                                                <div class="star-actions">
                                                                    <div class="product-rattings">
                                                                    <!-- Đánh giá sao -->
                                                                    <!-- if ($deal['rate'] == 0) { -->
                                                                    <?php rate($deal['rate']) ?>
                                                                    </div>

                                                                    <ul class="actions">
                                                                        <?php if ($user == null): ?>
                                                                            <li><a href="javascript:void(0)" onclick="return alert('Bạn cần đăng nhập để sử dụng chức năng ngày')"><i class="ion-android-favorite-outline"></i></a></li>
                                                                        <?php endif ?>
                                                                        <?php
                                                                        if ($user != null) {
                                                                            $user_id = $user['id'];
                                                                            $product_id = $deal['id'];
                                                                            $sqlCheck = "SELECT * from wish_lists where user_id=$user_id and product_id=$product_id";
                                                                            $checkWish = executeQuery($sqlCheck, false);
                                                                            if($checkWish == null){
                                                                                ?>
                                                                                <li><a href="add-wish.php?id=<?php echo $deal['id'] ?>"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                <?php
                                                                            }else{
                                                                                ?>
                                                                                <li><a href="javascipt:void(0)" onclick="return alert('Sản phẩm đã tồn tại trong danh sách yêu thích')"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <li><a href="javascript:void(0)"><i class="ion-ios-shuffle-strong"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- single product end -->
                                            </div>
                                            <?php endforeach ?>                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Best sellers end -->
                        <!-- Home fullwidth banner -->
                        <div class="home-fullwidth-banner-area">
                            <div class="container">
                                <div class="row">
                                    <a href="javascript:void(0)">
                                        <img src="images/banner/home2-banner1.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Home fullwidth banner end -->
                        <!-- Tab area product -->
                        <div class="tab-area-product">
                            <div class="tab-product">
                                <ul class="nav nav-tabs home-tabs-title">
                                    <li class="active"><a data-toggle="tab" href="#product1">Sản phẩm nổi bật</a></li>
                                    <li><a data-toggle="tab" href="#product2">Top đánh giá</a></li>
                                    <li><a data-toggle="tab" href="#product3">Sản phẩm mới</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="product1" class="tab-pane fade in show active">
                                        <div class="product-area-inner">
                                            <div class="row">
                                                <div class="home-two-product-carousel-active owl-carousel">
                                                    <!-- Sản phẩm nổi bật, lần lượt 2 sản phẩm -->
                                                    <div class="col-sm-12">
                                                    <?php $is = 0 ?>
                                                    <?php foreach ($hotProducts as $value): ?>
                                                        <?php $is++ ?>
                                                        <!-- single product -->
                                                        <div class="single-product-area">
                                                            <div class="product-wrapper gridview">
                                                                <div class="list-col4">
                                                                    <div class="product-image">
                                                                        <a href="single-product.php?product_id=<?php echo $value['id'] ?>">
                                                                            <?php if($value['price'] - $value['sale_price'] >= 1000000 ){
                                                                                ?>
                                                                                <span class="onsale">Sale!</span>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <img src="<?php echo $value['feature_image'] ?>" alt="">
                                                                        </a>
                                                                        <div class="quickviewbtn">
                                                                            <a href="#" data-toggle="modal" data-target="#<?php echo $value['id'] ?>" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-col8">
                                                                    <div class="product-info">
                                                                        <h2><a href="single-product.php?product_id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h2>
                                                                        <span class="price">
                                                                            <del><?php echo number_format($value['price'], 0, '', ',') ?> ₫</del> <?php echo number_format($value['sale_price'], 0, '', ',') ?> ₫
                                                                        </span>
                                                                    </div>
                                                                    <div class="product-hidden">
                                                                        <div class="add-to-cart">
                                                                            <a href="add-cart.php?id=<?php echo $value['id'] ?>">Add to cart</a>
                                                                        </div>
                                                                        <div class="star-actions">
                                                                            <div class="product-rattings">
                                                                                <?php rate($value['rate']) ?>
                                                                            </div>
                                                                            <ul class="actions">

                                                                                <?php if ($user == null): ?>
                                                                                    <li><a href="javascript:void(0)" onclick="return alert('Bạn cần đăng nhập để sử dụng chức năng ngày')"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                <?php endif ?>
                                                                                <?php
                                                                                if($user != null){
                                                                                    $user_id = $user['id'];
                                                                                    $product_id = $value['id'];
                                                                                    $sqlCheck = "SELECT * from wish_lists where user_id=$user_id and product_id=$product_id";
                                                                                    $checkWish = executeQuery($sqlCheck, false);
                                                                                    if($checkWish == null){
                                                                                        ?>
                                                                                        <li><a href="add-wish.php?id=<?php echo $value['id'] ?>"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                        <?php
                                                                                    }else{
                                                                                        ?>
                                                                                        <li><a href="javascipt:void(0)" onclick="return alert('Sản phẩm đã tồn tại trong danh sách yêu thích')"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <li><a href="javascript:void(0)"><i class="ion-ios-shuffle-strong"></i></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- single product end -->
                                                        <?php 
                                                        if($is%2 == 0 && $i != 16){
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <?php
                                                        }
                                                        ?>
                                                    <?php endforeach ?>
                                                    </div>
                                                    <!-- Duyệt 2 sản phẩm 1 lần -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="product2" class="tab-pane fade">
                                        <div class="product-area-inner">
                                            <div class="row">
                                                <div class="home-two-product-carousel-active owl-carousel">

                                                    <!-- Sản phẩm nổi bật, lần lượt 2 sản phẩm -->
                                                    <div class="col-sm-12">
                                                        <?php $is = 0 ?>
                                                        <?php foreach ($rateProducts as $value): ?>
                                                            <?php $is++ ?>
                                                            <!-- single product -->
                                                            <div class="single-product-area">
                                                                <div class="product-wrapper gridview">
                                                                    <div class="list-col4">
                                                                        <div class="product-image">
                                                                            <a href="single-product.php?product_id=<?php echo $value['id'] ?>">
                                                                                <?php if($value['price'] - $value['sale_price'] >= 1000000 ){
                                                                                    ?>
                                                                                    <span class="onsale">Sale!</span>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                <img src="<?php echo $value['feature_image'] ?>" alt="">
                                                                            </a>
                                                                            <div class="quickviewbtn">
                                                                                <a href="#" data-toggle="modal" data-target="#<?php echo $value['id'] ?>" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-col8">
                                                                        <div class="product-info">
                                                                            <h2><a href="single-product.php?product_id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h2>
                                                                            <span class="price">
                                                                                <del><?php echo number_format($value['price'], 0, '', ',') ?> ₫</del> <?php echo number_format($value['sale_price'], 0, '', ',') ?> ₫
                                                                            </span>
                                                                        </div>
                                                                        <div class="product-hidden">
                                                                            <div class="add-to-cart">
                                                                                <a href="add-cart.php?id=<?php echo $value['id'] ?>">Add to cart</a>
                                                                            </div>
                                                                            <div class="star-actions">
                                                                                <div class="product-rattings">
                                                                                    <?php rate($value['rate']) ?>
                                                                                </div>
                                                                            <ul class="actions">

                                                                                <?php if ($user == null): ?>
                                                                                    <li><a href="javascript:void(0)" onclick="return alert('Bạn cần đăng nhập để sử dụng chức năng ngày')"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                <?php endif ?>
                                                                                <?php
                                                                                if($user != null){
                                                                                    $user_id = $user['id'];
                                                                                    $product_id = $value['id'];
                                                                                    $sqlCheck = "SELECT * from wish_lists where user_id=$user_id and product_id=$product_id";
                                                                                    $checkWish = executeQuery($sqlCheck, false);
                                                                                    if($checkWish == null){
                                                                                        ?>
                                                                                        <li><a href="add-wish.php?id=<?php echo $value['id'] ?>"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                        <?php
                                                                                    }else{
                                                                                        ?>
                                                                                        <li><a href="javascipt:void(0)" onclick="return alert('Sản phẩm đã tồn tại trong danh sách yêu thích')"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <li><a href="javascript:void(0)"><i class="ion-ios-shuffle-strong"></i></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- single product end -->
                                                        <?php 
                                                        if($is%2 == 0 && $i != 16){
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <?php
                                                        }
                                                        ?>
                                                    <?php endforeach ?>
                                                </div>
                                                <!-- Duyệt 2 sản phẩm 1 lần -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="product3" class="tab-pane fade">
                                        <div class="product-area-inner">
                                            <div class="row">
                                                <div class="home-two-product-carousel-active owl-carousel">
                                                    <!-- Sản phẩm mới, lần lượt 2 sản phẩm -->
                                                    <div class="col-sm-12">
                                                        <?php $is = 0 ?>
                                                        <?php foreach ($new_products as $value): ?>
                                                            <?php $is++ ?>
                                                            <!-- single product -->
                                                            <div class="single-product-area">
                                                                <div class="product-wrapper gridview">
                                                                    <div class="list-col4">
                                                                        <div class="product-image">
                                                                            <a href="single-product.php?product_id=<?php echo $value['id'] ?>">
                                                                                <?php if($value['price'] - $value['sale_price'] >= 1000000 ){
                                                                                    ?>
                                                                                    <span class="onsale">Sale!</span>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                <img src="<?php echo $value['feature_image'] ?>" alt="">
                                                                            </a>
                                                                            <div class="quickviewbtn">
                                                                                <a href="#" data-toggle="modal" data-target="#<?php echo $value['id'] ?>" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="list-col8">
                                                                        <div class="product-info">
                                                                            <h2><a href="single-product.php?product_id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h2>
                                                                            <span class="price">
                                                                                <del><?php echo number_format($value['price'], 0, '', ',') ?> ₫</del> <?php echo number_format($value['sale_price'], 0, '', ',') ?> ₫
                                                                            </span>
                                                                        </div>
                                                                        <div class="product-hidden">
                                                                            <div class="add-to-cart">
                                                                                <a href="add-cart.php?id=<?php echo $value['id'] ?>">Add to cart</a>
                                                                            </div>
                                                                            <div class="star-actions">
                                                                                <div class="product-rattings">
                                                                                    <?php rate($value['rate']) ?>
                                                                            </div>
                                                                            <ul class="actions">

                                                                                <?php if ($user == null): ?>
                                                                                    <li><a href="javascript:void(0)" onclick="return alert('Bạn cần đăng nhập để sử dụng chức năng ngày')"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                <?php endif ?>
                                                                                <?php
                                                                                if($user != null){
                                                                                    $user_id = $user['id'];
                                                                                    $product_id = $value['id'];
                                                                                    $sqlCheck = "SELECT * from wish_lists where user_id=$user_id and product_id=$product_id";
                                                                                    $checkWish = executeQuery($sqlCheck, false);
                                                                                    if($checkWish == null){
                                                                                        ?>
                                                                                        <li><a href="add-wish.php?id=<?php echo $value['id'] ?>"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                        <?php
                                                                                    }else{
                                                                                        ?>
                                                                                        <li><a href="javascipt:void(0)" onclick="return alert('Sản phẩm đã tồn tại trong danh sách yêu thích')"><i class="ion-android-favorite-outline"></i></a></li>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                                <li><a href="javascript:void(0)"><i class="ion-ios-shuffle-strong"></i></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- single product end -->
                                                        <?php 
                                                        if($is%2 == 0 && $i != 16){
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <?php
                                                        }
                                                        ?>
                                                    <?php endforeach ?>
                                                </div>
                                                <!-- Duyệt 2 sản phẩm 1 lần -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tab area product end -->
                        <!-- Home two banner area -->
                        <div class="home-two-banner-area">
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="shop.html">
                                        <img src="images/banner/home2-banner2-1.jpg" alt="bege images">
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="shop.html">
                                        <img src="images/banner/home2-banner2-2.jpg" alt="bege images">
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="shop.html">
                                        <img src="images/banner/home2-banner2-3.jpg" alt="bege images">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Home two banner area end -->
                        <!-- product carosel area -->
                        <div class="product-carosel-area">
                            <div class="container55555">
                                <div class="row">
                                    <!-- Product column -->
                                    <?php foreach ($cate_group as $ca_gr): ?>
                                    <div class="col-sm-12 col-md-12 col-xl-4">
                                        <div class="section-title">
                                            <h3><?php echo $ca_gr['title'] ?></h3>
                                        </div>
                                        <div class="mini-product-2 carosel-next-prive owl-carousel">
                                            <div class="mini-product-listview">
                                                <?php
                                                $id_cate = $ca_gr['id'];
                                                $sqlQuery = "SELECT * from products where cate_id=$id_cate limit 12";
                                                $product_group = executeQuery($sqlQuery, true);
                                                 ?>
                                                <!-- single product -->
                                                <?php $pg1 = 0 ?>
                                                <?php if ($product_group != null): ?>
                                                    <?php foreach ($product_group as $pr_gr): ?>
                                                        <?php $pg1++ ?>
                                                        <div class="single-product-area">
                                                            <div class="product-wrapper listview">
                                                                <div class="list-col4">
                                                                    <div class="product-image">
                                                                        <a href="single-product.php?product_id=<?php echo $pr_gr['id'] ?>">
                                                                            <img src="<?php echo $pr_gr['feature_image'] ?>" alt="">
                                                                        </a>
                                                                        <div class="quickviewbtn">
                                                                            <a href="#" data-toggle="modal" data-target="#<?php echo $pr_gr['id'] ?>" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-col8">
                                                                    <div class="product-info">
                                                                        <h2><a href="single-product.php?product_id=<?php echo $pr_gr['id'] ?>"><?php echo $pr_gr['name'] ?></a></h2>
                                                                        <span class="price">
                                                                            <?php echo number_format($pr_gr['sale_price'], 0, '', ',') ?> ₫
                                                                        </span>
                                                                        <div class="product-rattings">
                                                                            <?php rate($pr_gr['rate']) ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="add-to-cart">
                                                                        <a href="add-cart.php?id=<?php echo $pr_gr['id'] ?>">Add to cart</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php 
                                                        if($pg1%4 == 0 && $pg1 != 12){
                                                            ?>
                                                        </div>
                                                        <div class="mini-product-listview">
                                                            <?php
                                                        }
                                                        ?>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                                <?php if ($product_group == null): ?>
                                                    <?php echo "Trống" ?>
                                                <?php endif ?>
                                                <!-- single product end -->
                                                </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                    <!-- Product column end -->
                                </div>
                            </div>
                        </div>
                        <!-- product carosel area end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar and content area end -->
        <!-- Footer area -->
        <?php include "includes/footer.php" ?>
        <!-- QUICKVIEW PRODUCT START -->
        <?php include "includes/quickview.php" ?>

        <!-- QUICKVIEW PRODUCT END -->
    </div>
    <!-- Body main wrapper end -->
    <script>
        window.jQuery || document.write('<script src="js/jquery-3.2.1.min.js"><\/script>')

    </script>

    <!-- Popper min js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap min js  -->
    <script src="js/bootstrap.min.js"></script>
    <!-- nivo slider pack js  -->
    <script src="js/jquery.nivo.slider.pack.js"></script>
    <!-- All plugins here -->
    <script src="js/plugins.js"></script>
    <!-- Main js  -->
    <script src="js/main.js"></script>



    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')

    </script>
</body>


<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:38 GMT -->
</html>
<script type="text/javascript">
    $('.home-tabs-title').on('click', 'li', function(){
        $('.home-tabs-title li').removeClass('active');
        $(this).addClass('active');
    });
</script>