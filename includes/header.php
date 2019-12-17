<?php
    require_once "commons/db.php";
    require_once "commons/constants.php";
    require_once "commons/helpers.php";

    $user = isset($_SESSION[AUTH]) ? $_SESSION[AUTH] : null;
    $cart = isset($_SESSION[CART]) ? $_SESSION[CART] : null;
    $totalPrice = 0;

    if($cart != null){
        foreach ($cart as $key => $value) {
            $itemTotal = $value['sale_price']*$value['quantity'];
            $totalPrice += $itemTotal;
        }
    }
    //select categories
    $sqlQuery = "SELECT * from categories";
    $categories = executeQuery($sqlQuery, true);
    //Truy vấn danh mục theo menu
    define('show_cate' ,"SELECT * from categories
                        from categories
                        where categories.show_menu=1");
    $show_cate = executeQuery(show_cate, true);


    //Lấy action id get
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    //Đăng xuất
    if($action == "logout"){
        unset($_SESSION[AUTH]);
        header('location: ' . BASE_URL . 'login.php');
    }

    //Xóa phần tử trong cart
    if($action == "deleteCart" && $cart != null){
        foreach ($cart as $key => $value) {
            if($cart[$key]['id'] == $id){
                unset($_SESSION[CART][$key]);
                header('location: '.$_SERVER['HTTP_REFERER']);
            }
        }
    }

    if(isset($_COOKIE['mess_ac'])){
        echo "<script>alert('".$_COOKIE['mess_ac']."')</script>";
    }
    
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<header class="header-area">
    <!-- Header top area start -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="top-bar-left">
                        <!-- main-menu -->
                        <div class="main-menu">
                            <nav class="nav">
                                <ul>
                                    <li><a href="<?php echo BASE_URL ?>">trang chủ</a></li>
                                    <li><a href="shop.php">cửa hàng</a></li>
                                    <li><a href="blog.php">tin tức</a></li>
                                    <li><a href="about-us.php">giới thiệu</a></li>
                                    <li><a href="contact-us.php">liên hệ</a></li>
                                    <!-- <li><a href="#">Menu <i class="fa fa-angle-down"></i></a>
                                        Hiện thị danh mục cha và danh mục con
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
                                    </li> -->
                                </ul>
                            </nav>
                        </div>
                        <div class="mobile-menu-area">
                            <div class="mobile-menu">
                                <nav id="mobile-menu-active">
                                    <ul class="menu-overflow">
                                        <li><a href="<?php echo BASE_URL ?>">Trang chủ</a></li>
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
                            if ($user != null){
                                if($user['role'] == 1){
                                    ?>
                                    <a href="#"><?= $user['name']?> <i class="ion-ios-arrow-down"></i></a>
                                    <ul>
                                        <li><a href="admin/" style="color: red">Quản trị</a></li>
                                        <li><a href="my-account.php">Tài khoản</a></li>
                                        <?php if ($cart != null): ?>
                                            <li><a href="checkout.php">Thanh toán</a></li>
                                        <?php endif ?>
                                        <?php if ($cart == null): ?>
                                            <li><a href="javascript:void(0)" class="disabled" >Thanh toán</a></li>
                                        <?php endif ?>
                                        <li><a href="?action=logout">Đăng xuất</a></li>
                                    </ul>
                                    <?php
                                }else{
                                    ?>
                                    <a href="#"><?= $user['name']?> <i class="ion-ios-arrow-down"></i></a>
                                    <ul>
                                        <li><a href="my-account.php">Tài khoản</a></li>
                                        <?php if ($cart != null): ?>
                                            <li><a href="checkout.php">Thanh toán</a></li>
                                        <?php endif ?>
                                        <?php if ($cart == null): ?>
                                            <li><a href="javascript:void(0)" class="disabled" >Thanh toán</a></li>
                                        <?php endif ?>
                                        <li><a href="?action=logout">Đăng xuất</a></li>
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
                        <a href="<?php echo BASE_URL ?>"><img src="images/logo/logo-white.png" alt="Nikado"></a>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <!-- header-search -->
                    <div class="header-search clearfix">
                        <form action="search.php" method="post">
                            <div class="category-select pull-right">
                                <!-- Tìm kiếm theo danh mục cha -->
                                <select class="nice-select-menu" name="sort">
                                    <option value="all" data-display="Tất cả danh mục">Tất cả danh mục</option>
                                    <?php foreach($categories as $me):?>
                                        <option value="<?php echo $me['id'] ?>"><?php echo $me['title'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="header-search-form">
                                <input type="text" name="value_search" placeholder="Tìm kiếm sản phẩm ..." required="Nhập từ khóa tìm kiếm">
                                <input type="submit" name="submit" value="Tìm kiếm">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12">
                    <!-- shop-cart-menu -->
                    <div class="shop-cart-menu pull-right">
                        <ul>
                            <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                            <li>
                                <?php if($user == null) { ?>
                                    <a href="javascript:void(0)" class="disabled" onclick="return alert('Bạn cần đăng nhập để sử dụng chức năng này')"><i class="ion-android-favorite-outline"></i></a>
                                <?php } else { ?>
                                    <a href="wishlist.php"><i class="ion-android-favorite-outline"></i></a>
                                <?php } ?>
                            </li>
                            <li><a href="cart.php">
                                    <span class="cart-icon">
                                        <i class="ion-bag"></i><sup><?php if ($cart != null) {
                                            echo count($cart);
                                        }else{
                                            echo '0';
                                        } ?></sup>
                                    </span>
                                    <span class="cart-text">
                                        <span class="cart-text-title">Giỏ hàng <br> <strong>
                                            <?php echo number_format($totalPrice, 0, '', ','); ?> đ</strong> </span>
                                    </span>
                                </a>
                                <ul>
                                    <?php if ($cart != null): ?>
                                        <?php foreach ($cart as $value): ?>
                                            <li>
                                                <!-- single-shop-cart-wrapper -->
                                                <div class="single-shop-cart-wrapper">
                                                    <div class="shop-cart-img">
                                                        <a href="cart.php"><img src="<?php echo $value['feature_image'] ?>" alt="Image of Product"></a>
                                                    </div>
                                                    <div class="shop-cart-info">
                                                        <h5><a href="cart.php"><?php echo $value['name'] ?></a></h5>
                                                        <span class="price">
                                                            <?php $itemTotal = $value['sale_price']*$value['quantity']; ?>
                                                            <?php echo number_format($value['sale_price'], 0, '', ','); ?> vnđ</span>
                                                        <span class="quantaty">Số lượng: <?php echo $value['quantity'] ?></span>
                                                        <span class="cart-remove"><a href="?action=deleteCart&id=<?php echo $value['id'] ?>"><i class="fa fa-times"></i></a></span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                    
                                    <li>
                                        <!-- shop-cart-total -->
                                        <div class="shop-cart-total">
                                            <p>Tổng phụ: <span class="pull-right"><?php echo number_format($totalPrice, 0, '', ','); ?> đ</span></p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shop-cart-btn">
                                            <?php if ($cart != null): ?>
                                                <a href="checkout.php">Thanh toán</a>
                                            <?php endif ?>
                                            <?php if ($cart == null): ?>
                                                <a href="javascript:void(0)" class="disabled">Thanh toán</a>
                                            <?php endif ?>
                                            <a href="cart.php" class="pull-right">Chi tiết</a>
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
