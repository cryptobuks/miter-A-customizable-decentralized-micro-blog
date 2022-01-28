<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="icon" type="image/x-icon" href="../../images/but/favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="../../images/but/favicon.ico" />
		<title>Upload Tenon Images</title>
	</head>
	<body>
		<center>
			<form name="upform" enctype="multipart/form-data" method="post" action="upload_tenon_load.php">
				<?
					$uploadsNeeded = $_POST['uploadsNeeded'];
					for ($i=0; $i < $uploadsNeeded; $i++) {
					?>
					<input name="uploadFile<? echo $i; ?>" type="file" id="uploadFile<? echo $i; ?>" /><br />
				<? } ?>
				<input name="uploadsNeeded" type="hidden" value="<? echo $uploadsNeeded; ?>" />
				<input type="submit" name="Submit" value="Upload" />
			</form>
		</center>
	</body>
</html>