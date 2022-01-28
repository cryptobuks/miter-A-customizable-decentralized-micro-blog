<?
	$user_file = '../../user/user.xml';
	$link = simplexml_load_file($user_file);
	$miter_link = $_POST["miter_color_link"];
	foreach( $link->xpath("user[@id='probe']") as $data ) {
		$data->link = $miter_link;
	}
	$link->asXML($user_file);
	header("location:../../index.php?u=settings");
?>