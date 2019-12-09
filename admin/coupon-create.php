<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";
    require_once '../libs/Faker/autoload.php';
    $faker = Faker\Factory::create('vi_VN');

    if(isset($_POST['btn_create'])){
        extract($_REQUEST);
        if($code == ""){
            $code = strtoupper(uniqid());
        }else if(strtotime($start_time) <= strtotime($end_time)){
            echo "<script>alert('Thời bắt đầu nhỏ hơn thời gian kết thúc')</script>";
        }else{
            //Kiểm tra code tồn tại không
            $sqlQuery = "SELECT * from vouchers where code='$code'";
            $check = executeQuery($sqlQuery, false);
            if($check != null){
                echo "<script>alert('Mã voucher đã tồn tại')</script>";
            }else{
                if(empty($active)){
                    $active = 0;
                }
                $sqlInsert = "INSERT into vouchers
                                (title, code, start_time, end_time, discount, user_count, active)
                            values
                                ('$title', '$code', '$start_time', '$end_time', $discount, $user_count, $active)";
                executeQuery($sqlInsert);
                dd($sqlInsert);
                // header('location: coupon-list.php');
                // die;
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/coupon-create.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:03 GMT -->
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

    <!-- Ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/flag-icon.css">

    <!-- Datepicker css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

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
                                <h3>Create Coupon
                                    <small>Bigdeal Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Coupons </li>
                                <li class="breadcrumb-item active">Create Coupon</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="card tab2-card">
                    <div class="card-header">
                        <h5>Discount Coupon Details</h5>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active show" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">General</a></li>
                            <li class="nav-item"><a class="nav-link" id="restriction-tabs" data-toggle="tab" href="#restriction" role="tab" aria-controls="restriction" aria-selected="false" data-original-title="" title="">Restriction</a></li>
                            <li class="nav-item"><a class="nav-link" id="usage-tab" data-toggle="tab" href="#usage" role="tab" aria-controls="usage" aria-selected="false" data-original-title="" title="">Usage</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <form class="needs-validation" novalidate="" method="post">
                                    <h4>General</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span> Voucher Title</label>
                                                <input class="form-control col-md-7" id="validationCustom0" type="text" required="" name="title">
                                            </div>
                                            <div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>Voucher Code</label>
                                                <input class="form-control col-md-7" id="validationCustom1" type="text" required="" name="code" >
                                                <div class="valid-feedback">Please Provide a Valid Coupon Code.</div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-md-4">Start Date</label>
                                                <input class="datepicker-here form-control digits col-md-7" type="text" data-language="en" name="start_time">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-md-4">End Date</label>
                                                <input class="datepicker-here form-control digits col-md-7" type="text" data-language="en" name="end_time">
                                            </div>  
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-md-4">Quantity</label>
                                                <input class="form-control col-md-7" name="used_count" type="number" required="">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-md-4">Discount Type</label>
                                                <input class="form-control col-md-7" name="discount" type="number" required="">
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-md-4">Status</label>
                                                <div class="checkbox checkbox-primary col-md-7">
                                                    <input id="checkbox-primary-2" name="status" value="1" type="checkbox" data-original-title="" title="">
                                                    <label for="checkbox-primary-2">Enable the Coupon</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" name="btn_create">Save</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="restriction" role="tabpanel" aria-labelledby="restriction-tabs">
                                <form class="needs-validation" novalidate="">
                                    <h4>Restriction</h4>
                                    <div class="form-group row">
                                        <label for="validationCustom3" class="col-xl-3 col-md-4">Products</label>
                                        <input class="form-control col-md-7" id="validationCustom3" type="text" required="" >
                                        <div class="valid-feedback">Please Provide a Product Name.</div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">Category</label>
                                        <select class="custom-select col-md-7" required="">
                                            <option value="">--Select--</option>
                                            <option value="1">Electronics</option>
                                            <option value="2">Clothes</option>
                                            <option value="2">Shoes</option>
                                            <option value="2">Digital</option>
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label for="validationCustom4" class="col-xl-3 col-md-4">Minimum Spend</label>
                                        <input class="form-control col-md-7" id="validationCustom4" type="number" >
                                    </div>
                                    <div class="form-group row">
                                        <label for="validationCustom5" class="col-xl-3 col-md-4">Maximum Spend</label>
                                        <input class="form-control col-md-7" id="validationCustom5" type="number" >
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="usage" role="tabpanel" aria-labelledby="usage-tab">
                                <form class="needs-validation" novalidate="">
                                    <h4>Usage Limits</h4>
                                    <div class="form-group row">
                                        <label for="validationCustom6" class="col-xl-3 col-md-4">Per Limit</label>
                                        <input class="form-control col-md-7" id="validationCustom6" type="number" >
                                    </div>
                                    <div class="form-group row">
                                        <label for="validationCustom7" class="col-xl-3 col-md-4">Per Customer</label>
                                        <input class="form-control col-md-7" id="validationCustom7" type="number" >
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="pull-right">
                            
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

<!--Datepicker jquery-->
<script src="../assets/js/datepicker/datepicker.js"></script>
<script src="../assets/js/datepicker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/datepicker.custom.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/coupon-create.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:03 GMT -->
</html>
