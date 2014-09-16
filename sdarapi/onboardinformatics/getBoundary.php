<?php

// This script is to get Boundary information based on Area ID from Onboard Informatics through an HTTP POST

// Requires 'aid', and 'token' to work
// Returns JSON object

if ($_POST['aid'] && $_POST['token']) {
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/Area/Boundary/Detail/?&AccessToken=" . urlencode($_POST['token']) . "&AreaId=" . $_POST['aid'] . "&mime=json";

  // Initiate curl
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $community );
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6');
  curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
  $content = curl_exec( $ch );
  $return = curl_getinfo( $ch );
  curl_close ( $ch );

  // Send back results
  echo $content;

} else {
  echo "Error";
}

?>