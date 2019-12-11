<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";

    //action & id
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    

    //select cate
    $sqlCate = "SELECT * from categories";
    $title = executeQuery($sqlCate, true);
    // $select = "SELECT * from categories";
    // $menu = executeQuery($select, true);
    // dd($title);
    //check cate id
    $cate_id = isset($_GET['cate_id']) ? $_GET['cate_id'] : null;
    //select products
    if($cate_id == null){
        $sqlQuery = "SELECT * from products";
    }else{
        $sqlQuery = "SELECT * from products where cate_id=$cate_id";
    }
    $products = executeQuery($sqlQuery, true);

    if($action == "delete" && $id != null){
        $sqlDelete = "DELETE from products where id=$id";
        executeQuery($sqlDelete);
        header('Refresh: 0');
    }
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
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
                                <h3>Products
                                    <small>Bigdeal Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="<?php echo BASE_URL.'admin/' ?>"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Product</li>
                                <li class="breadcrumb-item active">List</li>
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
                                <h5>List Products</h5>
                            </div>
                            <div class="card-body order-datatable">
                                <table class="display" id="basic-1">
                                    <thead>
                                    <tr>
                                        <th>Code product</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Sale price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $value): ?>
                                            <tr>
                                                <td>#<?php echo $value['sku'] ?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="../<?php echo $value['feature_image'] ?>" alt="" class="img-fluid img-60 mr-2 blur-up lazyloaded">
                                                    </div>
                                                </td>
                                                <td><span><?php echo $value['name'] ?></span></td>
                                                <td><?php echo number_format($value['price'], 0, '', ',') ?> vnđ</td>
                                                <td><?php echo number_format($value['sale_price'], 0, '', ',') ?> vnđ</td>
                                                <?php
                                                if( $value['quantum'] - $value['sold'] > 0){
                                                    $classStatus = "badge badge-warning";
                                                    $nameStatus = "Còn hàng";
                                                }else{
                                                    $classStatus = "badge badge-danger";
                                                    $nameStatus = "Hết hàng";
                                                }
                                                ?>
                                                <td><span class="<?php echo $classStatus ?>"><?php echo $nameStatus ?></span></td>
                                                <td style="text-align: center;">
                                                    <a href="product-update.php?id=<?php echo $value['id'] ?>">
                                                    <i class="fas fa-pen-square" title="update"></i>
                                                    </a>
                                                    <a onclick="return confirm('Bạn chắc chứ ?')" href="?action=delete&id=<?php echo $value['id'] ?>">
                                                    <i class="far fa-trash-alt" title="delete"></i>
                                                    </a>
                                                </td>
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
