<?php

main();

function main () {
	include("./TL.class.php");
	$requri = $_SERVER['REQUEST_URI'];
	$requri = explode("?", $requri);
	$requri = $requri[0];
	TL::conf("loginuri", $requri);
	TL::login() ? dostuff() : showform();
}
function showform () {
	echo '<form method=post action=' . TL::conf("loginuri") . '><fieldset>' .
		'<legend>please enter twitter username and password</legend>' . 
		'<label for="u">username</label>: <input id="u" name="u" type="text"><br>' .
		'<label for="p">password</label>: <input id="p" name="p" type="password"><br>' .
		'<input type="submit" value="login">' .
		'</fieldset></form>';
}
function dostuff () {
	echo 'you are <a href="http://twitter.com/' . TL::$user->screen_name . '">' .
		TL::$user->name . ' <img valign="middle" src="' . TL::$user->profile_image_url . '"></a>' .
		'<pre>' . print_r(TL::$user, 1) . '</pre>' .
		'<br><a href="?logout">log out</a>';
}

