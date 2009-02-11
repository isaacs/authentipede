<?php

include(dirname(__FILE__) . '/config.php');
include(dirname(__FILE__) . '/yosdk/lib/Yahoo.inc');


// Get a session first. If the viewer isn't sessioned yet, this call 
// will redirect them to log in and authorize your application to 
$session = YahooSession::requireSession($consumerKey, $consumerKeySecret, $applicationId);

// Get the currently sessioned user. That means the user who is 
// currently viewing this page.
$user = $session->getSessionedUser();

// Load the profile for the current user.
$profile = $user->loadProfile();

echo '<pre>';
var_dump($user);
var_dump($profile);
