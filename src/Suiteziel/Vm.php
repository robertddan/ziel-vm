<?php
namespace App\Suiteziel;

use App\Suiteziel\Vm\Box;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Vm\Memory;
use App\Suiteziel\Vm\Opcodes;


class Vm
{
	public $oOpcodes;
	public $oStack;
	public $aHex;
	
	public function __construct() {
		$this->oOpcodes = new Opcodes();
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
		$iCountArguments = 0; //if ! stack #no continue...

		foreach ($this->aHex as $k => $sHex) {
			if ($iCountArguments !== 0) {
				$iCountArguments = $iCountArguments - 1;
				continue;
			}

			if (!$this->oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate');
			if (!$this->oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
			$iCountArguments = count($this->oOpcodes->aArguments);


			if (!$this->implement($sHex)) die('Vm->implement');

		}
		
	}
	
	public function implement ($iKey = null): bool { // $aArguments = null, 
		//$this->aArguments = $aArguments;
		//$oStack->aArguments = '#######';
		
		switch ($iKey) {
			case 0x60: 
				return array_unshift($this->oStack->aaStack, array_reverse($this->oStack->aArguments));
				break; //ADD
		}
		
		return true;
	}

}

?>