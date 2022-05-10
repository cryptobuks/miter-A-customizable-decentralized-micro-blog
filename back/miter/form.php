<?
// if quote
if (isset($_GET['quote'])) {
	$quote_id = $_GET['quote'];
}
	// if edit last
if (isset($_GET['edit'])) {
	$edit_last_id = $_GET['edit'];
	// get edit last
	$edit_last_file = $edit_last_id . '.txt';
	$edit_last_dir = 'miters/';
	$edit_last_get = $edit_last_dir . '' . $edit_last_file;
	$edit_last = file($edit_last_get, FILE_IGNORE_NEW_LINES);
	$edit_last_text  = $edit_last[0];
	$edit_last_text  = str_replace("<br />", "\n", $edit_last_text);
	$quote_id        = $edit_last[1];
	$edit_last_img   = $edit_last[2];
	$edit_last_tpimg = $edit_last[3];
	$edit_last_odate = $edit_last[4];
	$edit_last_gdate = $edit_last[5];
	$edit_last_udate = $edit_last[6];
} 
?>

<script src='back/js/miter_upper.js'></script>

<table class="gen_table">
	<tr>
		<td class='gen_td'>
			
			<form name="miterform" id="miterform" action="back/miter/<? if (strlen($edit_last_id) != 0) { echo 'replace.php'; } else { echo 'miter.php'; } ?>" method="POST" enctype="multipart/form-data" onsubmit="return validate()">
				
				<textarea id="miter" name="miter" class="miter_input" onkeyup="limiter();"><? echo $edit_last_text; ?></textarea>
				
				<table class="sub_button_table">
					<tr>
						<td class="td_button" align="center">
							<table class="button_table_holder">
								<tr>
									<td>                 
										<input type="button" value="b" title="b" onclick="addTag(this)" class="format_button" style="font-weight:bold;" />
										<input type="button" value="i" title="i" onclick="addTag(this)" class="format_button" style="font-style:italic;" />
										<input type="button" value="u" title="u" onclick="addTag(this)" class="format_button" style="text-decoration:underline;" />
										<input type="button" value="s" title="s" onclick="addTag(this)" class="format_button" style="text-decoration:line-through;" />
										<input type="button" value="&#9661;" class="drop_button" onclick="more_buttons()" />
									</td>
								</tr>
							</table>

							<?
								$more_buttons = 'back/miter/miter_inserts_form.php';
							?>
							
							</tr>
							<tr>
								<td class="td_button" align="center">
									<table class="miter_button_table_holder">
										<tr>
											<td> 
												<span class='tenon' id='button_div' style='display:none;'><? include $more_buttons; ?></span>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>

					<table class="sub_link_table">
						<tr>
							<td class="link_td" align="right">
								<?
								if (strlen($quote_id) != 0) {
									echo "<input id='url' name='url' class='miter_url_field' value='" . $quote_id . "'>";
								} else {
									?>
									<table class="sub_url_table">
										<tr>
											<td class="sub_url_td_left">
												<input id="url" name="url" class="miter_url_field" value="" placeholder="Link, Tag(s), Image or Video">
											</td>
											<td class="sub_url_td_right">
												<label class="upload_label">
												<input type="file" name="upload" id="upload" class="upload_style" accept="image/*">
												+
												</label>
											</td>
										</tr>
									</table>
									<?
								}
								?>
							</td>
						</tr>
					</table>

<?
if (strlen($edit_last_id) != 0) {
echo "<input type='hidden' id='img' name='img' value='" . $edit_last_img . "'>";
echo "<input type='hidden' id='odate' name='odate' value='" . $edit_last_odate . "'>";
echo "<input type='hidden' id='gdate' name='gdate' value='" . $edit_last_gdate . "'>";
echo "<input type='hidden' id='udate' name='udate' value='" . $edit_last_udate . "'>";
echo "<input type='hidden' id='filename' name='filename' value='" . $edit_last_id . "'>";
}
?>

					<table cellpadding="0" cellspacing="0" class="sub_submit_table">
						<tr>
							<td class="submit_td" align="right">
								<table cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td class="submit_td_box">							
											<input type="checkbox" id="overchar"><label for="overchar" class="overchar_label"></label>
										</td>
										<td class="submit_td">
											<script>
												document.write("<input type='submit' name='submit' id='sub_but' value="+count+" class='miter_user_submit'>");
											</script>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

<script src='back/js/autosize.js'></script>
<script> autosize(document.querySelectorAll('textarea')); </script>
<script src="back/js/miter_lower.js"></script>
<script src="back/js/dirtyforms.js"></script>
<script>$('form').dirtyForms();</script>
<script src='back/js/miter_inserts.js'></script>

				</form>
			</td>
		</tr>
	</table>