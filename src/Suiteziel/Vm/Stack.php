<?php
namespace App\Suiteziel\Vm;

class Stack
{
	//public $iCursor;
	public $aHex;
	public $aaStack;
	public $aArguments;
		
	public function __construct () {
		$this->iCursor = 0;
		$aaStack = array();
		$aArguments = array();
	}

	public function stack_set ($aHex = null): bool {
		$this->aHex = $aHex;
		return true;
	}

	public function initiate ($iKey = null, $sHex = null): bool {
		switch ($sHex) {
			case 0x60:
				
				/*
					slice array from - to k + 1
					push to stack
				
				var_dump(array(
					array_slice($this->aHex, $iKey + 1, 1),
					'$iKey',
					$iKey
				));
				*/
				$this->aArguments = array_slice($this->aHex, $iKey + 1, 1);
				//"0x60\t3\tPUSH1\t\tPlace 1 byte item on stack\n"; 
				break;
			case 0x61: 
				return $iKey + 2; 
				//"0x61\t3\tPUSH2\t\tPlace 2 byte item on stack\n"; 
				break;
			case 0x62: 
				return $iKey + 3; 
				//"0x62\t3\tPUSH3\t\tPlace 3 byte item on stack\n"; 
				break;
			case 0x63: 
				return $iKey + 4; 
				//"0x63\t3\tPUSH4\t\tPlace 4 byte item on stack\n"; 
				break;
		}
		return true;
	}

	public function implement ($iKey = null) {
		switch ($iKey) {
			case 0x60:
				return $iKey + 1; 
				//"0x60\t3\tPUSH1\t\tPlace 1 byte item on stack\n"; 
				break;
			case 0x61: 
				return $iKey + 2; 
				//"0x61\t3\tPUSH2\t\tPlace 2 byte item on stack\n"; 
				break;
			case 0x62: 
				return $iKey + 3; 
				//"0x62\t3\tPUSH3\t\tPlace 3 byte item on stack\n"; 
				break;
			case 0x63: 
				return $iKey + 4; 
				//"0x63\t3\tPUSH4\t\tPlace 4 byte item on stack\n"; 
				break;
		}
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