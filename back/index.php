<?
	session_start();
	
	$user_file = '../user/user.xml';
	$user_get = simplexml_load_file($user_file);
	$user_array = $user_get->xpath("/miter/user[@id='probe']");
	$user_username = $user_array[0]->name;
	
	$user_username = str_replace('@','',$user_username);
	$_SESSION['miter'] = $user_username;
	
	// log
	$hour = date("H");
	$min = date("i");
	$sec = date("s");
	$day = date("z");
	$year = date("Y");

	$set_today = time();
	$new_year_gdate = mktime(0, 0, 0, 3, 20, $year);
	$set_year = $year - 2000;
	$final_year = $set_year - 1;
	$days_total = 365;
	if ((0 == $year % 4) and (0 != $year % 100) or (0 == $year % 400)) {
		$days_total = 366;
	}
	if ($set_today >= $new_year_gdate) {
		$next_year = $year + 1;
		$new_year_gdate = mktime(0, 0, 0, 3, 20, $next_year);
		$final_year = $set_year;
		if ((0 == $next_year % 4) and (0 != $next_year % 100) or (0 == $next_year % 400)) {
			$days_total = 366;
		}
	}
	$count_day_dif = $new_year_gdate - $set_today;
	$pre_final = floor($count_day_dif/60/60/24);
	$final_day = $days_total - $pre_final;
	
	if ($final_year < 100) {
		$zero_year = "0" . $final_year;
	} else {
		$zero_year = $final_year;
	}
		
	if ($final_day < 10) {
		$zero_final_day = "00" . $final_day;
	} else if ($final_day < 100 && $final_day > 9) {
		$zero_final_day = "0" . $final_day;
	} else {
		$zero_final_day = $final_day;
	}
	
	// write date
	$o_date = ($hour . ":" . $min . ":" . $sec . " " . $final_day . " " . $zero_year);

	// get ip
	function user_ip() {
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        	$ip_col = $_SERVER['HTTP_CLIENT_IP'];
    	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        	$ip_col = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	} else {
        	$ip_col = $_SERVER['REMOTE_ADDR'];
    }
    	return $ip_col;
	}
	$ip_get = user_ip();

	// get browser
	$user_browser = $_SERVER['HTTP_USER_AGENT'];

	$log_data = ($ip_get . " " . $o_date . " " . $user_browser . "\n");

	// write to log
	$log_file = 'admin/log.txt';
	$log_write = fopen($log_file, "a") or die("Error");
	fwrite($log_write, $log_data);
	fclose($log_write);

	// email log if checked


	header("Location: ../");
	die();
?>