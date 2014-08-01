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
    add_records($json);

}


function add_records($json){

    $json = json_decode($json);
    $search_metadata = $json->search_metadata;
    insert_search_metadata($search_metadata);
    $statuses = $json->statuses;


    foreach($statuses as $st){

        //inserting status
        $user_id = $st->user->id;
        insert_status($st, $user_id);

        //inserting users
        insert_user($st->user);


        //inserting status_metadata
        $status_metadata = $st->metadata;
        $status_id = $st->id;
        insert_status_metadata($status_metadata, $status_id);



    }



}


function insert_search_metadata($json){

    $db = new mysqli('localhost','root','root','TwitterGoggles');

    $search_metadata_columns = array(
        "completed_in",
        "max_id",
        "max_id_str",
        "next_results",
        "query",
        "refresh_url",
        "count",
        "since_id",
        "since_id_str"
    );

    $search_metadata_columns = implode(",", $search_metadata_columns);


    $search_metadata_values = array(
        $json->completed_in,
        $json->max_id,
        $json->max_id_str,
        $json->next_results,
        $json->query,
        $json->refresh_url,
        $json->count,
        $json->since_id,
        $json->since_id_str
    );

    $search_metadata_values = implode("\",\"", $search_metadata_values);
    if (!$db) {
      echo "Failed to connect to MySQL: ";
    }

    else {
        $query = "INSERT INTO search_metadata ($search_metadata_columns) VALUES (\"$search_metadata_values\")";
        //echo "$query\n\n\n";
        $db->query($query);
        echo $db->error."\n\n\n";
        $db->close();

    }


}


function insert_status_metadata($json, $status_id){

    $db = new mysqli('localhost','root','root','TwitterGoggles');
    $status_metadata_columns = array(
        'result_type',
        'iso_language_code',
        'status_id',
        );

    $status_metadata_columns = implode(",",$status_metadata_columns);

    $status_metadata_values = array(
        $json->result_type,
        $json->iso_language_code,
        $status_id
    );

    $status_metadata_values = implode("\",\"", $status_metadata_values);

    if (!$db) {
      echo "Failed to connect to MySQL: ";
    }

    else {
        $query = "INSERT INTO status_metadata ($status_metadata_columns) VALUES (\"$status_metadata_values\")";
       // echo "$query\n\n\n";
        $db->query($query);
        echo $db->error;
        $db->close();

    }

}

function insert_status($json, $userid){
    $db = new mysqli('localhost','root','root','TwitterGoggles');
    $status_columns = array(
        'status_id',
        'user_id',
        'id_str',
        'created_at',
        'text',
        'source',
        'truncated',
        'in_reply_to_status_id',
        'in_reply_to_status_id_str',
        'in_reply_to_user_id',
        'in_reply_to_user_id_str',
        'in_reply_to_screen_name'
        'contributors',
        'retweet_count',
        'favorites_count',
        'favorited',
        'lang',
        'retweeted'
        );

     $status_columns = implode(",",$status_columns);

     $status_values = array(
        $json->status_id,
        $userid
        $json->id_str,
        $json->created_at,
        $json->text,
        $json->source,
        $json->truncated,
        $json->in_reply_to_status_id,
        $json->in_reply_to_status_id_str,
        $json->in_reply_to_user_id,
        $json->in_reply_to_user_id_str,
        $json->in_reply_to_screen_name,
        $json->contributors,
        $json->retweet_count,
        $json->favorites_count,
        $json->favorited,
        $json->lang,
        $json->retweeted,
    );

    $statusvalues = implode("\",\"", $status_values);

    if (!$db) {
      echo "Failed to connect to MySQL: ";
    }

    else {
        $query = "INSERT INTO status ($status_columns) VALUES (\"$status_values\")";
       // echo "$query\n\n\n";
        $db->query($query);
        echo $db->error;
        $db->close();

    }


}

function insert_user($user_json){
      $user_columns = array (
        'user_id',
        'id_str',
        'name',
        'screen_name',
        'location',
        'description',
        'url',
        //'protected',
        'followers_count',
        'friends_count',
        'listed_count',
        //'created_at',
        //'favorites_count',
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
        //'profile_banner_url',
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
    $user_columns = implode(",", $user_columns);

    $db = new mysqli('localhost','root','root','TwitterGoggles');
    $user_values = array (

        $user_json->id,
        $user_json->id_str,
        $db->escape_string($user_json->name),
        $db->escape_string($user_json->screen_name),
        $db->escape_string($user_json->location),
        $db->escape_string($user_json->description),
        $user_json->url,
        //$user_json->protected,
        $user_json->followers_count,
        $user_json->friends_count,
        $user_json->listed_count,
       // $user_json->created_at,
        //$user_json->favorite_count,
        $user_json->utc_offset,
        $user_json->time_zone,
        $user_json->geo_enabled,
        $user_json->verified,
        $user_json->statuses_count,
        $user_json->lang,
        $user_json->contributors_enabled,
        $user_json->is_translator,
        $user_json->is_translation_enabled,
        $user_json->profile_background_color,
        $user_json->profile_background_image_url,
        $user_json->profile_background_image_url_https,
        $user_json->profile_background_tile,
        $user_json->profile_image_url,
        $user_json->profile_image_url_https,
        //$user_json->profile_banner_url,
        $user_json->profile_link_color,
        $user_json->profile_sidebar_border_color,
        $user_json->profile_sidebar_fill_color,
        $user_json->profile_text_color,
        $user_json->profile_use_background_image,
        $user_json->default_profile,
        $user_json->default_profile_image,
        $user_json->following,
        $user_json->follow_request_sent,
        $user_json->notifications


    );


    $user_values = implode("\",\"", $user_values);

    if (!$db) {
      echo "Failed to connect to MySQL: ";
    }

    else {
        $query = "INSERT INTO user ($user_columns) VALUES (\"$user_values\")";
        //echo "$query\n\n\n";
        $db->query($query);
        echo $db->error;
        $db->close();

    }

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
