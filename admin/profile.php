<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";


    if(isset($_POST['btn_update'])){
        // echo "<script>alert('Lỗi cái đjt mẹ mày')</script>";
        $user_id = $user['id'];
        extract($_REQUEST);
        //Kiểm tra mật khẩu trên database
        $sqlQuery = "SELECT password from users where id=$user_id";
        $check = executeQuery($sqlQuery, false);
        $password_data = $check['password'];

        if(password_verify($password, $password_data)){
            $sqlProfile = "UPDATE users set
                            name='$name', phone_number='$phone_number', email='$email', address='$address' where id=$user_id";
            executeQuery($sqlProfile);
            echo "<script>alert('Cập nhật thành công, vui lòng đăng nhập lại')</script>";
        }else{
            echo "<script>alert('Sai mật khẩu hoặc xác thực')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:13 GMT -->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bigdeal admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Bigdeal admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <title>Quản trị - Thông tin tài khoản</title>

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
                                <h3>Thông tin tài khoản
                                    <small>Bảng quản trị Shop</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Cài đặt</li>
                                <li class="breadcrumb-item active">Tài khoản</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-details text-center">
                                    <img src="../<?= $user['avatar']?>" alt="" class="img-fluid img-90 rounded-circle blur-up lazyloaded">
                                    <h5 class="f-w-600 mb-0"><?php echo $user['name'] ?></h5>
                                    <span><?php echo $user['email'] ?></span>
                                    <div class="social">
                                        <div class="form-group btn-showcase">
                                            <button class="btn social-btn btn-fb d-inline-block"> <i class="fa fa-facebook"></i></button>
                                            <button class="btn social-btn btn-twitter d-inline-block"><i class="fa fa-google"></i></button>
                                            <button class="btn social-btn btn-google d-inline-block mr-0"><i class="fa fa-twitter"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="project-status">
                                    <h5 class="f-w-600"></h5>
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Hiệu suất<span class="pull-right">80%</span></h6>
                                            <div class="progress sm-progress-bar">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: 80%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Tăng ca<span class="pull-right">60%</span></h6>
                                            <div class="progress sm-progress-bar">
                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="media-body">
                                            <h6>Leaves taken<span class="pull-right">70%</span></h6>
                                            <div class="progress sm-progress-bar">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 70%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card tab2-card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-profile-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><i data-feather="user" class="mr-2"></i>Hồ sơ</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><i data-feather="settings" class="mr-2"></i>Cài đặt</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab">
                                        <h5 class="f-w-600">Hồ sơ</h5>
                                        <div class="table-responsive profile-table">
                                            <table class="table table-responsive">
                                                <tbody>
                                                <tr>
                                                    <td>Họ tên:</td>
                                                    <td><?php echo $user['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email:</td>
                                                    <td>
                                                        <?php
                                                        if($user['email'] == ""){
                                                            echo "Địa chỉ email trống";
                                                        }else{
                                                            echo $user['email'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Vai trò:</td>
                                                    <td>
                                                        <?php
                                                        if($user['role'] == 1  && $user['username'] == "admin"){
                                                            echo "Quản trị Cao cấp";
                                                        }else{
                                                            echo "Quản trị viên";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Số điện thoại:</td>
                                                    <td>
                                                        <?php
                                                        if($user['phone_number'] == ""){
                                                            echo "Số điện thoại trống";
                                                        }else{
                                                            echo $user['phone_number'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Điểm:</td>
                                                    <td>
                                                        <?php echo $user['points']. " điểm"?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Địa chỉ:</td>
                                                    <td>
                                                        <?php
                                                        if($user['address'] == ""){
                                                            echo "Địa chỉ trống";
                                                        }else{
                                                            echo $user['address'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                        <form method="post">
                                            <div class="account-setting deactivate-account">
                                                <h5 class="f-w-600">Cập nhật thông tin tài khoản</h5>
                                                <div class="form-group row">
                                                    <label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span> Name</label>
                                                    <input class="form-control col-xl-8 col-md-7" id="validationCustom0" type="text" required="" name="name" value="<?php echo $user['name'] ?>">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span> Phone number</label>
                                                    <input class="form-control col-xl-8 col-md-7" id="validationCustom1" type="number" required="" name="phone" value="<?php echo $user['phone_number'] ?>">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="validationCustom2" class="col-xl-3 col-md-4"><span>*</span> Email</label>
                                                    <input class="form-control col-xl-8 col-md-7" id="validationCustom2" type="text" required="" name="email" value="<?php echo $user['email'] ?>">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="validationCustom2" class="col-xl-3 col-md-4"><span>*</span> Address</label>
                                                    <input class="form-control col-xl-8 col-md-7" id="validationCustom2" type="text" required="" name="address" value="<?php echo $user['address'] ?>">
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <label for="validationCustom3" class="col-xl-3 col-md-4"><span>*</span> Password</label>
                                                    <input class="form-control col-xl-8 col-md-7" id="validationCustom3" type="password" required="" name="password">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="validationCustom4" class="col-xl-3 col-md-4"><span>*</span> Confirm Password</label>
                                                    <input class="form-control col-xl-8 col-md-7" id="validationCustom4" type="password" required="" name="password_confirm">
                                                </div>
                                                <button name="btn_status" type="submit" class="btn btn-primary" name="btn_update">Lưu</button>
                                            </div>
                                        </form>
                                    </div>
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

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:13 GMT -->
</html>
