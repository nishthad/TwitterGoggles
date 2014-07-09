<?php
require_once('TwitterAPIExchange.php');
$api_info = array (
    w
);

$base_url = "https://api.twitter.com/1.1";

call_user_func($_GET['call']);

function getTimeline(){
    $userid = $_GET["query"];
    $query = "?screen_name=$userid";
    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
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