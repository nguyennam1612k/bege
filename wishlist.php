<?php
    require_once './commons/db.php';
    require_once './commons/constants.php';
    require_once './commons/helpers.php';

    //select wish list
    $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
    $user_id = $user['id'];
    
    if($user != null){
        $sqlQuery = "SELECT count(w.id) as count from products p inner join wish_lists w on w.product_id=p.id where user_id=$user_id";
        $count_w = executeQuery($sqlQuery, false);
        $countW = isset($count_w['count']) ? $count_w['count'] : 0;

        $sqlQuery = "SELECT w.*, p.name,p.feature_image, p.sale_price, p.quantum, p.sold
                    from products p
                    inner join wish_lists w
                    on w.product_id=p.id
                    where user_id=$user_id";
        $wishlists = executeQuery($sqlQuery, true);
    }else{
        $wishlists = null;
    }

    //Xóa wish list
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    if($action == "removeWish"){
        $id = $_GET['id'];
        $sqlDelete = "DELETE from wish_lists where id=$id";
        executeQuery($sqlDelete);
        // dd($sqlDelete);
        header('location: '.$_SERVER['HTTP_REFERER']);
    }
    
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Wishlist</title>
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
                                <span class="separator">/</span> Wishlist
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
                            <h1 class="entry-title">Wishlist</h1>
                            <?php if ($user == null): ?>
                                <center style="font-size: 20px; color: #C4820F; margin-top: 40px">Bạn cần đăng nhập để sử dụng chức năng này</center>
                            <?php endif ?>
                            <?php if ($user != null): ?>
                                <center style="font-size: 20px; color: #C4820F; margin-top: 40px">( <?php echo $countW ?> sản phẩm trong danh sách yêu thích)</center>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title end -->
            <!-- cart page content -->
            <div class="cart-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <!-- Form Start -->
                            <form action="#">
                                <!-- Table Content Start -->
                                <div class="table-content table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-remove">Remove</th>
                                                <th class="product-thumbnail">Image</th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price" width="20%">Unit Price</th>
                                                <th class="product-quantity">Stock Status</th>
                                                <th class="product-subtotal">add to cart</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($wishlists != null): ?>
                                                <?php foreach ($wishlists as $value): ?>
                                                    <tr>
                                                        <td class="product-remove"> <a href="?action=removeWish&id=<?php echo $value['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                                        <td class="product-thumbnail">
                                                            <a href="<?php echo $value['feature_image'] ?>"><img src="<?php echo $value['feature_image'] ?>" alt="cart-image"></a>
                                                        </td>
                                                        <td class="product-name"><a href="single-product.php?product_id=<?php echo $value['product_id'] ?>"><?php echo $value['name'] ?></a></td>
                                                        <td class="product-price"><span class="amount"><?php echo number_format($value['sale_price'], 0, '', ','); ?> vnđ</span></td>
                                                        <td class="product-stock-status"><span>
                                                            <?php 
                                                            if ($value['quantum'] - $value['sold'] > 0) {
                                                                echo "Còn hàng";
                                                            }else{
                                                                echo "Hết hàng";
                                                            }
                                                             ?>
                                                        </span></td>
                                                        <td class="product-add-to-cart"><a href="add-cart.php?id=<?php echo $value['product_id'] ?>">Add to cart</a></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
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

                                        <li><a class="next page-numbers" href="?page=<?php echo $page+1 ?>">→</a></li>
                                    </ul>
                                </nav>
                                <!-- Table Content Start -->
                            </form>
                            <!-- Form End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- cart page content end -->
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



        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
        <script src="../../../www.google-analytics.com/analytics.js" async defer></script>
    </body>

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/wishlist.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
</html>
