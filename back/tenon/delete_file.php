<?
	if (isset($_GET['d'])) {
		$loc = $_GET['d'];
		$doc_file = "../../docs/" . $loc . "";
		unlink($doc_file);
		header('location:../../index.php?u=tenon_files');
	}
?>