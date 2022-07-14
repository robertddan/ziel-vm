<?php

print(6);
require __DIR__.'/../config/bootstrap.php';
echo '<pre>';

use App\Suiteziel\Org\Diamonds;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\Box;


$oDiamonds = new Diamonds();
$oOpcodes = new Opcodes();
$oBox = new Box();


$oDiamonds->iCursor = 1; // skip compilation
$oDiamonds->sContract 'Contract.sol';
if (!$oDiamonds->compile_contract()) die('oDiamonds->compile_contract');

?>