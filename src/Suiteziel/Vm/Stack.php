<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Opcodes;

class Stack
{ 
	public $i_sp; //stack pointer
	
	private $aaOpcodes;
		
	public function __construct () {
		$this->i_sp = 0;
		$this->aaStack = array();
		$this->aArguments = array();
		
		$this->oOpcodes = new Opcodes(); //diff instance
		$this->aaOpcodes = $this->oOpcodes->aaOpcodes;
		
		var_dump($this->aaOpcodes);
	}

	public function arguments_get(): array {//$iKey = null, $aArguments = null): int {
		//$iKeyLeft = null;
		return $this->aArguments;
	}
		
	public function arguments_set($aArguments) {//$iKey = null, $aArguments = null): int {
		//$iKeyLeft = null;
		$this->aArguments = $aArguments;
	}
	
	public function positioning($iKey = null, $sHex = null) {
		return  "Hello woorld Stack";
	}
	
	
	
}

?>