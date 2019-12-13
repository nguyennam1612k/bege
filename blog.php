<?php
    require_once './commons/db.php';
    require_once './commons/constants.php';
    require_once './commons/helpers.php';

    //đếm tag bài viết
    $sqlQuery = "SELECT DISTINCT tag FROM blogs";
    $newBlog = executeQuery($sqlQuery, true);

    $search_blog = null;

    $tag = isset($_GET['tag']) ? $_GET['tag'] : null;
        if($tag != null){
            $sqlQuery = "SELECT * from blogs where tag='$tag'";
            $search_blog = executeQuery($sqlQuery, true);
        }
    //tìm kiếm bài viết
    if(isset($_POST['btn_search'])){
        $value_search_blog = $_POST['value_search_blog'];
        if($value_search_blog == ""){
            echo "<script>alert('Nhập từ khóa tìm kiếm')</script>";
        }else{
            $sqlQuery = "SELECT * from blogs
                            where name like '%$value_search_blog%'
                                or tag like '%$value_search_blog%'";
            $search_blog = executeQuery($sqlQuery, true);
        }
    }
    //PHÂN TRANG
    $page=1;//khởi tạo trang ban đầu
    $limit=3;//số bản ghi trên 1 trang (2 bản ghi trên 1 trang)
    
    $arrs_list = "SELECT count(id) as count from blogs";
    $count = executeQuery($arrs_list);

    $total_record = $count['count'];//tính tổng số bản ghi có trong bảng khoahoc
    
    $total_pageb = $total_record/$limit;//tính tổng số trang sẽ chia

    //xem trang có vượt giới hạn không:
    if(isset($_GET["page"])){
        $page=$_GET["page"];//nếu biến $_GET["page"] tồn tại thì trang hiện tại là trang $_GET["page"]
    }
    if($page<1){
        $page=1;
    }  //nếu trang hiện tại nhỏ hơn 1 thì gán bằng 1
    if($page>$total_pageb){
        $page=$total_pageb;
    } //nếu trang hiện tại vượt quá số trang được chia thì sẽ bằng trang cuối cùng

    //tính start (vị trí bản ghi sẽ bắt đầu lấy):
    $start=($page-1)*$limit;
    //PHÂN TRANG END

    //select blog
    $sqlQuery = "   SELECT u.name as user_name ,b.*
                    from blogs b
                    inner join users u
                        on u.id = b.user_id
                    limit $start,$limit";
    $blogs = executeQuery($sqlQuery, true);

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    
<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:48:59 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Bege || Blog Page</title>
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
                                <span class="separator">/</span> Blog
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
                            <h1 class="entry-title">Blog</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title end -->
            <!-- cart page content -->
            <div class="blog-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-9">
                            <div class="page-content blog-page blog-sidebar right-sidebar blog-text-align">
                                <!-- blog post -->
                                <?php foreach ($blogs as $value): ?>
                                    <article class="text-center">
                                        <div class="blog-entry-header">
                                            <div class="post-category">
                                                <a href="#"><?php echo $value['tag'] ?></a>
                                            </div>
                                            <h1><a href="single-blog.php?id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a></h1>
                                            <div class="post-meta">
                                                <a href="#"  class="post-author"><i class="fa fa-user"></i>Posted by <?php echo $value['user_name'] ?></a>
                                                <a href="#" class="post-date"><i class="fa fa-calendar"></i><?php echo $value['created_at'] ?></a>
                                            </div>
                                        </div>
                                        <div class="post-thumbnail">
                                            <a href="single-blog.php?id=<?php echo $value['id'] ?>"><img src="<?php echo $value['image'] ?>"></a>
                                        </div>
                                        <div class="postinfo-wrapper">
                                            <p><?php echo substr($value['content'], 0, 200) ?> ...</p>
                                            <a class="readmore button" href="single-blog.php?id=<?php echo $value['id'] ?>">Read more</a>
                                            <div class="social-sharing">
                                                <h3>Share this post</h3>
                                                <div class="social-sharie">
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
                                    </article>
                                <?php endforeach ?>
                                <!-- blog post end -->
                            </div>
                            <div class="row">
                                <nav class="woocommerce-pagination">
                                    <ul class="page-numbers">

                                        <?php
                                        $url_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        for($tik = 1; $tik <= $total_pageb; $tik++){

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
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="blog_sidebar">
                                <div class="row_products_side">
                                    <div class="product_left_sidbar">
                                        <div class="product-filter  mb-30">
                                          <h5>Search </h5>
                                          <div class="search__sidbar">
                                             <div class="input_form">
                                                <form method="post">
                                                    <input type="text" id="search_input" name="value_search_blog" placeholder="Search..." class="input_text">
                                                    <button id="blogsearchsubmit" type="submit" class="button" name="btn_search">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </form>
                                             </div>
                                          </div>
                                        </div>
                                        
                                        <?php if ($search_blog != null): ?>
                                            <div class="product-filter  mb-30">
                                                <h5>Blog Search </h5>
                                                <div class="blog_Archives__sidbar">
                                                    <ul>
                                                        <?php foreach ($search_blog as $value): ?>
                                                            <li><a href="single-blog.php?id=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a>&nbsp;</li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        <?php endif ?>

                                        <div class="product-filter  mb-30">
                                            <h5>Recent Posts</h5>
                                            <div class="blog_Archives__sidbar">
                                                <ul>
                                                    <?php foreach ($newBlog as $value): ?>
                                                        <?php
                                                        //đếm số bài viết có tag
                                                        $tag = $value['tag'];
                                                        $sqlQuery = "SELECT count(id) as count from blogs where tag='$tag'";
                                                        $count = executeQuery($sqlQuery, false);
                                                        ?>
                                                        <li><a href="?tag=<?php echo $value['tag'] ?>">Post with <?php echo $value['tag'] ?></a>&nbsp;(<?php echo $count['count'] ?>)</li>
                                                    <?php endforeach ?>
                                                </ul>
                                          </div>
                                        </div>
                                        <div class="sidebar-single-banner">
                                            <a href="#">
                                                <img src="images/banner/shop-sidebar.jpg" alt="Banner">
                                            </a>
                                        </div>
                                        <div class="product-filter mb-30">
                                            <h5>product tags</h5>
                                            <div class="blog-tags">
                                                <a href="shop.php?tag=sản phẩm mới">sản phẩm mới</a>
                                                <a href="shop.php?tag=khuyến mại">khuyến mại</a>
                                                <a href="shop.php?tag=thời trang">thời trang</a>
                                                <a href="shop.php?tag=yêu thích">yêu thích</a>
                                                <a href="shop.php?tag=giảm giá">giảm giá</a>
                                                <a href="shop.php?tag=bộ xử lý">bộ xử lý</a>
                                                <a href="shop.php?tag=đẹp">đẹp</a>
                                                <a href="shop.php?tag=free ship">free ship</a>
                                                <a href="shop.php?tag=màu sắc">màu sắc</a>
                                                <a href="shop.php?tag=số lượng">số lượng</a>
                                                <a href="shop.php?tag=chip 1022">chip 1022</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

<!-- Mirrored from preview.hasthemes.com/bege-v4/bege/blog.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Nov 2019 11:49:14 GMT -->
</html>
