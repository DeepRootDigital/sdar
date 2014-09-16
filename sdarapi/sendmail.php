<?php
$email = $_POST['email'];
$mid = $_POST['mid'];
$mname = $_POST['mname'];
$mnamedecode = urldecode($mname);
$url = "http://testing.businesslabkit.com/sdar/register/?action=registeruser&subscription=1&mid=" . $mid . "&mname=" . $mname;

$msg = "<html><body><p>Hello and thank you for your interest.</p><p>Click the link below to sign up for your free account at Just Knock courtesy of " . $mnamedecode . ". Just Knock is a San Diego Association of Realtors website focused on bringing valuable content for you to make the best choice possible when you go to buy a house.</p><a href='" . $url . "'>Click Here to Sign Up</a><p>Best Wishes, " . $mnamedecode . "</p></body></html>";

$subject = 'Just Knock Membership - ' . $mnamedecode;

$headers = "From: noreply@justknock.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($email, $subject, $msg, $headers);

echo "Success";

?>