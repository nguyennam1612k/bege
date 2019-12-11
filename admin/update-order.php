<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";
    
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if($id == null){//Chuyển trang nếu không có id
        header('location: order.php');
    }

    //Hiện thị dữ liệu
    $sqlShow = "SELECT * from orders where id=$id";
    $show = executeQuery($sqlShow, false);

    //Thực hiện update status
    if(isset($_POST['btn_update'])){
        $status = $_POST['status'];
        $sqlUpdate = "UPDATE orders set status='$status' where id=$id";
        executeQuery($sqlUpdate);
        // dd($sqlUpdate);
        header('location: order.php');
        die;
    }
    
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
                                <h3>Add Products
                                    <small>Bigdeal Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Physical</li>
                                <li class="breadcrumb-item active">Add Product</li>
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
                                <!-- <form method="post" enctype="multipart/form-data"> -->
                                    <div class="col-xl-5">
                                        <div class="add-product">
                                            <div class="row"  style="width: 1200px; margin-bottom: 100px">
                                                <!-- <div class="col-xl-9 xl-50 col-sm-12 col-9"> -->
                                                    <?php
                                                    $order_id = $show['id'];
                                                    $sqlQuery = "SELECT image from order_detail where order_id=$order_id";
                                                    $imageOrder = executeQuery($sqlQuery, true);
                                                    ?>
                                                    <?php foreach ($imageOrder as $value): ?>
                                                        <img style="max-width: 200px; margin-left: 20px; float: left" src="../<?php echo $value['image'] ?>" alt="" class="img-fluid image_zoom_1 blur-up lazyloaded">
                                                    <?php endforeach ?>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7">
                                            <div class="form">
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Mã hóa đơn :</label>
                                                    <p><?php echo $show['code'] ?></p>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Họ tên :</label>
                                                    <p><?php echo $show['name'] ?></p>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Phương thức thanh toán :</label>
                                                    <p><?php echo $show['payment_method'] ?></p>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Thời gian đặt hàng :</label>
                                                    <p><?php echo $show['created_date'] ?></p>
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Tổng tiền :</label>
                                                    <p><?php echo number_format($show['total_price'], 0, '', ',') ?> vnđ</p>
                                                </div>
                                            </div>
                                            <div class="form">
                                                <div class="form-group row">
                                                    <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Status :</label>
                                                    <form method="post">
                                                        <select class="form-control digits col-xl-8 col-sm-7" id="exampleFormControlSelect1" name="status">
                                                            <option value="2 - đang vận chuyển">Đang vận chuyển</option>
                                                            <option value="3 - đã giao hàng">Đã giao hàng</option>
                                                            <option value="0 - đã hủy">Hủy đơn hàng</option>
                                                        </select>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="offset-xl-3 offset-sm-4">
                                                <button type="submit" class="btn btn-primary" name="btn_update">Update</button>
                                                <button type="button" class="btn btn-light" onclick="javascript:history.go(-1)">Discard</button>
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                <!-- </form> -->
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
<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});
</script>
</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/add-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:30:33 GMT -->
</html>
