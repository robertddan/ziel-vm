<?php

//ini_set('zend.multibyte', 1);
//declare(encoding='UTF-8');
require __DIR__.'/../config/bootstrap.php';

echo '<pre>';

use App\Suiteziel\Opt\View;
use App\Suiteziel\Org\Utils;
use App\Suiteziel\Org\Diamonds;
use App\Suiteziel\Vm;

//$oView = new View();
$oUtils = new Utils();
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

var_dump('base_convert');
var_dump(base_convert(0x00000000000000000000000000000000000000000000000000000000000000FF, 10, 16));


/*

$d = "ff";

var_dump('decode_32bytes');
var_dump($oUtils->encode_32bytes($d));
var_dump($oUtils->decode_32bytes($d));
var_dump('decode_32bytes');




var_dump(base_convert('8080808080808080808080808080808080808080808080808080808080808080', 16, 9));
var_dump(strlen('1000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000100000001000000010000000'));


var_dump(base32_encode(8080808080808080808080808080808080808080808080808080808080808080));
$32bytes = base32_encode(8080808080808080808080808080808080808080808080808080808080808080);
$16bytes = "";
//$16bytes = base32_decode('HAXDAOBQHAYDQMBYGA4DAOBRIUVTMMD');
var_dump($16bytes);
*/

//var_dump(base_convert($16bytes, 16, 10));
//base_convert('8080808080808080808080808080808080808080808080808080808080808080', 16, 32)

/*

PHP Warning:  declare(encoding=...) ignored because Zend multibyte feature is turned off by settings in /workspace/CORDS/ziel/www/index.php on line 2
string(52) "KRUGKIDROVUWG2ZAMJZG653OEBTG66BANJ2W24DTEBXXMZLSEB2GQZJANRQXU6JAMRXWH"

*/
/*
// encode 32 bytes
$d = "The quick brown fox jumps over the lazy dog";
$d = "8080808080808080808080808080808080808080808080808080808080808080";

var_dump($oUtils->decode_32bytes($oUtils->encode_32bytes($d)));
// decode 32 bytes


string(52) "KRUGKIDROVUWG2ZAMJZG653OEBTG66BANJ2W24DTEBXXMZLSEB2GQZJANRQXU6JAMRXWH"
*/

/*
$config = [
    'private_key_type' => OPENSSL_KEYTYPE_EC,
    'curve_name' => 'secp256k1'
];

$res = openssl_pkey_new($config);

if (!$res) {
    echo 'ERROR: Fail to generate private key. -> ' . openssl_error_string();
    exit;
}

// Generate Private Key
openssl_pkey_export($res, $priv_key);

// Get The Public Key
$key_detail = openssl_pkey_get_details($res);
$pub_key = $key_detail["key"];

var_dump(array(
$pub_key,
$res,
$key_detail,
	
));

int(1)
int(2)
int(4)
int(8)
int(16)
int(32)
int(64)
int(128)
int(256)
int(512)
int(1024)
int(2048)
	
var_dump('bits');
var_dump(pow(2, 0));
var_dump(pow(2, 1));
var_dump(pow(2, 2));
var_dump(pow(2, 3));
var_dump(pow(2, 4));
var_dump(pow(2, 5));
var_dump(pow(2, 6));
var_dump(pow(2, 7)); //127
var_dump(pow(2, 8));
var_dump(pow(2, 9));
var_dump(pow(2, 10));
var_dump(pow(2, 11));

*/
/*
var_dump(base_convert(6000, 10, 16));

var_dump(base_convert(0x1770, 16, 8));
var_dump(hex2bin(0x1770));
var_dump(pack("H*", '36303030'));
var_dump(pack("H*", 36303030));

bin to dec (32 bytes)
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