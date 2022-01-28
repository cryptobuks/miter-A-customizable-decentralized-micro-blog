<?
	if (isset($_GET['p'])) {
		$index = $_GET['p'];
		$panel_dir = '../../user/panels.txt';
		$panel_data = array_map('trim', file($panel_dir));
		
		$pos = $panel_data[$index];
		$panel_data[$index] = $panel_data[$index-1];
		$panel_data[$index-1] = $pos;
		
		$f_panel = fopen($panel_dir, "w+") or die("Error");
		fwrite($f_panel, implode("\n", $panel_data));
		fclose($f_panel);
	}
	
	header('location:../../index.php?u=panels');
?>	