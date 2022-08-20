<?php

require __DIR__.'/../config/bootstrap.php';

echo '<pre>';
use App\Suiteziel\Vm;
$oVm = new Vm();
$oVm->run();

?>