<?
	// delete file + entry
	$txt_file = "tenon_inserts.txt";
	unlink($txt_file);
	
	// get post
	$more_butt_post = $_POST["more_butt"];
	
	// create and write
	$data_file = fopen($txt_file, "w") or die("Error");
	fwrite($data_file, $more_butt_post);
	fclose($data_file);
	
	header("location:../../index.php?u=tenon_inserts");
?>