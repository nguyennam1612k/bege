<?php
    require_once "commons/db.php";
    require_once "commons/constants.php";
    require_once "commons/helpers.php";

    
    //PHÂN TRANG
    $page=1;//khởi tạo trang ban đầu
    $limit=16;//số bản ghi trên 1 trang (2 bản ghi trên 1 trang)
    
    $arrs_list = "SELECT count(id) as count from products";
    $count = executeQuery($arrs_list);

    $total_record = $count['count'];//tính tổng số bản ghi có trong bảng khoahoc
    
    $total_page = $total_record/$limit;//tính tổng số trang sẽ chia

    //xem trang có vượt giới hạn không:
    if(isset($_GET["page"])){
        $page=$_GET["page"];//nếu biến $_GET["page"] tồn tại thì trang hiện tại là trang $_GET["page"]
    }
    if($page<1){
        $page=1;
    }  //nếu trang hiện tại nhỏ hơn 1 thì gán bằng 1
    if($page>$total_page){
        $page=$total_page;
    } //nếu trang hiện tại vượt quá số trang được chia thì sẽ bằng trang cuối cùng

    //tính start (vị trí bản ghi sẽ bắt đầu lấy):
    $start=($page-1)*$limit;
    //PHÂN TRANG END

    $sqlQuery = "SELECT * from products limit $start,$limit";
    $products = executeQuery($sqlQuery, true);

    //đếm số sản phẩm phù hợp
    $sqlDem = "SELECT count(id) as count from products";
    $reality = executeQuery($sqlDem, false);
    $reality = isset($reality) ? $reality : null;

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Cửa hàng</title>
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
                                <span class="separator">/</span> Cửa hàng
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Breadcrumbs End -->
            
            <!-- Shop page wraper -->
            <div class="shop-page-wraper">
                <div class="container">
                    <div class="row">
                            <?php include "includes/sidebar-shop.php" ?>
                        <div class="col-xs-12 col-md-9 shop-content">
                            <div class="product-toolbar">
                                <div class="topbar-title">
                                    <h1>CỬA HÀNG</h1>
                                    ( Hiện thị tất cả sản phẩm )
                                </div>
                                <?php
                                //đếm số lượng sản phẩm select
                                $countAb = $reality['count']; 
                                ?>
                                <div class="product-toolbar-inner">
                                    <div class="product-view-mode">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#grid"><i class="ion-grid"></i></a></li>
                                            <li><a data-toggle="tab" href="#list"><i class="ion-navicon"></i></a></li>
                                        </ul>
                                    </div>
                                    <p class="woocommerce-result-count">Hiện thị 1–12 trong <?php echo $countAb ?> kết quả</p>
                                    <div class="woocommerce-ordering">
                                        <form method="get" class="woocommerce-ordering hidden-xs">
                                            <div class="orderby-wrapper">
                                                <label>Sắp xếp :</label>
                                                <select class="nice-select-menu orderby">
                                                    <option dara-display="Select">Mặc định phân loại</option>
                                                    <option value="popularity">Mức độ phổ biến</option>
                                                    <option value="rating">Đánh giá cao</option>
                                                    <option value="date">Sản phẩm mới</option>
                                                    <option value="price">Theo giá: thấp đến cao</option>
                                                    <option value="price-desc">Theo giá: cao đến thấp</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="shop-page-product-area tab-content">
                                    <div id="grid" class="tab-pane fade in show active">
                                        <div class="row">
                                            <?php foreach ($products as $value): ?>
                                                <div class="col-sm-6 col-md-4 col-xl-3">
                                                    <div class="single-product-area">
                                                        <div class="product-wrapper gridview">
                                                            <div class="list-col4">
                                                                <div class="product-image">
                                                                    <a href="single-product.php?product_id=<?php echo $value['id'] ?>">
                                                                        <center>
                                                                        <img style="width: 300px; max-height: 250px" src="<?php echo $value['feature_image'] ?>" alt="">
                                                                        </center>
                                                                    </a>
                                                                    <div class="quickviewbtn">
                                                                        <a href="#" data-toggle="modal" data-target="#<?php echo $value['id'] ?>"  data-original-title="Quick View"><i class="ion-eye"></i></a>
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
                                                                        <a href="add-cart.php?id=<?php echo $value['id'] ?>">Thêm vào giỏ</a>
                                                                    </div>
                                                                    <div class="star-actions">
                                                                        <div class="product-rattings">
                                                                            <?php
                                                                            if ($value['rate'] == 0) {
                                                                                $pp = true;
                                                                            }
                                                                            for($j = 1; $j <= 5; $j++){
                                                                                if($value['rate'] >= $j){
                                                                                    $starClass = "fa fa-star";
                                                                                    $pp = is_float($value['rate']);
                                                                                }else if($pp == false ){
                                                                                    $starClass = "fa fa-star-half-o";
                                                                                    $pp = true;
                                                                                }else{
                                                                                    $starClass = "fa fa-star-o";
                                                                                }
                                                                                ?>
                                                                                <span><i class="<?php echo $starClass ?>"></i></span>
                                                                                <?php
                                                                            }
                                                                            ?>
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
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <div id="list" class="tab-pane fade">
                                        <div class="row">
                                            <?php $ik = 0 ?>
                                            <?php foreach ($products as $value): ?>
                                                <?php $ik++ ?>
                                                <?php if ($ik <= 8): ?>
                                                    <div class="col-sm-12">
                                                        <div class="single-product-area">
                                                            <div class="product-wrapper listview">
                                                                <div class="list-col4">
                                                                    <div class="product-image">
                                                                        <a href="single-product.php?product_id=<?php echo $value['id'] ?>">
                                                                            <?php if ($value['price'] - $value['sale_price'] >= 1000000): ?>
                                                                                <span class="onsale">Sale!</span>
                                                                            <?php endif ?>
                                                                            <img src="<?php echo $value['feature_image'] ?>" alt="">
                                                                        </a>
                                                                        <div class="quickviewbtn">
                                                                            <a href="#" data-toggle="modal" data-target="#<?php echo $value['id'] ?>"  data-original-title="Quick View"><i class="ion-eye"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-col8">
                                                                    <div class="product-info">
                                                                        <h2><a href="single-product.html"><?php echo $value['name'] ?></a></h2>
                                                                        <span class="price">
                                                                            <del><?php echo number_format($value['price'], 0, '', ',') ?> ₫</del> $ <?php echo number_format($value['sale_price'], 0, '', ',') ?> ₫
                                                                        </span>
                                                                        <div class="product-rattings">
                                                                            <?php
                                                                            if ($value['rate'] == 0) {
                                                                                    $op = true;
                                                                                }
                                                                            for($ia = 1; $ia <= 5; $ia++){
                                                                                if($value['rate'] >= $ia){
                                                                                    $starClass = "fa fa-star";
                                                                                    $op = is_float($value['rate']);
                                                                                }else if( $op == false ){
                                                                                    $starClass = "fa fa-star-half-o";
                                                                                    $op = true;
                                                                                }else{
                                                                                    $starClass = "fa fa-star-o";
                                                                                }
                                                                                ?>
                                                                                <span><i class="<?php echo $starClass ?>"></i></span>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div class="product-desc">
                                                                            <p><?php echo $value['detail'] ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="actions-wrapper">
                                                                        <div class="add-to-cart">
                                                                            <a href="add-cart.php?id=<?php echo $value['id'] ?>">Thêm vào giỏ</a>
                                                                        </div>
                                                                        <div class="star-actions">
                                                                            <ul class="actions">
                                                                                <?php if ($user == null): ?>
                                                                                    <li><a href="javascript:void(0)" onclick="return alert('Bạn cần đăng nhập để sử dụng chức năng này')"><i class="ion-android-favorite-outline"></i>Thêm vào yêu thích</a></li>
                                                                                <?php endif ?>
                                                                                <?php if ($user != null): ?>
                                                                                    <li><a href="#"><i class="ion-android-favorite-outline"></i>Thêm vào yêu thích</a></li>
                                                                                <?php endif ?>
                                                                                <li><a href="javascript:void(0)"><i class="ion-ios-shuffle-strong"></i>So sánh</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <nav class="woocommerce-pagination">
                                <ul class="page-numbers">

                                    <?php
                                    $url_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                    for($tik = 1; $tik <= $total_page; $tik++){

                                        if($url_page == $tik){
                                            $classPage = "current";
                                        }else{
                                            $classPage = "";
                                        }

                                        ?>
                                        <li><a class="page-numbers" href="?page=<?php echo $tik ?>"><span class="<?php echo $classPage ?>"><?php echo $tik ?></span></a></li>

                                        <?php
                                    }
                                    ?>

                                    <?php if ($tik > 1): ?>
                                        <li><a class="next page-numbers" href="?page=<?php echo $page+1 ?>">→</a></li>
                                    <?php endif ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div> 
            </div>
            <!-- Shop page wraper end -->
            <?php include "includes/footer.php" ?>
            <!-- QUICKVIEW PRODUCT START -->
            <?php include "includes/quickview.php" ?>
            <!-- QUICKVIEW PRODUCT END -->
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

        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
    </body>

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:19 GMT -->
</html>
