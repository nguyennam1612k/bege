<?php
require_once './commons/db.php';
require_once './commons/constants.php';
require_once './commons/helpers.php';

// $cart = isset($_SESSION[CART]) ? $_SESSION[CART] : [];

// dd($cart);
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Shoping cart</title>
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
                                <span class="separator">/</span> Cart
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
                            <h1 class="entry-title">Cart</h1>
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
                            <form action="update-cart.php" method="post">
                                <!-- Table Content Start -->
                                <div class="table-content table-responsive mb-50">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Image</th>
                                                <th class="product-name">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-subtotal">Total</th>
                                                <th class="product-remove">Remove</th>
                                            </tr>
                                        </thead>
                                        <!-- <tbody>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img src="images/product/1.jpg" alt="cart-image"></a>
                                                </td>
                                                <td class="product-name"><a href="#">dictum idrisus</a></td>
                                                <td class="product-price"><span class="amount">£165.00</span></td>
                                                <td class="product-quantity"><input type="number" value="1"></td>
                                                <td class="product-subtotal">£165.00</td>
                                                <td class="product-remove"> <a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a href="#"><img src="images/product/2.jpg" alt="cart-image"></a>
                                                </td>
                                                <td class="product-name"><a href="#">Carte Postal Clock</a></td>
                                                <td class="product-price"><span class="amount">£50.00</span></td>
                                                <td class="product-quantity"><input type="number" value="1"></td>
                                                <td class="product-subtotal">£50.00</td>
                                                <td class="product-remove"> <a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                            </tr>
                                        </tbody> -->
                                        <tbody>
                                            <?php foreach ($cart as $key => $item): ?>

                                                <tr>
                                                    <td class="product-thumbnail">
                                                        <a href="#">
                                                            <img src="<?php echo $item['feature_image'] ?>" alt="">
                                                        </a>
                                                    </td>
                                                    <td class="product-name">
                                                        <a href="#"><?php echo $item['name'] ?></a>
                                                    </td>
                                                    <td class="product-price">
                                                        <span class="amount"><?php echo number_format($item['sale_price'], 0, '', ','); ?> vnđ</span>

                                                    </td>
                                                    <td class="product-quantity">
                                                        <input type="number" min="1" name="quantity[<?php echo $key ?>]" value="<?php echo $item['quantity'] ?>">
                                                    </td>
                                                    <td class="product-subtotal"><?php 
                                                    $itemTotal = $item['sale_price']*$item['quantity'];

                                                    echo number_format($itemTotal, 0, '', ','); ?> vnđ</td>
                                                    <td class="product-remove"> <a href="?action=deleteCart&id=<?php echo $item['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                                </tr>
                                            <?php endforeach ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Table Content Start -->
                                <div class="row">
                                   <!-- Cart Button Start -->
                                    <div class="col-md-8 col-sm-7 col-xs-12">
                                        <div class="buttons-cart">
                                            <input type="submit" value="Update Cart">
                                            <a href="shop.php">Continue Shopping</a>
                                        </div>
                                    </div>
                                    <!-- Cart Button Start -->
                                    <!-- Cart Totals Start -->
                                    <div class="col-md-4 col-sm-5 col-xs-12">
                                        <div class="cart_totals">
                                            <h2>Cart Totals</h2>
                                            <br>
                                            <table>
                                                <tbody>
                                                    <tr class="cart-subtotal">
                                                        <th>Subtotal</th>
                                                        <td><span class="amount"><?php echo number_format($totalPrice, 0, '', ','); ?> vnđ </span></td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <th>Total</th>
                                                        <td>
                                                            <strong><span class="amount"><?php echo number_format($totalPrice, 0, '', ','); ?> vnđ </span></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="wc-proceed-to-checkout">
                                                <a href="checkout.php">Proceed to Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cart Totals End -->
                                </div>
                                <!-- Row End -->
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

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:17 GMT -->
</html>
