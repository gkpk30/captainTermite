<?php

	include '../includes/config.php';
	include '../includes/mysql.php';

    $message = "Week 13: CS-554";

    ///////////////////////////////////
    // follow the instructions below:
    ///////////////////////////////////

    // assign your name to $name:
    $name = "Guy Koomer";

    // assign your lab13 url to $url:
    $url = "http://gkooms.atwebpages.com/cs554/week13/loginGuest.php";


?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $message ?></title>

</head>
<body>
    <h1><?php echo $message ?></h1>
    <h2><?php echo $name ?></h2>
    <a href="../">CS-554 Home</a><br />
    <a href="<?php echo $url ?>"><?php echo $url?></a>

    <h3>MySQL</h3>
    
<?php

	$dbconn = new DBCS554;

	$dbconn->connect();

	$dbconn->readMyGuest();

	function form() {
		echo '<br />
		<form method="POST" action="loginGuest.php">
			<label>Enter your info:</label><br />
			<label>Email <input type="email" id="email" name="email" /></label><br />
			<label>Password <input type="password" id="password" name="password" /></label><br />
			<input type="submit" value="Submit" />
		</form>
		';
	}

	if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        form();
    }
    else {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$sql = "SELECT email, password from MyGuests where email = '" . $email . "' and password = '" . $password . "'";
		$result = $dbconn->runSQL($sql);
    }

	
	if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo  
						"Email: " . $row["email"].
						", Password: " . $row["password"].
				"<br>";
			}
		} else {
			echo "Email or Password not found<br />";
			echo $sql . "<br />";
		}
?>

    <h3>End of MySQL</h3>

</body>
</html>

