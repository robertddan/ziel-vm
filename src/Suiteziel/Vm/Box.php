<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\Vm\Memory;
use App\Suiteziel\Vm\Stack;
use App\Suiteziel\Org\Diamonds;

class Box extends Vm
{
	public $aHex;
	public $i_pc; //program counter

	function __construct() {
		$this->i_pc = 0;
		$this->oOpcodes = new Opcodes();
		$this->oMemory = new Memory();
		$this->oStack = new Stack();
	}

	public function set_hex() :bool {
		$this->aHex = Diamonds::$_aHex;
		return true;
	}

	public function implement ($iKey = null, $sHex = null): bool {
		if (!$this->set_hex() && empty($this->aHex)) die('Box->implement');
		if (!$this->oOpcodes->hex_set($this->aHex)) die('oOpcodes->hex_set');
		
		foreach ($this->aHex as $k => $sHex) {
			if ($this->i_pc !== 0) {
				$this->i_pc--;
				continue;
			}
			if (!$this->oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate');
			if (!$this->oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
			
			$this->oStack->arguments_set($this->oOpcodes->aArguments);
			if (!$this->oStack->positioning($k, $sHex)) die('oStack->positioning');

			$this->i_pc = count($this->oOpcodes->aArguments);
			
		}
		return true;
	}

}

?>