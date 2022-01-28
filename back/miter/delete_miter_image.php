<?
	if (isset($_GET['d'])) {
		$loc = $_GET['d'];
		$img_file = "../../uploads/" . $loc . "";
		unlink($img_file);
		header('location:../../index.php?u=miter_images');
	}
?>