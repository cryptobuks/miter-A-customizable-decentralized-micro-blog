<?
	if (isset($_GET['d'])) {
		$loc = $_GET['d'];
		$txt_file = "../../miters/" . $loc . ".txt";
		unlink($txt_file);
		header('location:../../index.php');
	}
?>