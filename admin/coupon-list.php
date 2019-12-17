<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";

    //Select tất cả vouchers
    $sqlQuery = "SELECT * from vouchers order by end_time desc";
    $vouchers = executeQuery($sqlQuery, true);

    //Lấy get action
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    if($id != null){
        $sqlQuery = "SELECT * from vouchers where id=$id";
        $show = executeQuery($sqlQuery, false);
    }

    if( isset($_POST['btn_update']) && $action == "update"){
        if($id == null){
            header('location: coupon-list.php');
            die;
        }else{
            if(empty($_POST['status_update'])){
                $active = 0; 
            }else{
                $active = 1;
            }
            //Thực hiện update
            $sqlUpdate = "UPDATE vouchers set active=$active where id=$id";
            executeQuery($sqlUpdate);
            // dd($sqlUpdate);
            header('location: coupon-list.php');
        }
    }

    //Thực hiện xóa nếu action = delete
    if($action == "delete" && $id != null){
        $sqlDelete = "DELETE from vouchers where id=$id";
        executeQuery($sqlDelete);
        // dd($sqlDelete);
        header('location: coupon-list.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/coupon-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:02 GMT -->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bigdeal admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Bigdeal admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <title>Quản trị - Mã giảm giá</title>

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
                                <h3>Danh sách Voucher
                                    <small>Bảng quản trị Shop</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Voucher</li>
                                <li class="breadcrumb-item active">Danh sách</li>
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
                                <h5>Danh sách</h5>
                            </div>
                            <div class="card-body">
                                <div class="jsgrid" style="position: relative; height: auto; width: 100%;">
                                    <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                        <table class="jsgrid-table">
                                            <tr class="jsgrid-header-row">
                                                <th class="jsgrid-header-cell" style="width: 150px;">Tiêu đề</th>
                                                <th class="jsgrid-header-cell jsgrid-align-right" style="width: 100px;">Mã voucher</th>
                                                <th class="jsgrid-header-cell jsgrid-align-right" style="width: 100px;">Giảm giá</th>
                                                <th class="jsgrid-header-cell jsgrid-align-right" style="width: 100px;">Trạng thái</th>
                                                <th class="jsgrid-header-cell" style="width: 100px;">Kích hoạt</th>
                                                <th class="jsgrid-header-cell jsgrid-align-center" style="width: 100px;">Thao tác</th>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="jsgrid-grid-body">
                                        <table class="jsgrid-table">
                                            <tbody>
                                                <?php if ($action == null): ?>
                                                    <?php foreach($vouchers as $vou): ?>
                                                        <tr class="jsgrid-row">
                                                        <td class="jsgrid-cell" style="width: 150px;"><?php echo $vou['title'] ?></td>
                                                        <td class="jsgrid-cell jsgrid-align-right" style="width: 100px;"><?php echo $vou['code'] ?></td>
                                                        <td class="jsgrid-cell jsgrid-align-right" style="width: 100px;">
                                                            <?php echo number_format($vou['discount'], 0, '', ',')  ?> vnđ
                                                        </td>
                                                        <td class="jsgrid-cell jsgrid-align-right" style="width: 100px;">
                                                            <?php
                                                            $start_v = strtotime($vou['start_time']);
                                                            $end_v = strtotime($vou['end_time']);
                                                            $now_v = strtotime("now");
                                                            if($now_v <= $start_v || $now_v > $end_v || $vou['used_count'] < 0){
                                                                $status_title = "Hết / hết hạn";
                                                                $status_voucher = "badge font-danger";
                                                            }else{
                                                                $status_title = "Còn sử dụng";
                                                                $status_voucher = "badge font-warning f-12";
                                                            }
                                                            ?>
                                                            <span class="<?php echo $status_voucher ?>"><?php echo $status_title ?></span>
                                                            <?php
                                                            ?>
                                                            </td>
                                                        <td class="jsgrid-cell" style="width: 100px;">
                                                            <?php
                                                            if($vou['active'] == 1){
                                                                $active_voucher = "badge font-warning";
                                                                $active_title = "Đã kích hoạt";
                                                            }else{
                                                                $active_voucher = "badge font-dark";
                                                                $active_title = "Chưa kích hoạt";
                                                            }
                                                            ?>
                                                            <span class="<?php echo $active_voucher ?>"><?php echo $active_title ?></span>
                                                            <?php
                                                            ?>
                                                        </td>
                                                        <td class="jsgrid-cell" style="width: 100px;">
                                                            <a href="?action=update&id=<?php echo $vou['id'] ?>"><input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit"></a>
                                                            &#160;&#160;
                                                            <a href="?action=delete&id=<?php echo $vou['id'] ?>" OnClick="return confirm('xóa Voucher này ?');"><input class="jsgrid-button jsgrid-delete-button" type="button" title="Delete"></a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                                <?php if ($action == "update"): ?>
                                                    <form method="post">
                                                        <tr class="jsgrid-row">
                                                            <td class="jsgrid-cell" style="width: 150px;"><?php echo $show['title'] ?></td>
                                                            <td class="jsgrid-cell jsgrid-align-right" style="width: 100px;"><?php echo $show['code'] ?></td>
                                                            <td class="jsgrid-cell jsgrid-align-right" style="width: 100px;">
                                                                <?php echo number_format($show['discount'], 0, '', ',')  ?> vnđ
                                                            </td>
                                                            <td class="jsgrid-cell jsgrid-align-right" style="width: 100px;">
                                                                <?php
                                                                    $start_v = strtotime($show['start_time']);
                                                                    $end_v = strtotime($show['end_time']);
                                                                    $now_v = strtotime("now");
                                                                    if($now_v <= $start_v || $now_v > $end_v || $show['used_count'] < 0){
                                                                        $status_title = "Hết / hết hạn";
                                                                        $status_voucher = "badge font-dark";
                                                                    }else{
                                                                        $status_title = "Còn";
                                                                        $status_voucher = "badge font-warning";
                                                                    }
                                                                ?>
                                                                <span class="<?php echo $status_voucher ?>"><?php echo $status_title ?></span>
                                                                <?php
                                                                ?>
                                                            </td>
                                                            <td class="jsgrid-cell" style="width: 100px;">
                                                                <?php
                                                                if($show['active'] == 1){
                                                                    ?>
                                                                    <label class="switch">
                                                                        <input type="checkbox" name="status_update" checked >
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <label class="switch">
                                                                        <input type="checkbox" name="status_update" >
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="jsgrid-cell" style="width: 100px;">
                                                                <button name="btn_update" class="jsgrid-button jsgrid-update-button" type="submit" title="Update"></button>
                                                                &#160;&#160;
                                                                <input onClick="history.go(-1);" class="jsgrid-button jsgrid-cancel-edit-button" type="button" title="Cancel edit">
                                                            </td>
                                                        </tr>
                                                    </form>
                                                <?php endif ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="jsgrid-load-panel" style="display: none; position: absolute; top: 50%; left: 50%; z-index: 1000;">Please, wait...</div></div>
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
<script src="../assets/js/jsgrid/griddata-discount-coupon.js"></script>
<script src="../assets/js/jsgrid/jsgrid-discount-coupon.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/coupon-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:02 GMT -->
</html>
