<?php
	session_start();
// tạo ra kết nối đến csdl
function getConnect(){
	$host = "127.0.0.1";
	$dbname = "du_an_1";
	$dbusername = "root";
	$dbpwd = "";
	try{
		
		// đoạn code có khả năng gây(bị) lỗi
		$connect = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbusername, $dbpwd);

	}catch(Exception $ex){
		var_dump($ex->getMessage());
		die;
	}
	return $connect;
}
function executeQuery($sqlQuery, $getAll = false){
	// tạo kết nối đến csdl
	$conn = getConnect();
	// nạp câu lệnh sql từ tham số vào kết nối
	$stmt = $conn->prepare($sqlQuery);
	// thực thi câu lệnh với csdl
	$stmt->execute();
	// lấy dữ liệu đc trả về từ csdl và gán cho biến $result
	$result = $stmt->fetchAll();
	if(!$result){
		return null;
	}
	if($getAll){
		return $result;
	}
	return $result[0];
}

 ?>