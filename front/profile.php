<?
	// build file array
	$dat_array = glob('miters/*.txt');
	
	// miters today
	$miters_today = 0;
	foreach($dat_array as $miters_today_get) {
		if (date('m-d-Y', filectime($miters_today_get)) == date('m-d-Y')) {
			$miters_today = $miters_today + 1;
		}
	}
	if ($miters_today == 1) {
		$miters_today = $miters_today . ' miter';
	} else {
		$miters_today = $miters_today . ' miters';
	}
	
?>
<table class="menu_header">
	<tr>
		<td class="menu_header_td">
			<span class="title">Miter</span>
		</td>
	</tr>
</table>
<table class="profile_panel_top">
	<tr>
		<td class="profile_top_td">
			<table class="profile_table">
				<tr>
					<td class="profile_avatar_td">
						<a href="images/<? echo $user_avatar; ?>" target="_blank"><img src="images/<? echo $user_avatar; ?>" class="avatar" alt=""></a>
					</td>
					<td class="profile_name_td">
						<a href="index.php" style="color:#111111;"><span class="tenon"><? echo $user_username; ?></span></a><br />
						<span class="tenon"><? echo $user_bio; ?></span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="profile_menu_top">
	<tr>
		<td class="profile_menu_td">
			<table class="profile_menu_table">
				<tr>
					<td class="profile_menu_td_left">
						<span class="tenon">
						<a href="miters/" target="_blank" style="color:#000;"><? echo number_format($miter_count); ?> miters</a><br />
						<? echo $miters_today; ?> today<br /></span>
					</td>
					<td class="profile_menu_td_right">
						<span class="tenon">
						<a href="index.php?a=" style="color:#000;"><? echo number_format($tenon_count); ?> tenons</a><br />
						<a href="front/atom.php" style="color:#000;" target="_blank">Subscribe</a></span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>