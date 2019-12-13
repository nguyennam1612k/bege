<?php
    require_once "../commons/db.php";
    require_once "../commons/constants.php";
    require_once "../commons/helpers.php";

    //action & id
    $action = isset($_GET['action']) ? $_GET['action'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;

     //Hiện thị danh sách slide
    $sqlQuery = "SELECT * from slides";
    $slides = executeQuery($sqlQuery, true);
    // dd($slides);
    //Thực hiện tạo slide
    if(isset($_POST['btn_create'])){
        extract($_REQUEST);
        if(empty($status)){
            $status = 0;
        }
        $image = "images/slider/".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'../'. $image);
        //Viết câu lệnh sql insert
        $sqlInsert = "  INSERT into slides
                            (title, content, image, url, sort_order, status)
                        values
                            ('$title', '$content', '$image', '$url', $sort_order, $status)";
        executeQuery($sqlInsert);
        header('Refresh: 0');
        // dd($sqlInsert);
    }

    //nếu action = update
    if($action == "update" && $id != null){
        $sqlQuery = "SELECT * from slides where id=$id";
        $show = executeQuery($sqlQuery, false);
    }

    //thực hiện update slide
    if(isset($_POST['btn_update'])){
        extract($_REQUEST);
        if(empty($status)){
            $status = 0;
        }

        if($_FILES['new_image']['name'] == ""){
            $image = $show['image'];
        }else{
            $image = "images/slider/".$_FILES['new_image']['name'];
            move_uploaded_file($_FILES['new_image']['tmp_name'],'../'. $image);
        }
        //Viết câu lệnh sql update
        $sqlUpdate = "  UPDATE slides set
                            title='$title',
                            content='$content',
                            image='$image',
                            url='$url',
                            sort_order=$sort_order,
                            status=$status
                        where id=$id";
        executeQuery($sqlUpdate);
        header('location: slide.php');
        // dd($sqlUpdate);
    }

    //nếu action = delete
    if($action == "delete" && $id != null){
        $sqlDelete = "DELETE from slides where id=$id";
        executeQuery($sqlDelete);
        header('location: slide.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/order.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:30:41 GMT -->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bigdeal admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Bigdeal admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="http://themes.pixelstrap.com/bigdeal/assets/images/favicon/favicon.ico" type="image/x-icon">
    <title>Quản trị - Slides</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/flag-icon.css">

    <!-- Datatables css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
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
                                <h3>Slide
                                    <small>Bảng quản trị Shop</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="<?php echo BASE_URL.'admin/' ?>"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item">Slide</li>
                                <li class="breadcrumb-item active">Quản trị</li>
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
                                <h5>Danh sách Slide</h5>
                            </div>
                            <div class="card-body order-datatable">
                                <table class="display" id="basic-1">
                                    <thead>
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Giảm giá</th>
                                        <th>Trạng thái</th>
                                        <th>Xử lý</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($slides as $value): ?>
                                            <tr>
                                                <td><?php echo $value['title'] ?></td>
                                                <td><span><?php echo $value['content'] ?></span></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="../<?php echo $value['image'] ?>" alt="" class="img-fluid img-90 mr-2 blur-up lazyloaded">
                                                    </div>
                                                </td>
                                                <td><?php echo $value['url'] ?></td>
                                                <td><?php echo $value['sort_order'] ?></td>
                                                <?php
                                                if( $value['status'] == 1){
                                                    $classStatus = "badge badge-warning";
                                                    $nameStatus = "Hiện thị";
                                                }else{
                                                    $classStatus = "badge badge-danger";
                                                    $nameStatus = "Tắt";
                                                }
                                                ?>
                                                <td><span class="<?php echo $classStatus ?>"><?php echo $nameStatus ?></span></td>
                                                <td style="text-align: center;">
                                                    <a href="?action=update&id=<?php echo $value['id'] ?>">
                                                    <i class="fas fa-pen-square" title="update"></i>
                                                    </a>
                                                    <a onclick="return confirm('Bạn chắc chứ ?')" href="?action=delete&id=<?php echo $value['id'] ?>">
                                                    <i class="far fa-trash-alt" title="delete"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
            <?php if ($action != "update"): ?>
                <div class="card ">
                    <div class="card-header">
                        <h5>Thêm Slide</h5>
                    </div>
                    <div class="card-body">
                        <form class="dropzone digits" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label for="validationCustom0" class="col-xl-3 col-md-4">Tiêu đề</label>
                                        <input class="form-control col-md-7" placeholder="Tiều đề được ngăn thành 3 dòng với dấu '/'" id="validationCustom0" type="text" required="" name="title">
                                    </div>
                                    <div class="form-group row">
                                        <label for="validationCustom1" class="col-xl-3 col-md-4">Nội dung</label>
                                        <input class="form-control col-md-7" id="validationCustom1" type="text" placeholder="Nội dung" required="" name="content" >
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4" for="image_input">Hình ảnh</label>
                                        <input class="datepicker-here form-control digits col-md-7" type="file" data-language="en" name="image" id="image_input" required="">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">Đường link</label>
                                        <input class="datepicker-here form-control digits col-md-7" type="text" data-language="en" name="url" required="">
                                    </div>  
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">Thứ tự hiện thị</label>
                                        <input class="form-control col-md-7" value="1" min="1" name="sort_order" type="number" required="">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">Trạng thái</label>
                                        <div class="checkbox checkbox-primary col-md-7">
                                            <input id="checkbox-primary-2" name="status" value="1" type="checkbox" data-original-title="" title="">
                                            <label for="checkbox-primary-2">Hiện thị</label>
                                        </div>
                                    </div>
                                    <div class="offset-xl-3 offset-sm-4">
                                        <button type="submit" class="btn btn-primary" name="btn_create">Tạo</button>
                                        <button type="button" class="btn btn-light" onclick="javascript:history.back(-1)">Hủy bỏ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif ?>
            <?php if ($action == "update"): ?>
                <div class="card ">
                    <div class="card-header">
                        <h5>Cập nhật Slide</h5>
                    </div>
                    <div class="card-body">
                        <form class="dropzone digits" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label for="validationCustom0" class="col-xl-3 col-md-4">Tiêu đề</label>
                                        <input class="form-control col-md-7" id="validationCustom0" type="text" required="" name="title" value="<?php echo $show['title'] ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label for="validationCustom1" class="col-xl-3 col-md-4">Nội dung</label>
                                        <input class="form-control col-md-7" id="validationCustom1" type="text" placeholder="Nội dung" required="" name="content" value="<?php echo $show['content'] ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4" for="image_input">Hình ảnh
                                            <img style="width: 200px" src="../<?php echo $show['image'] ?>" alt="">
                                        </label>
                                        <input class="datepicker-here form-control digits col-md-7" type="file" data-language="en" name="new_image" id="image_input">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">Đường link</label>
                                        <input class="datepicker-here form-control digits col-md-7" type="text" data-language="en" name="url" required="" value="<?php echo $show['url'] ?>">
                                    </div>  
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">Thứ tự hiện thị</label>
                                        <input class="form-control col-md-7" value="1" min="1" name="sort_order" type="number" required="" value="<?php echo $show['sort_order'] ?>">
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-md-4">Trạng thái</label>
                                        <div class="checkbox checkbox-primary col-md-7">
                                            <?php if ($show['status'] == 1){ ?>
                                                <input id="checkbox-primary-2" name="status" value="1" type="checkbox" data-original-title="" title="" checked="">
                                            <?php }else{ ?>
                                                <input id="checkbox-primary-2" name="status" value="1" type="checkbox" data-original-title="" title="" >
                                            <?php } ?>
                                            <label for="checkbox-primary-2">Hiện thị</label>
                                        </div>
                                    </div>
                                    <div class="offset-xl-3 offset-sm-4">
                                        <button type="submit" class="btn btn-primary" name="btn_update">Cập nhật</button>
                                        <button type="button" class="btn btn-light" onclick="javascript:history.back(-1)">Hủy bỏ</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif ?>
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

<!-- Datatable js-->
<script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/datatables/custom-basic.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

</body>

<!-- Mirrored from themes.pixelstrap.com/bigdeal/admin/order.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 04:33:01 GMT -->
</html>
