<?php
	// delete previous zip
	$usr_dir = '../../user/';
	$zip_past = glob($usr_dir.'miters.zip');
	foreach($zip_past as $zip){
		unlink($zip);
	}
	
	// zip dat
	$zip_dir = '../../user/';
	$zip_file = 'miters.zip';
	$zip_gather = $zip_dir . $zip_file;
	$zip_new = new ZipArchive;
	$zip_new->open($zip_gather, ZipArchive::CREATE);
	$dat_dir = '../../miters/';
	$dat_array = glob($dat_dir.'*.txt');
	foreach ($dat_array as $miter) {
		$zip_new->addFile($miter);
	}
	$zip_new->close();
	
	// download zip
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zip_file);
	header('Content-Length: '.filesize($zip_gather));
	readfile($zip_gather);
?>