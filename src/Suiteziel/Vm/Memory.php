<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Box;

class Memory extends Box
{
	public $aaMemory;

	public function __construct () {
		$this->aaMemory = array();
	}
	
	public function positioning($i_k = null, $sHex = null) {
		switch ($sHex) {
			case 0x51:
				
			break; //MLOAD
			case 0x52:
				
			break; //MSTORE
			case 0x53:
				
			break; //MSTORE8
			default: return true; break;
		}
	}
}
?>