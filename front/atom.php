<?
	
	$feed_print = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
	$feed_print .= "<feed xmlns='http://www.w3.org/2005/Atom'>";
	
	$user_file = '../user/user.xml';
	$user_get = simplexml_load_file($user_file);
	$user_array = $user_get->xpath("/miter/user[@id='probe']");
	$user_username  = $user_array[0]->name;
	$user_title     = $user_array[0]->title;
	$user_avatar    = $user_array[0]->avatar;
	$user_bio       = $user_array[0]->bio;
	
	$serv_name = $_SERVER['SERVER_NAME'];
	
	// WARNING --> Uncomment next line if using /miter folder
	// $serv_name = $serv_name . "/miter";
	
	$feed_print .= "<title>" . $user_title . "</title>";
	$feed_print .= "<subtitle>" . $user_bio . "</subtitle>";
	$feed_print .= "<link href='http://" . $serv_name . "/front/atom.php' rel='self' />";
	$feed_print .= "<id>http://" . $serv_name . "/</id>";
	$feed_print .= "<logo>http://" . $serv_name . "/uploads/" . $user_avatar . "</logo>";
	
	$files_listed = array();
	foreach (glob('../miters/*.txt') as $quip) {
		$files_listed[] = $quip;
	}
	arsort($files_listed);
	
	$newest_file = reset($files_listed);
	$last_update = date(DATE_ATOM,filectime($newest_file));
	
	$feed_print .= "<updated>" . $last_update . "</updated>";
	
	$start_page = 0;
	$m_page_show = 20;
	
	$master_arc = array_slice($files_listed, $start_page, $m_page_show, true);
	
	foreach($master_arc as $step_miter) {
		$arc = file($step_miter, FILE_IGNORE_NEW_LINES);
		
		$last_data  = $arc[0];
		$last_link  = $arc[1];
		$last_img   = $arc[2];
		$last_tpimg = $arc[3];
		$last_odate = $arc[4];
		$last_gdate = $arc[5];
				
		$o_perm = str_replace('../miters/','',$step_miter);
		$o_perm = str_replace('.txt','',$o_perm);
		$file_mod = date(DATE_ATOM,filemtime($step_miter));
		
		$miter = htmlspecialchars($last_data);
		// $miter = str_replace('&lt;br /&gt;','<br />',$miter);
		// $miter = preg_replace_callback('@(https?://([-\w\.]+)+(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)?)@', function($m) { return '<a href="'.$m[1].'" target="_blank">'.substr($m[1], 0, 30).'</a>'; }, $miter);
		$miter = preg_replace('/(?<!\w)#([0-9a-zA-Z]+)/m', '&lt;a href="http://' . $serv_name . '/index.php?q=$1"&gt;#$1&lt;/a&gt;', $miter);
	    $miter = preg_replace('#\[b\](.*?)\[/b\]#','&lt;b&gt;$1&lt;/b&gt;', $miter);
		$miter = preg_replace('#\[i\](.*?)\[/i\]#','&lt;i&gt;$1&lt;/i&gt;', $miter);
		$miter = preg_replace('#\[u\](.*?)\[/u\]#','&lt;u&gt;$1&lt;/u&gt;', $miter);
		$miter = preg_replace('#\[s\](.*?)\[/s\]#','&lt;s&gt;$1&lt;/s&gt;', $miter);
		if (substr($miter, 0, 3) == '&gt') {
			$miter = preg_replace('/&gt;([^<]*)/m', '&lt;font color="green"&gt;&gt;$1&lt;/font&gt;', $miter, 1);
		}
		$miter = preg_replace('/<br \/>&gt;([^<]*)/m', '&lt;br /&gt;&lt;font color="green"&gt;&gt;$1&lt;/font&gt;', $miter);
		
		$miter_link = $last_link;
		
		if (strlen($last_img) !== 0) {
			
			if (strpos($last_img, '.jpg') !== false || strpos($last_img, '.jpeg') !== false) { $media_type = "image/jpeg"; }
			else if (strpos($last_img, '.png') !== false) { $media_type = "image/png"; }
			else if (strpos($last_img, '.gif') !== false) { $media_type = "image/gif"; }
			
			$miter_link = "http://" . $serv_name . "" . $last_img;
			
			} else if (strlen($last_link) !== 0) {
			
			$last_link = str_replace('gifv','mp4',$last_link);
			if (strpos($last_link, '.jpg') !== false || strpos($last_link, '.jpeg') !== false) { $media_type = "image/jpeg"; }
			else if (strpos($last_link, '.png') !== false) { $media_type = "image/png"; }
			else if (strpos($last_link, '.gif') !== false) { $media_type = "image/gif"; }
			else if (strpos($last_link, '.bmp') !== false) { $media_type = "image/bmp"; }
			else if (strpos($last_link, '.svg') !== false) { $media_type = "image/svg"; }
			else if (strpos($last_link, '.mp4') !== false) { $media_type = "video/mp4"; }
			else if (strpos($last_link, '.webm') !== false) { $media_type = "video/webm"; }
			else { $media_type = "text/html"; }
			
			$miter_link = $last_link;
			
		}
		
		$feed_print .= "<entry>";
		$feed_print .= "<title>" . substr($miter, 0, 50) . "</title>";
		$feed_print .= "<link href='http://" . $serv_name . "/index.php?miter=" . $o_perm . "' rel='alternate' />";
		if (strlen($miter_link) !== 0) {
			$feed_print .= "<link rel='enclosure' type='" . $media_type . "' href='" . $miter_link . "' />";
		}
		$feed_print .= "<id>http://" . $serv_name . "/index.php?miter=" . $o_perm . "</id>";
		$feed_print .= "<updated>" . $file_mod . "</updated>";
		$feed_print .= "<content>" . $miter . "</content>";
		$feed_print .= "<author>";
		$feed_print .= "<name>" . $user_username . "</name>";
		$feed_print .= "</author>";
		$feed_print .= "</entry>";
		
	}	
	
	$feed_print .= "</feed>";
	
	header("Content-type: text/xml");
	echo $feed_print;
	
?>