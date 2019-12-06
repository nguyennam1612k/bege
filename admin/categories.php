<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";
    $mess = "";

    $select = "SELECT * from categories";
    $menu = executeQuery($select, true);

    //get id
    $id = isset($_GET['id']) ? $_GET['id']: null;
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    //Hiện thị dữ liệu update
    if($action == "update"){
        $showUpdate = "SELECT * from categories where id=$id";
        $cate_update = executeQuery($showUpdate, false);
    }
    // dd($cate_update);
    //Thêm menu danh mục
    if(isset($_POST['btn_create'])){
        extract($_REQUEST);
        //check
        
        if(empty($name)){
            $mess = "Thiếu tên menu";
        }else if($icon == ""){
            $mess = "Thiếu Icon";   
        }else if($_FILES['anh']['name'] == ""){
            $mess = "Thiếu ảnh menu";
        }else{
            $image = "images/product/menu/".$_FILES['anh']['name'];

            if(isset($_POST['show_menu'])){
                $show_menu = 1;
            }else{
                $show_menu = 0;
            }

            //Sql create
            $create = "INSERT into categories
                            (title, icon, image, show_menu)
                        values
                            ('$name', '$icon', '$image', $show_menu)";
            executeQuery($create);

            //Lưu ảnh vào thư mục menu
            move_uploaded_file($_FILES['anh']['tmp_name'], "../images/product/menu/".$anh);
            header("Refresh:0");
            
        }
    }
    //update menu danh mục
    if(isset($_POST['btn_update']) && $action == "update"){
        extract($_REQUEST);
        //ảnh cũ
        if($_FILES['new']['name'] == ""){
            $image = $cate_update['image'];
        }else{
            $image = "images/product/menu/".$_FILES['new']['name'];
        }
        //icon cũ
        if(empty($new_icon)){
            $icon = $cate_update['icon'];
        }else{
            $icon = $_FILES['new_icon']['name'];
        }
        //check
        
        if(empty($name)){
            // $mess = "Thiếu tên menu";
            echo "<script>alert('Thiếu tên menu')</script>";
        }else{

            if(isset($_POST['show_menu'])){
                $show_menu = 1;
            }else{
                $show_menu = 0;
            }
            //Sql create
            $update = "UPDATE categories 
                        set title='$name', icon='$icon', image='$image', show_menu=$show_menu
                        where id=$id";
            executeQuery($update);
            // dd($update);
            //Chuyển trang
                //Lưu ảnh vào thư mục menu
            if($_FILES['new']['name'] != ""){
                move_uploaded_file($_FILES['new']['tmp_name'], "../images/product/menu/".$new);
            }
            header('location: '. BASE_URL . 'admin/categories.php');
            
        }
    }
    //Xóa danh mục menu
    if($action == "delete"){
        $delete = "DELETE FROM categories WHERE id=$id";
        executeQuery($delete);
        header("Refresh:0");
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
    <title>Bigdeal - Menu Danh mục</title>

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
                                <h3>Menu Danh mục
                                    <small>Bảng quản trị Shop</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Danh mục</li>
                                <li class="breadcrumb-item active">Menu</li>
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
                            if($action == "update"){
                                ?>
                                <div class="card-header">
                                    <h5>Cập nhật Menu</h5>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="card-header">
                                    <h5>Danh sách Menu</h5>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="card-body">
                                
                                <!-- Hộp thoại thêm danh mục -->
                                <div class="btn-popup pull-right">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Thêm Menu</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Thêm Menu danh mục</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="needs-validation" method="post"  enctype="multipart/form-data">
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Tên danh mục :</label>
                                                                <input required="" class="form-control" name="name" id="validationCustom01" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Icon :</label>

                                                                <select required="" name="icon" id="icon" class="custom-select">
                                                                    <option value="">-- Select --</option>
                                                                <?php
                                                                foreach($list_icon as $ic){
                                                                    ?>
                                                                    <option value="<?=$ic['image']?>"><?=$ic['name']?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Trạng thái :</label>
                                                                <label class="switch">
                                                                  <input type="checkbox" name="show_menu" checked >
                                                                  <span class="slider round"></span>
                                                              </label>
                                                          </div>
                                                          <div class="form-group mb-0">
                                                            <label for="validationCustom02" class="mb-1">Ảnh danh mục :</label> <span style="font-size: 11px; color: blue">240x240</span>
                                                            <input required="" class="form-control" name="anh" id="validationCustom02" type="file">

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div style="color: red; margin-right: 150px">
                                                            <?= $mess?>
                                                        </div>
                                                        <button class="btn btn-primary" name="btn_create" type="submit">Thêm</button>
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hộp thoại thêm danh mục End -->
                                <div class="table-responsive">
                                    <div class="product-physical jsgrid" style="position: relative; height: auto; width: 100%;">
                                        <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                            <table class="jsgrid-table">
                                                <tr>
                                                    <th style="width: 50px;text-align: center;height: 45px">Icon</th>
                                                    <th style="width: 100px;text-align: center;">Tên danh mục</th>
                                                    <th style="width: 50px;text-align: center;">Hình ảnh</th>
                                                    <th style="width: 50px;text-align: center;">Trạng thái</th>
                                                    <th style="width: 50px;text-align: center">Thao tác</th>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="jsgrid-grid-body">
                                            <table class="jsgrid-table">
                                                <tbody>
                                                    <?php 
                                                    //Đổ dữ liệu ra
                                                    if($action == "update"){
                                                    ?>
                                                    <form method="post" enctype="multipart/form-data">
                                                       <tr class="jsgrid-row">
                                                            <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">
                                                                <label for="icon-input">
                                                                    <img  class="blur-up lazyloaded" src="../<?= $cate_update['icon'] ?>" alt="icon">
                                                                </label>
                                                                <input type="file" name="new_icon" id="icon-input" style="display: none;">
                                                            </td>
                                                            <td class="jsgrid-cell" style="width: 100px;">
                                                                <input style="border: 0; padding-left: 20px; width: 100%;" type="text" name="name" value="<?= $cate_update['title'] ?>">
                                                            </td>
                                                            <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">
                                                                <label for="image-input">
                                                                    <img class="blur-up lazyloaded" height="70px" src="../<?= $cate_update['image'] ?>" alt="hình ảnh">
                                                                </label>
                                                                <input type="file" name="new" id="image-input" style="display: none;">
                                                            </td>
                                                            <td class="jsgrid-cell" style="width: 50px;">
                                                                <?php
                                                                if($cate_update['show_menu'] == 1){
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
                                                            
                                                            <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                                                <button name="btn_update" class="jsgrid-button jsgrid-update-button" type="submit" title="Update"></button>
                                                                <input onClick="history.go(-1);" class="jsgrid-button jsgrid-cancel-edit-button" type="button" title="Cancel edit">
                                                            </td>
                                                        </tr>
                                                    </form>
                                                    <?php
                                                    }else{
                                                        foreach($menu as $row){
                                                            ?>
                                                            <tr class="jsgrid-row">
                                                                <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">
                                                                        <img  class="blur-up lazyloaded" src="../<?= $row['icon'] ?>" alt="icon">
                                                                </td>
                                                                <td class="jsgrid-cell" style="width: 100px;">
                                                                    <?= $row['title']?>
                                                                </td>
                                                                <td class="jsgrid-cell jsgrid-align-center" style="width: 50px;">
                                                                        <img class="blur-up lazyloaded" height="70px" src="../<?= $row['image'] ?>" alt="hình ảnh">
                                                                </td>
                                                                <td class="jsgrid-cell" style="width: 50px;">
                                                                    <?php
                                                                    if($row['show_menu'] == 1){
                                                                        ?>
                                                                        <i class="fa fa-circle font-success f-12"></i>
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                        <i class="fa fa-circle font-danger f-12"></i>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                </td>

                                                                <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
                                                                    

                                                                    <a href="?action=update&id=<?= $row['id'] ?>"><input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit"></a>
                                                                    &#160;&#160;
                                                                    <a href="?action=delete&id=<?= $row['id'] ?>" OnClick="return confirm('Xóa Danh mục này ?');"><input class="jsgrid-button jsgrid-delete-button" type="button" title="Delete"></a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        } 
                                                    }
                                                    ?>       
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- <div class="jsgrid-pager-container" style="display: none;"><div class="jsgrid-pager">Pages: <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button"><a href="javascript:void(0);">First</a></span> <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button"><a href="javascript:void(0);">Prev</a></span> <span class="jsgrid-pager-page jsgrid-pager-current-page">1</span> <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button"><a href="javascript:void(0);">Next</a></span> <span class="jsgrid-pager-nav-button jsgrid-pager-nav-inactive-button"><a href="javascript:void(0);">Last</a></span> &nbsp;&nbsp; 1 of 1 </div></div> -->
                                        <!-- <div class="jsgrid-load-shader" style="display: none; position: absolute; top: 0px; right: 0px; bottom: 0px; left: 0px; z-index: 1000;"></div> -->
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
