<?php
require_once('TwitterAPIExchange.php');
$api_info = array (
    "oauth_access_token"=> "32967775-amRk4e5aQ0ADonHPgcGBtJsrBPiwx72WcuTegQ7nT",
    "oauth_access_token_secret" => "zuVxpl4HaXIuRLhdsTaLxRRjBADTTqQuznyoyoX9oCezW",
    "consumer_key" => "5oAUCi6emcEbB8Xd6TVC1ejQs",
    "consumer_secret" => "CjOMlqPW8MFP2G8AdkJu0Jw0h8kEhJKicdoQCCh4GR7KcGyiy6"
);

$base_url = "https://api.twitter.com/1.1";

call_user_func($_GET['call']);

function getTimeline(){
    $userid = $_GET["query"];
    $query = "?screen_name=$userid";
    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    echo httpcall($query, $url);

}

function getSearch(){
     $querystring = urlencode($_GET["query"]);
    $query = "?q=$querystring";
    $url = "https://api.twitter.com/1.1/search/tweets.json";
    echo httpcall($query, $url);
    
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
