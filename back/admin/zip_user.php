<?php
	// delete previous zip
	$usr_dir = '../../user/';
	$zip_past = glob($usr_dir.'user.zip');
	foreach($zip_past as $zip){
		unlink($zip);
	}
	
	// zip usr
	$zip_dir = '../../user/';
	$zip_file = 'user.zip';
	$zip_gather = $zip_dir . $zip_file;
	$zip_new = new ZipArchive;
	$zip_new->open($zip_gather, ZipArchive::CREATE);
	// usr (txt,xml)
	$dat_dir = '../../user/';
	$dat_array = glob($dat_dir.'*.{txt,xml}', GLOB_BRACE);
	foreach ($dat_array as $user) {
		$zip_new->addFile($user);
	}
	// pan (txt)
	$dat_dir = '../../panels/';
	$dat_array = glob($dat_dir.'*.txt');
	foreach ($dat_array as $user) {
		$zip_new->addFile($user);
	}
	// miter_inserts.txt
	$dat_dir = '../miter/';
	$dat_array = glob($dat_dir.'miter_inserts.txt', GLOB_BRACE);
	foreach ($dat_array as $user) {
		$zip_new->addFile($user);
	}
	// tenon_inserts.txt
	$dat_dir = '../tenon/';
	$dat_array = glob($dat_dir.'tenon_inserts.txt', GLOB_BRACE);
	foreach ($dat_array as $user) {
		$zip_new->addFile($user);
	}
	$zip_new->close();
	
	// download zip
	header('Content-Type: application/zip');
	header('Content-disposition: attachment; filename='.$zip_file);
	header('Content-Length: '.filesize($zip_gather));
	readfile($zip_gather);
?>