<?php

// This script is to get Points of Interest information based on Longitude and Latitude from Onboard Informatics through an HTTP POST

// Requires 'longitude', 'latitude', and 'token' to work
// Returns JSON object

if ($_POST['longitude'] && $_POST['latitude'] && $_POST['token']) {
  // Create empty array
  $dataarray = [];

  // BARS AND CLUBS
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/POI+Search/POI/Point/?&AccessToken=" . urlencode($_POST['token']) . "&Point=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&LOB=" . urlencode("BARS - CLUBS") . "&mime=json";

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

  array_push($dataarray,json_decode($content));

  // BANKS AND CREDIT
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/POI+Search/POI/Point/?&AccessToken=" . urlencode($_POST['token']) . "&Point=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&BusinessCategory=" . urlencode("BANKS - FINANCIAL") . "&mime=json";

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

  array_push($dataarray,json_decode($content));

  // SHOPPING
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/POI+Search/POI/Point/?&AccessToken=" . urlencode($_POST['token']) . "&Point=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&BusinessCategory=" . urlencode("SHOPPING") . "&mime=json";

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

  array_push($dataarray,json_decode($content));

  // HEALTH
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/POI+Search/POI/Point/?&AccessToken=" . urlencode($_POST['token']) . "&Point=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&BusinessCategory=" . urlencode("HEALTH CARE SERVICES") . "&mime=json";

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

  array_push($dataarray,json_decode($content));

  // LOCAL GOV
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/POI+Search/POI/Point/?&AccessToken=" . urlencode($_POST['token']) . "&Point=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&BusinessCategory=" . urlencode("GOVERNMENT - PUBLIC") . "&mime=json";

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

  array_push($dataarray,json_decode($content));

  // Sports & Rec
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/POI+Search/POI/Point/?&AccessToken=" . urlencode($_POST['token']) . "&Point=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&LOB=" . urlencode("SPORTS AND RECREATION") . "&mime=json";

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

  array_push($dataarray,json_decode($content));

  // Eating and Drink
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/POI+Search/POI/Point/?&AccessToken=" . urlencode($_POST['token']) . "&Point=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&LOB=" . urlencode("RESTAURANTS") . "&mime=json";

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

  array_push($dataarray,json_decode($content));

  // Groceries and Markets
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/POI+Search/POI/Point/?&AccessToken=" . urlencode($_POST['token']) . "&Point=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&LOB=" . urlencode("GROCERY STORES AND MARKETS") . "&mime=json";

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

  array_push($dataarray,json_decode($content));

  // Entertainment
  // Create link to curl to api
  $community = "http://api.obiwebservices.com/POI+Search/POI/Point/?&AccessToken=" . urlencode($_POST['token']) . "&Point=POINT%28" . $_POST['longitude'] . "%20" . $_POST['latitude'] . "%29&BusinessCategory=" . urlencode("ATTRACTIONS - RECREATION") . "&mime=json";

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

  array_push($dataarray,json_decode($content));

  // Send back results
  echo json_encode($dataarray);

} else {
  echo "Error";
}

?>