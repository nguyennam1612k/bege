<?php
    require_once "commons/db.php";
    //Top sản phẩm bán chạy nhất
    $sqlSaleProduct = "SELECT * from products order by sale_price asc limit 12";
    $top_sale_products = executeQuery($sqlSaleProduct, true);
?>
<div class="sidebar col-sm-12 col-lg-3 col-md-12">
    <!-- categories menu wrapper -->
    <div class="categories-menu-wrapper">
        <div class="categori-menu">
            <span class="categorie-title">Categories</span>
            <nav>
                <ul class="categori-menu-list menu-hidden">
                    <li><a href="shop.php"><span><img src="images/icons/16.png" alt="menu-icon"></span>Electronics<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        <!-- categori Mega-Menu Start -->
                        <ul class="ht-dropdown megamenu first-megamenu">
                            <!-- Single Column Start -->
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Cameras</li>
                                    <li><a href="shop.php">Cords and Cables</a></li>
                                    <li><a href="shop.php">gps accessories</a></li>
                                    <li><a href="shop.php">Microphones</a></li>
                                    <li><a href="shop.php">Wireless Transmitters</a></li>
                                </ul>
                            </li>
                            <!-- Single Column End -->
                            <!-- Single Column Start -->
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Digital Cameras</li>
                                    <li><a href="shop.php">Camera one</a></li>
                                    <li><a href="shop.php">Camera two</a></li>
                                    <li><a href="shop.php">Camera three</a></li>
                                    <li><a href="shop.php">Camera four</a></li>
                                </ul>
                            </li>
                            <!-- Single Column End -->
                            <!-- Single Column Start -->
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Digital Cameras</li>
                                    <li><a href="shop.php">Camera one</a></li>
                                    <li><a href="shop.php">Camera two</a></li>
                                    <li><a href="shop.php">Camera three</a></li>
                                    <li><a href="shop.php">Camera four</a></li>
                                </ul>
                            </li>
                            <!-- Single Column End -->
                        </ul>
                        <!-- categori Mega-Menu End -->
                    </li>
                    <li><a href="shop.php"><span><img src="images/icons/17.png" alt="menu-icon"></span>Fashion<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        <!-- categori Mega-Menu Start -->
                        <ul class="ht-dropdown megamenu megamenu-two">
                            <!-- Single Column Start -->
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Men’s Fashion</li>
                                    <li><a href="shop.php">Blazers</a></li>
                                    <li><a href="shop.php">Boots</a></li>
                                    <li><a href="shop.php">pants</a></li>
                                    <li><a href="shop.php">Tops &amp; Tees</a></li>
                                </ul>
                            </li>
                            <!-- Single Column End -->
                            <!-- Single Column Start -->
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Women’s Fashion</li>
                                    <li><a href="shop.php">Bags</a></li>
                                    <li><a href="shop.php">Bottoms</a></li>
                                    <li><a href="shop.php">Shirts</a></li>
                                    <li><a href="shop.php">Tailored</a></li>
                                </ul>
                            </li>
                            <!-- Single Column End -->
                        </ul>
                        <!-- categori Mega-Menu End -->
                    </li>
                    <li><a href="shop.php"><span><img src="images/icons/18.png" alt="menu-icon"></span>Home &amp; Kitchen<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        <!-- categori Mega-Menu Start -->
                        <ul class="ht-dropdown megamenu megamenu-two">
                            <!-- Single Column Start -->
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Large Appliances</li>
                                    <li><a href="shop.php">Armchairs</a></li>
                                    <li><a href="shop.php">Bunk Bed</a></li>
                                    <li><a href="shop.php">Mattress</a></li>
                                    <li><a href="shop.php">Sideboard</a></li>
                                </ul>
                            </li>
                            <!-- Single Column End -->
                            <!-- Single Column Start -->
                            <li class="single-megamenu">
                                <ul>
                                    <li class="menu-tile">Small Appliances</li>
                                    <li><a href="shop.php">Bootees Bags</a></li>
                                    <li><a href="shop.php">Jackets</a></li>
                                    <li><a href="shop.php">Shelf</a></li>
                                    <li><a href="shop.php">Shoes</a></li>
                                </ul>
                            </li>
                            <!-- Single Column End -->
                        </ul>
                        <!-- categori Mega-Menu End -->
                    </li>
                    <li><a href="shop.php"><span><img src="images/icons/19.png" alt="menu-icon"></span>Phones &amp; Tablets<i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                    <!-- categori Mega-Menu Start -->
                    <ul class="ht-dropdown megamenu megamenu-two">
                        <!-- Single Column Start -->
                        <li class="single-megamenu">
                            <ul>
                                <li class="menu-tile">Tablet</li>
                                <li><a href="shop.php">tablet one</a></li>
                                <li><a href="shop.php">tablet two</a></li>
                                <li><a href="shop.php">tablet three</a></li>
                                <li><a href="shop.php">tablet four</a></li>
                            </ul>
                        </li>
                        <!-- Single Column End -->
                        <!-- Single Column Start -->
                        <li class="single-megamenu">
                            <ul>
                                <li class="menu-tile">Smartphone</li>
                                <li><a href="shop.php">phone one</a></li>
                                <li><a href="shop.php">phone two</a></li>
                                <li><a href="shop.php">phone three</a></li>
                                <li><a href="shop.php">phone four</a></li>
                            </ul>
                        </li>
                        <!-- Single Column End -->
                    </ul>
                    <!-- categori Mega-Menu End -->
                </li>
                <li><a href="shop.php"><span><img src="images/icons/20.png" alt="menu-icon"></span>TV &amp; Video<i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    <!-- categori Mega-Menu Start -->
                    <ul class="ht-dropdown megamenu megamenu-two">
                        <!-- Single Column Start -->
                        <li class="single-megamenu">
                            <ul>
                                <li class="menu-tile">Gaming Desktops</li>
                                <li><a href="shop.php">Alpha Desktop</a></li>
                                <li><a href="shop.php">rober Desktop</a></li>
                                <li><a href="shop.php">Ultra Desktop </a></li>
                                <li><a href="shop.php">beta desktop</a></li>
                            </ul>
                        </li>
                        <!-- Single Column End -->
                        <!-- Single Column Start -->
                        <li class="single-megamenu">
                            <ul>
                                <li class="menu-tile">Women’s Fashion</li>
                                <li><a href="shop.php">3D-Capable</a></li>
                                <li><a href="shop.php">Clearance</a></li>
                                <li><a href="shop.php">Free Shipping Eligible</a></li>
                                <li><a href="shop.php">On Sale</a></li>
                            </ul>
                        </li>
                        <!-- Single Column End -->
                    </ul>
                    <!-- categori Mega-Menu End -->
                </li>
                <li><a href="shop.php"><span><img src="images/icons/21.png" alt="menu-icon"></span>Beauty</a>
                </li>
                <li><a href="shop.php"><span><img src="images/icons/22.png" alt="menu-icon"></span>Sport &amp; tourism</a>
                </li>
                <li><a href="shop.php"><span><img src="images/icons/23.png" alt="menu-icon"></span>Fruits &amp; Veggies</a></li>
                <li><a href="shop.php"><span><img src="images/icons/24.png" alt="menu-icon"></span>Computer &amp; Laptop</a></li>
                <li><a href="shop.php"><span><img src="images/icons/25.png" alt="menu-icon"></span>Meat &amp; Seafood</a></li>
                <li><a href="shop.php"><span><img src="images/icons/26.png" alt="menu-icon"></span>Samsung</a></li>
                <li><a href="shop.php"><span><img src="images/icons/27.png" alt="menu-icon"></span>Sanyo</a></li>
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
                            <a href="#">
                                <img style="width: 102px; height: 102px" src="<?php echo $sale['feature_image'] ?>" alt="">
                            </a>
                            <div class="quickviewbtn">
                                <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="list-col8">
                        <div class="product-info">
                            <h2><a href="single-product.php"><?php echo $sale['name'] ?></a></h2>
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
                    <h3>New Arrivals</h3>
                </div>
            </div>
        </div>
        <div class="product-area-inner">
            <div class="row">
                <div class="newarival-sidebar carosel-next-prive owl-carousel">
                    <div class="col-sm-12">
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/1.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Sit voluptatem</a></h2>
                                        <span class="price">
                                            <del>$ 77.00</del> $ 66.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/2.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Nulla sed libero</a></h2>
                                        <span class="price">
                                            $ 45.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                    </div>
                    <div class="col-sm-12">
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/3.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Pellentesque posuere</a></h2>
                                        <span class="price">
                                            $ 100.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/4.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Tincidunt malesuada</a></h2>
                                        <span class="price">
                                            <del>$ 80.00</del> $ 50.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                    </div>
                    <div class="col-sm-12">
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/5.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Pellentesque posuere</a></h2>
                                        <span class="price">
                                            $ 45.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/6.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Kaoreet lobortis</a></h2>
                                        <span class="price">
                                            $ 95.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                    </div>
                    <div class="col-sm-12">
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/7.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Aliquam lobortis est</a></h2>
                                        <span class="price">
                                            $ 80.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/8.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Sit voluptatem</a></h2>
                                        <span class="price">
                                            <del>$ 77.00</del> $ 66.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                    </div>
                    <div class="col-sm-12">
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/9.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Phasellus vel hendrerit</a></h2>
                                        <span class="price">
                                            $ 55.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/10.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Auctor gravida enim</a></h2>
                                        <span class="price">
                                            <del>$ 85.00</del> $ 75.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                    </div>
                    <div class="col-sm-12">
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/11.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Sit voluptatem</a></h2>
                                        <span class="price">
                                            <del>$ 77.00</del> $ 66.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/12.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Sit voluptatem</a></h2>
                                        <span class="price">
                                            <del>$ 77.00</del> $ 66.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                    </div>
                    <div class="col-sm-12">
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/13.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Sit voluptatem</a></h2>
                                        <span class="price">
                                            <del>$ 77.00</del> $ 66.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/1.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Sit voluptatem</a></h2>
                                        <span class="price">
                                            <del>$ 77.00</del> $ 66.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                    </div>
                    <div class="col-sm-12">
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/2.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Sit voluptatem</a></h2>
                                        <span class="price">
                                            <del>$ 77.00</del> $ 66.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
                        <!-- single product -->
                        <div class="single-product-area">
                            <div class="product-wrapper gridview">
                                <div class="list-col4">
                                    <div class="product-image">
                                        <a href="#">
                                            <span class="onsale">Sale!</span>
                                            <img src="images/product/3.jpg" alt="">
                                        </a>
                                        <div class="quickviewbtn">
                                            <a href="#" data-toggle="modal" data-target="#product_modal" data-original-title="Quick View"><i class="ion-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-col8">
                                    <div class="product-info">
                                        <h2><a href="single-product.php">Sit voluptatem</a></h2>
                                        <span class="price">
                                            <del>$ 77.00</del> $ 66.00
                                        </span>
                                    </div>
                                    <div class="product-hidden">
                                        <div class="add-to-cart">
                                            <a href="cart.php">Add to cart</a>
                                        </div>
                                        <div class="star-actions">
                                            <div class="product-rattings">
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star-half-o"></i></span>
                                                <span><i class="fa fa-star-o"></i></span>
                                            </div>
                                            <ul class="actions">
                                                <li><a href="#"><i class="ion-android-favorite-outline"></i></a></li>
                                                <li><a href="#"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single product end -->
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
        <h3>Testimonials</h3>
    </div>
    <div class="testimonial-sidebar carosel-next-prive owl-carousel">
        <!-- Testimonial area -->
        <div class="testimonial-area">
            <img src="images/testimonials/testimonial3-120x120.jpg" alt="testimonial">
            <blockquote class="testimonials-text">
                <p>RoadThemes support and response has been amazing, helping me with several issues I came across and got them solved almost the same day. A pleasure to work with them!</p>
            </blockquote>
            <span>Katherine Sullivan</span>
        </div>
        <!-- Testimonial area end -->
        <!-- Testimonial area -->
        <div class="testimonial-area">
            <img src="images/testimonials/testimonial5-120x120.jpg" alt="testimonial">
            <blockquote class="testimonials-text">
                <p>RoadThemes support and response has been amazing, helping me with several issues I came across and got them solved almost the same day. A pleasure to work with them!</p>
            </blockquote>
            <span>Jenifer Brown</span>
        </div>
        <!-- Testimonial area end -->
        <!-- Testimonial area -->
        <div class="testimonial-area">
            <img src="images/testimonials/testimonial6-120x120.jpg" alt="testimonial">
            <blockquote class="testimonials-text">
                <p>RoadThemes support and response has been amazing, helping me with several issues I came across and got them solved almost the same day. A pleasure to work with them!</p>
            </blockquote>
            <span>Kathy Young</span>
        </div>
        <!-- Testimonial area end -->
    </div>
</div>
<!-- hometestimonial end -->
</div>