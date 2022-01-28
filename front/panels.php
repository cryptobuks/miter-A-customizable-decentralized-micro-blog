<?
	// Load Panels
	$panel_get = file('user/panels.txt');
	foreach($panel_get as $panel_sold) {
		
		$panel_hide_get = substr($panel_sold, 0, 1);
		$panel_title_get = substr($panel_sold, 1, 1);
		
		$panel_txt_get = substr($panel_sold, 2);
		$panel_title_space = preg_replace('/\s+/', '', $panel_txt_get);
		$panel_title_trim = str_replace("_", " ", $panel_title_space);
		
		$panel_body = "panels/" . $panel_title_space . ".txt";
		
		if(file_exists($panel_body)) {
			
			if ($panel_hide_get == '2') {
				if($login == true) {
					if ($panel_title_get == '1') {
					?>
					<table class="menu_header">
						<tr>
							<td class="menu_header_td">
								<span class="title"><? echo $panel_title_trim; ?></span>
							</td>
						</tr>
					</table>
					<table class="menu_table">
						<tr>
							<td class="menu_td">
								<span class="tenon"><? include $panel_body; ?></span>
							</td>
						</tr>
					</table>
					<div class="bump"></div>
					<?
						} else if ($panel_title_get == '2') {
					?>
					<table class="menu_table_no_title">
						<tr>
							<td class="menu_td">
								<span class="tenon"><? include $panel_body; ?></span>
							</td>
						</tr>
					</table>
					<div class="bump"></div>
					<?
					}
				}
				} else {
				if ($panel_title_get == '1') {
				?>
				<table class="menu_header">
					<tr>
						<td class="menu_header_td">
							<span class="title"><? echo $panel_title_trim; ?></span>
						</td>
					</tr>
				</table>
				<table class="menu_table">
					<tr>
						<td class="menu_td">
							<span class="tenon"><? include $panel_body; ?></span>
						</td>
					</tr>
				</table>
				<div class="bump"></div>
				<?
					} else if ($panel_title_get == '2') {
				?>
				<table class="menu_table_no_title">
					<tr>
						<td class="menu_td">
							<span class="tenon"><? include $panel_body; ?></span>
						</td>
					</tr>
				</table>
				<div class="bump"></div>
				<?
				}
			}
			} else {
		}
	}
	
	// miter panel
	include('front/profile.php');
?>