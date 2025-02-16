<?php

function exception_handler (Throwable $exception) {
    print PHP_EOL. $exception->getMessage() .PHP_EOL.
    'On file: '.$exception->getFile() .PHP_EOL.
    'On line: '. $exception->getLine() .PHP_EOL.
    $exception->getTraceAsString() .PHP_EOL;
}

function throw_exception ($sException) {
    throw new Exception($sException);
}

set_exception_handler('exception_handler');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS);
define('CONFIG', ROOT . DS . 'config' . DS);
define('VENDOR', ROOT . DS . 'vendor' . DS);

require(CONFIG . DS . 'bootstrap.php');


$aRouter = array();
$aRouter = parse_url('/'. $_SERVER["REQUEST_URI"]);

if (isset($aRouter['host']))
switch ($aRouter['host']) {
    case 'favicon.ico':
        header('Content-Type: text/x-icon');
        print file_get_contents(ROOT .'public'. DS .'favicon.ico');
        exit();
    break;
}


print '<pre>';

use Ziel\Vm;
$oVm = new Vm();
$oVm->run();

print '</pre>';

?>


<script>
var solc = require('solc');

var input = {
  language: 'Solidity',
  sources: {
    'test.sol': {
      content: 'import "lib.sol"; contract C { function f() public { L.f(); } }'
    }
  },
  settings: {
    outputSelection: {
      '*': {
        '*': ['*']
      }
    }
  }
};

function findImports(path) {
  if (path === 'lib.sol')
    return {
      contents:
        'library L { function f() internal returns (uint) { return 7; } }'
    };
  else return { error: 'File not found' };
}

// New syntax (supported from 0.5.12, mandatory from 0.6.0)
var output = JSON.parse(
  solc.compile(JSON.stringify(input), { import: findImports })
);

// `output` here contains the JSON output as specified in the documentation
for (var contractName in output.contracts['test.sol']) {
  console.log(
    contractName +
      ': ' +
      output.contracts['test.sol'][contractName].evm.bytecode.object
  );
}
</script>