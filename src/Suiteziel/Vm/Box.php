<?php
namespace App\Suiteziel\Vm;


class Box
{
	public $i_pc; //program counter
	public $i_sp; //stack pointer
	
	public $aArguments;
/*
pub fn decode(s: &str) -> Result<Vec<u8>, ParseIntError> {
	(0..(s.len()-1))
		.step_by(2)
		.map(|i| u8::from_str_radix(&s[i..i+2], 16))
		.collect()
}
*/
	function __construct() {
	}	
	public function new_from_call($sJson = null, $aParameters = null) {
		return  "Hello woorld Memory";
	}
	public function new_from_cli($sJsonHex = null, $aParameters = null) {
		return  "Hello woorld Memory";
	}
	public function new_from_file($sFilePath = null, $aParameters = null) {
		return  "Hello woorld Memory";
	}
	public function decode($sHex = null) {
		$aHex = str_split($sHex, 2);
		
		//var_dump($aHex);
	}
	
	public function push () {
		array_unshift($oStack->aaStack, array_reverse($oStack->aArguments));
	}
	
	public function implement (&$oStack = null, $iKey = null): bool { // $aArguments = null, 
		//$this->aArguments = $aArguments;
		//$oStack->aArguments = '#######';
		
		switch ($iKey) {
			case 0x60: 
				return array_unshift($oStack->aaStack, array_reverse($oStack->aArguments));
				break; //PUSH1
			case 0x61:
				return array_unshift($oStack->aaStack, array_reverse($oStack->aArguments));
				break; //PUSH2
			case 0x62: 
				return array_unshift($oStack->aaStack, array_reverse($oStack->aArguments));
				break; //PUSH3
			case 0x63: $a = array(4); break; //PUSH4
			case 0x64: $a = array(5); break; //PUSH5
			case 0x65: $a = array(6); break; //PUSH6
			case 0x66: $a = array(7); break; //PUSH7
			case 0x67: $a = array(8); break; //PUSH8
			case 0x68: $a = array(9); break; //PUSH9
		}
		
		return true;
	}
	
}

/*
opcodes vm memory stack parameters test
*/
?>