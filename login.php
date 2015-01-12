<?php
	//session_save_path("/nfs/stak/students/a/anderjen/sessions"); stored in htaccess
	session_start();
	//ini_set('display_errors',1); 
?>
<!DOCTYPE html>
<html>
<head>
	<!--Jen Anderson-->
	<title>LOGIN</title>
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
		if (isset ($_SESSION['username']))
		{
			if ($_SESSION['permission'] === 0)
			{
				echo '<h3>You\'re already logged in as ' . $_SESSION['username'] . '.<br></h3>';
				echo '<a href = "userpage.php" style = "color: #ADA692;"><h3>Click here to view your information</h3></a>';
				echo '<a href = "logout.php" style = "color: #ADA692;"><h3>Click here to logout</h3></a>';
				break;
			}
			else
			{	
				echo '<h3>You\'re already logged in.<br></h3>';
				echo '<a href = "adminpage.php" style = "color: #ADA692;"><h3>Click here to view your information</h3></a>';
				break;
			}
		}
		else
		{
			if (isset($_POST['newusername'])) //Enter it in as a new username.  Enter username and password into userlogins, then the rest of infor
			//as new user in clients table
			{
				
				$newusername = $_POST['newusername'];
				$newuserpass = $_POST['newpassword'];
				$newuserfname = $_POST['newfname'];
				$newuserlname = $_POST['newlname'];
				$newuserphone = $_POST['newphone'];
				$newuserstreet1 = $_POST['newstreet1'];
				$newuserstreet2 = $_POST['newstreet2'];
				$newusercity = $_POST['newcity'];
				$newuserstate = $_POST['newstate'];
				$newuserzip = $_POST['newzip'];
				$newuserssn = $_POST['newssn'];
				$newuserdob = $_POST['newdob'];
				
				//Enter the new user login information to users_logins
				$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", "Fd9lqRLTkguN4PNO", "anderjen-db");
				if ($mysqli->connect_errno) 
				{
					echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
				}
				if ( !($stmt = $mysqli->prepare("INSERT INTO users_logins(`username`, `password`) values('$newusername', '$newuserpass')") ) ) 
				{
					echo "prepare failed";
				}
				if (!$stmt->execute()) 
				{
					echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				}
				
				//Enter the new user login information to clients table
				$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", "Fd9lqRLTkguN4PNO", "anderjen-db");
				if ($mysqli->connect_errno) 
				{
					echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
				}
				if ( !($stmt = $mysqli->prepare("INSERT INTO clients(`first_name`, `last_name`, `street1`, 
													`street2`, `city`, `state`, `zip`, `dob`, `ssn`, `username`, `phone`) 
												values('$newuserfname', '$newuserlname', '$newuserstreet1', 
													'$newuserstreet2', '$newusercity', '$newuserstate', 
													'$newuserzip', '$newuserdob', '$newuserssn', 
													(SELECT username FROM users_logins WHERE username = '$newusername'), 
													'$newuserphone')") ) ) 
				{
					echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
				}
				if (!$stmt->execute()) 
				{
					echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				}
			}

			if(array_key_exists("enteredusername", $_REQUEST) && array_key_exists("enteredpassword", $_REQUEST))
			{
				$myusername=$_POST['enteredusername'];
				$mypassword=$_POST['enteredpassword'];
				
				//Connect to database and test the connection
				$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "anderjen-db", "Fd9lqRLTkguN4PNO", "anderjen-db");
				if ($mysqli->connect_errno) 
				{
					echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
				}
				
				//Prepare the statement, which returns a handle to the statement.  It uses 
				// the username the user has entered.  If the username is incorrect, the password doesn't
				// need to be checked, and the incorrect login message will be displayed
				if ( !($stmt = $mysqli->prepare("SELECT username, password, permission_level FROM users_logins WHERE username = '$myusername'") ) ) 
				{
					echo "prepare failed";
				}
				
				//Run the statement
				if (!$stmt->execute()) 
				{
					echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
				}
				
				if (!$stmt->bind_result($username, $password, $permission_level))
				{
					echo "Error binding result: (" . $stmt->errno . ") " . $stmt->error;
				}
				else
				{
					$stmt->store_result();
				}
				$stmt->fetch();
				
				if ((!isset($username) || ($password !== $mypassword)) || ($myusername == "") || ($mypassword == ""))
				{
					echo "Login information is incorrect.";
				}
				else
				{
					$_SESSION['username'] = $username;
					$_SESSION['permission'] = $permission_level;
					$_SESSION['start'] = time(); 
					$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
				}
			}
		
			if (isset ($_SESSION['username']))
			{
				if ($permission_level === 0)
				{
					echo '<a href = "userpage.php" style = "color: #ADA692;"> View your information </a>';
				}
				else
				{
					$_SESSION['username'] = $username;
					echo '<a href = "adminpage.php" style = "color: #ADA692;"> View your information </a>';
				}
			}
			else
			{
	?>			<!--Need AJAX in HTML section to make sure something is entered-->
				<form action = "login.php" method = "POST">
					<div> 
						username: <input type = "text" name = "enteredusername">
					</div>
					<div>
						password: <input type = "password" name = "enteredpassword">
					</div>
					<div>
						<input type = "submit" value = "login">
					</div>
				</form>
				<form action = "usercreation.php" method = "POST">
					<input type = "submit" value = "create a new user"></input>
				</form>
<?php
			}
		}
?>
	</div>
	</body>
	</html>
