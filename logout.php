<!DOCTYPE html>
<html>
<head>
	<title>LOGOUT</title>
	<!--Declare the character encoding-->
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="projectstyle.css">
	<style>
		table.center
		{
			margin-left:auto; 
			margin-right:auto;
		}
		#wrap 
		{ 
			width: 1000px; 
			padding: 210px;
		}
	</style>
<?php
	session_start();
	unset($_SESSION['username']);
	session_destroy();
?>
</head>
<body>
<div id = "wrap">
	<h1 id = "header">SOAR client website</h1>
	<form action = "login.php" method = "POST">
		Login again to see your page.
		<div><input type = "submit" value = "login again"></div>
	</form>
</div>
</body>
</html>
