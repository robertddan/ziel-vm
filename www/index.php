<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require __DIR__.'/../config/bootstrap.php';

use App\Suiteziel\Vm;
use App\Suiteziel\Vm\Opcodes;



$oVm = new Vm();
var_dump($oVm->run());


?>