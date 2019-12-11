<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";
    $mess = "";

    //get id
    $id = isset($_GET['id']) ? $_GET['id']: null;
    //Hiện thị dữ liệu update
    $showUpdate = "SELECT * from users where id=$id";
    $user_update = executeQuery($showUpdate, false);
    if(isset($_POST['btn_update'])){
        if(isset($_POST['status'])){
            $status = 1;
        }else{
            $status = 0;
        }

            $sqlUpdate = "UPDATE users set status=$status where id=$id";
            executeQuery($sqlUpdate);
            header('location: users.php');
            // dd($sqlUpdate);
    }
    
 ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/product-listdigital.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:30:34 GMT -->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bigdeal admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Bigdeal admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <title>Bigdeal - Cập nhật tài khoản</title>

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
    <style>
        th{
            background-color: #BBDAFA;
            color: #353535;
        }
        table{
            border: 1px solid #D2D2D2;
        }
        .button_update{
            margin-left: 20px;
            width: 40px ;
            float: left;
            background-color: green;
            color: #fff;
            padding: 10px;
            border: 0;
            border-radius: 5px
        }
        button>a{
            display: block;
        }
    </style>
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->
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
                                <h3>Tài khoản
                                    <small>Bảng quản trị Shop</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Users</li>
                                <li class="breadcrumb-item active">Update</li>
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
                                <h5>Cập nhật Tài khoản</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="product-physical jsgrid" style="position: relative; height: auto; width: 100%;">
                                        <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                            <table class="jsgrid-table">
                                                <tr>
                                                    <th style="width: 50px;text-align: center;height: 45px">Icon</th>
                                                    <th style="width: 100px;text-align: center;">Tên danh mục</th>
                                                    <th style="width: 50px;text-align: center;">Hình ảnh</th>
                                                    <th style="width: 50px;text-align: center;">Kích hoạt</th>
                                                    <th style="width: 50px;text-align: center">Thao tác</th>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="jsgrid-grid-body">
                                            <table class="jsgrid-table">
                                                <tbody>
                                                    <!-- đổ dữ liệu ra -->
                                                    <form method="post">
                                                       <tr class="jsgrid-row">
                                                            <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">
                                                                <img style="max-width: 150px" src="../<?php echo $user_update['avatar'] ?>" alt="">
                                                            </td>
                                                            <td class="jsgrid-cell" style="width: 100px;">
                                                                <?php echo $user_update['name'] ?>
                                                            </td>
                                                            <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">
                                                                <?php 
                                                                if($user_update['role'] == 1){
                                                                    echo "Quản trị viên";
                                                                }else{
                                                                    echo "Người dùng";
                                                                }
                                                                 ?>
                                                            </td>
                                                            <td class="jsgrid-cell" style="width: 50px;">
                                                                <?php
                                                                if($user_update['status'] == 1){
                                                                    ?>
                                                                    <label class="switch">
                                                                        <input type="checkbox" name="status" checked value="1">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <label class="switch">
                                                                        <input type="checkbox" name="status" >
                                                                        <span class="slider round" value="0"></span>
                                                                    </label>
                                                                    <?php
                                                                }
                                                                ?>
                                                                
                                                            </td>
                                                            <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                                                <button name="btn_update" class="jsgrid-button jsgrid-update-button" type="submit" title="Update"></button>
                                                                <input onclick="javascript:history.go(-1)" class="jsgrid-button jsgrid-cancel-edit-button" type="button" title="Cancel edit">
                                                            </td>
                                                        </tr>
                                                    </form>      
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="" class="product-list digital-product">
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

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- Jsgrid js-->
<script src="../assets/js/jsgrid/jsgrid.min.js"></script>
<script src="../assets/js/jsgrid/griddata-manage-product.js"></script>
<script src="../assets/js/jsgrid/jsgrid-manage-product.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/category.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:28:19 GMT -->
</html>
