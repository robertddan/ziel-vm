<?php

//ini_set('zend.multibyte', 1);
//declare(encoding='UTF-8');
require __DIR__.'/../config/bootstrap.php';

ini_set('zend.multibyte', 1);
echo '<pre>';

use App\Suiteziel\Org\Diamonds;
use App\Suiteziel\Vm;

$oDiamonds = new Diamonds();
$oVm = new Vm();

$oDiamonds->iCursor = 1; // skip compilation
$oDiamonds->sContract = 'Storage.sol'; // contract file name in contracts folder
$oDiamonds->sFolder = '20220714123825000000'; // specify folder
if (!$oDiamonds->set_output_folder()) die('oDiamonds->set_output_folder'); //set it
if (!$oDiamonds->compile_contract()) die('oDiamonds->compile_contract');
if (!$oDiamonds->iCursor) die('oDiamonds->iCursor');
if (!$oDiamonds->read_from_file()) die('oDiamonds->read_from_file');
var_dump($oDiamonds->sHex);
if (!$oDiamonds->decode_hex()) die('oDiamonds->decode_hex');

var_dump(implode(" ", str_split($oDiamonds->sHex, 2)));
var_dump(implode(" ", $oDiamonds->aHex));

function base32_decode($d)
    {
    list($t, $b, $r) = array("ABCDEFGHIJKLMNOPQRSTUVWXYZ234567", "", "");

    foreach(str_split($d) as $c)
        $b = $b . sprintf("%05b", strpos($t, $c));

    foreach(str_split($b, 8) as $c)
        $r = $r . chr(bindec($c));

    return($r);
    }

function base32_encode($d)
    {
    list($t, $b, $r) = array("ABCDEFGHIJKLMNOPQRSTUVWXYZ234567", "", "");

    foreach(str_split($d) as $c)
        $b = $b . sprintf("%08b", ord($c));

    foreach(str_split($b, 5) as $c)
        $r = $r . $t[bindec($c)];

    return($r);
    }
/*
references 
Anonymous. (2018). https://www.php.net/manual/en/function.base-convert.php
*/
var_dump(base32_encode(8080808080808080808080808080808080808080808080808080808080808080));
$32bytes = base32_encode(8080808080808080808080808080808080808080808080808080808080808080);
$16bytes = base32_decode('HAXDAOBQHAYDQMBYGA4DAOBRIUVTMMD');
var_dump($16bytes);
var_dump(base_convert($16bytes, 16, 10));
//base_convert('8080808080808080808080808080808080808080808080808080808080808080', 16, 32)
/*
 PHP Warning:  declare(encoding=...) ignored because Zend multibyte feature is turned off by settings in /workspace/CORDS/ziel/www/index.php on line 2
*/
var_dump('bits');
var_dump(pow(2, 0));
var_dump(pow(2, 1));
var_dump(pow(2, 2));
var_dump(pow(2, 3));
var_dump(pow(2, 4));
var_dump(pow(2, 5));
var_dump(pow(2, 6));
var_dump(pow(2, 7));
var_dump(pow(2, 8));
//var_dump(pow(2, 9));
//var_dump(pow(2, 10));
//var_dump(pow(2, 11));


/*
var_dump(base_convert(6000, 10, 16));

var_dump(base_convert(0x1770, 16, 8));
var_dump(hex2bin(0x1770));
var_dump(pack("H*", '36303030'));
var_dump(pack("H*", 36303030));

bin to dec
1 to 10
1000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000

10: 77 
58123087930888129467517984631811969432229639361576439988433610796128943505536

16: 64
8080808080808080808080808080808080808080808080808080808080808080
*/

//$binarydata = hash('sha3-256', 'The quick brown fox jumps over the lazy dog');

$oVm->run();

/*
$a = array(1,2,3,4,5);
$aa = array();

foreach ($a as $aArgument) array_unshift($aa, $aArgument);


	// 1024 bits stack
$str = bin2hex("test");

//var_dump(base_convert("$str", 16, 10));
var_dump(str_pad("0x" . $str, 64, 0)); //0x

var_dump('$hex');#
var_dump(str_pad("0x" . $str, 64, 0));
var_dump(hex2bin(0x96000000000000000000000000000000000000000000000000000000000000));
*/
/*
	
}
*/

?>