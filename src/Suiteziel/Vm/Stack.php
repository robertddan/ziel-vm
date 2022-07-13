<?php
namespace App\Suiteziel\Vm;

use Ds;

class Stack
{
	public $iCursor;
	public $aHex;
		
	public function __construct () {
		$this->iCursor = 0;
		$stack = new \Ds\Stack();
		print_r($stack);
	}

	public function stack_pointer_set ($iKey = null) {
		$this->iCursor = $iKey;
	}

	public function initiate ($iKey = null) {
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
	
	public function arguments_get($iKey = null, $aArguments = null): int {
		$iKeyLeft = null;
		return $iKeyLeft;
	}
	
	public function test() {
		return  "Hello woorld Stack";
	}
}

?>