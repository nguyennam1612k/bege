<?php
	require_once './commons/db.php';
    require_once './commons/constants.php';
    require_once './commons/helpers.php';

	//Thực hiện hủy đơn hàng khi chưa xác nhận
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    if($id != null){
        $sqlUpdate = "UPDATE orders set status='0 - đã hủy' where id=$id";
        executeQuery($sqlUpdate);
        // dd($sqlUpdate);
        //Chuyển trang
        header('location: '.$_SERVER['HTTP_REFERER']);
        die;
    }
?>