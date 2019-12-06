<?php 
require_once 'connection.php';

$sqlQuery = "SELECT * from products where id=1";
$stmt = $conn->prepare($sqlQuery);
$stmt->execute();
$products = $stmt->fetch();
echo $products['detail'];
echo "<br>";
echo $products['parameter'];
 ?>