<?
	function formatbytes($bytes, $precision = 2) { 
		$units = array('b', 'kb', 'mb', 'gb', 'tb'); 
		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 
		$bytes /= (1 << (10 * $pow)); 
		// $bytes /= pow(1024, $pow);
		return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 
	$var_sort = $_GET['sort'];
?>

<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<table class='list_header_inset'>
				<tr>
					<td align='left'>
						<span class='title'>Miter Images</span>
					</td>
					<td align='right'>
						<?
							if ($var_sort == 'date') {
								echo "<span class='title'><a href='?u=miter_images&sort=abc'>abc</a> | date</span>";
							} else {
								echo "<span class='title'>abc | <a href='?u=miter_images&sort=date'>date</a></span>";
							}
						?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table class='static_table'>
	<tr>
		<td class='static_td'>
			<table class='list_table'>
				<?	
					if(isMobile()) {
						$char_count = 25;
						} else {
						$char_count = 45;
					}
					
					$i = 1;
					$file_list = glob("uploads/*.*");
					
					if ($var_sort == 'date') {
						usort($file_list, function($newest, $oldest) {
						return filemtime($newest) < filemtime($oldest);
					});
					}
					
					foreach($file_list as $file_name) {
						$file_name = str_replace("uploads/","",$file_name);
						$file_loc = "uploads/" . $file_name;
						$file_size = filesize($file_loc);
						
						echo "<tr><td align='left'><span class='tenon'>" . $i++ . ". <a href='uploads/" . $file_name . "' target='_blank'>" . substr($file_name, 0, $char_count) . "</a></span>";
						echo "</td><td align='right'><span class='name'>" . formatbytes($file_size) . " <a href='back/miter/delete_miter_image.php?d=" . $file_name . "' onclick='return confirm_delete()'><img src='buttons/delete.png' class='button_side'></a></span>";
						echo "</td></tr>";
					}
				?>
			</table>
		</td>
	</tr>
</table>		