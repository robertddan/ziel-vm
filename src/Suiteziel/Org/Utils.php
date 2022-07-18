<?php
namespace App\Suiteziel\Org;


class Utils
{

	public function encode_32bytes ($d) {
		list($t, $b, $r) = array("ABCDEFGHIJKLMNOPQRSTUVWXYZ234567", "", "");
		foreach(str_split($d) as $c) $b = $b . sprintf("%08b", ord($c));
		foreach(str_split($b, 5) as $c) $r = $r . $t[bindec($c)];
		return $r;
	}

	public function decode_32bytes ($d) {
		list($t, $b, $r) = array("ABCDEFGHIJKLMNOPQRSTUVWXYZ234567", "", "");
		foreach(str_split($d) as $c) $b = $b . sprintf("%05b", strpos($t, $c));
		foreach(str_split($b, 8) as $c) $r = $r . chr(bindec($c));
		return $r;
	}

}

?>