<?php 
	require_once "../connection.php";
	//Kiểm tra nếu tồn tại thì Get giá trị
	//Xóa danh mục menu
	if(isset($_GET['menu_id'])){
		$menu_id = $_GET['menu_id'];
		$delete_menu = "DELETE FROM menu_category WHERE id=$menu_id";
		$stmt = $conn->prepare($delete_menu);
		$stmt->execute();
		//Kiểm tra nếu xóa thành công thì chuyển trang view
		if($stmt->rowCount() >0){
			header('location: product-listdigital.php');
		}else{
			echo "<script>alert('Không thể xóa Danh mục')</script>";
		}
	}
	if(isset($_GET['cate_id'])){
		$cate_id = $_GET['cate_id'];
		$delete_category = "DELETE FROM category WHERE id=$cate_id";
		$stmt = $conn->prepare($delete_category);
		$stmt->execute();
		//Kiểm tra nếu xóa thành công thì chuyển trang view
		if($stmt->rowCount() >0){
			header('location: category-digital.php');
		}else{
			echo "<script>alert('Không thể xóa Danh mục')</script>";
		}
	}
 ?>