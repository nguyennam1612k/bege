<?php
    require_once "commons/db.php";

    //select danh mục
    $sqlCategories = "SELECT * from categories limit 12";
    $cateSidebar = executeQuery($sqlCategories, true);

    //Top sản phẩm bán chạy nhất
    $sqlSaleProducts = "SELECT * from products order by sold desc limit 12";
    $top_sale_products = executeQuery($sqlSaleProducts, true);

    //Sản phẩm mới
    $sqlNewProducts = "SELECT * from products order by id desc limit 16";
    $top_new_products = executeQuery($sqlNewProducts, true);

    //select thông báo của quản trị viên
    $sqlQuery = "SELECT * from users where role=1";
    $notification = executeQuery($sqlQuery, true);
?>
<div class="sidebar col-sm-12 col-lg-3 col-md-12">
    <!-- categories menu wrapper -->
    <div class="categories-menu-wrapper">
        <div class="categori-menu">
            <span class="categorie-title">Danh mục</span>
            <nav>
                <ul class="categori-menu-list menu-hidden">
                    <!-- <li><a href="shop.php"><span><img src="images/icons/16.png" alt="menu-icon"></span>Electronics<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        categori Mega-Menu Start
                        <ul class="ht-dropdown megamenu first-megamenu">
                            Single Column Start
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Cameras</li>
                                    <li><a href="shop.php">Cords and Cables</a></li>
                                    <li><a href="shop.php">gps accessories</a></li>
                                    <li><a href="shop.php">Microphones</a></li>
                                    <li><a href="shop.php">Wireless Transmitters</a></li>
                                </ul>
                            </li>
                            Single Column End
                            Single Column Start
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Digital Cameras</li>
                                    <li><a href="shop.php">Camera one</a></li>
                                    <li><a href="shop.php">Camera two</a></li>
                                    <li><a href="shop.php">Camera three</a></li>
                                    <li><a href="shop.php">Camera four</a></li>
                                </ul>
                            </li>
                            Single Column End
                            Single Column Start
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Digital Cameras</li>
                                    <li><a href="shop.php">Camera one</a></li>
                                    <li><a href="shop.php">Camera two</a></li>
                                    <li><a href="shop.php">Camera three</a></li>
                                    <li><a href="shop.php">Camera four</a></li>
                                </ul>
                            </li>
                            Single Column End
                        </ul>
                        categori Mega-Menu End
                    </li> -->
                    <?php foreach ($cateSidebar as $value): ?>
                        <li><a href="shop.php?cate_id=<?php echo $value['id'] ?>"><span><img src="<?php echo $value['icon'] ?>" alt="menu-icon"></span><?php echo $value['title'] ?></a></li>
                    <?php endforeach ?>
                </ul>
            </nav>
        </div>
    </div>
<!-- categories menu wrapper end -->
<!-- Product column -->
<div class="sidebar-best-seller">
    <div class="section-title">
        <h3>Bán chạy nhất</h3>
    </div>
    <div class="bestseller-sidebar carosel-next-prive owl-carousel">
        <!-- Duyệt 4 sản phẩm 1 start -->
        <div class="mini-product-listview">
        <?php  $i=0; ?>
        <?php foreach($top_sale_products as $sale):?>
            <?php $i++ ?>
            <!-- single product -->
            <div class="single-product-area">
                <div class="product-wrapper listview">
                    <div class="list-col4">
                        <div class="product-image">
                            <a href="single-product.php?product_id=<?php echo $sale['id'] ?>">
                                <img style="width: 102px; height: 102px" src="<?php echo $sale['feature_image'] ?>" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="list-col8">
                        <div class="product-info">
                            <h2><a href="single-product.php?product_id=<?php echo $sale['id'] ?>"><?php echo $sale['name'] ?></a></h2>
                            <span class="price">
                                <?php echo number_format($sale['sale_price'], 0, '', ',') ?> ₫
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single product end -->
            <!-- Cứ 4 sản phẩm cách tab 1 lần -->
        <?php 
        if($i%4 == 0 && $i != 12){
                ?>
                </div>
                <div class="mini-product-listview">
                <?php
            }
        ?>
        <?php endforeach?>
        </div>
        <!-- Duyệt 4 sản phẩm 1 end -->
    </div>
</div>
<!-- Product column end -->
<!-- Home two sidebar banner -->
<div class="home-two-sidebar-banner">
    <a href="#">
        <img src="images/banner/home2-sidebar.jpg" alt="bege banner images">
    </a>
</div>
<!-- Home two sidebar banner end -->
<!-- Best sellers -->
<div class="product-area">
    <div class="sidebar-product-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                    <h3>Mới nhất</h3>
                </div>
            </div>
        </div>
        <div class="product-area-inner">
            <div class="row">
                <div class="newarival-sidebar carosel-next-prive owl-carousel">
                    <div class="col-sm-12">
                        <?php $io = 0 ?>
                        <?php foreach ($top_new_products as $value): ?>
                            <?php $io++ ?>
                            <!-- single product -->
                            <div class="single-product-area">
                                <div class="product-wrapper gridview">
                                    <div class="list-col4">
                                        <div class="product-image">
                                            <a href="#">
                                                <?php if ($value['price'] - $value['sale_price'] >= 1000000): ?>
                                                    <span class="onsale">Sale!</span>
                                                <?php endif ?>
                                                <center>
                                                    <img style="max-width: 200px" src="<?php echo $value['feature_image'] ?>" alt="">
                                                </center>
                                            </a>
                                            <div class="quickviewbtn">
                                                <a href="#" data-toggle="modal" data-target="#<?php echo $value['id'] ?>" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-col8">
                                        <div class="product-info">
                                            <h2><a href="single-product.php"><?php echo $value['name'] ?></a></h2>
                                            <span class="price">
                                                <del><?php echo number_format($value['price'], 0, '', ',') ?> ₫</del> <?php echo number_format($value['sale_price'], 0, '', ',') ?> ₫
                                            </span>
                                        </div>
                                        <div class="product-hidden">
                                            <div class="add-to-cart">
                                                <a href="cart.php">Add to cart</a>
                                            </div>
                                            <div class="star-actions">
                                                <div class="product-rattings">
                                                    <?php
                                                    if ($value['rate'] == 0) {
                                                        $sb1 = true;
                                                    }
                                                    for($sb2 = 1; $sb2 <= 5; $sb2++){
                                                        if($value['rate'] >= $sb2){
                                                            $starClass = "fa fa-star";
                                                            $sb1 = is_float($value['rate']);
                                                        }else if($sb1 == false ){
                                                            $starClass = "fa fa-star-half-o";
                                                            $sb1 = true;
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
                            <!-- single product end -->
                            <?php if ($io%2==0 && $io<16): ?>
                                </div>
                                <div class="col-sm-12">
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Best sellers end -->
<!-- hometestimonial -->
<div class="hometestimonial">
    <div class="section-title">
        <h3>Quản trị viên</h3>
    </div>
    <div class="testimonial-sidebar carosel-next-prive owl-carousel">
        <?php foreach ($notification as $value): ?>
            <!-- Testimonial area -->
            <div class="testimonial-area">
                <img src="<?php echo $value['avatar'] ?>" alt="testimonial">
                <blockquote class="testimonials-text">
                    <p>Hỗ trợ và phản hồi của chúng tôi luôn sẵn sàng, giúp bạn giải quyết một số vấn đề bạn gặp phải và giải quyết chúng gần như cùng ngày. Một niềm vui để làm việc với bạn!</p>
                </blockquote>
                <span><?php echo $value['name'] ?></span>
            </div>
            <!-- Testimonial area end -->
        <?php endforeach ?>
    </div>
</div>
<!-- hometestimonial end -->
</div>