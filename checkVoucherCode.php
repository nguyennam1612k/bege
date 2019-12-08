<?php 
require_once './commons/db.php';
$code = $_GET['code'];
$sqlQuery = "SELECT * from vouchers where code = '$code'";
$voucher = executeQuery($sqlQuery);
echo json_encode($voucher);


 ?>