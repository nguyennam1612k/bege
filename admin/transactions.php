<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";

    //select giao dịch ( những hóa đơn đã thanh toán )
    //select hóa đơn
    $sqlQuery = "SELECT 
                    ROW_NUMBER() OVER (ORDER BY id) AS stt,
                    orders.*
                from orders
                where status='Đã giao hàng'
                limit 5";
    $transactions = executeQuery($sqlQuery, true);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/transactions.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:01 GMT -->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bigdeal admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Bigdeal admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <title>Bigdeal - Premium Admin Template</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/flag-icon.css">

    <!-- jsgrid css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/jsgrid.css">

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
                                    <h3>Transactions
                                        <small>Bigdeal Admin panel</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item">Sales</li>
                                    <li class="breadcrumb-item active">Transactions</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Transaction Details</h5>
                                    <?php if ($transactions == null): ?>
                                        <p style="color: #9C370F">Không có giao dịch nào thành công</p>
                                    <?php endif ?>
                                </div>
                                <div class="card-body">
                                    <div class="transactions jsgrid" style="position: relative; height: auto; width: 100%;">
                                        <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                            <table class="jsgrid-table">
                                                <tr class="jsgrid-header-row">
                                                    <th class="jsgrid-header-cell" style="width: 50px;">
                                                    Order Id</th>
                                                    <th class="jsgrid-header-cell jsgrid-align-right" style="width: 100px;">
                                                    Transaction Id</th>
                                                    <th class="jsgrid-header-cell" style="width: 100px;">
                                                    Date</th>

                                                    <th class="jsgrid-header-cell" style="width: 50px;">
                                                    Payment Method
                                                    </th>
                                                    <th class="jsgrid-header-cell" style="width: 100px;">
                                                    Delivery Status</th>
                                                    <th class="jsgrid-header-cell" style="width: 100px;">
                                                    Amount</th>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="jsgrid-grid-body">
                                            <table class="jsgrid-table">
                                                <tbody>
                                                    <?php if ($transactions != null): ?>
                                                        <?php foreach ($transactions as $value): ?>
                                                            <tr class="jsgrid-row">
                                                                <td class="jsgrid-cell" style="width: 50px;">#<?php echo $value['id'] ?></td><td class="jsgrid-cell jsgrid-align-right" style="width: 100px;">
                                                                # <?php echo $value['code'] ?></td>
                                                                <td class="jsgrid-cell" style="width: 100px;">
                                                                <?php echo $value['created_date'] ?></td>
                                                                <td class="jsgrid-cell" style="width: 50px;">
                                                                <?php echo $value['payment_method'] ?></td>
                                                                <td class="jsgrid-cell" style="width: 100px;">
                                                                <?php echo $value['status'] ?></td>
                                                                <td class="jsgrid-cell" style="width: 100px;">
                                                                <?php echo number_format($value['total_price'] , 0, '', ',') ?> đ</td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    <?php endif ?>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="jsgrid-pager-container">
                                            <div class="jsgrid-pager">Pages: 
                                                <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button">
                                                    <a href="javascript:void(0);">First</a>
                                                </span>
                                                <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button">
                                                    <a href="javascript:void(0);">Prev</a>
                                                </span> 
                                                <span class="jsgrid-pager-page jsgrid-pager-current-page">1</span> 
                                                <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button">
                                                    <a href="javascript:void(0);">Next</a>
                                                </span> 
                                                <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button">
                                                    <a href="javascript:void(0);">Last</a>
                                                </span> &nbsp;&nbsp; 1 of 1 
                                            </div>
                                        </div>
                                        <!-- <div class="jsgrid-load-shader" style="display: none; position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; z-index: 1000;">
                                        </div>
                                        <div class="jsgrid-load-panel" style="display: none; position: absolute; top: 50%; left: 50%; z-index: 1000;">Please, wait...</div> -->
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

    <!-- Jsgrid js-->
    <script src="../assets/js/jsgrid/jsgrid.min.js"></script>
    <script src="../assets/js/jsgrid/griddata-transactions.js"></script>
    <script src="../assets/js/jsgrid/jsgrid-transactions.js"></script>

    <!--Customizer admin-->
    <script src="../assets/js/admin-customizer.js"></script>

    <!-- lazyload js-->
    <script src="../assets/js/lazysizes.min.js"></script>

    <!--right sidebar js-->
    <script src="../assets/js/chat-menu.js"></script>

    <!--script admin-->
    <script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/transactions.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:02 GMT -->
</html>
