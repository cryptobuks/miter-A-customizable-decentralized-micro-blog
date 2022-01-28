<?
	$miter_avatar = $_FILES['avatar']['name'];
	$upload_file = move_uploaded_file($_FILES['avatar']['tmp_name'], "../../images/" . $miter_avatar);
	
	$user_file = '../../user/user.xml';
	$avatar_file = simplexml_load_file($user_file);
	foreach( $avatar_file->xpath("user[@id='probe']") as $data ) {
		$data->avatar = $miter_avatar;
	}
	$avatar_file->asXML($user_file);
	header("location:../../index.php?u=settings");
?>