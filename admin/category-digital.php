<?php require_once "../connection.php";
$mess = "";
    //select icon
    $stmt = $conn->prepare("SELECT * from icons_extra");
    $stmt->execute();
    $list_icon = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //select menu
    $stmt = $conn->prepare("SELECT id, name from menu_categories");
    $stmt->execute();
    $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //Hiện thị tất cả cate
    $select =   "SELECT
                    menu_categories.name as 'name_menu', categories.*
                from categories
                INNER join menu_categories 
                on
                    categories.menu_id=menu_categories.id";
    $stmt = $conn->prepare($select);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //Hiện thị cate theo id
    if(isset($_GET['menu_id'])){
        $id = $_GET['menu_id'];
        $select_single = "SELECT
                            menu_categories.name as 'name_menu', categories.*
                        from categories
                        INNER join menu_categories 
                        on
                            categories.menu_id=menu_categories.id
                        where menu_id=$id";
        $stmt = $conn->prepare($select_single);
        $stmt->execute();
        $cate_single = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //action & id
    $action = "";
    $id = "";
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        $id = $_GET['id'];
    }
    //Hiện danh mục đang sửa
    if($action == "update"){
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
    //update danh mục
    if(isset($_POST['btn_update']) && $action == "update"){
        extract($_REQUEST);
        //check
        
        if(empty($name)){
            // $mess = "Thiếu tên menu";
            echo "<script>alert('Thiếu tên danh mục')</script>";
        }else{
            //Sql create
            $update = "UPDATE categories 
                        set name='$name', description='$description', menu_id=$menu_id
                        where id=$id";
            $stmt = $conn->prepare($update);
            $stmt->execute();
            //Check
            if($stmt->rowCount() > 0){
                //Chuyển trang
                header('location: category-digital.php');
            }else{
                echo "<script>alert('Không thay đổi')</script>";
            }
        }
    }
    //Delete danh mục
    if($action == "delete"){
        $delete = "DELETE FROM categories WHERE id=$id";
        $stmt = $conn->prepare($delete);
        $stmt->execute();
        //Kiểm tra nếu xóa thành công thì chuyển trang view
        if($stmt->rowCount() >0){
            header('location: category-digital.php');
        }else{
            echo "<script>alert('Không thể xóa Danh mục')</script>";
        }
    }
    //Thêm danh mục
    if(isset($_POST['btn_create'])){
        extract($_REQUEST);
        if(empty($description)){
            $description = "";
        }
        $insert =   "INSERT into categories
                        (name, description, menu_id)
                    values
                        ('$name', '$description', $menu_id)";
        $stmt = $conn->prepare($insert);
        $stmt->execute();
        //Kiểm tra
        if($stmt->rowCount() >0){
            //làm mới trang
            echo "<meta http-equiv='refresh' content='0'>";
        }else{
            echo "<script>alert('Không thể thêm Danh mục')</script>";
        }
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
                                <h3>Danh mục
                                    <small>Bảng quản trị Shop</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Danh mục</li>
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
                            <?php
                            if($action == "update"){
                                ?>
                                <div class="card-header">
                                    <h5>Cập nhật danh mục</h5>
                                </div>
                                <?php
                            }else{
                                ?>
                                <div class="card-header">
                                    <h5>Danh sách danh mục</h5>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="card-body">
                                
                                <!-- Hộp thoại thêm danh mục -->
                                <div class="btn-popup pull-right">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Thêm danh mục</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Thêm danh mục</h5>
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
                                                                <label for="validationCustom01" class="mb-1">Menu :</label>

                                                                <select required="" name="menu_id" id="icon" class="custom-select">
                                                                    <option value="">-- Select --</option>
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
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Mô tả :</label>
                                                                <textarea name="description" id="" cols="66" rows="6"></textarea>
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
                            <!-- Hiện thị dữ liệu category -->
                                <div class="table-responsive">
                                    <div class="product-physical">
                                        <table style=" font-size: 16px" border="">
                                            <tr style=" height: 50px;">
                                                
                                                <th width="4%"  style="text-align: center;">ID</th>
                                                <th width="10%" style="text-align: center;">Tên danh mục</th>
                                                <th width="15%" style="text-align: center;">Mô tả</th>
                                                <th width="10%" style="text-align: center;">Danh mục cha</th>
                                                <th width="6%" style="text-align: center;">Thao tác</th>
                                            </tr>
                                            <?php
                                             //đổ dữ liệu ra
                                            if(isset($_GET['menu_id'])){
                                                foreach($cate_single as $single){
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: center; height: 50px"><?= $single['id'] ?></td>
                                                        <td style="padding: 0 2%"><?= $single['name'] ?></td>
                                                         <td style="padding: 0 2%"><?= $single['description'] ?></td>
                                                        <td style="padding: 0 2%"><?= $single['name_menu'] ?></td>
                                                        <td class="action" style="text-align: center; ">
                                                            <a href="?action=update&id=<?= $single['id'] ?>"><i class="far fa-edit"></i></a>
                                                            &#160;&#160;
                                                            <a  href="?action=delete&id=<?= $single['id'] ?>" OnClick="return confirm('Xóa Danh mục này ?');"><i class="far fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }else if($action == "update"){
                                                ?>
                                                <tr>
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
                                                        <input class="hihi" type="submit" value="Lưu" name="btn_update">
                                                        <INPUT class="hihi" type="button" value="Hủy" onClick="history.go(-1);">
                                                    </td>
                                                </form>
                                                </tr>
                                                <?php
                                            }else{
                                                foreach($categories as $row){
                                                    ?>
                                                    <tr>
                                                        <td style="text-align: center; height: 60px"><?= $row['id'] ?></td>
                                                        <td style="padding: 0 2%"><?= $row['name'] ?></td>
                                                        <td style="padding: 0 2%"><?= $row['description'] ?></td>
                                                        <td style="padding: 0 2%"><?= $row['name_menu'] ?></td>
                                                        <td class="action" style="text-align: center; ">
                                                            <a href="?action=update&id=<?= $row['id'] ?>"><i class="far fa-edit"></i></a>
                                                            &#160;&#160;
                                                            <a  href="?action=delete&id=<?= $row['id'] ?>" OnClick="return confirm('Xóa Danh mục này ?');"><i class="far fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                <!-- Hiện thị dữ liệu category end -->
                                
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

<!-- Jsgrid js-->
<script src="../assets/js/jsgrid/jsgrid.min.js"></script>
<script src="../assets/js/jsgrid/griddata-digital.js"></script>
<script src="../assets/js/jsgrid/jsgrid-manage-product.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/category-digital.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:30:33 GMT -->
</html>
