<?
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
	
	// img
	$img_path = $_POST["img"];
	
	// retired 59019
	$miter_tp_img = $_POST["tpimg"];
	
	// odate
	$o_date = $_POST["odate"];
	
	// gdate
	$g_date = $_POST["gdate"];
	
	// utc date
	$u_date = gmdate("Y-m-d H:i:s");
	
	// location
	$miter_file = "../../miters/" . $_POST['filename'] . ".txt";
	
	// complile data
	$miter_data = $miter_post . "\n" . $miter_url . "\n" . $img_path . "\n" . $miter_tp_img . "\n" . $o_date . "\n" . $g_date . "\n" . $u_date;
	
	// create and write
	$dat_file = fopen($miter_file, "w+") or die("Error");
	fwrite($dat_file, $miter_data);
	fclose($dat_file);
	
	// return
	header("location:../../index.php");
?>