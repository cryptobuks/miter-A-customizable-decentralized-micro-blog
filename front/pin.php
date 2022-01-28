<?
	// location
	$pin_url_txt = $user_pin;
	$pin_get = 'miters/' . $pin_url_txt . '.txt';
	
	// array
	$pin_arc = file($pin_get, FILE_IGNORE_NEW_LINES);
	
	$pin_data  = $pin_arc[0];
	$pin_link  = $pin_arc[1];
	$pin_img   = $pin_arc[2];
	$pin_tpimg = $pin_arc[3];
	$pin_odate = $pin_arc[4];
	$pin_gdate = $pin_arc[5];
    
	$pin = htmlspecialchars($pin_data);
	$pin = str_replace('&lt;br /&gt;','<br />',$pin);
	$pin = preg_replace_callback('@(https?://([-\w\.]+)+(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)?)@', function($p) { return '<a href="'.$p[1].'" target="_blank">'.substr($p[1], 0, 30).'</a>'; }, $pin);
	$pin = preg_replace('/(?<!\w)#([0-9a-zA-Z]+)/m', '<a href="index.php?q=$1">#$1</a>', $pin);
	$pin = preg_replace('#\[b\](.*?)\[/b\]#','<b>$1</b>', $pin);
	$pin = preg_replace('#\[i\](.*?)\[/i\]#','<i>$1</i>', $pin);
	$pin = preg_replace('#\[u\](.*?)\[/u\]#','<u>$1</u>', $pin);
	$pin = preg_replace('#\[s\](.*?)\[/s\]#','<s>$1</s>', $pin);
	if (substr($miter, 0, 3) == '&gt') {
		$miter = preg_replace('/&gt;([^<]*)/m', '<span class="green_text">&gt;$1</span>', $miter, 1);
	}
	$miter = preg_replace('/<br \/>&gt;([^<]*)/m', '<br /><span class="green_text">&gt;$1</span>', $miter);
	
	// table miter
	echo "<table class='last_table_pin'>
	<tr><td class='last_table_td'>";
	
	// user name
	echo "<span class='name'>" . $user_username . " ";
	
	// days ago
	$p_start = new DateTime('now');
	$p_end  = new DateTime($pin_gdate);
	$p_dif = $p_start->diff($p_end);
	$p_d = $p_dif->days;
	$p_h = $p_dif->h;
	$p_m = $p_dif->i;
    if ($p_d < 1) {
		if ($p_h < 1) {
			$p_since = $p_m . "m";
			} else {
			$p_since = $p_h . "h";
		}
		} else {
		$p_since = $p_d . "d";
	}
	echo "&middot; " . $p_since . "</span><br />";
	
	echo "<div class='space_name'></div>";
	
	// miter
	echo $pin . "<br />";
	
	// upload
	if (strlen($pin_img) !== 0) {
		echo "<a href='" . $pin_img . "' target='_blank'><img src='uploads/" . $pin_img . "' class='embed_img' alt=''></a>";
		echo "<div class='space_img_bot'></div>";
	}
	
    // link
    if (strlen($pin_link) != 0 || strlen($pin_tpimg) != 0) {
		
		// retired 59019
		if (strlen($pin_tpimg) != 0){
			$pin_link = $pin_tpimg;
		}
		
		// gifv embed bug fix
		$pin_link = str_replace('gifv','mp4',$pin_link);
		
		// youtube
		if (strpos($pin_link, 'youtube.com/') !== false || strpos($pin_link, 'youtu.be/') !== false) {
			
			// upload then no youtube embed
			if (strlen($pin_img) !== 0) { // null
				} else if (strpos($pin_link, 'youtu') !== false) {
				preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $pin_link, $yt_p_match);
				$yt_p_id = $yt_p_match[1];
				echo "<div class='embed_yt_iso'>
				<iframe src='https://www.youtube.com/embed/" . $yt_p_id . "' frameborder='0' allowfullscreen class='yt'></iframe>
				</div>";
				echo "<div class='space_img_bot'></div>";
			}
			
			// video
			} else if (strpos($pin_link, '.mp4') !== false || strpos($pin_link, '.webm') !== false) {
			
			// upload then no video
			if (strlen($pin_img) !== 0) { // null
				} else if (strpos($pin_link, '.mp4') !== false) {
				echo "<div class='embed_yt_iso'>
				<video class='video_miter' controls><source src='" . $pin_link . "' type='video/mp4'></video>
				</div>";
				echo "<div class='space_img_bot'></div>";
				} else if (strpos($pin_link, '.webm') !== false) {
				echo "<div class='embed_yt_iso'>
				<video class='video_miter' controls><source src='" . $pin_link ."' type='video/webm'></video>
				</div>";
				echo "<div class='space_img_bot'></div>";
			}
			
			// image
			} else if (strpos($pin_link, '.jpg') !== false || strpos($pin_link, '.jpeg') !== false || strpos($pin_link, '.png') !== false || strpos($pin_link, '.gif') !== false) {
			
			// upload then no image
			if (strlen($pin_img) !== 0) { // null
				} else {
				echo "<a href='" . $pin_link . "' target='_blank'><img src='" . $pin_link . "' class='embed_img' alt=''></a>";
				echo "<div class='space_img_bot'></div>";
			}
			
			// quote
			} else if (strpos($pin_link, 'index.php?miter=') !== false) {
			
			echo "<table class='quote_container'><tr><td>";
			$quote_p_link = str_replace('index.php?miter=','miters/',$pin_link);
			$quote_p_link = $quote_p_link . '.txt';
			$quote_p_arc = file($quote_p_link, FILE_IGNORE_NEW_LINES);
			$quote_p_data  = $quote_p_arc[0];
			$quote_p_link  = $quote_p_arc[1];
			$quote_p_img   = $quote_p_arc[2];
			$quote_p_tpimg = $quote_p_arc[3];
			$quote_p_odate = $quote_p_arc[4];
			$quote_p_gdate = $quote_p_arc[5];
			$quote_p = htmlspecialchars($quote_p_data);
			$quote_p = str_replace('&lt;br /&gt;','<br />',$quote_p);
			$quote_p = preg_replace_callback('@(https?://([-\w\.]+)+(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)?)@', function($w_p) { return '<a href="'.$w_p[1].'" target="_blank">'.substr($w_p[1], 0, 30).'..</a>'; }, $quote_p);
			$quote_p = preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/m', '<a href="index.php?q=$1">#$1</a>', $quote_p);
			$quote_p = preg_replace('#\[b\](.*?)\[/b\]#','<b>$1</b>', $quote_p);
			$quote_p = preg_replace('#\[i\](.*?)\[/i\]#','<i>$1</i>', $quote_p);
			$quote_p = preg_replace('#\[u\](.*?)\[/u\]#','<u>$1</u>', $quote_p);
			$quote_p = preg_replace('#\[s\](.*?)\[/s\]#','<s>$1</s>', $quote_p);
			if (substr($quote, 0, 3) == '&gt') { $quote = preg_replace('/&gt;([^<]*)/m', '<span class="green_text">&gt;$1</span>', $quote, 1); }
			$quote = preg_replace('/<br \/>&gt;([^<]*)/m', '<br /><span class="green_text">&gt;$1</span>', $quote);
			$quote_page_contents_p = file_get_contents($pin_link);
			preg_match("/<title>(.+)<\/title>/i",$quote_page_contents_p,$quote_p_username);
			$quote_p_username = str_replace('Miter -','',$quote_p_username[1]);
			echo "<span class='name'>@" . $quote_p_username . " ";
			$q_start_p = new DateTime('now');
			$q_end_p  = new DateTime($quote_p_gdate);
			$q_dif_p = $q_start_p->diff($q_end_p);
			$q_d_p = $q_dif_p->days;
			$q_h_p = $q_dif_p->h;
			$q_m_p = $q_dif_p->i;
			if ($q_d_p < 1) {
				if ($q_h_p < 1) {
					$q_since_p = $q_m_p . "m";
					} else {
					$q_since_p = $q_h_p . "h";
				}
				} else {
				$q_since_p = $q_d_p . "d";
			}
			echo "&middot; " . $q_since_p . "</span><br />";
			echo "<div class='quote_name'></div>";
			echo $quote_p . "<br />";
			echo "<div class='quote_permalink'></div>";
			echo "<a href='" . $pin_link . "' target='_blank' class='permalink' style='color:silver;'>" . $quote_p_odate . "</a>";
			echo "</td>
			</tr>
			</table>";
			
			// link
			} else {
			if (strlen($pin_link) != 0) {
				echo "<table class='link_container'><tr><td>";
				echo "<a href='" . $pin_link . "' target='_blank'>" . $pin_link . "</a>";
				echo "</td>
				</tr>
				</table>";
			}
		}
	}
	
    echo "<div class='space_permalink'></div>";
    
    // permalink date
    echo "<a href='index.php?miter=" . $pin_url_txt . "' class='permalink' style='color:silver;'>" . $pin_odate . "</a><br />";
    
    // footer
    echo "<table class='footer_table'>
	<tr>
	<td class='footer_button_td'>";
	
	// quote
	if($login == true) {
        $quote_p_protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
        $quote_p_host = $_SERVER['HTTP_HOST'];
        echo "<a href='index.php?quote=" . $quote_p_protocol . "://" . $quote_p_host . "/index.php?miter=" . $pin_url_txt . "'><img src='buttons/quote.png' class='footer_button_img' title='Quote'></a>";
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
	echo "<a href='index.php?miter=" . $pin_url_txt . "'><img src='buttons/share.png' class='footer_button_img' title='Share' alt='Share'></a>";
	
	echo "</td>
	<td class='footer_button_td'>";
	
	// pinned
	echo "<img src='buttons/pin.png' class='footer_button_img' title='Pinned' alt='Pinned'>";
	
	if($login == true) {
        echo "</td>
		<td class='footer_button_td'>";
        
        // delete
        echo "<a href='back/miter/delete.php?d=" . $pin_url_txt . "' onclick='return confirm_delete()'><img src='buttons/delete.png' class='footer_button_img' title='Delete' alt='Delete'></a>";
		
        echo "</td>
		<td class='footer_button_td'>";
        
        // edit
        echo "<a href='index.php?edit=" . $pin_url_txt . "'><img src='buttons/edit.png' class='footer_button_img' title='Edit' alt='Edit'></a>";
		
        echo "</td>
		<td class='footer_button_td'>";
		
        // unpin
        echo "<a href='back/miter/pin.php'><img src='buttons/pin.png' class='footer_button_img' title='Unpin' alt='Unpin'></a>";
	}  
	
    echo "</td>
	</tr>
	</table>";   
    
    // close table
    echo "</td>
	</tr>
	</table>
	</div>";
    
	echo "<div class='bump'></div>";
?>