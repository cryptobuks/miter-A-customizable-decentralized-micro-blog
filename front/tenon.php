<?
	$var_sort = $_GET['sort'];
?>

<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<table class='list_header_inset'>
				<tr>
					<td align='left'>
						<span class='title'>Tenons</span>
					</td>
					<td align='right'>
						<?
							if ($var_sort == 'date') {
								echo "<span class='title'><a href='?a=&sort=abc'>abc</a> | date</span>";
							} else {
								echo "<span class='title'>abc | <a href='?a=&sort=date'>date</a></span>";
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
					$file_list = glob("tenons/*.txt");
					
					if ($var_sort == 'date') {
						usort($file_list, function($newest, $oldest) {
						return filemtime($newest) < filemtime($oldest);
					});
					}
					
					foreach($file_list as $file_name) {
						$file_name = str_replace("tenons/","",$file_name);
						$file_name = str_replace(".txt","",$file_name);
						$file_print = str_replace("_"," ",$file_name);
						
						echo "<tr><td align='left'><span class='tenon'>" . $i++ . ". <a href='index.php?t=" . $file_name . "' target='_blank'>" . substr($file_print, 0, $char_count) . "</a></span>";
						if($login == true) {
							echo "</td><td align='right'><span class='name'><a href='index.php?e=" . $file_name . "#edit'><img src='buttons/edit.png' class='button_side' alt='Edit'></a>&nbsp;&nbsp;&nbsp;";
							echo "<a href='back/tenon/delete_static_archive.php?d=" . $file_name . "' onclick='return confirm_delete()'><img src='buttons/delete.png' class='button_side' alt='Delete'></a></span>";
						}
						echo "</td>
						</tr>";
					}
				?> 
			</table>
		</td>
	</tr>
</table>