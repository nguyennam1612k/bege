<?php require_once "../connection.php";
    $update = $_GET['update'];
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * from icon");
    $stmt->execute();
    $list_icon = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt = $conn->prepare("SELECT id, name from menu_categories");
    $stmt->execute();
    $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //Thêm menu danh mục
    $mess = "";
    //Hiện thị menu danh mục đang sửa
    $menu_id = "";
    if($update == "menu"){
        $stmt = $conn->prepare("SELECT * from menu_categories where id=$id");
        $stmt->execute();
        $menu_update = $stmt->fetch();
    }
    //Hiện danh mục đang sửa
    if($update == "cate"){
        $stmt = $conn->prepare("SELECT
                                    menu_categories.name as 'name_menu', categories.*
                                from categories
                                INNER join menu_categories 
                                on
                                    categories.menu_id=menu_categories.id
                                                where categories.id=$id");
        $stmt->execute();
        $cate_update = $stmt->fetch();
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
    <style>
        tr:nth-child(even) {background-color: #f2f2f2;}
        th{
            background-color: #368CB4;
            color: #fff;
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
                                <h3>Update
                                    <small>Bảng quản trị Shop</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Danh mục</li>
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
                            <?php
                            //Update menu start
                            if($update == "menu"){
                                ?>
                                <div class="card-header">
                                    <h5>Update Menu</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="product-physical">
                                            <table style=" font-size: 16px"  border="">
                                                <tr style="text-align: center; height: 50px;">

                                                    <th width="1%"  style="text-align: center;">Icon</th>
                                                    <th width="20%" style="padding-left: 2%">Tên danh mục</th>
                                                    <th width="15%" style="">Hình ảnh</th>
                                                    <th width="10%">Hiện thị trên Menu</th>
                                                    <th width="10%" style="text-align: center; margin-right: 0">Thao tác</th>
                                                </tr>
                                                <form method="post" enctype="multipart/form-data">
                                                    <td style="text-align: center;">
                                                        <label for="icon-input">
                                                            <img height="45px" src="../images/icons/<?= $menu_update['icon'] ?>" alt="icon">
                                                        </label>
                                                        <input type="file" name="new_icon" id="icon-input" style="display: none;">
                                                    </td>
                                                    <td>
                                                        <input style="border: 0; padding-left: 20px; width: 100%;" type="text" name="name" value="<?= $menu_update['name'] ?>">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <label for="image-input">
                                                            <img height="70px" src="../images/product/menu/<?= $menu_update['image'] ?>" alt="hình ảnh">
                                                        </label>
                                                        <input type="file" name="new" id="image-input" style="display: none;">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php
                                                        if($menu_update['show_menu'] == 1){
                                                            ?>
                                                            <label class="switch">
                                                                <input type="checkbox" name="show_menu" checked >
                                                                <span class="slider round"></span>
                                                            </label>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <label class="switch">
                                                                <input type="checkbox" name="show_menu" >
                                                                <span class="slider round"></span>
                                                            </label>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="btn btn-secondary" type="submit" value="Lưu" name="btn_update">
                                                        <input type="reset" value="Hủy" class="btn btn-secondary">
                                                    </td>
                                                </form>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="" class="product-list digital-product">
                                    </div>
                                </div>
                                <?php
                                //Update menu end
                            }else if($update == "cate"){
                                //Update category start
                                ?>
                                <div class="card-header">
                                    <h5>Update Danh mục</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="product-physical">
                                            <table style=" font-size: 16px;" border="">
                                                <tr style="text-align: center; height: 50px;">

                                                    <th width="4%"  style="text-align: center;">ID</th>
                                                    <th width="10%" style="text-align: center">Tên danh mục</th>
                                                    <th width="15%" style="">Mô tả</th>
                                                    <th width="10%">Menu</th>
                                                    <th width="8%" style="text-align: center; margin-right: 0">Thao tác</th>
                                                </tr>
                                                <form method="post" enctype="multipart/form-data">
                                                    <td style="text-align: center; height: 50px">
                                                        <?= $cate_update['id'] ?>
                                                    </td>
                                                    <td>
                                                        <input style="border: 0; padding-left: 20px; width: 100%;" type="text" name="name" value="<?= $cate_update['name'] ?>">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input style="border: 0; padding-left: 20px; width: 100%;" type="text" name="description" value="<?= $cate_update['description'] ?>">
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <select name="menu_id" id="">
                                                            <?php
                                                            foreach($menu as $m){
                                                                if ($m['id'] == $cate_update['menu_id']) {
                                                                    ?>
                                                                    <option selected value="<?=$m['id']?>"><?= $m['name'] ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?= $m['id']?>"><?= $m['name'] ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <input class="btn btn-secondary" type="submit" value="Lưu" name="btn_update">
                                                        <input type="reset" value="Hủy" class="btn btn-secondary">
                                                    </td>
                                                </form>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="" class="product-list digital-product">
                                    </div>
                                </div>
                                <?php
                                //Update category end
                            }
                            ?>
                            
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
<script src="../assets/js/jsgrid/griddata-productlist-digital.js"></script>
<script src="../assets/js/jsgrid/jsgrid-list.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/product-listdigital.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:30:35 GMT -->
</html>

