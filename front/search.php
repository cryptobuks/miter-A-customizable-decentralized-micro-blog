<script>
	$(document).ready(function() {
		$('.crop_container').on('click', toggleImage);
		function toggleImage(event) {
			$(event.target).closest('.crop_container').toggleClass('expanded');
		}
	});
</script>

<?
	$search_get = $_GET['q'];
	
	// start number
	if (isset($_GET['page'])) {
		$page_id = $_GET['page'];
		$start_page = $page_id;
		// Show Last 10
		$m_page_show = 10;
		} else {
		$start_page = 0;
		$m_page_show = 10;
	}
	
?>

<table class='static_header'>
	<tr>
		<td class='static_header_td'>
			<span class='title'>Search</span>
		</td>
	</tr>
</table>  

<table class='static_table'>
	<tr>
		<td class='static_td' align='center'>
			
			<form name='search_form' id='search_form' action='index.php'>
				<input type='input' name='q' id='search_field' class='search_field' value='<? echo $search_get; ?>'> <input type='submit' class='search_submit' value='Search'>
			</form>
			
		</td>
	</tr>
</table>

<div class='bump'></div>

<?
	// search miters
	foreach (glob("miters/*.txt") as $miter_search) {
		$miter_contents = file_get_contents($miter_search);
		if (!empty($miter_contents) && stripos($miter_contents, $search_get)) {
			$miter_found[] = $miter_search;
		}
	}
	
	krsort($miter_found);
	$miter_files = count($miter_found);

	if (strlen($search_get) !== 0) {
?>

<table class='static_table_no_title'>
	<tr>
		<td class='static_td' align='right'>
			<span class='tenon'><b><? echo $miter_files; ?></b> results for "<? echo $search_get; ?>"</span>
		</td>
	</tr>
</table>

<?
	} else {
?>

<table class='static_table_no_title'>
	<tr>
		<td class='static_td' align='right'>
			<span class='tenon'>No search results</span>
		</td>
	</tr>
</table>

<?
	}
?>

<div class='bump'></div>

<?
	// miter print
	$miter_print_arc = array_slice($miter_found, $start_page, $m_page_show, true);
	
	if ($miter_files > 0) {
		// set print miter array
		foreach($miter_print_arc as $step_miter) {
			$arc = file($step_miter, FILE_IGNORE_NEW_LINES);
			include 'echo.php';
		}
		
		// next page
		if ($miter_files <= $m_page_show || ($page_id + $m_page_show) >= $miter_files){
			echo "<table class='next_page'><tr><td><a href='' style='text-decoration:none;color:#808080;'>Next Page</a></tr></td></table>";
			} else {
			$next_page = $start_page + $m_page_show;
			echo "<table class='next_page'><tr><td><a href='index.php?q=" . $search_get . "&page=" . $next_page . "' style='text-decoration:none;color:#000;'>Next Page</a></tr></td></table>";
		}
		
		} else {
	
	}
?>