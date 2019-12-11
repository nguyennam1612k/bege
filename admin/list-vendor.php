<?php 
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";

    $action = isset($_GET['action']) ? $_GET['action'] : null;
    $id     = isset($_GET['id']) ? $_GET['id'] : null;
    //select tất cả danh sách nhà cung cấp
    $sqlQuery = "SELECT * from vendors";
    $vendors = executeQuery($sqlQuery, true);

    //THực hiện xóa nhà cung cấp nếu action = delete
    if($action == "delete" && $id != null){
        $sqlDel = "DELETE from vendors where id=$id";
        executeQuery($sqlDel);
        header('location: list-vendor.php');
    }
 ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/list-vendor.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:06 GMT -->
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

    <!-- Datatable css-->
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
                                <h3>Vendor List
                                    <small>Bigdeal Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Vendors</li>
                                <li class="breadcrumb-item active">Vendor List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h5>Vendor Details</h5>
                    </div>
                    <div class="card-body vendor-table">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>Nhà cung cấp</th>
                                <th>Số sản phẩm</th>
                                <th>Tên cửa hàng</th>
                                <th>Ngày tạo</th>
                                <th>Doanh thu</th>
                                <th>Chiết khẩu</th>
                                <th>Xử lý</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vendors as $value): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex vendor-list">
                                                <img src="../<?php echo $value['avatar'] ?>" alt="" class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                                <span><?php echo $value['name'] ?></span>
                                            </div>
                                        </td>
                                        <td><?php echo $value['products'] ?></td>
                                        <td><?php echo $value['store_name'] ?></td>
                                        <td><?php echo nicetime($value['create_date']) ?></td>
                                        <td><?php echo number_format($value['revenue'], 0, '', ',') ?> vnđ</td>
                                        <td><?php echo number_format($value['extracting'], 0, '', ',') ?> vnđ</td>
                                        <td>
                                            <div>
                                                <a href="?id=<?php echo $value['id'] ?>"><i class="fa fa-edit mr-2 font-success"></i></a>
                                                <a href="?action=delete&id=<?php echo $value['id'] ?>" onclick="return confirm('Xóa nhà cung cấp này ?')" ><i class="fa fa-trash font-danger"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
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

<!-- Datatables js-->
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

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/list-vendor.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:07 GMT -->
</html>
