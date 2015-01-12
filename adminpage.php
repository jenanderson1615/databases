<?php
	//session_save_path("/nfs/stak/students/a/anderjen/sessions"); stored in htaccss
	session_start();
	ini_set('display_errors',1); 
?>
<!DOCTYPE html>
<html>
<head>
	<!--Jen Anderson-->
	<title>Administrator home page</title>
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
		$myusername=$_SESSION['username'];
		echo "Welcome to the admin page! <br>";
		if (isset($_POST['useredited']))
		{
			$usernameeditedclient = $_POST['editedclient'];
			$newstreet1 = $_POST['newaddress1'];
			$newstreet2 = $_POST['newaddress2'];
			$newcity = $_POST['newcity'];
			$newstate = $_POST['newstate'];
			$newzip = $_POST['newzip'];
			$newphone = $_POST['newphone'];
			
			$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", "Fd9lqRLTkguN4PNO", "anderjen-db");
			if ($mysqli->connect_errno) 
			{
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET street1 = '$newstreet1' WHERE username = '$usernameeditedclient'") ) ) 
			{
				echo "prepare failed";
			}
			//Run the statement
			if (!$stmt->execute()) 
			{
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			
			if ($mysqli->connect_errno) 
			{
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET street2 = '$newstreet2' WHERE username = '$usernameeditedclient'") ) ) 
			{
				echo "prepare failed";
			}
			//Run the statement
			if (!$stmt->execute()) 
			{
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			
			if ($mysqli->connect_errno) 
			{
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET city = '$newcity' WHERE username = '$usernameeditedclient'") ) ) 
			{
				echo "prepare failed";
			}
			//Run the statement
			if (!$stmt->execute()) 
			{
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			
			if ($mysqli->connect_errno) 
			{
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET state = '$newstate' WHERE username = '$usernameeditedclient'") ) ) 
			{
				echo "prepare failed";
			}
			//Run the statement
			if (!$stmt->execute()) 
			{
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			
			if ($mysqli->connect_errno) 
			{
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET zip = '$newzip' WHERE username = '$usernameeditedclient'") ) ) 
			{
				echo "prepare failed";
			}
			//Run the statement
			if (!$stmt->execute()) 
			{
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
			
			if ($mysqli->connect_errno) 
			{
				echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			}
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET phone = '$newphone' WHERE username = '$usernameeditedclient'") ) ) 
			{
				echo "prepare failed";
			}
			//Run the statement
			if (!$stmt->execute()) 
			{
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
		}
		
		if (isset($_POST['addedclients']))
		{
			if(!(empty($_POST['addedclientarr'])))
			{
				
				$num = count($_POST['addedclientarr']);
				for($i=0; $i < $num; $i++)
				{
					$newclientusername = $_POST['addedclientarr'][$i];
					$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", "Fd9lqRLTkguN4PNO", "anderjen-db");
					if ($mysqli->connect_errno) 
					{
						echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
					}
					if ( !($stmt = $mysqli->prepare("UPDATE clients 
													SET casemanager = 
													(SELECT AID 
													 FROM administrators
													 WHERE username = '$myusername')
													WHERE username = '$newclientusername'") ) ) 
													
					{
						echo "prepare failed";
					}
					//Run the statement
					if (!$stmt->execute()) 
					{
						echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
					}
				}
			}
		}
?>
		Clients:<br>
<?php
		$cmclients;
		$clientsusernames;
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", "Fd9lqRLTkguN4PNO", "anderjen-db");
		if ($mysqli->connect_errno) 
		{
			echo "Failed to connect to MySQL";
		}
		if ( !($stmt = $mysqli->prepare("SELECT c.first_name, c.last_name, c.username FROM clients c INNER JOIN  administrators a ON c.casemanager = a.AID WHERE a.username = '$myusername'") ) ) 
		{
			echo "prepare failed";
		}
		//Run the statement
		if (!$stmt->execute()) 
		{
			echo "Execute failed";
		}
		if (!$stmt->bind_result($first_name, $last_name, $clientusername))
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
			$cmclients[$x] = ($first_name . " " . $last_name);
			$clientsusernames[$x] = $clientusername;
			$x++;
		}
		for ($i = 0; $i < count($cmclients); $i++)
		{
?>
			<form action = "admineditclient.php" method = "post" value = "test">
				<?php
					echo $cmclients[$i] . " ";
				?>
				<input type = "submit" name = "submit" value = "Edit"></input>
				<input type = "hidden" name = "usertoedit" value = "<?php echo $clientsusernames[$i]; ?>"></input>
			</form>
<?php
		}
?>
		<form action = "setcasemanager.php" method = "POST">
			<input type = "submit" value = "Add a new client to your roster"></input>
		</form>
		<form action = "logout.php" method = "POST">
			<input type = "submit" name = "testpost" value = "Logout"></input>
		</form>
<?php
	}
?>
</div>
</body>
</html>
