<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require __DIR__.'/../config/bootstrap.php';

use App\Suiteziel\Vm;
use App\Suiteziel\Vm\Opcodes;

var_dump(__DIR__);

$oVm = new Vm();
var_dump($oVm->run());


use App\Suiteziel\Org\Diamonds;

var_dump(file_exists($sFilePath));
$oDiamonds = new Diamonds();
var_dump($oDiamonds->write_to_file(__APP__));
	
	

?>