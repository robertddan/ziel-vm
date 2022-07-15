<?php
namespace App\Suiteziel;

use App\Suiteziel\Vm\Box;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\Memory;
use App\Suiteziel\Vm\Opcodes;


class Vm
{
	public $oOpcodes;
	public $oMemory;
	public $oStack;
	public $aHex;
	
	public function __construct() {
		$this->oOpcodes = new Opcodes();
		$this->oMemory = new Memory();
		$this->oStack = new Stack();
		$this->oBox = new Box();
	}
	
	public function set_hex($aHex = null) :bool {
		if (empty($aHex)) return false;
		//
		if (!$this->oOpcodes->hex_set($aHex)) die('oOpcodes->hex_set');
		//
		$this->aHex = $aHex;
		return true;
	}
	
	// loop
	public function run () {
		$iCountArguments = 0; //box pc var

		foreach ($this->aHex as $k => $sHex) {
			if ($iCountArguments !== 0) {
				$iCountArguments = $iCountArguments - 1;
				continue;
			}

			if (!$this->oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate');
			if (!$this->oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
			$iCountArguments = count($this->oOpcodes->aArguments);

/*
1. set_oo variables
2. instantiate in second layer
3. 
*/

			if (!$this->oBox->implement($k, $sHex)) die('oBox->implement');

		}
		
	}

}

?>