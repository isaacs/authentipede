<?php


include(dirname(__FILE__) . '/config.php');

define('FB_STATIC_URL', 'http://static.ak.'.FB_BASE_URL);

include(dirname(__FILE__) . '/facebook-client/facebook.php');

$f = new Facebook(FB_API_KEY, FB_API_SECRET);

$user = $f->require_login();

echo "<pre>";

/*
Storable forever:
	uid		User ID
	nid		Primary network ID
	eid		Event ID
	gid		Group ID
	pid		Photo ID
	aid		Photo album ID
	flid	friend list ID
	listing_id	Marketplace listing ID
	page_id		Facebook Page ID
	proxied_email	Placeholder email addresses for your users
	notes_count		Total number of notes written by the user
	profile_update_time		Time that the user's profile was last updated
Storable for 24 hours:
	first_name
	last_name
	name
	timezone
	birthday
	sex
	affiliations (regional type only)
	locale
	profile_url
*/


var_dump($f->api_client->users_getStandardInfo($user, array(
	'name',
	'first_name',
	'last_name',
	'name',
	'timezone',
	'birthday',
	'sex',
	'affiliations',
	'locale',
	'profile_url'
)));
var_dump($f->api_client->users_getInfo($user, array(
	'uid',
	'about_me',
	'activities',
	'affiliations',
	'birthday',
	'books',
	'current_location',
	'education_history',
	'first_name',
	'hometown_location',
	'hs_info',
	'is_app_user',
	'has_added_app',
	'interests',
	'last_name',
	'locale',
	'meeting_for',
	'meeting_sex',
	'movies',
	'music',
	'name',
	'notes_count',
	'pic',
	'pic_big',
	'pic_small',
	'pic_square',
	'political',
	'profile_update_time',
	'quotes',
	'relationship_status',
	'religion',
	'sex',
	'significant_other_id',
	'status',
	'timezone',
	'tv',
	'wall_count',
	'work_history'
)));
