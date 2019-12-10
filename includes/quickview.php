<?php 
    // require_once "commons/db.php";
    // require_once "commons/constants.php";
    // require_once "commons/helpers.php";

    $sqlQuery = "SELECT * from products";
    $quickViews = executeQuery($sqlQuery, true);
?>
<div id="quickview-wrapper">
    <?php foreach ($quickViews as $value): ?>
        <?php
        $product_id = $value['id'];
        $sqlQuery = "SELECT * from product_galleries where product_id=$product_id";
        $albums = executeQuery($sqlQuery, true);

        //select tên danh mục
        $cate_id = $value['cate_id'];
        $sqlQuery = "SELECT title from categories where id=$cate_id";
        $title_cate = executeQuery($sqlQuery, false);
        ?>
        <!-- Modal -->
        <div class="modal fade" id="<?php echo $product_id ?>" tabindex="-1">
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
                                                    <!-- Feature image làm ảnh galleries đầu tiên -->
                                                    <div class="tab-pane active" id="pro-details1">
                                                        <div class="product-popup">
                                                            <a href="<?php echo $value['feature_image'] ?>">
                                                                <img src="<?php echo $value['feature_image'] ?>" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- select tất cả album làm ảnh galleries tiếp theo -->
                                                    <?php if ($albums != null): ?>
                                                        <?php $al1 = 2 ?>
                                                        <?php foreach ($albums as $key): ?>
                                                            <?php $al1++ ?>
                                                            <div class="tab-pane" id="pro-details<?php echo $alc ?>">
                                                                <div class="product-popup">
                                                                    <a href="<?php echo $key['url'] ?>">
                                                                        <img src="<?php echo $key['url'] ?>" alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </div>
                                                <div class="product-details-small nav product-dec-slider-qui owl-carousel">
                                                    <!-- tương tự như trên -->
                                                    <a class="active" href="#pro-details1">
                                                        <img src="<?php echo $value['feature_image'] ?>" alt="">
                                                    </a>
                                                    <?php if ($albums != null): ?>
                                                        <?php $al2 = 2 ?>
                                                        <?php foreach ($albums as $key): ?>
                                                            <?php $al2++ ?>
                                                            <a href="#pro-details<?php echo $al2 ?>">
                                                                <img src="<?php echo $key['url'] ?>" alt="">
                                                            </a>
                                                        <?php endforeach ?>                                 
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-5 col-lg-5">
                                       <div class="single-product-info">
                                            <h1><?php echo $value['name'] ?></h1>
                                            <div class="product-rattings">
                                                <?php
                                                if ($value['rate'] == 0) {
                                                    $qv = true;
                                                }
                                                for($qv1 = 1; $qv1 <= 5; $qv1++){
                                                    if($value['rate'] >= $qv1){
                                                        $starClass = "fa fa-star";
                                                        $qv = is_float($value['rate']);
                                                    }else if( $qv == false ){
                                                        $starClass = "fa fa-star-half-o";
                                                        $qv = true;
                                                    }else{
                                                        $starClass = "fa fa-star-o";
                                                    }
                                                    ?>
                                                    <span><i class="<?php echo $starClass ?>"></i></span>
                                                    <?php
                                                }
                                                ?>                                            </div>
                                        <span class="price">
                                            <del><?php echo number_format($value['price'], 0, '', ',') ?> ₫</del> $ <?php echo number_format($value['sale_price'], 0, '', ',') ?> ₫
                                        </span>
                                        <!-- <p> <?php $detail //= $value['detail'] ?> -->
                                            <?php $detail = substr( $value['detail'],  0, 230) ?>
                                        <p><?php echo $detail ?></p>
                                        <div class="box-quantity d-flex">
                                            <a style="margin-left: 50px" class="add-cart" href="add-cart.php?id=<?php echo $value['id'] ?>">add to cart</a>
                                        </div>
                                        <div class="wishlist-compear-area">
                                            <?php if ($user == null): ?>
                                                <a href="javascript:void(0)" onclick="return alert('Bạn cần đăng nhập để sử dụng chức năng này')" ><i class="ion-ios-heart-outline"></i> Add to Wishlist</a>
                                            <?php endif ?>
                                            <?php
                                            if($user != null){
                                                $user_id = $user['id'];
                                                $product_id = $value['id'];
                                                $sqlCheck = "SELECT * from wish_lists where user_id=$user_id and product_id=$product_id";
                                                $checkWish = executeQuery($sqlCheck, false);
                                                if($checkWish == null){
                                                    ?>
                                                    <a href="add-wish.php?id=<?php echo $value['id'] ?>"><i class="ion-ios-heart-outline"></i> Add to Wishlist</a>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <a href="javascript:void(0)" onclick="return alert('Sản phẩm đã tồn tại trong danh sách yêu thích')" ><i class="ion-ios-heart-outline"></i> Add to Wishlist</a>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <a href="javascript:void(0)"><i class="ion-ios-loop-strong"></i> Compare</a>
                                        </div>
                                        <div class="product_meta">
                                            <span class="posted_in">Categories: <a href="#" rel="tag"><?php echo $title_cate['title'] ?></a></span>
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
        </div>
        <!-- .modal-content -->
    </div>
    <!-- .modal-dialog -->
</div>
<?php endforeach ?>
<!-- END Modal -->
</div>