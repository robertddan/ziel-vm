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

	public function implement (): bool {
		//if (!$this->set_hex() && empty($this->aHex)) die('Box->implement');
		$this->aHex = array(0x60, 0x02, 0x60, 0x03, 0x01);
		

		
		if (!$this->oOpcodes->hex_set($this->aHex)) die('oOpcodes->hex_set');
		
		$i_opargs = 0;
		foreach ($this->aHex as $k => $sHex) {
			if ($i_opargs !== 0) {
				$i_opargs--;
				continue; 
			}
		
			if (!$this->oOpcodes->initiate($k, $sHex)) die('oOpcodes->initiate'); // view
			if (!$this->oOpcodes->describe($k, $sHex)) die('oOpcodes->describe');
			
			$this->oStack->arguments_set($this->oOpcodes->aArguments);
			if (!$this->oStack->positioning($k, $sHex)) die('oStack->positioning');

			$i_opargs = count($this->oOpcodes->aArguments);
			
		}
		
		var_dump('$this->oStack->aaStack');
		var_dump($this->oStack->aaStack);
		return true;
	}

}

?>