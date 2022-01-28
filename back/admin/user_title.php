<?
	$user_file = '../../user/user.xml';
	$title = simplexml_load_file($user_file);
	$miter_title = $_POST["user_title"];
	foreach( $title->xpath("user[@id='probe']") as $data ) {
		$data->title = $miter_title;
	}
	$title->asXML($user_file);
	header("location:../../index.php?u=settings");
?>