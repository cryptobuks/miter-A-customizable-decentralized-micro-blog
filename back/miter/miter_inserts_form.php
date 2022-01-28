<?
	$buttons_get = 'back/miter/miter_inserts.txt';
	
	$buttons_arc = file($buttons_get, FILE_IGNORE_NEW_LINES);
?>
	<select id="more_buttons_dropdown" class="more_buttons_dropdown_style">
	<option value="">Select</option>
<?
	foreach($buttons_arc as $buttons_button) {
		?>
		<option value="<? echo htmlspecialchars($buttons_button); ?>"><? echo htmlspecialchars($buttons_button); ?></option>
		<?
	}
?>
	</select>