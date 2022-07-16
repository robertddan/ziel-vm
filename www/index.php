<?php

require __DIR__.'/../config/bootstrap.php';

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

var_dump(implode(",", str_split($oDiamonds->sHex, 2)));
var_dump(implode(",", $oDiamonds->aHex));


$oVm->run();

/*
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