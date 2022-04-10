<?
	$tenon_id = $_GET['e'];
	$tenon_dir = 'tenons/' . $tenon_id . '.txt';
	$tenon_data = file_get_contents($tenon_dir);
	list($title, $odate, $gdate, $tenon) = explode("|&|", $tenon_data);
	// replace <br /> with line break
	$tenon = str_replace("<br />", "\n", $tenon);
?>

<a name="edit"></a>
<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<span class='title'>Edit Tenon</span>
		</td>
	</tr>
</table>
	
<table class="gen_table">
	<tr>
		<td class='gen_td'>
			
			<form name="tenonform" id="tenonform" action="back/tenon/tenon.php" method="POST" enctype="multipart/form-data" onsubmit="return validate()">
				
			<table class="title_table">
				<tr>
					<td class="title_td">
						<input id="title" name="title" class="title_field" value="<? echo $title; ?>" required>
					</td>
				</tr>
			</table>
			
			<table class="input_table">
				<tr>
					<td class="input_td">
						<textarea id="tenon" name="tenon" class="tenon_input"><? echo $tenon; ?></textarea>
					</td>
				</tr>
			</table>
			
			<?
				$more_buttons = 'back/tenon/tenon_inserts_form.php';
			?>

			<table class="more_button_table_holder">
				<tr>
					<td> 
						<? include $more_buttons; ?>
					</td>
				</tr>
			</table>
			
			<table class="submit_table">
				<tr>
					<td class="submit_td" align="center">
						<input type="submit" name="submit" value="Update" class="tenon_submit">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
	
<script src='back/js/autosize.js'></script>
<script> autosize(document.querySelectorAll('textarea')); </script>
<script src="back/js/panels_inserts.js"></script>
<script src="back/js/tenon_form.js"></script>

</form>