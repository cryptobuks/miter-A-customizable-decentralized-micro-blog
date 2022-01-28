<?
	$user_file = '../../user/user.xml';
	$pin = simplexml_load_file($user_file);
	$miter_pin = $_GET['miter'];
	foreach( $pin->xpath("user[@id='probe']") as $data ) {
		$data->pin = $miter_pin;
	}
	$pin->asXML($user_file);
	header("location:../../index.php");
?>