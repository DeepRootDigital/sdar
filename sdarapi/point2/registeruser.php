<?php
  $link = "https://api.point2portal.com/ManageUsers/Create";

  $fields = array(
    'Email' => urlencode("paul@businessonmarketst.com"),
    'Password' => urlencode("hyuna123"),
    'FirstName' => urlencode("Paul"),
    'LastName' => urlencode("McMahon"),
    'UserType' => urlencode("HomeBuyer"),
    'Country' => urlencode("US"),
    'State' => urlencode("CA"),
    'City' => urlencode("San Diego"),
    'UserIdentifier' => urlencode("colpan"),
    'ApiKey' => urlencode("261b1859-5150-43e8-aa1b-253127cf68fb")
  );

  foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

  // Initiate curl
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $link );
  curl_setopt($ch,CURLOPT_POST, count($fields));
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/535.6 (KHTML, like Gecko) Chrome/16.0.897.0 Safari/535.6');
  curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
  $content = curl_exec( $ch );
  $return = curl_getinfo( $ch );
  curl_close ( $ch );

  // Send back results
  var_dump($return);

?>