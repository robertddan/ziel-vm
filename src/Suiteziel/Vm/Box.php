<?php
namespace App\Suiteziel\Vm;


class Box
{
	public $i_pc; //program counter
	public $aArguments;

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
	
	public function implement ($iKey = null): bool { // $aArguments = null, 
		//$this->aArguments = $aArguments;
		//$oStack->aArguments = '#######';
		case 4: return $this->aaOpcodes[$sHex][3]; //name
		case 5: return $this->aaOpcodes[$sHex][4]; //description
		
		switch ($iKey) {
			case 0x60: 
				return array_unshift($this->oStack->aaStack, array_reverse($this->oStack->aArguments));
				break; //ADD
		}
		
		return true;
	}
	
}

?>