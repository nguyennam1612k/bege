<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";

    //action & id
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    $id     = isset($_GET['id']) ? $_GET['id'] : null;

    //select cate
    $sqlCate = "SELECT * from categories";
    $title = executeQuery($sqlCate, true);
    // dd($title);
    //check cate id
    $cate_id = isset($_GET['cate_id']) ? $_GET['cate_id'] : null;
    //select products
    if($cate_id == null){
        $sqlQuery = "SELECT * from products limit 20";
    }else{
        $sqlQuery = "SELECT * from products where cate_id=$cate_id limit 20";
    }
    $products = executeQuery($sqlQuery, true);

    //Hiện thị dữ liệu nếu có update
    if($id != null){
        $sqlQuery = "SELECT * from products where id=$id";
        $proUpdate = executeQuery($sqlQuery, false);
    }
    //thực hiện theo action
    //action = update
    if($action == "update" && $id != null){
        extract($_REQUEST);
        $sqlUpdate =    "UPDATE products set
                            (name, sale_price,feature_image, detail, especially, parameter, quantum, cate_id)
                        values
                            ('$name', $sale_price,'$feature_image', '$detail', $especially, '$parameter', $quantum, $cate_id)
                        where
                            id=$id";
        executeQuery($sqlUpdate);
        // dd($sqlUpdate);
        // header('location: '. $_SERVER['HTTP_REFRESH']);
    }

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/category.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:28:16 GMT -->
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
                                <h3>Category
                                    <small>Bigdeal Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Physical</li>
                                <li class="breadcrumb-item active">Category</li>
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
                                <h5>Products Category</h5>
                            </div>
                            <div class="card-body">
                                <div class="btn-popup pull-right">
                                    <button type="button" class="btn btn-primary"><a href="add-product.php" style="color: #fff">Add Product</a></button>
                                </div>
                                <?php if ($action == null): ?>
                                    <div class="table-responsive">
                                        <div  class="product-physical jsgrid" style="position: relative; height: auto; width: 100%;">
                                            <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                                <table class="jsgrid-table">
                                                    <tr class="jsgrid-header-row">
                                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" style="width: 50px;">
                                                        Image</th>
                                                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 100px;">
                                                        Name</th>
                                                        <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 50px;">
                                                        Price</th>
                                                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 50px;">
                                                        Status</th>
                                                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 50px;">
                                                        Category</th>
                                                        <th class="jsgrid-header-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                                            <input class="jsgrid-button jsgrid-mode-button jsgrid-insert-mode-button" type="button" title="Switch to inserting">
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="jsgrid-grid-body">
                                                <table class="jsgrid-table">
                                                    <!-- hiện thị danh sách sản phẩm -->
                                                    <tbody>
                                                        <?php foreach ($products as $value): ?>
                                                            <tr class="jsgrid-row">
                                                                <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">
                                                                    <img src="../<?php echo $value['feature_image'] ?>" class="blur-up lazyloaded" style="height: 50px; width: 50px;">
                                                                </td>
                                                                <td class="jsgrid-cell" style="width: 100px;">
                                                                <?php echo $value['name'] ?></td>
                                                                <td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">
                                                                    <?php echo number_format($value['sale_price'] , 0 , '', ',') ?> vnđ
                                                                </td>
                                                                <td class="jsgrid-cell" style="width: 50px;">
                                                                    <?php
                                                                    if ($value['quantum'] - $value['sold'] > 0){
                                                                        $classStatusP = "fa fa-circle font-success f-12";
                                                                        $titleStatusP = "còn hàng";
                                                                    }else{
                                                                        $classStatusP = "fa fa-circle font-danger f-12";
                                                                        $titleStatusP = "hết hàng";
                                                                    }
                                                                    ?>
                                                                    <i class="<?php echo $classStatusP ?>" title="<?php echo $titleStatusP ?>">
                                                                        </i>
                                                                </td>

                                                                <?php
                                                                $cate_id = $value['cate_id'];
                                                                $sqlQuery = "SELECT title from categories where id=$cate_id";
                                                                $titleC = executeQuery($sqlQuery, false);
                                                                ?>

                                                                <td class="jsgrid-cell" style="width: 50px;">
                                                                <?php echo $titleC['title'] ?>
                                                                    
                                                                </td>
                                                                <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                                                    <a href="?action=update&id=<?php echo $value['id'] ?>">
                                                                        <input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit">
                                                                    </a>
                                                                    <a href="?action=delete&id=<?php echo $value['id'] ?>">
                                                                        <input class="jsgrid-button jsgrid-delete-button" type="button" title="Delete">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="jsgrid-pager-container" style="">
                                                <div class="jsgrid-pager">Pages:
                                                    <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button">
                                                        <a href="javascript:void(0);">First</a>
                                                    </span> 
                                                    <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button">
                                                        <a href="javascript:void(0);">Prev</a>
                                                    </span>
                                                    <span class="jsgrid-pager-page jsgrid-pager-current-page">1</span><span class="jsgrid-pager-page">
                                                        <a href="javascript:void(0);">2</a>
                                                    </span> 
                                                    <span class="jsgrid-pager-nav-button">
                                                        <a href="javascript:void(0);">Next</a>
                                                    </span> 
                                                    <span class="jsgrid-pager-nav-button">
                                                        <a href="javascript:void(0);">Last</a>
                                                    </span>
                                                    &nbsp;&nbsp; 1 of 2 
                                                </div>
                                             </div>
                                             <div class="jsgrid-load-shader" style="display: none; position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; z-index: 1000;">
                                                 
                                             </div>
                                             <div class="jsgrid-load-panel" style="display: none; position: absolute; top: 50%; left: 50%; z-index: 1000;">Please, wait...</div>
                                         </div>
                                    </div>
                                <?php endif ?>
                                <?php if ($action == "update"): ?>
                                    <div class="table-responsive">
                                        <div  class="product-physical jsgrid" style="position: relative; height: auto; width: 100%;">
                                            <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                                <table class="jsgrid-table">
                                                    <tr class="jsgrid-header-row">
                                                        <th class="jsgrid-header-cell jsgrid-align-center jsgrid-header-sortable" style="width: 50px;">
                                                        Image</th>
                                                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 100px;">
                                                        Name</th>
                                                        <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 50px;">
                                                        Price</th>
                                                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 50px;">
                                                        Status</th>
                                                        <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 50px;">
                                                        Category</th>
                                                        <th class="jsgrid-header-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                                            <input class="jsgrid-button jsgrid-mode-button jsgrid-insert-mode-button" type="button" title="Switch to inserting">
                                                        </th>
                                                    </tr>                                                    
                                                </table>
                                            </div>
                                            <form method="post">
                                                <div class="jsgrid-grid-body">
                                                    <table class="jsgrid-table">
                                                        <!-- hiện thị danh sách sản phẩm -->
                                                        <tbody>
                                                            <tr class="jsgrid-row">
                                                                <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">
                                                                    <label for="new">
                                                                        <img src="../<?php echo $proUpdate['feature_image'] ?>" class="blur-up lazyloaded" style="height: 50px; width: 50px;">
                                                                    </label>
                                                                    <input type="file" name="new" id="new" style="display: none;">
                                                                </td>
                                                                <td class="jsgrid-cell" style="width: 100px;">
                                                                    <label for="name">
                                                                        <?php echo $proUpdate['name'] ?>
                                                                    </label>
                                                                    <input type="name" name="name" id="name" style="border: 0">
                                                                </td>
                                                                <td class="jsgrid-cell jsgrid-align-right" style="width: 50px;">
                                                                    <label for="sale_price">
                                                                        <?php echo number_format($proUpdate['sale_price'] , 0 , '', ',') ?> vnđ
                                                                    </label>
                                                                    <input type="number" name="sale_price" id="sale_price" style="border: 0">
                                                                </td>
                                                                <td class="jsgrid-cell" style="width: 50px;">
                                                                    <label for="quantum">
                                                                        <?php echo $proUpdate['quantum'] ?>
                                                                    </label>
                                                                    <input type="number" name="quantum" id="quantum" style="border: 0">
                                                                </td>
                                                                <td class="jsgrid-cell" style="width: 50px;">
                                                                    <select name="cate_id" id="">
                                                                        <?php foreach ($title as $tit): ?>
                                                                            <!-- <?php //if ($tit['id'] == $proUpdate['cate_id']): ?>
                                                                                <option value="<?php //echo $title['id'] ?>" selected><?php //echo $title['title'] ?></option>
                                                                            <?php //endif ?>
                                                                            <?php //if ($tit['id'] != $proUpdate['cate_id']): ?>
                                                                                <option value="<?php //echo $title['id'] ?>"><?php //echo $title['title'] ?></option>
                                                                            <?php //endif ?> -->
                                                                            <?php echo $tit['title'] ?>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                </td>
                                                                <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                                                    <a href="?action=update&id=<?php echo $proUpdate['id'] ?>">
                                                                        <input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit">
                                                                    </a>
                                                                    <a href="?action=delete&id=<?php echo $proUpdate['id'] ?>">
                                                                        <input class="jsgrid-button jsgrid-delete-button" type="button" title="Delete">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </form>
                                            <div class="jsgrid-pager-container" style="">
                                                <div class="jsgrid-pager">Pages:
                                                    <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button">
                                                        <a href="javascript:void(0);">First</a>
                                                    </span> 
                                                    <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button">
                                                        <a href="javascript:void(0);">Prev</a>
                                                    </span>
                                                    <span class="jsgrid-pager-page jsgrid-pager-current-page">1</span><span class="jsgrid-pager-page">
                                                        <a href="javascript:void(0);">2</a>
                                                    </span> 
                                                    <span class="jsgrid-pager-nav-button">
                                                        <a href="javascript:void(0);">Next</a>
                                                    </span> 
                                                    <span class="jsgrid-pager-nav-button">
                                                        <a href="javascript:void(0);">Last</a>
                                                    </span>
                                                    &nbsp;&nbsp; 1 of 2 
                                                </div>
                                             </div>
                                             <div class="jsgrid-load-shader" style="display: none; position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; z-index: 1000;">
                                                 
                                             </div>
                                             <div class="jsgrid-load-panel" style="display: none; position: absolute; top: 50%; left: 50%; z-index: 1000;">Please, wait...</div>
                                         </div>
                                    </div>
                                <?php endif ?>
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
