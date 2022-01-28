<?
	$prep = glob('../../miters/*.txt');
	foreach($prep as $gone){
		if(is_file($gone))
		unlink($gone);
	}
	header("location:../../index.php");
?>