<?
$log_file = fopen('log.txt', 'w');
fclose($log_file);
echo "<script>window.close();</script>";
?>