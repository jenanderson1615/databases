<?php
	//session_save_path("/nfs/stak/students/a/anderjen/sessions");  stored in htaccess
	session_start();
	ini_set('display_errors',1); 
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="projectstyle.css">
	<title>User home page</title>
	<meta charset="UTF-8">
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
	if(!(isset($_SESSION['username'])))
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
		if (isset($_POST['newaddress']))
		{
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
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET street1 = '$newstreet1' WHERE username = '$myusername'") ) ) 
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
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET street2 = '$newstreet2' WHERE username = '$myusername'") ) ) 
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
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET city = '$newcity' WHERE username = '$myusername'") ) ) 
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
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET state = '$newstate' WHERE username = '$myusername'") ) ) 
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
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET zip = '$newzip' WHERE username = '$myusername'") ) ) 
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
			if ( !($stmt = $mysqli->prepare("UPDATE clients SET phone = '$newphone' WHERE username = '$myusername'") ) ) 
			{
				echo "prepare failed";
			}
			//Run the statement
			if (!$stmt->execute()) 
			{
				echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			}
		}
	
		//Connect to database and test the connection
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", "Fd9lqRLTkguN4PNO", "anderjen-db");
		if ($mysqli->connect_errno) 
		{
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
			
		//Prepare the statement, which returns a handle to the statement.  It uses 
		// the username the user has entered.  If the username is incorrect, the password doesn't
		// need to be checked, and the incorrect login message will be displayed
		if ( !($stmt = $mysqli->prepare("SELECT c.first_name, c.last_name, c.street1, c.street2, c.city, c.state, c.zip, c.dob, c.ssn, c.phone, cs.Status_description
										 FROM clients c
										 Inner Join case_status cs ON c.status_id = cs.Status_ID
										 WHERE c.username = '$myusername'") ) ) 
		{
			echo "prepare failed";
		}
			
		//Run the statement
		if (!$stmt->execute()) 
		{
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
			//login_wrong();
		}
			
		if (!$stmt->bind_result($first_name, $last_name, $street1, $street2, $city, $state, $zip, $dob, $ssn, $phone, $status_desc))
		{
			echo "Error binding result: (" . $stmt->errno . ") " . $stmt->error;
			//login_wrong();
		}
		else
		{
			$stmt->store_result();
		}
		$stmt->fetch();
		$_SESSION['street1'] = $street1;
		$_SESSION['street2'] = $street2;
		$_SESSION['state'] = $state;
		$_SESSION['city'] = $city;
		$_SESSION['zip'] = $zip;
		$_SESSION['dob'] = $dob;
		$_SESSION['ssn'] = $ssn;
		$_SESSION['phone'] = $phone;
?>
</head>
<body>
		<div id="wrap"> 
		<h1 id = "header">SOAR client website</h1>
		<ul class = "list" style="list-style: none;">
			<li>
				<span>Last Name: </span>
				<span>
<?php
					echo $last_name;
?>
				</span>
			</li>
			<li>
				<span>First Name: </span>
				<span>
<?php
					echo $first_name;
?>
				</span>
			</li>
			<li>
				<span>Date of Birth: </span>
				<span>
<?php
					echo $dob;
?>
				</span>
			</li>
			<li>
				<span>SSN: </span>
				<span>
<?php
					echo $ssn;
?>
				</span>
			</li>
			<li>
				<span>Address: </span>
				<span>
<?php
					echo $street1 . " " . $street2 . " " . $city . " " . $state . " " . $zip;
?>
			</li>
			<li>
				<span>Phone: </span>
<?php
				echo $phone;
?>
			</li>
						<li>
				<span>Status: </span>
<?php
				echo $status_desc;
?>
			</li>
		</ul>
	
<?php
	//Section to get their record places
		
	//Connect to database and test the connection
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", "Fd9lqRLTkguN4PNO", "anderjen-db");
	if ($mysqli->connect_errno) 
	{
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	//Prepare the statement, which returns a handle to the statement. 
	if ( !($stmt = $mysqli->prepare("SELECT r.record_name, pr.received, pr.date_requested 
									FROM records r 
									INNER JOIN person_record pr ON pr.record_id = r.record_id 
									INNER JOIN clients c ON c.PID = pr.PID
									WHERE c.username = '$myusername'") ) ) 
	{
		echo "prepare failed<br><br>";
	}
	//Run the statement
	if (!$stmt->execute()) 
	{
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		//login_wrong();
	}
	if (!$stmt->bind_result($rname, $rreceived, $request_date))
	{
		echo "Error binding result: (" . $stmt->errno . ") " . $stmt->error;
		//login_wrong();
	}
	else
	{
		$stmt->store_result();
	}
	$x = 0;
	$records = array();
	
	while ($stmt->fetch())
	{
		//puts rows into an array named users with the key being the username and the password being the value
		$records[$x] = $rname;
		$x++;
		$records[$x] = $rreceived;
		$x++;
		$records[$x] = $request_date;
		$x++;
	}	
?>
<table style = " border-spacing: 10px; text-align: center;" class = "center">
		<thead>Your records
			<th>Record Place</th>
			&nbsp;&nbsp;&nbsp;
			<th>Received</th>
			&nbsp;&nbsp;&nbsp;
			<th>Date Requested</th>
		</thead>
		<?php
		for ($i = 0; $i < count($records); $i++)
		{
		?>
		<tbody>
			<td><?php echo $records[$i]; $i++;?></td>
			<td><?php if ($records[$i] == 1) echo "Received"; else echo "Not yet"; $i++;?></td>
			<td><?php echo $records[$i];}?></td>
		</tbody>
</table>
	<form action = "logout.php" method = "POST">
		<input type = "submit" value = "Logout"></input>
	</form>
	<form action = "clienteditclient.php" method = "POST">
		<input type = "submit" value = "Edit your personal information"></input>
	</form>
	</div>
</body>
</html>
<?php
	}
?>
