<?php
extract($_POST);
extract($_GET);
require_once('TwitterAPIExchange.php');
 
$settings = array(
    'oauth_access_token' => "5058421-MwSkCJ5CvPSa6Jm72J2pX2oZQaAypHHex9lmIAvxmF",
    'oauth_access_token_secret' => "8q16RwiuvhUptHbhafvzZVf0VzohfD1TlOKivvix59k5O",
    'consumer_key' => "pYyynVXoOYeepzO1VeBnubOID",
    'consumer_secret' => "Y68BQ3HLDcjrN6rNPz9tB5uCfXH3CKoGhZCUbV6fAzfqrlr6rc"
);


$url = 'https://api.twitter.com/1.1/favorites/list.json';
$getfield = '?screen_name='.$usuario.'&count=10';        
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$json =  $twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest();
echo $json;
?>