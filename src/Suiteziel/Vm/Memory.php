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
			case 0x51: return 1; break; //MLOAD
			case 0x52: return 1; break; //MSTORE
			case 0x53: return 1; break; //MSTORE8
			default: return true; break;
		}
	}
}
?>