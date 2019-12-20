<?php
    require_once "commons/db.php";
    require_once "commons/constants.php";
    require_once "commons/helpers.php";
    //Lấy id product
    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
    if($product_id == null){
        $sqlRand = "SELECT id from products order by RAND() limit 1";
        $randomProduct = executeQuery($sqlRand, false);
        $product_id = $randomProduct['id'];
    }

    //Cộng thêm lượt xem mỗi khi truy cập
    $sqlUpdateView = "UPDATE products set views=views+1 where id=$product_id";
    executeQuery($sqlUpdateView);

    //select product
    $sqlQuery = "SELECT
                    categories.title,products.*
                from
                    products inner join categories
                on
                    categories.id=products.cate_id
                where products.id=$product_id";
    $single = executeQuery($sqlQuery, false);

    //select comment và đánh giá
    $sqlQuery = "SELECT users.name, users.avatar, comments.*
                from comments INNER JOIN users ON users.id=comments.user_id
                WHERE product_id=$product_id";
    $comment = executeQuery($sqlQuery, true);

    //Đếm đánh giá
    $sqlQuery = "SELECT
                    COUNT(comments.id) as count,
                    AVG(rating) AS rating
                from
                    comments where product_id=$product_id";
    $rate = executeQuery($sqlQuery, false);

    //select album ảnh product
    $sqlQuery = "SELECT 
                    product_galleries.id, 
                    product_galleries.product_id, 
                    product_galleries.url, 
                    product_galleries.image_text 
                FROM product_galleries 
                where product_id=$product_id
                order by sort_order asc";
    $album = executeQuery($sqlQuery, true);

    //select sản phẩm liên quan random
    $cate_id = isset($single['cate_id']) ? $single['cate_id'] : null;
    $sqlQuery =     "SELECT * FROM products
                    WHERE cate_id=$cate_id
                    ORDER BY RAND()
                    LIMIT 5";
    $related = executeQuery($sqlQuery, true);
    // dd($related);

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:49:58 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Chi tiết Sản phẩm</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/icons/icon_logo.png">
        <!-- Place favicon.ico in the root directory -->
        <script src="https://kit.fontawesome.com/1fc0c130cc.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/ionicons.min.css">
        <link rel="stylesheet" href="css/css-plugins-call.css">
        <link rel="stylesheet" href="css/bundle.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link rel="stylesheet" href="css/colors.css">
        <style>
            *{
                margin: 0;
                padding: 0;
            }
            .rate {
                float: left;
                height: 46px;
                padding: 0 10px;
            }
            .rate:not(:checked) > input {
                position:absolute;
                top:-9999px;
            }
            .rate:not(:checked) > label {
                float:right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:30px;
                color:#ccc;
            }
            .rate:not(:checked) > label:before {
                content: '★';
            }
            .rate > input:checked ~ label {
                color: #ffc700;    
            }
            .rate:not(:checked) > label:hover,
            .rate:not(:checked) > label:hover ~ label {
                color: #deb217;  
            }
            .rate > input:checked + label:hover,
            .rate > input:checked + label:hover ~ label,
            .rate > input:checked ~ label:hover,
            .rate > input:checked ~ label:hover ~ label,
            .rate > label:hover ~ input:checked ~ label {
                color: #c59b08;
            }

            /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
        </style>
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
                                <span class="separator">/</span>
                                <a href="shop.php">Cửa hàng</a>
                                <span class="separator">/</span>
                                <a href="shop.php?cate_id=<?php echo $single['cate_id'] ?>"><?php echo $single['title'] ?></a>
                                <span class="separator">/</span> <?php echo $single['name'] ?>
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
                            <h1 class="entry-title"><?php echo $single['name'] ?></h1>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title end -->
           <!-- Single product area -->
           <div class="single-product-area">
               <div class="container">
                   <div class="single-product-wrapper">
                       <div class="row">
                           <div class="col-xs-12 col-md-7 col-lg-7">
                                <div class="product-details-img-content">
                                    <div class="product-details-tab mr-40">
                                        <div class="product-details-large tab-content">

                                            <div class="tab-pane active" id="pro-details1">
                                                <div class="product-popup">
                                                    <a href="<?php echo $single['feature_image'] ?>">
                                                        <center><img style="width: 377px; margin: auto" src="<?php echo $single['feature_image'] ?>" alt=""></center>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php $jk = 1 ?>
                                            <?php foreach ($album as $al): ?>
                                                <?php $jk++ ?>
                                                <div class="tab-pane" id="pro-details<?php echo $jk ?>">
                                                    <div class="product-popup">
                                                        <a href="<?php echo $al['url'] ?>">
                                                            <center><img style="width: 377px;" src="<?php echo $al['url'] ?>" alt=""></center>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                            
                                            
                                        </div>
                                        <div class="product-details-small nav product-dec-slider owl-carousel">
                                            
                                            <a class="active" href="#pro-details1">
                                                <img src="<?php echo $single['feature_image'] ?>" alt="">
                                            </a>
                                            <?php $jh = 1 ?>
                                            <?php foreach ($album as $al): ?>
                                                <?php $jh++ ?>
                                                <a class="active" href="#pro-details<?php echo $jh ?>">
                                                    <img src="<?php echo $al['url'] ?>" alt="">
                                                </a>
                                            <?php endforeach ?>

                                            
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <div class="col-xs-12 col-md-5 col-lg-5" style="padding-left: 5%">
                               <div class="single-product-info">
                                   <h1><?php echo $single['name'] ?></h1>
        
                                   <div class="product-rattings" style="float: left">
                                    <?php
                                    if ($single['rate'] == 0) {
                                        $pp = true;
                                    }
                                    for($j = 1; $j <= 5; $j++){
                                        if($single['rate'] >= $j){
                                            $starClass = "fa fa-star";
                                            $pp = is_float($single['rate']);
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
                                    <p style="float: right ;margin-right: 300px">Lượt xem: <?php echo $single['views'] ?> <i class="far fa-eye"></i></p>
                                    <span class="price">
                                        <del><?php echo number_format($single['price'], 0, '', ',') ?> ₫</del><br> <?php echo number_format($single['sale_price'], 0, '', ',') ?> ₫
                                    </span>
                                    <?php $detail = explode('&nbsp', $single['detail'], 2) ?>
                                    <p><?php echo $detail[0] ?> ....</p>
                                    <div class="box-quantity d-flex">
                                        <a class="add-cart" href="add-cart.php?id=<?php echo $single['id'] ?>">Cho vào giỏ</a>
                                    </div>
                                    <div class="wishlist-compear-area">

                                        <?php if ($user == null): ?>
                                            <a href="javascript:void(0)" onclick="return alert('Bạn cần đăng nhập để sử dụng chức năng này')" ><i class="ion-ios-heart-outline"></i> Thêm vào yêu thích</a>
                                        <?php endif ?>
                                        <?php
                                        if($user != null){
                                            $user_id = $user['id'];
                                            $product_id = $single['id'];
                                            $sqlCheck = "SELECT * from wish_lists where user_id=$user_id and product_id=$product_id";
                                            $checkWish = executeQuery($sqlCheck, false);
                                            if($checkWish == null){
                                                ?>
                                                <a href="add-wish.php?id=<?php echo $single['id'] ?>"><i class="ion-ios-heart-outline"></i> Thêm vào yêu thích</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a href="javascript:void(0)" onclick="return alert('Sản phẩm đã tồn tại trong danh sách yêu thích')" ><i class="ion-ios-heart-outline"></i> Thêm vào yêu thích</a>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <a href="javascript:void(0)"><i class="ion-ios-loop-strong"></i> So sánh</a>
                                    </div>
                                    <div class="product_meta">
                                        <span class="posted_in">Danh mục: <a href="shop.php?cate_id=<?php echo $single['cate_id'] ?>" rel="tag"><?php echo $single['title'] ?></a></span>
                                    </div>
                                    <div class="single-product-sharing">
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title">Chia sẻ sản phẩm</h3>
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
            <!-- product description -->
            <div class="product-description-area">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#description">Mô tả</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#reviews">Reviews <?php echo $rate['count'] ?></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="description" class="tab-pane fade in show active">
                                    <style>#more {display: none;}</style>
                                    <script>
                                        function myFunction() {
                                          var dots = document.getElementById("dots");
                                          var moreText = document.getElementById("more");
                                          var btnText = document.getElementById("myBtn");

                                          if (dots.style.display === "none") {
                                            dots.style.display = "inline";
                                            btnText.innerHTML = "Read more";
                                            moreText.style.display = "none";
                                        } else {
                                            dots.style.display = "none";
                                            btnText.innerHTML = "Read less";
                                            moreText.style.display = "inline";
                                        }
                                    }
                                    </script>
                                    <h2>Mô tả</h2>
                                    <div style="width: 45%; float: left;"><?php echo $single['detail'] ?></div>
                                    <div style="width: 45%; float: right; padding-left: 5%; margin-top: -5%">
                                        <p style="font-weight: bold; font-size: 26px">Thông số:</p> 
                                        <p><?php echo $single['parameter'] ?></p>
                                    </div>
                                </div>
                                <div id="reviews" class="tab-pane fade product-review-area">
                                    <h3><?php echo $rate['count'] ?> đánh giá cho <?php echo $single['name'] ?></h3>
                                    
                                    <?php if (!empty($comment)): ?>
                                    <?php foreach ($comment as $cmt): ?>
                                        <?php

                                        if($cmt['reply_for'] == null){//Nếu không có recomment
                                            ?>
                                            <ol class="commentlist">
                                                <!-- Reply nằm trong thẻ li -->
                                                <li>
                                                    <div class="single-comment">
                                                        <div class="comment-avatar">
                                                            <img style="height: 100px; width: 100px" src="<?php echo $cmt['avatar'] ?>" alt="<?php echo $cmt['name'] ?>">
                                                        </div>
                                                        <div class="comment-info">
                                                            <div class="product-rattings">
                                                                <?php
                                                                for($k = 1; $k <= 5; $k++){
                                                                    if($k <= $cmt['rating']){
                                                                        $classStar = "fa fa-star";
                                                                    }else{
                                                                        $classStar = "fa fa-star-o";
                                                                    }

                                                                    ?>
                                                                    <span><i class="<?php echo $classStar ?>"></i></span>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <span class="date"><strong><?php echo $cmt['name'] ?></strong>
                                                                <span style="float: right;"><?php echo nicetime($cmt['created_at']) ?></span>
                                                                <!--  October 6, 2014 at 1:38 am -->
                                                            </span>
                                                            <p><?php echo $cmt['content'] ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ol>
                                            <?php
                                        }else{//Nếu có recomment
                                            // --------------
                                        }

                                        ?>
                                        
                                    <?php endforeach ?>
                                    <?php endif ?>

                                    <div class="comment-respond">
                                        <p>Thêm đánh giá</p>
                                        <p>Đánh giá sao</p>


                                    <?php if ($user == null): ?>
                                        <form action="javascript:void(0)" method="post">
                                    <?php endif ?>
                                    <?php if ($user != null): ?>
                                        <form action="add-comment.php" method="post">
                                    <?php endif ?>
                                            <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                                            <div class="rate">
                                                <input type="radio" id="star5" name="rate" value="5" />
                                                <label for="star5" >5 stars</label>
                                                <input type="radio" id="star4" name="rate" value="4" />
                                                <label for="star4">4 stars</label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3">3 stars</label>
                                                <input type="radio" id="star2" name="rate" value="2" />
                                                <label for="star2">2 stars</label>
                                                <input type="radio" id="star1" name="rate" value="1" />
                                                <label for="star1">1 star</label>
                                            </div>
                                            <div class="text-filds">
                                                <label for="comment"><span class="required"></span></label>
                                                <textarea placeholder="Điền nội dung comment" id="comment" name="content" cols="45" rows="8" maxlength="65525" required="required"></textarea>
                                            </div>
                                            <div class="form-submit">
                                                <?php if ($user == null): ?>
                                                    <input name="submit" type="submit" id="submit" class="submit" onclick="return alert('Bạn cần đăng nhập để bình luận')">
                                                <?php endif ?>
                                                <?php if ($user != null): ?>
                                                    <input name="submit" type="submit" id="submit" class="submit">
                                                <?php endif ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- product description end -->
            <!-- Single related product -->
            <div class="single-related-product-area">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title">
                                <h3>Sản phẩm liên quan</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Select sản phẩm liên quan -->
                        
                        <?php foreach ($related as $rlt): ?>
                            <div class="related-product">
                                <div class="single-product-area">
                                    <div class="product-wrapper gridview">
                                        <div class="list-col4">
                                            <div  style="text-align: center;" class="product-image">
                                                <a href="single-product.php?product_id=<?php echo $rlt['id'] ?>">
                                                    <img style="width: 200px;" src="<?php echo $rlt['feature_image'] ?>" alt="">
                                                </a>
                                                <div class="quickviewbtn">
                                                    <a href="#" data-toggle="modal" data-target="#<?php echo $rlt['id'] ?>"  data-original-title="Quick View"><i class="ion-eye"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-col8">
                                            <div class="product-info">
                                                <h2><a href="single-product.php?product_id=<?php echo $rlt['id'] ?>"><?php echo $rlt['name'] ?></a></h2>
                                                <span class="price">
                                                    <del><?php echo number_format($rlt['price'], 0, '', ',') ?> ₫</del><br> <?php echo number_format($rlt['sale_price'], 0, '', ',') ?> ₫
                                                </span>
                                            </div>
                                            <div class="product-hidden">
                                                <div class="add-to-cart">
                                                    <a href="add-cart.php?id=<?php echo $rlt['id'] ?>">Thêm vào giỏ</a>
                                                </div>
                                                <div class="star-actions">
                                                    <div class="product-rattings">
                                                        <?php
                                                        if ($rlt['rate'] == 0) {
                                                            $il = true;
                                                        }
                                                        for($ui = 1; $ui <= 5; $ui++){
                                                            if($rlt['rate'] >= $ui){
                                                                $starClass = "fa fa-star";
                                                                $il = is_float($rlt['rate']);
                                                            }else if($il == false ){
                                                                $starClass = "fa fa-star-half-o";
                                                                $il = true;
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
                                                            $product_id = $rlt['id'];
                                                            $sqlCheck = "SELECT * from wish_lists where user_id=$user_id and product_id=$product_id";
                                                            $checkWish = executeQuery($sqlCheck, false);
                                                            if($checkWish == null){
                                                                ?>
                                                                <li><a href="add-wish.php?id=<?php echo $rlt['id'] ?>"><i class="ion-android-favorite-outline"></i></a></li>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <li><a href="javascipt:void(0)" onclick="return alert('Sản phẩm đã tồn tại trong danh sách yêu thích')"><i class="ion-android-favorite-outline"></i></a></li>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        
                                                        <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
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
            </div>    
            <!-- Single related product end -->

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

        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-XXXXX-Y','auto');ga('send','pageview')
        </script>
    </body>

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:49:58 GMT -->
</html>
