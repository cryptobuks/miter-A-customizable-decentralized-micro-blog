<?
	// remove pan/*.txt
	if (isset($_GET['p'])) {
		$panel_del = $_GET['p'];
		$panel_name = substr($panel_del, 2);
		$txt_file = "../../panels/" . $panel_name . ".txt";
		unlink($txt_file);
		
		// remove line from usr/panels.txt
		$panel_dir = '../../user/panels.txt';
		$panel_data = array_map('trim', file($panel_dir));
		
		foreach($panel_data as $panel_key => $panel_line) {
			if($panel_line == $panel_del) {
				unset($panel_data[$panel_key]);
			}
		}
		$f_panel = fopen($panel_dir, "w+") or die("Error");
		fwrite($f_panel, implode("\n", $panel_data));
		fclose($f_panel);
	}
	header('location:../../index.php?u=panels');
?>