<?
	$user_file = '../../user/user.xml';
	$border_file = simplexml_load_file($user_file);
	$miter_border = $_POST["miter_color_border"];
	foreach( $border_file->xpath("user[@id='probe']") as $data ) {
		$data->border = $miter_border;
	}
	$border_file->asXML($user_file);
	header("location:../../index.php?u=settings");
?>