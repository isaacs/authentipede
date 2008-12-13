<?php

main();

function main () {
	include("./TwitterLogin.class.php");
	$requri = $_SERVER['REQUEST_URI'];
	$requri = explode("?", $requri);
	$requri = $requri[0];
	TwitterLogin::conf("loginuri", $requri);
	TwitterLogin::login() ? dostuff() : showform();
}
function showform () {
	echo '<form method=post action=' . TwitterLogin::conf("loginuri") . '><fieldset>' .
		'<legend>please enter twitter username and password</legend>' . 
		'<label for="u">username</label>: <input id="u" name="u" type="text"><br>' .
		'<label for="p">password</label>: <input id="p" name="p" type="password"><br>' .
		'<input type="submit" value="login">' .
		'</fieldset></form>';
}
function dostuff () {
	echo 'you are <a href="http://twitter.com/' . TwitterLogin::$user->screen_name . '">' .
		TwitterLogin::$user->name . ' <img valign="middle" src="' . TwitterLogin::$user->profile_image_url . '"></a>' .
		'<pre>' . print_r(TwitterLogin::$user, 1) . '</pre>' .
		'<br><a href="?logout">log out</a>';
}

