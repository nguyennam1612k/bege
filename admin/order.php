<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";

    //select hóa đơn
    $sqlQuery = "SELECT 
                    ROW_NUMBER() OVER (ORDER BY id) AS stt,
                    orders.*
                from orders";
    $orders = executeQuery($sqlQuery, true);
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/order.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:30:41 GMT -->
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

    <!-- Datatables css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">

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
                                <h3>Orders
                                    <small>Bigdeal Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Sales</li>
                                <li class="breadcrumb-item active">Orders</li>
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
                                <h5>Manage Order</h5>
                            </div>
                            <div class="card-body order-datatable">
                                <table class="display" id="basic-1">
                                    <thead>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Sản phẩm</th>
                                        <th>Họ tên</th>
                                        <th>Phương thức</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian</th>
                                        <th>Tổng giá</th>
                                        <th>Xử lý</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $value): ?>
                                            <?php
                                            $id=$value['id'];
                                            $sqlQuery = "SELECT image from order_detail where order_id=$id";
                                            $productOrder = executeQuery($sqlQuery, true);
                                            ?>
                                            <tr>
                                                <td>#<?php echo $value['code'] ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <?php foreach ($productOrder as $key): ?>
                                                            <img src="../<?php echo $key['image'] ?>" alt="" class="img-fluid img-30 mr-2 blur-up lazyloaded">
                                                        <?php endforeach ?>
                                                    </div>
                                                </td>
                                                <td><span><?php echo $value['name'] ?></span></td>
                                                <td><?php echo $value['payment_method'] ?></td>
                                                <?php
                                                if( $value['status'] == "1 - chờ xử lý"){
                                                    $classStatus = "badge badge-warning";
                                                }else if( $value['status'] == "2 - đang vận chuyển"){
                                                    $classStatus = "badge badge-primary";
                                                }else if( $value['status'] == "3 - đã giao hàng"){
                                                    $classStatus = "badge badge-success";
                                                }else if( $value['status'] == "0 - đã hủy"){
                                                    $classStatus = "badge badge-danger";
                                                }
                                                ?>
                                                <td><span class="<?php echo $classStatus ?>"><?php echo $value['status'] ?></span></td>
                                                <td><?php echo nicetime($value['created_date']) ?></td>
                                                <td><?php echo number_format($value['total_price'], 0, '', ',') ?> đ</td>
                                                <td><a href="update-order.php?id=<?php echo $value['id'] ?>">Xử lý</a></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
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

<!-- Datatable js-->
<script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/datatables/custom-basic.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/order.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:01 GMT -->
</html>
