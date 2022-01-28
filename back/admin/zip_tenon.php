<?php
	// delete previous zip
	$usr_dir = '../../user/';
	$zip_past = glob($usr_dir.'tenons.zip');
	foreach($zip_past as $zip){
		unlink($zip);
	}
	
	// zip ten
	$zip_dir = '../../user/';
	$zip_file = 'tenons.zip';
	$zip_gather = $zip_dir . $zip_file;
	$zip_new = new ZipArchive;
	$zip_new->open($zip_gather, ZipArchive::CREATE);
	$dat_dir = '../../tenons/';
	$dat_array = glob($dat_dir.'*.txt');
	foreach ($dat_array as $tenon) {
		$zip_new->addFile($tenon);
	}
	$zip_new->close();
	
	// download zip
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zip_file);
	header('Content-Length: '.filesize($zip_gather));
	readfile($zip_gather);
?>