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
$oDiamonds->iCursor = 1;
var_dump($oDiamonds->compile_contract('Contract.sol'));

$oDiamonds->sFolder = '20220711084913000000';
var_dump($oDiamonds->set_output_folder());

if ($oDiamonds->iCursor) {
	var_dump($oDiamonds->read_from_file());
	var_dump($oDiamonds->sHex);
}



?>