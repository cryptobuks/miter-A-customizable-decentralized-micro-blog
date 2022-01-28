<?
	$user_file = '../../user/user.xml';
	$bio_file = simplexml_load_file($user_file);
	$miter_bio_call = $_POST["miter_bio"];
	foreach( $bio_file->xpath("user[@id='probe']") as $data ) {
		$data->bio = $miter_bio_call;
	}
	$bio_file->asXML($user_file);
	header("location:../../index.php?u=settings");
?>