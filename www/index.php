<?php

require __DIR__.'/../config/bootstrap.php';

/*
use App\Suiteziel\Vm;
use App\Suiteziel\Vm\Opcodes;


$oVm = new Vm();
var_dump($oVm->run());

*/

use App\Suiteziel\Org\Diamonds;
$oDiamonds = new Diamonds();
$oDiamonds->iCursor = 1; // skip compilation
var_dump($oDiamonds->compile_contract('Contract.sol'));
$oDiamonds->sFolder = '20220711084913000000';
var_dump($oDiamonds->set_output_folder());
if ($oDiamonds->iCursor) {
	var_dump($oDiamonds->read_from_file());
}
var_dump($oDiamonds->sHex);


$aHex = str_split($oDiamonds->sHex, 2);


//for($i=0; $i<=20; $i=$i+2) { // = $aHex as $sHex) {
foreach ($aHex as $sHex) {
	/*
	var_dump($sHex);
	$hex = hexdec($sHex);
	var_dump($hex);
	

	$output = array_slice($aHex, $i, 2);
	$sHexChunk = implode("", $output);	
	//var_dump($sHexChunk);
	*/
	
	$base = base_convert($sHex, 8, 16);

	var_dump($base);
	
}

/*
[96, 128, 96, 64, 82, 52, 128, 21, 96, 15, 87, 96, 0, 128, 253, 91, 80, 96, 4, 54, 16, 96, 50, 87, 96, 0, 53, 96, 224, 28, 128, 99, 12, 85, 105, 156, 20, 96, 55, 87, 128, 99,
 165, 243, 194, 59, 20, 96, 81, 87, 91, 96, 0, 128, 253, 91, 96, 63, 96, 0, 84, 129, 86, 91, 96, 64, 81, 144, 129, 82, 96, 32, 1, 96, 64, 81, 128, 145, 3, 144, 243, 91, 96, 9
6, 96, 92, 54, 96, 4, 96, 113, 86, 91, 96, 98, 86, 91, 0, 91, 96, 106, 129, 131, 96, 168, 86,91, 96, 0, 85, 80, 80, 86, 91, 96, 0, 128, 96, 64, 131, 133, 3, 18, 21, 96, 131,
87, 96, 0, 128, 253, 91, 80, 80, 128, 53, 146, 96, 32, 144, 145, 1, 53, 145, 80, 86, 91, 99, 78, 72, 123, 113, 96, 224, 27, 96, 0, 82, 96, 17, 96, 4, 82, 96, 36, 96, 0, 253,
91, 96, 0, 128, 130, 18, 128, 21, 96, 1, 96, 1, 96, 255, 27, 3, 132, 144, 3, 133, 19, 22, 21, 96, 199, 87, 96, 199, 96, 146, 86, 91, 96, 1, 96, 255, 27, 131, 144, 3, 132, 18,
 129, 22, 21, 96, 221, 87, 96, 221, 96, 146, 86, 91, 80, 80, 1, 144, 86, 254, 162, 100, 105, 112, 102, 115, 88, 34, 18, 32, 175, 3, 110, 61, 208, 220, 218, 141, 143, 130, 158

*/
?>