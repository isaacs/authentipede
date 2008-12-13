<?php


class TwitterLogin {
	public static $user = null;
	private static $conf = array();
	public static function conf ($key, $val = null) {
		if (
			$val === null
		) return array_key_exists($key, self::$conf) ? self::$conf[$key] : null;
		self::$conf[$key] = $val;
	}
	public static function logout () {
		setcookie("l", "", time() + 60*60*24*365, '/', false, false);
		self::$user = null;
		header('Location: ' . self::conf("loginuri"), true, 302);
		return false;
	}
	public static function getUser ($cookie) {
		$cookie = json_decode($cookie);
		if (!$cookie || !is_object($cookie)) return self::formLogin();
		return (self::$user = $cookie);
	}
	public static function login () {
		if (array_key_exists('logout', $_REQUEST)) return self::logout();
		$c = array_key_exists('l', $_COOKIE) ? $_COOKIE['l'] : null;
		if (!$c) return self::formLogin();
		return self::getUser($c);
	}
	public static function testCredentials ($u, $p) {
		$cred = "http://$u:$p@twitter.com/account/verify_credentials.json";
		$cred = json_decode(`curl "$cred" 2>/dev/null`);
		return (
			$cred &&
			is_object($cred) &&
			property_exists($cred, 'authorized') &&
			$cred->authorized
		);
	}
	public static function userLogin ($u, $p) {
		if (!self::testCredentials($u, $p)) return false;
		$user = "http://twitter.com/users/show/$u.json";
		$user = json_decode(`curl "$user" 2>/dev/null`);
		return self::setUser($user);
	}
	public static function setUser ($user) {
		if (
			$user && is_object($user)
		) setcookie("l", json_encode($user), time() + 60*60*24*365, '/', false, false);
		return (self::$user = $user);
	}
	public static function formLogin () {
		if (!(
			array_key_exists('u', $_REQUEST) &&
			array_key_exists('p', $_REQUEST)
		)) return false;
		return self::userLogin(
			rawurlencode($_REQUEST['u']),
			rawurlencode($_REQUEST['p'])
		);
	}	
}
