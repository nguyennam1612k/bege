<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";

    //select tổng sản phẩm , bình luận, lượt xem, tài khoản
    $sqlQuery = "SELECT count(id) as count, sum(view) as sum from products";
    $countPro = executeQuery($sqlQuery, false);

    $sqlQuery = "SELECT count(id) as count from comments";
    $countCmt = executeQuery($sqlQuery, false);

    $sqlQuery = "SELECT count(id) as count from users";
    $countUser = executeQuery($sqlQuery, false);

    //SELECT khách hàng
    $sqlQuery = "SELECT * from users limit 5";
    $users = executeQuery($sqlQuery, true);
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:27:10 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bigdeal admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Bigdeal admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <title>Quản trị - Bảng điểu khiển</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/flag-icon.css">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">

    <!-- Prism css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/prism.css">

    <!-- Chartist css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/vector-map.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
</head>

<body>

<!-- page-wrapper Start-->
<div class="page-wrapper">

    <!-- Page Header Start-->
    <?php include "includes/header.php" ?>
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        <?php include "includes/sidebar.php" ?>
        <!-- Page Sidebar Ends-->

        <!-- Right sidebar Start-->
        <?php include "includes/right_sidebar.php" ?>
        <!-- Right sidebar Ends-->

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Bảng điều khiển
                                    <small>Bảng quản trị Shop</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Bảng điều khiển</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden  widget-cards">
                            <div class="bg-secondary card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body"><span class="m-0">Sản phẩm</span>
                                        <h3 class="mb-0"> <span class="counter"><?php echo $countPro['count'] ?></span><small> sản phẩm trên hệ thống</small></h3>
                                    </div>
                                    <div class="icons-widgets">
                                        <i data-feather="box"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                            <div class="bg-primary card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body"><span class="m-0">Bình luận</span>
                                        <h3 class="mb-0"> <span class="counter"><?php echo $countCmt['count'] ?></span><small> lượt bình luận</small></h3>
                                    </div>
                                    <div class="icons-widgets">
                                        <i data-feather="message-square"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                            <div class="bg-warning card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body"><span class="m-0">Lượt xem</span>
                                        <h3 class="mb-0"> <span class="counter"><?php echo $countPro['sum'] ?></span><small> lượt xem sản phẩm</small></h3>
                                    </div>
                                    <div class="icons-widgets">
                                        <i data-feather="navigation"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 xl-50">
                        <div class="card o-hidden widget-cards">
                            <div class="bg-success card-body">
                                <div class="media static-top-widget">
                                    <div class="media-body"><span class="m-0">Tài khoản</span>
                                        <h3 class="mb-0"> <span class="counter"><?php echo $countUser['count'] ?></span><small> đã được tạo</small></h3>
                                    </div>
                                    <div class="icons-widgets">
                                        <i data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-xl-6 xl-100">
                        <div class="card">
                            <div class="card-header">
                                <h5>Đơn hàng mới nhất</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="icofont icofont-simple-left"></i></li>
                                        <li><i class="view-html fa fa-code"></i></li>
                                        <li><i class="icofont icofont-maximize full-card"></i></li>
                                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                                        <li><i class="icofont icofont-error close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="user-status table-responsive latest-order-table">
                                    <table class="table table-bordernone">
                                        <thead>
                                        <tr>
                                            <th scope="col">ID Đơn hàng</th>
                                            <th scope="col">Tổng số thanh toán</th>
                                            <th scope="col">Họ tên</th>
                                            <th scope="col">Trạng thái</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="digits">$120.00</td>
                                            <td class="font-danger">Bank Transfers</td>
                                            <td class="digits">On Way</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td class="digits">$90.00</td>
                                            <td class="font-secondary">Ewallets</td>
                                            <td class="digits">Delivered</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td class="digits">$240.00</td>
                                            <td class="font-warning">Cash</td>
                                            <td class="digits">Delivered</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td class="digits">$120.00</td>
                                            <td class="font-danger">Direct Deposit</td>
                                            <td class="digits">$6523</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td class="digits">$50.00</td>
                                            <td class="font-primary">Bank Transfers</td>
                                            <td class="digits">Delivered</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <a href="order.php" class="btn btn-primary">Xem tất cả đơn hàng</a>
                                </div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head1" title="" data-original-title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                                    <pre class=" language-html"><code class=" language-html" id="example-head1">
                                        <div class="user-status table-responsive latest-order-table">
                                            <table class="table table-bordernone">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Order ID</th>
                                                        <th scope="col">Order Total</th>
                                                        <th scope="col">Payment Method</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td class="digits">$120.00</td>
                                                        <td class="font-secondary">Bank Transfers</td>
                                                        <td class="digits">Delivered</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td class="digits">$90.00</td>
                                                        <td class="font-secondary">Ewallets</td>
                                                        <td class="digits">Delivered</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td class="digits">$240.00</td>
                                                        <td class="font-secondary">Cash</td>
                                                        <td class="digits">Delivered</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td class="digits">$120.00</td>
                                                        <td class="font-primary">Direct Deposit</td>
                                                        <td class="digits">Delivered</td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td class="digits">$50.00</td>
                                                        <td class="font-primary">Bank Transfers</td>
                                                        <td class="digits">Delivered</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-4 xl-50">
                        <div class="card customers-card">
                            <div class="card-header">
                                <h5>Khách hàng mới</h5>
                                <div class="chart-value-box pull-right">
                                    <div class="value-square-box-secondary"></div><span class="f-12 f-w-600">Khách hàng</span>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="apex-chart-container">
                                    <div id="customers"></div>
                                </div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head7" title="" data-original-title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                                    <pre class=" language-html"><code class=" language-html" id="example-head7">
                                    <div id="customers"></div>
                                    </code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 xl-50">
                        <div class="card height-equal">
                            <div class="card-header">
                                <h5>Trạng thái khách hàng</h5>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="icofont icofont-simple-left"></i></li>
                                        <li><i class="view-html fa fa-code"></i></li>
                                        <li><i class="icofont icofont-maximize full-card"></i></li>
                                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                                        <li><i class="icofont icofont-error close-card"></i></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="user-status table-responsive products-table">
                                    <table class="table table-bordernone mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">Họ tên</th>
                                            <th scope="col">Ngày đăng ký</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($users as $value): ?>
                                            <tr>
                                                <td class="bd-t-none u-s-tb">
                                                    <div class="align-middle image-sm-size"><img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/user2.jpg" alt="" data-original-title="" title="">
                                                        <div class="d-inline-block">
                                                            <h6><?php echo $value['name'] ?> <span class="text-muted digits">(<?php echo $value['onlines'] ?>+ Online)</span></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="digits"><?php echo $value['date_register'] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="code-box-copy">
                                    <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head5" title="" data-original-title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                                    <pre class=" language-html"><code class=" language-html" id="example-head5">
                                        <div class="user-status table-responsive products-table">
                                            <table class="table table-bordernone mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Designation</th>
                                                        <th scope="col">Skill Level</th>
                                                        <th scope="col">Experience</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="bd-t-none u-s-tb">
                                                            <div class="align-middle image-sm-size"><img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/user2.jpg" alt="" data-original-title="" title="">
                                                                <div class="d-inline-block">
                                                                    <h6>John Deo <span class="text-muted digits">(14+ Online)</span></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Designer</td>
                                                        <td>
                                                            <div class="progress-showcase">
                                                                <div class="progress" style="height: 8px;">
                                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="digits">2 Year</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bd-t-none u-s-tb">
                                                            <div class="align-middle image-sm-size"><img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/man.png" alt="" data-original-title="" title="">
                                                                <div class="d-inline-block">
                                                                    <h6>Mohsib lara<span class="text-muted digits">(99+ Online)</span></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Tester</td>
                                                        <td>
                                                            <div class="progress-showcase">
                                                                <div class="progress" style="height: 8px;">
                                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="digits">5 Month</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bd-t-none u-s-tb">
                                                            <div class="align-middle image-sm-size"><img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/user.png" alt="" data-original-title="" title="">
                                                                <div class="d-inline-block">
                                                                    <h6>Hileri Soli <span class="text-muted digits">(150+ Online)</span></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Designer</td>
                                                        <td>
                                                            <div class="progress-showcase">
                                                                <div class="progress" style="height: 8px;">
                                                                    <div class="progress-bar bg-secondary" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="digits">3 Month</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bd-t-none u-s-tb">
                                                            <div class="align-middle image-sm-size"><img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="assets/images/dashboard/designer.jpg" alt="" data-original-title="" title="">
                                                                <div class="d-inline-block">
                                                                    <h6>Pusiz bia <span class="text-muted digits">(14+ Online)</span></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>Designer</td>
                                                        <td>
                                                            <div class="progress-showcase">
                                                                <div class="progress" style="height: 8px;">
                                                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="digits">5 Year</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </code></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>

        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">Copyright 2019 © Bigdeal All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <p class="pull-right mb-0">Hand crafted & made with<i class="fa fa-heart"></i></p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer end-->
    </div>

</div>

<!-- latest jquery-->
<script src="../assets/js/jquery-3.3.1.min.js"></script>

<!-- Bootstrap js-->
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.js"></script>

<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>

<!--chartist js-->
<script src="../assets/js/chart/chartist/chartist.js"></script>


<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--copycode js-->
<script src="../assets/js/prism/prism.min.js"></script>
<script src="../assets/js/clipboard/clipboard.min.js"></script>
<script src="../assets/js/custom-card/custom-card.js"></script>

<!--counter js-->
<script src="../assets/js/counter/jquery.waypoints.min.js"></script>
<script src="../assets/js/counter/jquery.counterup.min.js"></script>
<script src="../assets/js/counter/counter-custom.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!--map js-->
<script src="../assets/js/vector-map/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js"></script>

<!--apex chart js-->
<script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="../assets/js/chart/apex-chart/stock-prices.js"></script>

<!--chartjs js-->
<script src="../assets/js/chart/flot-chart/excanvas.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.time.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.categories.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.stack.js"></script>
<script src="../assets/js/chart/flot-chart/jquery.flot.pie.js"></script>
<!--dashboard custom js-->
<script src="../assets/js/dashboard/default.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--height equal js-->
<script src="../assets/js/equal-height.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:27:49 GMT -->
</html>
