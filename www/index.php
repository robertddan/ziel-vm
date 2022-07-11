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
//var_dump($oDiamonds->compile_contract(__APP__ . 'contracts/Contract.sol'));
var_dump($oDiamonds->read_from_file());
	



?>