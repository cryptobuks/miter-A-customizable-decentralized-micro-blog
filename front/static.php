<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<span class='title'><? echo $title; ?></span>
		</td>
	</tr>
</table>
<table class='static_table'>
	<tr>
		<td class='static_td'>
			<span class='tenon'><? echo $tenon; ?></span>
			<div class='space_permalink'></div>
			<a href='' class='permalink' style='color:silver;'><? echo $odate; ?></a><br />
<? if ($login == true) { ?>
			<div class='space_buttons'></div>
			<table class='button_table'>
				<tr>
					<td class='button_td'>
						<a href='index.php?e=<? echo $tenon_id; ?>#edit'><img src='buttons/edit.png' class='button_img_edit' title='Edit' alt='Edit'></a>
					</td>
					<td class='button_td'>
						<a href='back/tenon/delete_static.php?d=<? echo $tenon_id; ?>' onclick='return confirm_delete()'><img src='buttons/delete.png' class='button_img' title='Delete' alt='Delete'></a>
					</td>
				</tr>
			</table>
<?	}  ?>
		</td>
	</tr>
</table>
<?
	if ($login == true) {
		if (isset($_GET['e'])) {
			echo "<div class='bump'></div>";
			include 'back/tenon/edit.php';
		}
	}
?>