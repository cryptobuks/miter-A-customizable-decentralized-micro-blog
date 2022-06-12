<script src='back/js/user.js'></script>

<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<span class='title'>Profile</span>
		</td>
	</tr>
</table>

<table class='static_table'>
	<tr>
		<td class='static_td'>
			
			<span class="tenon">40 Character Limit &rarr; No @ Symbol</span>
			<div class='bump'></div>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_user_form" action="back/admin/user_name.php" method="POST" onsubmit="return validate_user()">
							<input id="miter_user" name="miter_user" class="settings_field" maxlength="40" value="<? $miter_user = str_replace('@', '', $user_username); echo $miter_user; ?>"><br />
							<input type="submit" name="user_submit" value="Change Miter Name" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
			
			
			<div class='bump'></div>
			
			
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_title_form" action="back/admin/user_title.php" method="POST" onsubmit="return validate_title()">
						<input id="user_title" name="user_title" class="settings_field" maxlength="40" value="<? echo $user_title; ?>">
							<input type="submit" name="user_submit" value="Change Title" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
				
				
			<div class='bump'></div>
			
			
			<span class="tenon">Images will be resized to 50x50px</span>
			<div class='bump'></div>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_avatar" action="back/admin/avatar.php" enctype="multipart/form-data" method="POST">
							<input name="avatar" type="file" id="avatar" class="settings_field_file">
							<input type="submit" name="user_submit" value="Change Avatar" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
			
			
			<div class='bump'></div>
				
				
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_bio_form" action="back/admin/bio.php" method="POST" onsubmit="return validate_bio()">
						<input id="miter_bio" name="miter_bio" class="settings_field" maxlength="40" value="<? echo $user_bio; ?>">
							<input type="submit" name="user_submit" value="Change Bio" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
					
					
			<div class='bump'></div>
					
					
			<span class="tenon">Favicons must be saved as <i>favicon.ico</i></span>
			<div class='bump'></div>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_favicon" action="back/admin/favicon.php" enctype="multipart/form-data" method="POST">
							<input name="favicon" type="file" id="favicon" class="settings_field_file">
							<input type="submit" name="user_submit" value="Change Favicon" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<div class='bump'></div>


<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<span class='title'>Customize</span>
		</td>
	</tr>
</table>
		
<table class='static_table'>
	<tr>
		<td class='static_td'>
					
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_color_form" action="back/admin/color.php" method="POST">
						<input type="color" id="miter_color" name="miter_color" class="settings_color_field" value="<? echo $user_bg; ?>">
							<input type="submit" name="color_submit" value="Change Background Color" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
						
						
			<div class='bump'></div>
						
						
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_header_form" action="back/admin/color_header.php" method="POST">
						<input type="color" id="miter_color_header" name="miter_color_header" class="settings_color_field" value="<? echo $user_header; ?>">
						<input type="submit" name="color_submit" value="Change Header Color" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
			
			
			<div class='bump'></div>
			
			
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_border_form" action="back/admin/color_border.php" method="POST">
							<input type="color" id="miter_color_border" name="miter_color_border" class="settings_color_field" value="<? echo $user_border; ?>">
							<input type="submit" name="color_submit" value="Change Border Color" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
			
				
			<div class='bump'></div>
			
			
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_link_form" action="back/admin/color_link.php" method="POST">
							<input type="color" id="miter_color_link" name="miter_color_link" class="settings_color_field" value="<? echo $user_link; ?>">
							<input type="submit" name="color_submit" value="Change Link Color" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>


<div class='bump'></div>


<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<span class='title'>Data</span>
		</td>
	</tr>
</table>

<table class='static_table'>
	<tr>
		<td class='static_td'>
			
			
			<span class="tenon">miters/*.txt</span>
			<div class='bump'></div>
			<?
				// miter dir size
				$dir_size = 0;
				$dir_loc = 'miters';
				$miter_files = glob($dir_loc.'/*');
				foreach($miter_files as $miter_path){
					is_file($miter_path) && $dir_size += filesize($miter_path);
					is_dir($miter_path) && get_dir_size($miter_path);
				}
					if ($dir_size > 1048576) {
					$miter_size = $dir_size / 1048576;
					$miter_size = "" . number_format($miter_size, 2) . " mb";
					} else if ($dir_size > 1024 && $dir_size <= 1048576) {
					$miter_size = $dir_size / 1024;
					$miter_size = "" . number_format($miter_size, 2) . " kb";
					} else {
					$miter_size = "" . number_format($dir_size) . " bytes";
				}
			?>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_button_form" action="back/admin/zip.php" method="POST" target="_blank">
							<input class="settings_field" value="<? echo $miter_size;	?>" readonly>
							<input type="submit" value="Download Miter Archive" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
			
			
			<div class='bump'></div>
			
			
			<span class="tenon">tenons/*.txt</span>
			<div class='bump'></div>
			<?
				// tenon dir size
				$ten_size = 0;
				$ten_dir_loc = 'tenons';
				$ten_files = glob($ten_dir_loc.'/*');
				foreach($ten_files as $ten_path){
					is_file($ten_path) && $ten_dir_size += filesize($ten_path);
					is_dir($ten_path) && get_dir_size($ten_path);
				}
					if ($ten_dir_size > 1048576) {
					$ten_size = $ten_dir_size / 1048576;
					$ten_size = "" . number_format($ten_size, 2) . " mb";
					} else if ($ten_dir_size > 1024 && $ten_dir_size <= 1048576) {
					$ten_size = $ten_dir_size / 1024;
					$ten_size = "" . number_format($ten_size, 2) . " kb";
					} else {
					$ten_size = "" . number_format($ten_dir_size) . " bytes";
				}
			?>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_button_form" action="back/admin/zip_tenon.php" method="POST" target="_blank">
							<input class="settings_field" value="<? echo $ten_size; ?>" readonly>
							<input type="submit" value="Download Tenon Archive" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
			
			
			<div class='bump'></div>
			
			
			<span class="tenon">user/*.{xml,txt} | panels/*.txt</span>
			<div class='bump'></div>
			
			<?
				// user xml file size
				$xml_dir = 'user/user.xml';
				$xml_size = filesize($xml_dir);
				
				// panel dir size
				$pan_size = 0;
				$pan_dir_loc = 'panels';
				$pan_files = glob($pan_dir_loc.'/*');
				foreach($pan_files as $pan_path){
					is_file($pan_path) && $pan_dir_size += filesize($pan_path);
					is_dir($pan_path) && get_dir_size($pan_path);
				}
				$pan_dir_size = $pan_dir_size + $xml_size;
				if ($pan_dir_size > 1024) {
					$pan_size = $pan_dir_size / 1024;
					$pan_size = "" . number_format($pan_size, 2) . " kb";
					} else {
					$pan_size = "" . number_format($pan_dir_size) . " bytes";
				}
			?>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_button_form" action="back/admin/zip_user.php" method="POST" target="_blank">
							<input class="settings_field" value="<? echo $pan_size; ?>" readonly>
							<input type="submit" value="Download User Data" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>
			
			
			<div class='bump'></div>
			
			
			<span class="tenon">uploads/ (miter)</span>
			<div class='bump'></div>
			<?
				// miter upload dir size
				$upl_size = 0;
				$upl_dir_loc = 'uploads';
				$upl_files = glob($upl_dir_loc.'/*');
				foreach($upl_files as $upl_path){
					is_file($upl_path) && $upl_dir_size += filesize($upl_path);
					is_dir($upl_path) && get_dir_size($upl_path);
				}
					if ($upl_dir_size > 1048576) {
					$upl_size = $upl_dir_size / 1048576;
					$upl_size = "" . number_format($upl_size, 2) . " mb";
					} else if ($upl_dir_size > 1024 && $upl_dir_size <= 1048576) {
					$upl_size = $upl_dir_size / 1024;
					$upl_size = "" . number_format($upl_size, 2) . " kb";
					} else {
					$upl_size = "" . number_format($upl_dir_size) . " bytes";
				}
			?>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_button_form" method="POST">
							<input class="settings_field_solo" value="<? echo $upl_size; ?>" readonly>
						</form>
					</td>
				</tr>
			</table>
			
			
			<div class='bump'></div>


			<span class="tenon">images/ (tenon)</span>
			<div class='bump'></div>
			<?
				// tenon image dir size
				$img_size = 0;
				$img_dir_loc = 'images';
				$img_files = glob($img_dir_loc.'/*');
				foreach($img_files as $img_path){
					is_file($img_path) && $img_dir_size += filesize($img_path);
					is_dir($img_path) && get_dir_size($img_path);
				}
					if ($img_dir_size > 1048576) {
					$img_size = $img_dir_size / 1048576;
					$img_size = "" . number_format($img_size, 2) . " mb";
					} else if ($img_dir_size > 1024 && $img_dir_size <= 1048576) {
					$img_size = $img_dir_size / 1024;
					$img_size = "" . number_format($img_size, 2) . " kb";
					} else {
					$img_size = "" . number_format($img_dir_size) . " bytes";
				}
			?>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_button_form" method="POST">
							<input class="settings_field_solo" value="<? echo $img_size; ?>" readonly>
						</form>
					</td>
				</tr>
			</table>
			
			
			<div class='bump'></div>


			<span class="tenon">docs/ </span>
			<div class='bump'></div>
			<?
				// tenon doc dir size
				$doc_size = 0;
				$doc_dir_loc = 'docs';
				$doc_files = glob($doc_dir_loc.'/*');
				foreach($doc_files as $doc_path){
					is_file($doc_path) && $doc_dir_size += filesize($doc_path);
					is_dir($doc_path) && get_dir_size($doc_path);
				}
					if ($doc_dir_size > 1048576) {
					$doc_size = $doc_dir_size / 1048576;
					$doc_size = "" . number_format($doc_size, 2) . " mb";
					} else if ($doc_dir_size > 1024 && $doc_dir_size <= 1048576) {
					$doc_size = $doc_dir_size / 1024;
					$doc_size = "" . number_format($doc_size, 2) . " kb";
					} else {
					$doc_size = "" . number_format($doc_dir_size) . " bytes";
				}
			?>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_button_form" method="POST">
							<input class="settings_field_solo" value="<? echo $doc_size; ?>" readonly>
						</form>
					</td>
				</tr>
			</table>

			<div class='bump'></div>
			
			
			<span class="tenon">log.txt</span>
			<div class='bump'></div>
			
			<?
				// log file size
				$log_dir = 'back/admin/log.txt';
				$log_size = filesize($log_dir);
				if ($log_size > 1024) {
					$log_size = $log_size / 1024;
					$log_size = "" . number_format($log_size, 2) . " kb";
					} else {
					$log_size = "" . number_format($log_size) . " bytes";
				}
			?>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_button_form" action="back/admin/log_purge.php" method="POST" target="_blank">
							<input class="settings_field" value="<? echo $log_size; ?>" readonly>
							<input type="submit" value="Purge Log File" class="settings_submit">
						</form>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>					

<div class='bump'></div>

<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<span class='title'>Delete Miter Archive</span>
			
		</td>
	</tr>
</table>

<table class='static_table'>
	<tr>
		<td class='static_td'>						
			
			<span class="tenon">Warning: This action is permanent</span>
			<div class='bump'></div>
			<table class='setting_table'>
				<tr>
					<td>
						<form name="miter_button_form" action="back/admin/delete_miter_archive.php" method="POST" target="_blank">
							<input type="submit" value="Delete Archive" class="settings_submit_solo" style="background-color:#af7579;color:#fff;" onclick="return confirm('Delete Archive?!')">
						</form>
					</td>
				</tr>
			</table>
			
		</td>
	</tr>
</table>