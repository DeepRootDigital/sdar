<?php

// This script is to authenticate the user and return a unique access token for that user

// Requires 'uid' to work
// Returns accesstoken as a string

if ($_POST['uid']) {

// Generate string for uid
$url="http://api.obiwebservices.com/Security/AccessToken/Standard?Aid=1049-2320b2f0978&Uid=" . $_POST['uid'] . "&UidType=1&Domain=testing.businesslabkit.com";

// Execute curl to onboard
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $url );
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
$content = curl_exec( $ch );
$return = curl_getinfo( $ch );
curl_close ( $ch );

// Access the token in the XML response
$xml = new SimpleXMLElement($content);
$accesstoken = $xml->result->package->item[access_token][0];

// Return access token so you can access onboard informations information
echo $accesstoken;

} else {
  echo "Error";
}

?>