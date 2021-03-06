<?php
    //Tìm kiếm theo cate id
    $cate_id = isset($_GET['cate_id']) ? $_GET['cate_id'] : null;
    if($cate_id != null){
        $sqlQuery = "SELECT * from products
                    where cate_id=$cate_id limit 16";
        $searchs = executeQuery($sqlQuery, true);

        //lấy title cate
        $sqlQuery = "SELECT title from categories where id=$cate_id";
        $title = executeQuery($sqlQuery, false);
        $value_search = $title['title'];
        // dd($value_search);
    }


    //tìm kiếm theo tag
    $tag = isset($_GET['tag']) ? $_GET['tag'] : null;
    if($tag != null){
        $sqlQuery = "SELECT * from products where detail like '%$tag%' limit 16";
        $searchs = executeQuery($sqlQuery, true);
        $value_search = $tag;
    }

    //select 2 sản phẩm top đánh giá
    $sqlQuery = "SELECT * from products order by rate desc limit 2";
    $topRateProducts = executeQuery($sqlQuery, true);

    //select ramdom voucher
    $sqlQuery = "SELECT * from vouchers order by rand() limit 5";
    $vouchers = executeQuery($sqlQuery, true);

?>
<div class="col-xs-12 col-md-3 sidebar-shop">
    <div class="sidebar-product-categori">
        <div class="widget-title">
            <h3>DANH MỤC SẢN PHẨM</h3>
        </div>
        <div class="widget-content">
            <ul class="product-categories">
                <form action="shop.php" method="post">
                    <?php foreach ($categories as $value): ?>
                        <?php
                        $cate_id = $value['id'];
                        $sqlQuery = "SELECT count(id) as cou from products where cate_id = $cate_id";
                        $countPro = executeQuery($sqlQuery, false);
                        ?>
                        <li class="cat-item">
                            <a href="search.php?cate_id=<?php echo $value['id'] ?>"><?php echo $value['title'] ?></a>
                            <span class="count">(<?php echo $countPro['cou'] ?>)</span>
                        </li>
                    <?php endforeach ?>
                </form>
            </ul>
        </div>                                
        <div class="product-filter mb-30">
            <div class="widget-title">
                <h3>SẢN PHẨM ĐÁNH GIÁ CAO</h3>
            </div>
            <div class="widget-content">
                <ul class="product_list_widget">
                    <?php foreach ($topRateProducts as $value): ?>
                        <li class="widget-mini-product">
                            <div class="product-image">
                                <a title="Phasellus vel hendrerit" href="single-product.php?product_id=<?php echo $value['id'] ?>">
                                    <img alt="" src="<?php echo $value['feature_image'] ?>">
                                </a>
                            </div>
                            <div class="product-info">
                                <a title="Phasellus vel hendrerit" href="single-product.php?product_id=<?php echo $value['id'] ?>">
                                    <span class="product-title"><?php echo $value['name'] ?></span>
                                </a>
                                <div class="star-rating">
                                    <div class="rating-box">
                                        <?php
                                        $ok = is_float($value['rate']);
                                        for($i = 1; $i <= 5; $i++){
                                            if($value['rate'] >= $i){
                                                $starClass = "fa fa-star";
                                            }else if( $ok == false ){
                                                $starClass = "fa fa-star-half-o";
                                                $ok = true;
                                            }else{
                                                $starClass = "fa fa-star-o";
                                            }
                                            ?>
                                            <span><i class="<?php echo $starClass ?>"></i></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol"><?php echo number_format($value['sale_price'], 0, '', ',') ?> ₫</span></span>
                                </div>
                            </li>
                    <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-single-banner">
                    <a href="#">
                        <img src="images/banner/shop-sidebar.jpg" alt="Banner">
                    </a>
                </div>
                <div class="sidebar-tag">
                    <div class="widget-title">
                        <h3>NHÃN SẢN PHẨM</h3>
                    </div>
                    <div class="widget-content">
                        <div class="product-tags">
                            <a href="search.php?tag=sản phẩm mới">sản phẩm mới</a>
                            <a href="search.php?tag=khuyến mại">khuyến mại</a>
                            <a href="search.php?tag=thời trang">thời trang</a>
                            <a href="search.php?tag=yêu thích">yêu thích</a>
                            <a href="search.php?tag=giảm giá">giảm giá</a>
                            <a href="search.php?tag=bộ xử lý">bộ xử lý</a>
                            <a href="search.php?tag=đẹp">đẹp</a>
                            <a href="search.php?tag=free ship">free ship</a>
                            <a href="search.php?tag=màu sắc">màu sắc</a>
                            <a href="search.php?tag=số lượng">số lượng</a>
                            <a href="search.php?tag=chip 1022">chip 1022</a>
                        </div>
                    </div>
                </div><div class="sidebar-tag">
                    <div class="widget-title">
                        <h3>Mã giảm giá</h3>
                    </div>
                    <div class="widget-content">
                        <ul class="product-categories">
                            <?php foreach ($vouchers as $value): ?>
                                <label for="" style="float: left; width: 50%">
                                    <?php echo $value['title'] ?>
                                </label>
                                <input onclick="copyVoucher()" readonly="" type="text" value="<?php echo $value['code'] ?>" id="myInput" style="width: 50%">
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<script>
    function copyVoucher() {
      /* Get the text field */
      var copyText = document.getElementById("myInput");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/

      /* Copy the text inside the text field */
      document.execCommand("copy");

      /* Alert the copied text */
      alert("Copied the text: " + copyText.value);
  }
</script>