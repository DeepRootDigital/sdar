<?php
require_once('OAuth.php');
$CONSUMER_KEY = "WKm-wG2PPmq837enXpqZNw";
$CONSUMER_SECRET = "JNddStpBx7HvpROPYz6iAlzDhmU";
$TOKEN = "qRgpsJHmoB91PhWIGptob-xp_nIx8Uru";
$TOKEN_SECRET = "Invjbz64U591fCywukc1zD_2KWk";

$API_HOST = 'api.yelp.com';
$DEFAULT_TERM = 'restaurant';
$DEFAULT_LOCATION = 'San Diego, CA';
$SEARCH_LIMIT = 6;
$SEARCH_PATH = '/v2/search/';
$BUSINESS_PATH = '/v2/business/';
$FAKEVAR = "MEW";

function request($host, $path) {
    $unsigned_url = "http://" . $host . $path;

    // Token object built using the OAuth library
    $token = new OAuthToken($GLOBALS['TOKEN'], $GLOBALS['TOKEN_SECRET']);

    // Consumer object built using the OAuth library
    $consumer = new OAuthConsumer($GLOBALS['CONSUMER_KEY'], $GLOBALS['CONSUMER_SECRET']);

    // Yelp uses HMAC SHA1 encoding
    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

    $oauthrequest = OAuthRequest::from_consumer_and_token(
        $consumer, 
        $token, 
        'GET', 
        $unsigned_url
    );
    
    // Sign the request
    $oauthrequest->sign_request($signature_method, $consumer, $token);
    
    // Get the signed URL
    $signed_url = $oauthrequest->to_url();
    
    // Send Yelp API Call
    $ch = curl_init($signed_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    
    return $data;
}

function search($term, $location) {
    $url_params = array();
    
    $url_params['term'] = $term ?: $GLOBALS['DEFAULT_TERM'];
    $url_params['location'] = $location?: $GLOBALS['DEFAULT_LOCATION'];
    $url_params['limit'] = $GLOBALS['SEARCH_LIMIT'];
    $url_params['radius_filter'] = "4000";
    $search_path = $GLOBALS['SEARCH_PATH'] . "?" . http_build_query($url_params);
    
    return request($GLOBALS['API_HOST'], $search_path);
}

function query_api($term, $location) {     
    $response = search($term, $location);
    echo $response;
}

$term = 'restaurant';
$location = $_GET['location'] . ", CA";

query_api($term,$location);
?>