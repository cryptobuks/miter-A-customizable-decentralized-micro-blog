<?
	if (isset($_GET['d'])) {
		$loc = $_GET['d'];
		$img_file = "../../images/" . $loc . "";
		unlink($img_file);
		header('location:../../index.php?u=tenon_images');
	}
?>