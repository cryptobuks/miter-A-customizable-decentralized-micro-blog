<?
	// convert gregorian to otc
	$hour = date("H");
	$min = date("i");
	$sec = date("s");
	
	$day = date("z");
	if ($day < 79) {
		$final_day = $day + 287;
		} else if ($day >= 79) {
		$final_day = $day - 78;
	}
	
	$year = date("Y");
	$set_year = $year - 2000;
	if ($day < 79) {
		$final_year = $set_year - 1;
		} else {
		$final_year = $set_year;
	}
	$zero_year = "0".$final_year;
	
	// print date
	$o_date = ($hour . ":" . $min . ":" . $sec . " " . $final_day . " " . $zero_year); 
	
	// gregorian date
	$g_date = date("Y-m-d H:i:s");
	
	// get title
	$tenon_title = $_POST["title"];
	
	// get post
	$tenon_post = str_replace(array("\r\n", "\r", "\n"), "<br />", $_POST["tenon"]);
	
	// replace file name space
	$title_to_file = str_replace(' ','_',$tenon_title);
	
	// replace non-file-compliant characters
	$title_to_file = str_replace('<','-',$title_to_file);
	$title_to_file = str_replace('>','-',$title_to_file);
	$title_to_file = str_replace(':','-',$title_to_file);
	$title_to_file = str_replace('"','-',$title_to_file);
	$title_to_file = str_replace('/','-',$title_to_file);
	$title_to_file = str_replace('\\','-',$title_to_file);
	$title_to_file = str_replace('|','-',$title_to_file);
	$title_to_file = str_replace('?','-',$title_to_file);
	$title_to_file = str_replace('*','-',$title_to_file);
	$title_to_file = str_replace('\'','-',$title_to_file);
	$title_to_file = str_replace('#','-',$title_to_file);
	
	// get file name
	$tenon_file = "../../tenons/" . $title_to_file . ".txt";
	
	// complile data
	$tenon_data = $tenon_title . "|&|" . $o_date . "|&|" . $g_date . "|&|" . $tenon_post;
	
	// create and write
	$data_file = fopen($tenon_file, "w") or die("Error");
	fwrite($data_file, $tenon_data);
	fclose($data_file);
	
	// load new page
	header("location:../../index.php?t=" . $title_to_file . "");
?>