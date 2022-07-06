<?

    $last_data   = $arc[0]; // miter
    $last_link   = $arc[1]; // link image video
    $last_img    = $arc[2]; // upload
    $last_tpimg  = $arc[3]; // retired 59019
    $last_odate  = $arc[4]; // otc date
    $last_gdate  = $arc[5]; // gregorian date
    $last_thread = $arc[6]; // thread

	// permalink address build
    $o_perm = str_replace('miters/','',$step_miter);
    $o_perm = str_replace('.txt','',$o_perm);
    
    $miter = htmlspecialchars($last_data);
    $miter = str_replace('&lt;br /&gt;','<br />',$miter);
    $miter = preg_replace_callback('@(https?://([-\w\.]+)+(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)?)@', function($m) { return '<a href="'.$m[1].'" target="_blank">'.substr($m[1], 0, 47).'</a>'; }, $miter);
    $miter = preg_replace('/(?<!\w)#([0-9a-zA-Z]+)/m', '<a href="index.php?q=$1">#$1</a>', $miter);
    $miter = preg_replace('#\[b\](.*?)\[/b\]#','<b>$1</b>', $miter);
    $miter = preg_replace('#\[i\](.*?)\[/i\]#','<i>$1</i>', $miter);
    $miter = preg_replace('#\[u\](.*?)\[/u\]#','<u>$1</u>', $miter);
    $miter = preg_replace('#\[s\](.*?)\[/s\]#','<s>$1</s>', $miter);
    if (substr($miter, 0, 3) == '&gt') {
    	$miter = preg_replace('/&gt;([^<]*)/m', '<span class="green_text">&gt;$1</span>', $miter, 1);
    }
    $miter = preg_replace('/<br \/>&gt;([^<]*)/m', '<br /><span class="green_text">&gt;$1</span>', $miter);

    // table miter
    echo "<table class='last_table'>
    <tr>
    <td class='last_table_td'>";
    
    // user name
    echo "<span class='name'>" . $user_username . " ";
    
    // days ago
    $d_start = new DateTime('now');
    $d_end  = new DateTime($last_gdate);
    $d_dif = $d_start->diff($d_end);
    $d_d = $d_dif->days;
    $d_h = $d_dif->h;
    $d_m = $d_dif->i;
    if ($d_d < 1) {
    	if ($d_h < 1) {
    		$d_since = $d_m . "m";
    	} else {
    		$d_since = $d_h . "h";
    	}
    } else {
    	$d_since = $d_d . "d";
    }
    echo "&middot; " . $d_since . "</span><br />";

    echo "<div class='space_name'></div>";

	// miter
    echo $miter . "<br />";

	// upload
    if (strlen($last_img) !== 0) {
    	echo "<div class='crop_container'><img src='uploads/" . $last_img . "' alt=''></div>";
    	echo "<div class='space_img_bot'></div>";
    }

	// link
    if (strlen($last_link) != 0 || strlen($last_tpimg) != 0) {

		// retired 59019
    	if (strlen($last_tpimg) != 0){
    		$last_link = $last_tpimg;
    	}

		// gifv embed bug fix
    	$last_link = str_replace('gifv','mp4',$last_link);

		// youtube
    	if (strpos($last_link, 'youtube.com/') !== false || strpos($last_link, 'youtu.be/') !== false) {

		// upload then no youtube
		if (strlen($last_img) !== 0) { // null
		} else if (strpos($last_link, 'youtu') !== false) {
			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $last_link, $yt_match);
			$yt_id = $yt_match[1];
			echo "<div class='embed_yt'>
			<iframe src='https://www.youtube.com/embed/" . $yt_id . "' frameborder='0' allowfullscreen class='yt'></iframe>
			</div>";
			echo "<div class='space_img_bot'></div>";
		}
		
	// video
	} else if (strpos($last_link, '.mp4') !== false || strpos($last_link, '.webm') !== false) {
		
		// upload then no video
		if (strlen($last_img) !== 0) { // null
		} else if (strpos($last_link, '.mp4') !== false) {
			echo "<div class='embed_video'>
			<video class='video_miter' controls><source src='" . $last_link . "' type='video/mp4'></video>
			</div>";
			echo "<div class='space_img_bot'></div>";
		} else if (strpos($last_link, '.webm') !== false) {
			echo "<div class='embed_video'>
			<video class='video_miter' controls><source src='" . $last_link ."' type='video/webm'></video>
			</div>";
			echo "<div class='space_img_bot'></div>";
		}
		
	// image
	} else if (strpos($last_link, '.jpg') !== false || strpos($last_link, '.jpeg') !== false || strpos
	($last_link, '.png') !== false || strpos($last_link, '.gif') !== false || strpos($last_link, '.svg') !== false
	|| strpos($last_link, '.webp') !== false || strpos($last_link, '.JPG') !== false) {
		
		// upload then no image
		if (strlen($last_img) !== 0) { // null
		} else {
			echo "<div class='crop_container'><img src='" . $last_link . "' alt=''></div>";
			echo "<div class='space_img_bot'></div>";
		}
		
	// quote
	} else if (strpos($last_link, 'index.php?miter=') !== false) {
		include 'front/quote.php';
		
	// link
	} else {
		if (strlen($last_link) != 0) {
			echo "<table class='link_container'><tr><td>";
			echo "<a href='" . $last_link . "' target='_blank'>" . $last_link . "</a>";
			echo "</td>
			</tr>
			</table>"; 
		}
	}
}

echo "<div class='space_permalink'></div>";

// permalink date
echo "<a href='index.php?miter=" . $o_perm . "' class='permalink' style='color:silver;'>" . $last_odate . "</a><br />";

// footer
echo "<table class='footer_table'>
<tr>
<td class='footer_button_td'>";

// quote
if($login == true) {
	$quote_protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
	$quote_host = $_SERVER['HTTP_HOST'];
	echo "<a href='index.php?quote=" . $quote_protocol . "://" . $quote_host . "/index.php?miter=" . $o_perm . "'><img src='buttons/quote.png' class='footer_button_img' title='Quote'></a>";
} else {
	echo "<img src='buttons/quote.png' class='footer_button_img' title='Quote' alt='Quote'>";
}
echo "</td>
<td class='footer_button_td'>";

// like
echo "<img src='buttons/like.png' class='footer_button_img' title='Like' alt='Like'>";

echo "</td>
<td class='footer_button_td'>";

// share
echo "<a href='index.php?miter=" . $o_perm . "'><img src='buttons/share.png' class='footer_button_img' title='Share' alt='Share'></a>";

if($login == true) {
	echo "</td>
	<td class='footer_button_td'>";

	// delete
	echo "<a href='back/miter/delete.php?d=" . $o_perm . "' onclick='return confirm_delete()'><img src='buttons/delete.png' class='footer_button_img' title='Delete' alt='Delete'></a>";

	echo "</td>
	<td class='footer_button_td'>";

	// edit
	echo "<a href='index.php?edit=" . $o_perm . "'><img src='buttons/edit.png' class='footer_button_img' title='Edit' alt='Edit'></a>";

	echo "</td>
	<td class='footer_button_td'>";

	// pin
	echo "<a href='back/miter/pin.php?miter=" . $o_perm . "'><img src='buttons/pin.png' class='footer_button_img' title='Pin' alt='Pin'></a>";

	echo "</td>
	<td class='footer_button_td'>";

    // file
	echo "<a href='" . $step_miter . "' target='_blank'><img src='buttons/file.png' class='footer_button_img' title='File' alt='File'></a>";		
}  

echo "</td>
</tr>
</table>"; 

// close table
echo "</td>
</tr>
</table>"; 

echo "<div class='bump'></div>";
?>								