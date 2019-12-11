<?php 
	function dd($var){
		echo "<pre>";
		var_dump($var);
		die;
	}
	//Đếm thời gian chi tiết
	function nicetime($date){
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		if(empty($date)) {
			return "No date provided";
		}
		$periods         = array("giây", "phút", "giờ", "ngày", "tuần", "tháng", "năm", "thập kỷ");
		$lengths         = array("60","60","24","7","4.35","12","10");
		$now             = time();

		$unix_date       = strtotime($date);
       // check validity of date
		if(empty($unix_date)) {   
			return "Ngày xấu";
		}
    	// is it future date or past date
		if($now > $unix_date) {   
			$difference     = $now - $unix_date;
			$tense         = "trước";
		} else {
			$difference     = $unix_date - $now;
			$tense         = "kể từ giờ";
		}
		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}
		$difference = round($difference);
		return "$difference $periods[$j] {$tense}";
	}
 ?>