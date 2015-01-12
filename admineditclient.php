<?php
	//session_save_path("/nfs/stak/students/a/anderjen/sessions"); stored in htaccss
	session_start();
	ini_set('display_errors',1); 
?>
<!DOCTYPE html>
<html>
<head>
	<!--Jen Anderson-->
	<title>Administrator edit user</title>
	<link rel="stylesheet" type="text/css" href="projectstyle.css">
	<meta charset="UTF-8">
	<script src = "jquery.min.js"></script>
	<style>
		table.center
		{
			margin-left:auto; 
			margin-right:auto;
		}
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
<?php
	if (!(isset($_SESSION['username'])))
	{
		echo "You're not logged in yet.";
?>
		<form action = "login.php" method = "post">
			<input type = "submit" value = "Login"></input>
		</form>
<?php
	}
	else
	{
		$clientusername = $_POST['usertoedit'];
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", "Fd9lqRLTkguN4PNO", "anderjen-db");
		if ($mysqli->connect_errno) 
		{
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		if ( !($stmt = $mysqli->prepare("SELECT first_name, last_name, street1, street2, city, state, zip, dob, ssn, phone, next_appointment FROM clients WHERE username = '$clientusername'") ) ) 
		{
			echo "prepare failed";
		}
		//Run the statement
		if (!$stmt->execute()) 
		{
			//echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			login_wrong();
		}
		if (!$stmt->bind_result($first_name, $last_name, $street1, $street2, $city, $state, $zip, $dob, $ssn, $phone, $next_appointment))
		{
			echo "Error binding result: (" . $stmt->errno . ") " . $stmt->error;
			//login_wrong();
		}
		else
		{
			$stmt->store_result();
		}
		$stmt->fetch();
		//At this point have the information for the user being edited in php variables
?>
		<form action = "adminpage.php" method = "POST"><h3>Update anything that needs changing:<h3><br>
			<table style = " border-spacing: 10px; text-align: center;" class = "center">
			<tr>
				<td>
					Phone:
				</td>
				<td>
					<input type = "text" name = "newphone" value = "<?php echo $phone; ?>"></input><br>
				</td>
			</tr>
			<tr>
				<td>
					Street(1):  
				</td>
				<td>
					<input type = "text" name = "newaddress1" value = "<?php echo $street1; ?>"></input><br>
				</td>
			</tr>
			<tr>
				<td>
					Street(2): 
				</td>
				<td>
					<input type = "text" name = "newaddress2" value = "<?php echo $street2; ?>"></input><br>
				</td>
			</tr>
			<tr>
				<td>
					City: 
				</td>
				<td>
					<input type = "text" name = "newcity" value = "<?php echo $city; ?>"></input><br>
				</td>
			</tr>
			<tr>
				<td>
					State:  
				</td>
				<td>
					<input type = "text" name = "newstate" value = "<?php echo $state; ?>"></input><br>
				</td>
			</tr>
			<tr>
				<td>
					Zip:  
				</td>
				<td>
					<input type = "text" name = "newzip" value = "<?php echo $zip; ?>"></input><br>
				</td>
			</tr>	
		</table><br><br>
	<div style = "margin-left: 1.5cm;">
		<input type = "submit" value = "Save your changes or go back"></input>
		<input type = "hidden" name = "useredited" value = "set"></input>
		<input type = "hidden" name = "editedclient" value = "<?php echo $clientusername; ?>"></input>
	</div>
	</form>
<?php
	}
?>
</div>
</body>
</html>
