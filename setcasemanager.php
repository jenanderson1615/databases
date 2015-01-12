<!DOCTYPE html> <?php
	session_start();
	//do ziptastic on page so that only zip has to be entered, then 
correct city appears above it.  City not visible/changable at first
	//check entry in zip to make sure its a valid zip
	//Same form for all information- make it so admins can use this 
page too. ?> <html> <head>
	<META http-equiv="Content-Style-Type" content="text/css">
	<link rel="stylesheet" type="text/css" href="projectstyle.css">
	<title>Set case manager</title>
	<!--Lets an administrator select clients who don't have a case 
manager assigned yet to be on their roster.-->
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
	</style> </head> <body>
	<div id = "wrap">
	<h1 id = "header">SOAR client website</h1> <?php
	$cmclients = array();
	$clientsusernames = array();
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", 
"Fd9lqRLTkguN4PNO", "anderjen-db");
	if ($mysqli->connect_errno)
	{
		echo "Failed to connect to MySQL";
	}
	if ( !($stmt = $mysqli->prepare("SELECT first_name, last_name, 
username FROM clients WHERE casemanager = 3") ) )
	{
		echo "prepare failed";
	}
		//Run the statement
		if (!$stmt->execute())
		{
			echo "Execute failed";
		}
		if (!$stmt->bind_result($first_name, $last_name, 
$clientusername))
		{
			echo "Error binding result";
		}
		else
		{
			$stmt->store_result();
		}
		$x = 0;
		while ($stmt->fetch())
		{
			$cmclients[$x] = ($first_name . " " . 
$last_name);
			$clientsusernames[$x] = $clientusername;
			$x++;
		}
?>
	<form action = "adminpage.php" method = "post" name = 
"selectuser">
		List of clients with no case manager set:<br>
		<ul style = "list-style-type: none;"> <?php
		for ($i = 0; $i < count($cmclients); $i++)
		{ ?>
			<li><input type = "checkbox" 
name="addedclientarr[]" value="<?php echo $clientsusernames[$i]; 
?>"><?php echo $cmclients[$i]; ?></li> <?php
		}
?>
	<input type = "submit"	value = "Add these clients to your 
list"><br>
	<input type = "submit" value = "Back"><br>
	<input type = "hidden" name = "addedclients" value = "set">
	</ul>
	</form> </div> </body> </html>
