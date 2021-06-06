

<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$nameErr = $emailErr = $interestTypeErr = $telephoneErr = $propertyTypeErr = "";
$name = $email = $telephone = $comment = $interestType = $propertyType =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }

  if (empty($_POST["telephone"])) {
    $emailErr = "Telephone is required";
  } else {
    $email = test_input($_POST["telephone"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid telephone format"; 
    }
  }
    
  if (empty($_POST["interestType"])) {
    $propertyTypeErr = "Interest Type is required";
  } else {
    $propertyType = test_input($_POST["interestType"]);
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["propertyType"])) {
    $propertyTypeErr = "Property Type is required";
  } else {
    $propertyType = test_input($_POST["propertyType"]);
  }
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Telephone: <input type="tel" name="telephone">
  <span class="error">* <?php echo $telephoneErr;?></span>
  <br><br>
  I'M INTERESTED IN: 
  <input type="radio" name="interestType" <?php if (isset($interestType) && $interestType=="freeQoute") echo "checked";?> value="freeQoute">Free Estimate
  <input type="radio" name="interestType" <?php if (isset($interestType) && $interestType=="account") echo "checked";?> value="account">My Account
  <span class="error">* <?php echo $interestTypeErr;?></span>
  <br><br>
 
  Comment: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>

  Property Type:
  <input type="radio" name="propertyType" <?php if (isset($propertyType) && $propertyType=="residential") echo "checked";?> value="residential">Residential
  <input type="radio" name="propertyType" <?php if (isset($propertyType) && $propertyType=="commercial") echo "checked";?> value="commercial">Commercial
  <input type="radio" name="propertyType" <?php if (isset($propertyType) && $propertyType=="homeowners") echo "checked";?> value="hoa">Home Owners Association  
  <input type="radio" name="propertyType" <?php if (isset($propertyType) && $propertyType=="constructionSite") echo "checked";?> value="construction">Construction Site
  <span class="error">* <?php echo $propertyTypeErr;?></span>
  <br><br>
  
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $interestType;
echo "<br>";
echo $propertyType;
echo "<br>";
echo $comment;
echo "<br>";



?>


<?php
$to = "guy@captaintermitecontrol.com";
$subject = "You Received a Message!";

$message = "
<html>
<head>
<title>Test HTML email</title>
</head>
<body>

<p>You received an email from $name !</p>
<div>
    <p>THis email is from $name. <br/>
        Email:   
    </p>
</div>
<table>
<tr>
<th>Guy</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
<tr>
<td>$comment</td>
<td></td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$from = "noreply@captaintermitecontrol.com"
$headers .= 'From: <'.$from.'>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

mail($to,$subject,$message,$headers);
?> 

</body>
</html>
 