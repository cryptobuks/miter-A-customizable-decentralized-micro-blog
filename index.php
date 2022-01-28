<?
	session_start();

	// user data
	$user_file = 'user/user.xml';
	$user_get = simplexml_load_file($user_file);
	$user_array = $user_get->xpath("/miter/user[@id='probe']");
	$user_username =  $user_array[0]->name;
	$user_title =     $user_array[0]->title;
	$user_avatar =    $user_array[0]->avatar;
	$user_bio =       $user_array[0]->bio;
	$user_bg =        $user_array[0]->bg;
	$user_header =    $user_array[0]->header;
	$user_border =    $user_array[0]->border;
	$user_link =      $user_array[0]->link;
	$user_pin =       $user_array[0]->pin;

	// logged in?
	$user_log_in = str_replace('@','',$user_username);
	if($_SESSION['miter'] == $user_log_in) {
		$login = true;
	} else {
		$login = false;
	}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="ALL,INDEX,FOLLOW,ARCHIVE" />
	<meta name="revisit-after" content="1 day" />

	<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	<link rel="alternate" type="application/atom+xml" href="front/atom.php" />
	<link rel="stylesheet" href="style.css">

	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

	<?

	// admin css
	if($login == true){
		echo "<link href='back/admin.css' rel='stylesheet'>";
	}

	// mobile or desktop
	function isMobile() {
		return preg_match("/(android|webos|avantgo|iphone|ipad|ipod|blackberry|iemobile|bolt|boost|cricket|docomo|fone|hiptop|mini|opera mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}

	// miter form js
	if($login == true){
		echo "<script src='back/js/index.js'></script>";
	}

	// count miters
	$dat_dir = "miters/";
	$miter_count = 0;
	$count_files = glob($dat_dir . "*.txt");
	if ($count_files){
		$miter_count = count($count_files);
	}

	// count tenons
	$ten_dir = "tenons/";
	$tenon_count = 0;
	$count_tenon = glob($ten_dir . "*.txt");
	if ($count_tenon){
		$tenon_count = count($count_tenon);
	}
	?>

	<style>
		<? include 'front/style.php'; ?>
	</style>


	<title><?
	echo $user_title;

	if (isset($_GET['t'])) {
		echo " - ";
		$page_title = $_GET['t'];
		$page_title = str_replace('_',' ',$page_title);
		echo $page_title;
	}
	?></title>

</head>

<body>

	<center>

		<? 
		if(isMobile()) {
			echo "<table class='mobile'><tr><td>";
		} else {
			echo "<table class='whole'><tr><td class='left_td'>";
		}
		?>

		<?
		// static
		if (isset($_GET['t'])) {

			include 'front/static.php';

			if(isMobile()) {
				echo "<div class='bump'></div>";
			}

		// user page
		} else if (isset($_GET['u'])) {

			if($login == true) {

				$get_user = $_GET['u'];
				if ($get_user == 'new') {
					include 'back/tenon/new.php';
				} else if ($get_user == 'panels') {
					include 'back/panels/panels.php';
				} else if ($get_user == 'upload') {
					include 'back/upload/upload.php';
				} else if ($get_user == 'miter_images') {
					include 'back/miter/miter_images.php';
				} else if ($get_user == 'tenon_images') {
					include 'back/tenon/tenon_images.php';
				} else if ($get_user == 'tenon_files') {
					include 'back/tenon/tenon_files.php';
				} else if ($get_user == 'settings') {
					include 'back/admin/settings.php';
				} else if ($get_user == 'miter_inserts') {
					include 'back/miter/miter_inserts.php';
				} else if ($get_user == 'tenon_inserts') {
					include 'back/tenon/tenon_inserts.php';
				} else if ($get_user == 'help') {
					include 'back/help.php';							
				}

				if(isMobile()) {
					echo "<div class='bump'></div>";
				}

			}

		// edit static
		} else if (isset($_GET['e'])) {

			if($login == true) {
				include 'front/static.php';

				if(isMobile()) {
					echo "<div class='bump'></div>";
				}

			}

		// search 
		} else if (isset($_GET['q'])) {

			include 'front/search.php';

			if(isMobile()) {
				echo "<div class='bump'></div>";
			}

		// tenons
		} else if (isset($_GET['a'])) {

			include 'front/tenon.php';

			if(isMobile()) {
				echo "<div class='bump'></div>";
			}

		// miter iso
		} else if (isset($_GET['miter'])) {

			include 'front/miter.php';

		// miter page
		} else if (isset($_GET['page'])) {

			include 'front/miter.php';

			if(isMobile()) {
				echo "<div class='bump'></div>";
			}

		// miter
		} else {

			include 'front/miter.php';

			if(isMobile()) {
				echo "<div class='bump'></div>";
			}

		}

		// desktop table break
		if(isMobile()) {
		} else {
			echo "</td><td class='center_td'>";
			echo "</td><td class='right_td'>";

		}

		// menu
		include 'front/panels.php';

		// admin menu
		if($login == true) {
			echo "<div class='bump'></div>";
			include 'back/menu.php';
		}

		?>

		</td>
	</tr>
</table>

</center>

</body>
</html>