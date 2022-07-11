<?php
namespace App\Suiteziel;

use App\Suiteziel\Vm\Box;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\Memory;
use App\Suiteziel\Vm\Opcodes;

/*
Will be called from:
-command
-view
-call over http like API
-- regarding parameters passing

*/
class Vm
{
	public function run() {
		
		
		$oBox = new Box();
		$oVmBox = $oBox->new_from_file(); //$sFilePath, $sParam);
		
		
		//let mut vm = Vm::new_from_file(&filename, params)?;
		//println!("Correctly loaded VM");
		
	}
}

?>