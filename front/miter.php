<script>
	$(document).ready(function() {
		$('.crop_container').on('click', toggleImage);
		function toggleImage(event) {
			$(event.target).closest('.crop_container').toggleClass('expanded');
		}
	});
</script>

<?
if($login == true) {
	// insert form
	include 'back/miter/form.php';
	echo "<div class='bump'></div>";
}

// isolated
if (isset($_GET['miter'])) {
	include 'iso.php';

} else {
	// pin
	if (strlen($user_pin) !== 0) {
		if (isset($_GET['page'])) {
		} else {
			include 'pin.php';
		}
	}
	// start number
	if (isset($_GET['page'])) {
		$page_id = $_GET['page'];
		$start_page = $page_id;
		// Show Last 10
		$m_page_show = 10;
	} else {
		$start_page = 0;
		// Show Last 5
		$m_page_show = 5;
	}
	// list files
	$files_listed = array();
	foreach (glob('miters/*.txt') as $quip) {
		$files_listed[] = $quip;
	}
	arsort($files_listed);
	$master_arc = array_slice($files_listed, $start_page, $m_page_show, true);

	// array
	foreach($master_arc as $step_miter) {
		$arc = file($step_miter, FILE_IGNORE_NEW_LINES);
		// print
		include 'echo.php';
	}

	// next page
	if ($miter_count <= $m_page_show || ($page_id + $m_page_show) >= $miter_count){
		echo "<table class='next_page'>
		<tr>
		<td>
		<a href='' style='text-decoration:none;color:#808080;'>Next Page</a>
		</td>
		</tr>
		</table>";
	} else {
		$next_page = $start_page + $m_page_show;
		echo "<table class='next_page'>
		<tr>
		<td>
		<a href='index.php?page=" . $next_page . "' style='text-decoration:none;color:#000;'>Next Page</a>
		</td>
		</tr>
		</table>";
	}

}
?>		