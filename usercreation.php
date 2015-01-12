<?php
	//session_save_path("/nfs/stak/students/a/anderjen/sessions"); stored in htaccss
	session_start();
	ini_set('display_errors',1); 
?>
<!DOCTYPE html>
<html>
<head>
	<!--Jen Anderson-->
	<title>Create new user page</title>
	<link rel="stylesheet" type="text/css" href="projectstyle.css">
	<meta charset="UTF-8">
	<script src = "jquery.min.js"></script>
	<style>
		#wrap 
		{ 
			padding: 240px;
			width: 1025px; 
		}
	</style>
</head>
<body>
<div id = "wrap">
	<h1 id = "header">SOAR client website</h1>
<form action = "login.php" method = "post">
	<!--Make all information required -->
	New username (must be at least 6 letters/numbers long): <input type = "text" name = "newusername"></input><br>
	New password (must be at least 6 letters/numbers long): <input type = "text" name = "newpassword"></input><br>
	First name: <input type = "text" name = "newfname"></input><br>
	Last name: <input type = "text" name = "newlname"></input><br>
	Phone number: <input type = "text" name = "newphone"></input><br>
	Street(1): <input type = "text" name = "newstreet1"></input><br>
	Street(2): <input type = "text" name = "newstreet2"></input><br>
	City: <input type = "text" name = "newcity"></input><br>
	State: <input type = "text" name = "newstate"></input><br>
	Zip: <input type = "text" name = "newzip"></input><br>
	SSN: <input type = "text" name = "newssn"></input><br>
	DOB: <input type = "text" name = "newdob"></input><br>
	<input type = "submit" value = "Submit new user information"></input>
</form>
<form action = "login.php" method = "post">
	<input type = "submit" value = "back"></input>
</form>
</html>
</body>
</html>
