<?
	
	// WARNING
	// Changing coded aesthetics and implementation is welcomed.
	// -- tho we discourage you from altering this file (scr/miter.php).
	// Corruption of the standardized format will deny your
	// data from public visibility and sharing.
	
	// upload image
	if (!empty($_FILES['upload']['name'])) {
		$img_name = $_FILES['upload']['name'];
		$img_name = stripslashes($img_name);
		$img_name = str_replace("'", "", $img_name);
		$upload_file = move_uploaded_file($_FILES['upload']['tmp_name'], "../../uploads/" . $img_name);
		$img_path = $img_name;
		} else {
		$img_path = '';
	}
	
	// convert gregorian to otc
	$hour = date("H");
	$min = date("i");
	$sec = date("s");
	$day = date("z");
	$year = date("Y");
	
	// days until new year and con-to doy
	// adjust for leap year
	$set_today = time();
	$new_year_gdate = mktime(0, 0, 0, 3, 20, $year);
	$set_year = $year - 2000;
	$final_year = $set_year - 1;
	$days_total = 365;
	if((0 == $year % 4) and (0 != $year % 100) or (0 == $year % 400)) {
		$days_total = 366;
	}
	if ($set_today >= $new_year_gdate) {
		$next_year = $year + 1;
		$new_year_gdate = mktime(0, 0, 0, 3, 20, $next_year);
		$final_year = $set_year;
		if((0 == $next_year % 4) and (0 != $next_year % 100) or (0 == $next_year % 400)) {
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
		
	// file name correction
	if ($final_day < 10) {
		$zero_final_day = "00" . $final_day;
		} else if ($final_day < 100 && $final_day > 9) {
		$zero_final_day = "0" . $final_day;
		} else {
		$zero_final_day = $final_day;
	}
	
	// print date
	$o_date = ($hour . ":" . $min . ":" . $sec . " " . $final_day . " " . $zero_year); 
	
	// file date
	$id_date = ($zero_year . "" . $zero_final_day . "" . $hour . "" . $min . "" . $sec); 
	
	// gregorian date
	$g_date = date("Y-m-d H:i:s");
	
	// utc date
	$u_date = gmdate("Y-m-d H:i:s");
	
	// get post
	$miter_post = str_replace(array("\r\n", "\r", "\n"), "<br />", $_POST["miter"]);
	
	// get link
	$link = $_POST["url"];
	if (strpos($link, 'Link, Image or Video:') !== false) {
		$miter_url = '';
		} else {
		$link = str_replace('&', '%26', $link);
		$miter_url = $link;
	}
	
	// retired 59019
	$miter_tp_img = '';
	
	// location
	$miter_file = "../../miters/" . $id_date . ".txt";
	
	// complile data
	$miter_data = $miter_post . "\n" . $miter_url . "\n" . $img_path . "\n" . $miter_tp_img . "\n" . $o_date . "\n" . $g_date . "\n" . $u_date;
	
	// create and write
	$dat_file = fopen($miter_file, "w") or die("Error");
	fwrite($dat_file, $miter_data);
	fclose($dat_file);
	
	// return
	header("location:../../index.php");
?>