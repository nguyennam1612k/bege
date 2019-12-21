<?php 
	require_once "commons/db.php";
    require_once "commons/constants.php";
    require_once "commons/helpers.php";

    $product_id = $_POST['product_id'];
    $user_id    = $_POST['user_id'];
    $content = $_POST['content'];
    $content = nl2br($content);
    $rating = isset($_POST['rate']) ? $_POST['rate'] : 0;
    //Thực hiện thêm comment
    $sqlInsert = "INSERT into comments
    				(product_id, content, rating, user_id)
    			values($product_id, '$content', $rating, $user_id)";
    executeQuery($sqlInsert);

    //select tổng rate sản phẩm và tính trung bình
    $sqlQuery = "SELECT count(rating) as count, sum(rating) as sum FROM comments where product_id =$product_id
";
    $sumCount = executeQuery($sqlQuery, false);
    $average = $sumCount['sum']/$sumCount['count'];

    //Thực hiện thêm rate vào bảng products
    $sqlUpdate = "UPDATE products set rate = $average where id=$product_id";
    executeQuery($sqlUpdate);

    //Chuyển trang
    header('location: '.$_SERVER['HTTP_REFERER']);
	die;
 ?>