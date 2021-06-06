<?php
if(isset($_POST['submit'])) {

$myemail = "guy@captaintermitecontrol.com"; Caution: replace youremail@yourdomain.com with a vaild one you created in Email Manager 
$subject = $_POST['subject'];
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$headers = "From:Contact Form <$myemail>\r\n";
$headers .= "Reply-To: $name <$email>\r\n";

echo "Your message has been sent successfully!";
mail($myemail, $subject, $message, $headers);

} else {

echo "An error occurred during the submission of your message";

}
?>