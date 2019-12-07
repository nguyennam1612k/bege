<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";

    //select cate
    $sqlCate = "SELECT * from categories";
    $cates = executeQuery($sqlCate, true);
    //action = update
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    //Hiện thị dữ liệu nếu có update
    if($id != null){
        $sqlQuery = "SELECT * from products where id=$id";
        $proUpdate = executeQuery($sqlQuery, false);
    }else{
        $sqlQuery = "SELECT id from products order by rand() limit 1";
        $rand = executeQuery($sqlQuery, false);
        $id = $rand['id'];

        $sqlQuery = "SELECT * from products where id=$id";
        $proUpdate = executeQuery($sqlQuery, false);
    }

    if(isset($_POST['btn_update'])){
        extract($_REQUEST);
        $especially = 1;

        //check ảnh
        if($_FILES['new_feature']['name'] == ""){
            $feature_image = $proUpdate['feature_image'];
        }else{
            $feature_image = 'images/products/'.$_FILES['new_feature']['name'];
            move_uploaded_file($_FILES['new_feature']['tmp_name'],'../'. $feature_image);
        }

        // dd($feature_image);

        if($price > $sale_price){
            $sqlUpdate =    "UPDATE products set
                                name='$name',
                                price=$price,
                                sale_price=$sale_price,
                                feature_image='$feature_image',
                                detail='$detail',
                                especially=$especially,
                                parameter='$parameter',
                                quantum=$quantum,
                                cate_id=$cate_id
                            where
                                id=$id";
            executeQuery($sqlUpdate);
            // dd($sqlUpdate);
            // header('location: '. $_SERVER['HTTP_REFRESH']);
        }else{
            echo "<script>alert('Giảm giá không được lớn hơn giá mặc định')</script>";
        }
    }
// dd($sqlUpdate);
    // dd($proUpdate);
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/add-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:30:28 GMT -->
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

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'.textarea1'});</script>
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
                                <h3>Update Product
                                    <small>Bản quản trị Shop</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Product</li>
                                <li class="breadcrumb-item active">Update Product</li>
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
                                <h5>Update Product</h5>
                            </div>
                            <div class="card-body">
                                <div class="row product-adding">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="col-xl-5">
                                        <div class="add-product">
                                            <div class="row"  style="width: 1200px">
                                                <div class="col-xl-9 xl-50 col-sm-6 col-9">
                                                    <img src="../<?php echo $proUpdate['feature_image'] ?>" alt="" class="img-fluid image_zoom_1 blur-up lazyloaded">
                                                </div>
                                                <div class="col-xl-3 xl-50 col-sm-6 col-3">
                                                    <!-- <form enctype="multipart/form-data"> -->
                                                        <ul class="file-upload-product">
                                                            <li><div class="box-input-file"><input class="upload" type="file" name="new_feature"><i style="color: red" class="fa fa-plus"></i></div></li>
                                                            <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                            <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                            <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                            <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                            <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                        </ul>
                                                    <!-- </form> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7">
                                        <!-- <form class="needs-validation add-product-form" method="post" enctype="multipart/form-data"> -->
                                            <!-- <div class="col-xl-5" style="float: left;">
                                                <div class="add-product">
                                                    <div class="row">
                                                        <div class="col-xl-3 xl-50 col-sm-6 col-3">
                                                            <ul class="file-upload-product">
                                                                <li><div class="box-input-file"><input class="upload" type="file" name="new_feature"><i style="color: red" class="fa fa-plus"></i></div></li>
                                                                <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                                <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                                <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                                <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                                <li><div class="box-input-file"><input class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="form">
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Name :</label>
                                                    <input class="form-control col-xl-8 col-sm-7" id="validationCustom01" type="text" required="" name="name" value="<?php echo $proUpdate['name'] ?>">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Price :</label>
                                                    <input class="form-control col-xl-8 col-sm-7" id="validationCustom02" type="text" required="" name="price" value="<?php echo $proUpdate['price'] ?>">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Sale price :</label>
                                                    <input class="form-control col-xl-8 col-sm-7" id="validationCustom02" type="text" required="" name="sale_price" value="<?php echo $proUpdate['sale_price'] ?>">
                                                    <div class="valid-feedback">Looks good!</div>
                                                </div>
                                            </div>
                                            <div class="form">
                                                <div class="form-group row">
                                                    <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Select Cate :</label>
                                                    <select class="form-control digits col-xl-8 col-sm-7" id="exampleFormControlSelect1" name="cate_id">
                                                        <?php foreach ($cates as $value): ?>
                                                            <option value="<?php echo $value['id'] ?>"><?php echo $value['title'] ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-sm-4 mb-0">Total Products :</label>
                                                    <fieldset class="qty-box col-xl-9 col-xl-8 col-sm-7 pl-0">
                                                        <div class="input-group" style="margin-left: 0">
                                                            <input class="touchspin" type="text" name="quantum" value="<?php echo $proUpdate['quantum'] ?>">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="form-group row" style="margin-top: 30px">
                                                    <label class="col-xl-3 col-sm-4">Description :</label>
                                                    <div class="col-xl-8 col-sm-7 pl-0 description-sm">
                                                        <textarea name="detail" class="textarea1" rows="4">
                                                            <?php echo $proUpdate['detail'] ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-sm-4" style="margin-top: 30px">Parameter :</label>
                                                    <div class="col-xl-8 col-sm-7 pl-0 description-sm">
                                                        <textarea name="parameter" class="textarea1" rows="4"><?php echo $proUpdate['parameter'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-xl-3 offset-sm-4">
                                                <button type="submit" class="btn btn-primary" name="btn_update">Update</button>
                                                <button type="button" class="btn btn-light">Discard</button>
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </form>
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

<!-- touchspin js-->
<script src="../assets/js/touchspin/vendors.min.js"></script>
<script src="../assets/js/touchspin/touchspin.js"></script>
<script src="../assets/js/touchspin/input-groups.min.js"></script>

<!-- form validation js-->
<script src="../assets/js/dashboard/form-validation-custom.js"></script>

<!-- ckeditor js-->
<script src="../assets/js/editor/ckeditor/ckeditor.js"></script>
<script src="../assets/js/editor/ckeditor/styles.js"></script>
<script src="../assets/js/editor/ckeditor/adapters/jquery.js"></script>
<script src="../assets/js/editor/ckeditor/ckeditor.custom.js"></script>

<!-- Zoom js-->
<script src="../assets/js/jquery.elevatezoom.js"></script>
<script src="../assets/js/zoom-scripts.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/add-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:30:33 GMT -->
</html>
