<?
		echo "<table class='quote_container'><tr><td>";
		$quote_link = str_replace('index.php?miter=','miters/',$last_link);
		$quote_link = $quote_link . '.txt';
		$quote_arc = file($quote_link, FILE_IGNORE_NEW_LINES);
		$quote_data  = $quote_arc[0];
		$quote_link  = $quote_arc[1];
		$quote_img   = $quote_arc[2];
		$quote_tpimg = $quote_arc[3];
		$quote_odate = $quote_arc[4];
		$quote_gdate = $quote_arc[5];
		$quote = htmlspecialchars($quote_data);
		$quote = str_replace('&lt;br /&gt;','<br />',$quote);
		$quote = preg_replace_callback('@(https?://([-\w\.]+)+(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)?)@', function($w) { return '<a href="'.$w[1].'" target="_blank">'.substr($w[1], 0, 30).'..</a>'; }, $quote);
		$quote = preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/m', '<a href="index.php?q=$1">#$1</a>', $quote);
		$quote = preg_replace('#\[b\](.*?)\[/b\]#','<b>$1</b>', $quote);
		$quote = preg_replace('#\[i\](.*?)\[/i\]#','<i>$1</i>', $quote);
		$quote = preg_replace('#\[u\](.*?)\[/u\]#','<u>$1</u>', $quote);
		$quote = preg_replace('#\[s\](.*?)\[/s\]#','<s>$1</s>', $quote);
		if (substr($quote, 0, 3) == '&gt') { $quote = preg_replace('/&gt;([^<]*)/m', '<span class="green_text">&gt;$1</span>', $quote, 1); }
		$quote = preg_replace('/<br \/>&gt;([^<]*)/m', '<br /><span class="green_text">&gt;$1</span>', $quote);
		
		$quote_url_scheme = parse_url($last_link, PHP_URL_SCHEME);
		$quote_url_host = parse_url($last_link, PHP_URL_HOST);
		$quote_user_file = $quote_url_scheme . '://' . $quote_url_host;
		$quote_user_file = $quote_user_file . '/user/user.xml';
		$quote_user_get = simplexml_load_file($quote_user_file);
		$quote_user_array = $quote_user_get->xpath("/miter/user[@id='probe']");
		$quote_user_username =  $quote_user_array[0]->name;
		echo "<span class='name'>" . $quote_user_username . " ";

		$q_start = new DateTime('now');
		$q_end  = new DateTime($quote_gdate);
		$q_dif = $q_start->diff($q_end);
		$q_d = $q_dif->days;
		$q_h = $q_dif->h;
		$q_m = $q_dif->i;
		if ($q_d < 1) {
			if ($q_h < 1) {
				$q_since = $q_m . "m";
			} else {
				$q_since = $q_h . "h";
			}
		} else {
			$q_since = $q_d . "d";
		}
		echo "&middot; " . $q_since . "</span><br />";
		echo "<div class='quote_name'></div>";
		echo $quote . "<br />";
		echo "<div class='quote_permalink'></div>";
		echo "<a href='" . $last_link . "' target='_blank' class='permalink' style='color:silver;'>" . $quote_odate . "</a>";
		echo "</td>
		</tr>
		</table>";
?>