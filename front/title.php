<?
	echo $user_title;
	echo " - ";
	if (isset($_GET['t'])) {
		$tenon_id = $_GET['t'];
		$tenon_dir = 'tenons/' . $tenon_id . '.txt';
		$tenon_data = file_get_contents($tenon_dir);
		list($title, $odate, $gdate, $tenon) = explode("|&|", $tenon_data);
		$page_title = $title;
	} else if (isset($_GET['e'])) {
		if ($login == true) {
			$tenon_id = $_GET['e'];
			$tenon_dir = 'tenons/' . $tenon_id . '.txt';
			$tenon_data = file_get_contents($tenon_dir);
			list($title, $odate, $gdate, $tenon) = explode("|&|", $tenon_data);
			$page_title = 'Edit ' . $title;
		}
	} else if (isset($_GET['q'])) {
		$page_title = 'Search "' . $_GET['q'] . '"';
	} else if (isset($_GET['a'])) {
		$page_title = 'Tenons';
	} else if (isset($_GET['u'])) {
		$u_title = $_GET['u'];
			if ($u_title == 'new') {
				$page_title = 'New Tenon';
			} else if ($u_title == 'panels') {
				$page_title = 'Panels';
			} else if ($u_title == 'upload') {
				$page_title = 'Upload';
			} else if ($u_title == 'miter_images') {
				$page_title = 'Miter Images';
			} else if ($u_title == 'tenon_images') {
				$page_title = 'Tenon Images';
			} else if ($u_title == 'tenon_files') {
				$page_title = 'Files';
			} else if ($u_title == 'settings') {
				$page_title = 'Settings';
			} else if ($u_title == 'miter_inserts') {
				$page_title = 'Miter Inserts';
			} else if ($u_title == 'tenon_inserts') {
				$page_title = 'Tenon Inserts';
			} else if ($u_title == 'help') {
				$page_title = 'Help';
			} else if ($u_title == 'tenons') {
				$page_title = 'Tenons';
			}
	} else {
		$page_title = $user_username;
	}
	echo $page_title;
?>