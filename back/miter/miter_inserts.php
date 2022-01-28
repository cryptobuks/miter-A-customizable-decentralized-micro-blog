<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<span class='title'>Miter Inserts</span>
		</td>
	</tr>
</table>

<table class="gen_table">
	<tr>
		<td class='gen_td'>
		
			<form name="button_form" id="button_form" action="back/miter/miter_inserts_edit.php" method="POST" enctype="multipart/form-data">
				
			<table class="input_table">
				<tr>
					<td class="input_td">
						<textarea id="more_butt" name="more_butt" class="tenon_input" placeholder="Content"><? include 'back/miter/miter_inserts.txt'; ?></textarea>
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
	
</form>