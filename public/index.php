<?php

require(CONFIG . DS . 'bootstrap.php');

/* will be replaced by http */
$aRouter = array();
$aRouter = parse_url('/'. $_SERVER["REQUEST_URI"]);

if (isset($aRouter['host'])) //[["host"]=>"favicon.ico"
switch ($aRouter['host']) {
    case 'favicon.ico':
        header('Content-Type: text/x-icon');
        print file_get_contents(ROOT .'public'. DS .'favicon.ico');
        exit();
        break;
}
/* end will be replaced by http */

print '<pre>';
use Ziel\Vm;
$oVm = new Vm();
$oVm->run();
print '</pre>';


?>