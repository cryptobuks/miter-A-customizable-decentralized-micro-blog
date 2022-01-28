<?
	$buttons_get = 'back/tenon/tenon_inserts.txt';
	
	$buttons_arc = file($buttons_get, FILE_IGNORE_NEW_LINES);
?>
	<select id="more_buttons_dropdown" class="more_buttons_dropdown_style">
	<option value="">Select</option>
<?
	foreach($buttons_arc as $buttons_button) {
		$label_insert = explode('||', $buttons_button);
		?>
		<option value="<? echo htmlspecialchars($label_insert[1]); ?>"><? echo htmlspecialchars($label_insert[0]); ?></option>
		<?
	}
?>
	</select>