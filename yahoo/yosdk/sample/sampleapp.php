<?php

// Include the YOS library.
require("Yahoo.inc");

// Make sure you obtain application keys before continuing by visiting:
//
// http://developer.yahoo.com/dashboard/

// Your consumer key goes here.
$consumerKey = "";

// Your consumer key secret goes here.
$consumerKeySecret = "";

// Your application ID goes here.
$applicationId = "";

// Get a session first. If the viewer isn't sessioned yet, this call 
// will redirect them to log in and authorize your application to 
$session = YahooSession::requireSession($consumerKey, $consumerKeySecret, 
		$applicationId);

// Get the currently sessioned user. That means the user who is 
// currently viewing this page.
$user = $session->getSessionedUser();

// Load the profile for the current user.
$profile = $user->loadProfile();

// Fetch the presence for the current user.
$presence = $user->getPresence();

// Access the connection list for the current user.
$start = 0; $count = 100; $total = 0;
$connections = $user->getConnections($start, $count, $total);

// Retrieve the updates for the current user.
$updates = $user->listUpdates();

// Retrieve the updates for the connections of the current user.
$connectionUpdates = $user->listConnectionUpdates();

// Set the Content-Type header with the character set so that 
// special characters are rendered properly.
header("Content-Type: text/html; charset=utf-8");

?>
<html>
	<head>
		<title>YOS Social Platform Sample Application</title>
	</head>

	<body>
		<h1>YOS Social Platform Sample Application</h1>

		<h2>Profile</h2>
		<?php echo print_html($profile); ?>

		<h2>Presence</h2>
		<?php echo print_html($presence); ?>

		<h2>Connections</h2>
		<?php echo print_html($connections); ?>

		<h2>Updates</h2>

		<h3>Yours</h3>
		<?php echo print_html($updates); ?>

		<h3>Your Connections</h3>
		<?php echo print_html($connectionUpdates); ?>
	</body>
</html>
<?php

/**
 * A simple method that implements print_r/var_dump in a HTML friendly way.
 */
function print_html($object) {
	return str_replace(array(" ", "\n"), array("&nbsp;", "<br>"),
		htmlentities(print_r($object, true), ENT_COMPAT, "UTF-8"));
}

?>
