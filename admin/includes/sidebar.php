<?php

?>
<div class="page-sidebar">
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <div><img class="img-60 rounded-circle lazyloaded blur-up" src="../<?php echo $user['avatar'] ?>" alt="#">
            </div>
            <h6 class="mt-3 f-14"><?php echo $user['name'] ?></h6>
            <p>
                <?php
                if($user['role'] == 1  && $user['username'] == "admin"){
                    echo "Quản trị Cao cấp";
                }else{
                    echo "Quản trị viên";
                }
                ?>
            </p>
        </div>
        <ul class="sidebar-menu">
            <li><a class="sidebar-header" href="index.php"><i data-feather="home"></i><span>Bảng điều khiển</span></a></li>
            <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Danh sách</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="categories.php"><i class="fa fa-circle"></i>
                            <span>Danh mục</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle"></i>
                            <span>Sản phẩm</span> <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="product.php"><i class="fa fa-circle"></i>Danh sách sản phẩm</a></li>
                            <li><a href="product-update.php"><i class="fa fa-circle"></i>Chỉnh sửa</a></li>
                            <li><a href="add-product.php"><i class="fa fa-circle"></i>Thêm sản phẩm</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="#"><i data-feather="dollar-sign"></i><span>Bán hàng</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="order.php"><i class="fa fa-circle"></i>Đơn đặt hàng</a></li>
                    <li><a href="transactions.php"><i class="fa fa-circle"></i>Giao dịch</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="#"><i data-feather="tag"></i><span>Voucher giảm giá</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="coupon-list.php"><i class="fa fa-circle"></i>Danh sách voucher</a></li>
                    <li><a href="coupon-create.php"><i class="fa fa-circle"></i>Tạo voucher</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="media.php"><i data-feather="camera"></i><span>Slide</span></a></li>
            <li><a class="sidebar-header" href="#"><i data-feather="align-left"></i><span>Menus</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="menu-list.php"><i class="fa fa-circle"></i>Danh sách Menu</a></li>
                    <li><a href="create-menu.php"><i class="fa fa-circle"></i>Tạo Menu</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="#"><i data-feather="users"></i><span>Nhà cung cấp</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="sidebar-submenu">
                            <li><a href="list-vendor.php"><i class="fa fa-circle"></i>Danh sách nhà cung cấp</a></li>
                            <li><a href="create-vendors.php"><i class="fa fa-circle"></i>Thêm nhà cung cấp</a></li>
                        </ul>
                    </li>
            <li><a class="sidebar-header" href="#"><i data-feather="user-plus"></i><span>Tài khoản</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="users.php"><i class="fa fa-circle"></i>Danh sách tài khoản</a></li>
                    <li><a href="create-user.php"><i class="fa fa-circle"></i>Tạo tài khoản</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="reports.php"><i data-feather="bar-chart"></i><span>Thống kê</span></a></li>
            <li><a class="sidebar-header" href="#"><i data-feather="settings" ></i><span>Cài đặt</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="profile.php"><i class="fa fa-circle"></i>Thông tin tài khoản</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="invoice.php"><i data-feather="archive"></i><span>Biên lai</span></a>
            </li>
            <li><a class="sidebar-header" href="?action=logout"><i data-feather="log-in"></i><span>Đăng xuất</span></a>
            </li>
        </ul>
    </div>
</div>