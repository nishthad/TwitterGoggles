<?php //Calls TwitterAPIExchange's functions from the library
require_once('TwitterAPIExchange.php');
$api_info = array (
    "oauth_access_token"=> "32967775-amRk4e5aQ0ADonHPgcGBtJsrBPiwx72WcuTegQ7nT",
    "oauth_access_token_secret" => "zuVxpl4HaXIuRLhdsTaLxRRjBADTTqQuznyoyoX9oCezW",
    "consumer_key" => "5oAUCi6emcEbB8Xd6TVC1ejQs",
    "consumer_secret" => "CjOMlqPW8MFP2G8AdkJu0Jw0h8kEhJKicdoQCCh4GR7KcGyiy6"
);

$base_url = "https://api.twitter.com/1.1";

call_user_func($_GET['call']);

function getTimeline(){ //this function combines the queried userid and the search url
    $userid = $_GET["query"]; // Receives query query
    $query = "?screen_name=$userid"; //converts query to readable http
    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    echo httpcall($query, $url); //combines the queried string with the search url

}

<<<<<<< HEAD
function getSearch(){ //this function combines the queried string and the search url
    $querystring = urlencode($_GET["query"]); //Receives query inputted and encodes querystring to be passed through $url
    $query = "?q=$querystring";  //converts query to readable http
=======
function getSearch(){
     $querystring = urlencode($_GET["query"]);
    $query = "?q=$querystring";
>>>>>>> origin/master
    $url = "https://api.twitter.com/1.1/search/tweets.json";
    echo httpcall($query, $url); //combines the queried string with the search url
    
}

function httpcall($query, $url){
	global $api_info, $base_url;
    $requestMethod = "GET";
    $twitter = new TwitterAPIExchange($api_info);
	$response = $twitter->setGetfield($query)
             ->buildOauth($url, $requestMethod)
             ->performRequest();  
	
	return $response;
}

?>
