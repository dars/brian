<?php
session_start();
require_once('config.php');
$img_name = $db->get_row('SELECT * FROM property');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>後端管理</title>
		<link rel="stylesheet" href="resources/css/ext-all.css" />
		<link rel="stylesheet" href="css/fileuploadfield.css" />
		<link rel="stylesheet" href="css/Growl.css" />
		<link rel="stylesheet" href="css/admin.css" />
		<script type="text/javascript" src="js/ext-base.js"></script>
		<script type="text/javascript" src="js/ext-all-debug.js"></script>
		<script type="text/javascript" src="js/ext-lang-zh_TW.js"></script>
		<script type="text/javascript" src="js/FileUploadField.js"></script>
		<script type="text/javascript" src="js/Growl.js"></script>
		<script type="text/javascript" src="js/login.js"></script>
		<script type="text/javascript" src="js/render.js"></script>
		<script type="text/javascript" src="js/grid.js"></script>
		<script type="text/javascript" src="js/form.js"></script>
		<script type="text/javascript" src="js/admin.js"></script>
		
	</head>
	<body>
		<div id="header"><h1>索取資料、預約看屋清單</h1></div>
		<div id="window-win"></div>
	</body>
</html>
