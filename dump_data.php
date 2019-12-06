<?php 
require_once './db.php';
require_once 'commons/helpers.php';
//https://github.com/fzaninotto/Faker
require_once './libs/Faker/autoload.php';
$faker = Faker\Factory::create('vi_VN');
// $faker = Faker\Factory::create('en_US');
// try{
// 	$sqlQuery = "select * from products";
// 	$products = executeQuery($sqlQuery, true);
	
// 	foreach ($products as $pro) {	
// 		// $feature_image = str_replace("public", "", $pro['feature_image']);
// 		// $feature_image = ltrim($pro['feature_image'], "/");
// 		$proId = $pro['id'];
// 		$sqlQuery = "update products 
// 						set feature_image = '$feature_image'
// 					where id = $proId";
// 		executeQuery($sqlQuery);
// 	}
// }catch(Exception $ex){
// 	var_dump($ex->getMessage());
// }
// var_dump($faker->imageUrl($width = 640, $height = 480));
// var_dump($faker->image('public/images', 640, 480, 'cats'));
// die;
// $companyName = $faker->company;
// echo $name. "-" . $companyName;
// die;
// tạo dump data cho bảng roles
// $roles = [
// 	['name' => 'member', 'status' => 1],
// 	['name' => 'admin', 'status' => 1],
// 	['name' => 'super admin', 'status' => 1]
// ];
// foreach ($roles as $value) {
// 	extract($value);
// 	$sqlQuery = "insert into roles (name, status)
// 				values ('$name', $status)";
// 	// executeQuery($sqlQuery);
// }
// $users = [
// 	[
// 		'name' => 'Trần Thị Yên',
// 		'email' => 'yentt@gmail.com',
// 		'password' => password_hash('123456', PASSWORD_DEFAULT),
// 		'role_id'=> 1
// 	],
// 	[
// 		'name' => 'Trần Hồng Phước',
// 		'email' => 'phuocth@gmail.com',
// 		'password' => password_hash('123456', PASSWORD_DEFAULT),
// 		'role_id'=> 2
// 	],
// 	[
// 		'name' => 'admin',
// 		'email' => 'admin@gmail.com',
// 		'password' => password_hash('123456', PASSWORD_DEFAULT),
// 		'role_id'=> 2
// 	]
// ];
// foreach ($users as $value) {
// 	extract($value);
// 	$sqlQuery = "insert into users (name, email, password, role_id)
// 			values ('$name', '$email', '$password', $role_id)";
// 	// executeQuery($sqlQuery);
// }
// for ($i=0; $i < 10; $i++) { 
// 	$name = $faker->name;
// 	$desc = $faker->realText($maxNbChars = 200, $indexSize = 2);
// 	//biến đổi dữ liệu / chuẩn hóa dữ liệu cho chức năng
// 	$desc = str_replace("'","\'", $desc);
// 	$showMenu = rand(0, 1);
// 	$sqlQuery = "insert into categories
// 					(name, description, show_menu)
// 				values
// 					('$name', '$desc', $showMenu)";
// 	// echo "<pre>";
// 	// var_dump($sqlQuery);
// 	// executeQuery($sqlQuery);
// }


// // insert dữ liệu mẫu cho bảng products (100 bản ghi)
for ($i=1; $i < 26; $i++) {
	$name = $faker->realText($maxNbChars = 10, $indexSize = 1);
	// $name = $faker->name;
	$name = "Laptop ".$name;
	$sku = strtoupper(uniqid());
	$cate_id = 1;
	$price = rand(10000000, 40000000);
	$sale_price = $price - rand(500000, 8000000);
	// $detail = $faker->realText($maxNbChars = 200, $indexSize = 2);
	$detail = "<b>Khuyến mại đặc biệt (SL có hạn)</b><br>

	<p>Khách hàng chọn 1 trong 2 khuyến mại sau:</p>

	<b>KM1:</b><br>

	<p>Trả góp 0%/0đ</p>
	<b>KM2:</b><br>

	<p>Tặng PMH 500,000đ</p>
	<b>Khách hàng được khuyến mại thêm:</b><br>

	<p>Tặng Balo Laptop</p>
	<p>Mua Combo Sinh viên: Office 365 Personal + Lạc Việt giá chỉ còn 690,000 đồng
	Giảm 25% Combo bảo vệ Laptop (Combo MDMH và Phần mềm Diệt virus Eset) khi mua kèm máy</p>";
	$detail = str_replace("'","\'", $detail);
	// $detail = addslashes($detail);
	
	$parameter = "<b>Bộ xử lý</b><br>
	<p>Hãng CPU :	Intel</p>
	<p>Công nghệ CPU :	Core i3</p>
	<p>Loại CPU :	7020U</p>
	<p>Tốc độ CPU :	2.3 GHz</p>
	<p>Bộ nhớ đệm :	3 MB Cache</p>
	<p>Tốc độ tối đa :	2.3 GHz</p>
	<b>Bo mạch</b><br>
	<p>Chipset :	Intel core i3</p>
	<p>Tốc độ Bus :	2400 MHz</p>
	<p>Hỗ trợ RAM tối đa :	12 GB</p>
	<b>RAM</b><br>
	<p>Dung lượng RAM :	4 GB</p>
	<p>Loại RAM :	DDR4</p>
	<p>Tốc độ BUS RAM :	2400 MHz</p>
	<p>Số lượng khe RAM :	1</p>
	<b>Đĩa cứng</b><br>
	<p>Loại ổ đĩa :	SSD</p>
	<p>Dung lượng ổ đĩa :	512 GB</p>
	<p>Khe cắm ổ SSD :	Không</p>
	<b>Đồ họa</b><br>
	<p>Chipset đồ họa :	Intel® HD graphics 620</p>
	<p>Bộ nhớ đồ họa :	Shared</p>
	<p>Kiểu thiết kế đồ họa :	Tích hợp</p>
	<b>Màn hình</b><br>
	<p>Kích thước màn hình :	15.6 inchs</p>
	<p>Độ phân giải (W x H) :	1366 x 768 Pixels</p>
	<p>Công nghệ màn hình :	Anti - Glare</p>
	<p>Cảm ứng :	Không</p>
	<b>Âm thanh</b><br>
	<p>Kênh âm thanh :	Không</p>
	<p>Thông tin thêm :	Sonic Master</p>
	<b>Đĩa quang</b><br>
	<p>Có sẵn đĩa quang :	Không</p>
	<b>Tính năng mở rộng & cổng giao tiếp</b><br>
	<p>Cổng giao tiếp :	2x USB 2.0 1x USB3.1 Type A (Gen1) 1x USB3.1 Type C (Gen 1)</p>
	<p>Tính năng mở rộng :	Chiclet Keyboard with Num-Key</p>
	<b>Giao tiếp mạng</b><br>
	<p>LAN :	Không</p>
	<p>Chuẩn Wi-Fi :	802.11 ac</p>
	<p>Kết nối không dây khác :	Bluetooth 4.2</p>
	<b>Card Reader</b><br>
	<p>Đọc thẻ nhớ :	Micro SD</p>
	<p>Khe đọc thẻ nhớ :	Micro SD</p>
	<b>Webcam</b><br>
	<p>Độ phân giải :	1.0 MP</p>
	<p>Thông tin thêm :	VGA Webcam</p>
	<b>Hệ điều hành, phầm mềm có sẵn</b><br>
	<p>Hệ điều hành :	Windows 10 Home</p>
	<p>Phần mềm có sẵn :	không</p>
	<b>PIN/Battery</b><br>
	<p>Loại pin :	2 Cells</p>
	<p>Kiểu pin :	Lithium-Ion, Liền</p>
	<b>Thông tin khác</b><br>
	<p>Cảm biến vân tay :	Có</p>
	<p>Đèn bàn phím :	Không</p>
	<p>Bàn phím số :	Có</p>
	<p>Phụ kiện kèm theo :	Sạc, Sách HDSD</p>
	<b>Kích thước & trọng lượng</b><br>
	<p>Kích Thước :	36.0(W) x 23.5(D) x 2.29 ~ 2.29 (H) cm</p>
	<p>Trọng lượng :	1.90 KG (with 2 cell battery)</p>
	<p>Chất liệu :	Nhựa</p>
	<b>Bảo hành</b><br>
	<p>Thời gian bảo hành :	24 Tháng</p>";
	$parameter = str_replace("'","\'", $parameter);
	$feature_image = "images/products/laptop_00".$i.".jpg";
	if($i >= 10){
		$feature_image = str_replace("_00", "_0", $feature_image);
	}
	$view_count = rand(0, 999);
	$especially = rand(0, 1);
	$quantum = rand(50,300);
	$sqlQuery = "INSERT into products 
					(name,
					sku,
					cate_id, 
					price, 
					sale_price,
					detail,
					parameter,
					feature_image,
					view_count,
					quantum,
					especially)
			values ('$name',
					'$sku',
					$cate_id, 
					$price, 
					$sale_price,
					'$detail',
					'$parameter',
					'$feature_image',
					$view_count,
					$quantum,
					$especially)";
	executeQuery($sqlQuery);
	// dd($sqlQuery);
}
//Insert 25 bản voucher
for ($i=1; $i < 26; $i++) { 
	$code = strtoupper(uniqid());
	// $start_time = $date;
	// $end_time = $date_end;
	$discount = rand(10, 5000)*100;
	$title = "Voucher ".number_format($discount, 0, '', ',')." Đ";
	$used_count = rand(50, 100);
	$active = rand(0, 1);
	$sqlQuery = "INSERT into vouchers 
					(title, 
					code,
					start_time,
					end_time,
					discount,
					used_count,
					active)
			values 
					('$title', 
					'$code', 
					'2019-11-23 09:40:00',
					'2019-11-27 18:00:00',
					$discount,
					$used_count,
					$active)";
	// executeQuery($sqlQuery);
	// dd($sqlQuery);
}
 ?>