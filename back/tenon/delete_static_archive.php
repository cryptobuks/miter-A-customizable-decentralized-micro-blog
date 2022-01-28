<?
	if (isset($_GET['d'])) {
		$loc = $_GET['d'];
		$txt_file = "../../tenons/" . $loc . ".txt";
		unlink($txt_file);
		header('location:../../index.php?a=');
	}
?>