<?php //Calls TwitterAPIExchange's functions from the library
require_once('TwitterAPIExchange.php');
$api_info = array (
    "oauth_access_token"=> "32967775-amRk4e5aQ0ADonHPgcGBtJsrBPiwx72WcuTegQ7nT",
    "oauth_access_token_secret" => "zuVxpl4HaXIuRLhdsTaLxRRjBADTTqQuznyoyoX9oCezW",
    "consumer_key" => "5oAUCi6emcEbB8Xd6TVC1ejQs",
    "consumer_secret" => "CjOMlqPW8MFP2G8AdkJu0Jw0h8kEhJKicdoQCCh4GR7KcGyiy6"
);


    call_user_func($_GET['call']);


//done by Nishtha
function getTimeline(){ //this function combines the queried userid and the search url
    $userid = $_GET["query"]; // Receives query from js
    $query = "?screen_name=$userid"; //adds as param
    $url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    echo httpcall($query, $url); //calls httpcall function with query and url

}


//done by Jordan
function getSearch(){ //this function combines the queried string and the search url
    $querystring = urlencode($_GET["query"]); //Receives query inputted and urlencodes querystring
    $query = "?q=$querystring";  //adds as param
    $url = "https://api.twitter.com/1.1/search/tweets.json";
    $json = httpcall($query, $url); //calls httpcall function with query and url
    //echo $json;
    connectdb($json);

}


function connectdb($json){

    $db = mysqli_connect("localhost","root","root","TwitterGoggles");
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: ";
    }
    
    $json = json_decode($json);

    $statuses = $json->statuses;
//    $user = $statuses[0]->user;
//    echo $user->name;

    foreach($statuses as $stat_key=>$status){
        $user = $status->user;
        foreach($user as $key=>$value){
            if($key != "entities")
                echo "key= ".$key. " val= ".$value."\n";
        }
    }

$user_columns = array (
    'user_id',
    'id_str',
    'name',
    'screen_name',
    'location',
    'description',
    'url',
    'protected',
    'followers_count',
    'friends_count',
    'listed_count',
    'created_at',
    'favorites_count',
    'utc_offset',
    'time_zone',
    'geo_enabled',
    'verified',
    'statuses_count',
    'lang',
    'contributors_enabled',
    'is_translator',
    'is_translation_enabled',
    'profile_background_color',
    'profile_background_image_url',
    'profile_background_image_url_https',
    'profile_background_tile',
    'profile_image_url',
    'profile_image_url_https',
    'profile_banner_url',
    'profile_link_color',
    'profile_sidebar_border_color',
    'profile_sidebar_fill_color',
    'profile_text_color',
    'profile_use_background_image',
    'default_profile',
    'default_profile_image',
    'following',
    'follow_request_sent',
    'notifications'
);

$user_vals_try = array (
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1',
    '1'
);

$usercols = implode(",", $user_columns);
    $SQL = "INSERT INTO user (". $usercols .") VALUES (" . $user_vals_try . ")";

    $result = mysql_query($SQL);

    //mysql_close($db);
    echo "Records added to the database";

}



/**
httpcall function takes endpoint (url) and query entered by user to make http request to twitter api
uses TwitterAPIExchange library, creates an instance, provides the keys and tokens
**/


//done by Nishtha & Jordan
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
