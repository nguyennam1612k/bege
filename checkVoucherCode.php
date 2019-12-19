<?php 
require_once './commons/db.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');

$code = $_GET['code'];
$sqlQuery = "SELECT * from vouchers where code = '$code'";
$voucher = executeQuery($sqlQuery);
echo json_encode($voucher);


 ?>