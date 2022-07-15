<?php
namespace App\Suiteziel\Vm;

class Stack
{ 
	public $i_sp; //stack pointer
		
	public function __construct () {
		$this->i_sp = 0;
		$this->aaStack = array();
		$this->aArguments = array();
	}

	public function arguments_get(): array {//$iKey = null, $aArguments = null): int {
		//$iKeyLeft = null;
		return $this->aArguments;
	}
		
	public function arguments_set($aArguments) {//$iKey = null, $aArguments = null): int {
		//$iKeyLeft = null;
		$this->aArguments = $aArguments;
	}
	public function test() {
		return  "Hello woorld Stack";
	}
	
	
	
}

?>