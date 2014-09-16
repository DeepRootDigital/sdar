<?php

// This script is to get AreaIds based longitude and latitude from Onboard Informatics through an HTTP POST

// Requires 'longitude', 'latitude', and 'token' to work
// Returns JSON object

if ($_POST['longitude'] && $_POST['latitude'] && $_POST['token']) {

// Create the query string
$location = "http://api.obiwebservices.com/Area/Hierarchy/Lookup/?WKTString=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&AccessToken=" . $_POST['token'] . "&mime=json";

// Initiate the curl
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $location );
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
$content = curl_exec( $ch );
$return = curl_getinfo( $ch );
curl_close ( $ch );


// Return all the AreaIds associated with given coordinates
echo $content;

} else {
  echo "Error";
}

?>