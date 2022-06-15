<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style>
 	body {
		padding: 0;
		margin: 10px;
		background-color: #eeeeee;
 	}
 	.log {
		font:normal 13px Courier;
		color: #000000;
		line-height: 19px;
		white-space: nowrap;
	}
</style>
</head>

<title>Log</title>

<body>
<span class="log">
<?
	if ($log_file = fopen("log.txt", "r")) {
		$i = 1;
    	while (!feof($log_file)) {
        	$log_br = fgets($log_file);
         	echo $i . ". " . $log_br . "<br />";
         	$i++;
    	}
    fclose($log_file);
 	}
?>
</span>
</body>
</html>