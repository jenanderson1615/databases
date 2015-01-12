<!DOCTYPE html>
<?php
	session_start();
	//do ziptastic on page so that only zip has to be entered, then correct city appears above it.  City not visible/changable at first
	//check entry in zip to make sure its a valid zip
	//Same form for all information- make it so admins can use this page too.
?>
<html>
<head>
	<META http-equiv="Content-Style-Type" content="text/css">
	<link rel="stylesheet" type="text/css" href="projectstyle.css">
	<title>Change client information</title>
	<meta charset="UTF-8">
	<style>
		table.center
		{
			margin-left:auto; 
			margin-right:auto;
		}
		#wrap 
		{ 
			width: 1300px; 
			padding: 100px;
		}
	</style>
</head>
<body>
	<div id = "wrap">
	<h1 id = "header">SOAR client website</h1>
<?php
	if (!(isset($_SESSION['username'])))
	{
		echo "You're not logged in yet.";
?>

		<form action = "login.php" method = "post">
			<input type = "submit" value = "Login">
		</form>
<?php
	}
	else
	{
?>
			<form action = "userpage.php" method = "POST"><h3>Update anything that needs changing:<h3><br>

	<table style = " border-spacing: 10px; text-align: center;" class = "center">
		<tr>
			<td>
				Phone:
			</td>
			<td>
				<input type = "text" name = "newphone" value = "<?php echo $_SESSION['phone']; ?>"></input><br>
			</td>
		</tr>
		<tr>
			<td>
				Street(1):  
			</td>
			<td>
				<input type = "text" name = "newaddress1" value = "<?php echo $_SESSION['street1']; ?>"></input><br>
			</td>
		</tr>
		<tr>
			<td>
				Street(2): 
			</td>
			<td>
				<input type = "text" name = "newaddress2" value = "<?php echo $_SESSION['street2']; ?>"></input><br>
			</td>
		</tr>
		<tr>
			<td>
				City: 
			</td>
			<td>
				<input type = "text" name = "newcity" value = "<?php echo $_SESSION['city']; ?>"></input><br>
			</td>
		</tr>
		<tr>
			<td>
				State:  
			</td>
			<td>
				<input type = "text" name = "newstate" value = "<?php echo $_SESSION['state']; ?>"></input><br>
			</td>
		</tr>
		<tr>
			<td>
				Zip:  
			</td>
			<td>
				<input type = "text" name = "newzip" value = "<?php echo $_SESSION['zip']; ?>"></input><br>
			</td>
		</tr>	
	</table><br><br>
	<div style = "margin-left: 1.5cm;">
		<input type = "submit" value = "Save your changes or go back"></input>
		<input type = "hidden" name = "newaddress" value = "set"></input>
	</div>
</form>
<?php
	}
?>
	</div>
	</body>
	</html>
