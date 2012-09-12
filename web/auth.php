<?php
namespace Statapus;
/**
 * This is the redirect URL for an Oauth server to send the oauth Code to.
 * This script then does the exchange for a access_token, stores that token then
 * redirect to the home page
 *
 */
$app = require dirname(__DIR__) . "/src/bootstrap.php";

$auth_state          = isset($_SESSION['auth_state']) ? $_SESSION['auth_state'] : null;
$auth_code           = isset($_GET['code']) ? $_GET['code'] : null;
$response_auth_state = isset($_GET['state']) ? $_GET['state'] : null;
$client_id           = $app->get_client_id();
$client_secret       = $app->get_client_secret();

if($auth_state != $response_auth_state)
{
    exit("Oauth states did not match");
}

if( ! $auth_code)
{
    exit("Not Oauth code found in response");
}

/*
 * Now exchange your auth code for an Access Token
 */
$requester = new \Presta\Request();
$result = $requester
    ->uri('https://github.com/login/oauth/access_token')
    ->headers(array('Accept: application/json'))
    ->post(
        array(
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'code'          => $auth_code,
            'state'         => $auth_state
        )
    );
echo "<pre>";
$response = json_decode($result->body(), true);
if( ! $response)
{
    exit("unable to json decode access token response: ".$result->body());
}
if( ! isset($response['access_token']))
{
    exit('Unable to find access token in response: '.print_r($response, true));
}

/*
 * record the access token
 */
$app->record_access_token($response['access_token']);
Http::redirect('/');

//$shepherd = new \OctoShepherd\Shepherd(array('access_token' => $response['access_token']));
//$me = $shepherd->me();
//
//print_r($result->body());