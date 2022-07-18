<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Box;

class Memory extends Box
{
	public $aaMemory;

	public function __construct () {
		$this->aaMemory = array();
	}
	
	public function positioning($i_k = null, $sHex = null, $aArguments = null, $iDelta = null) {
		switch ($sHex) {
			case 0x51:
				$a_e = array_splice($this->aaMemory, 0, $iDelta);
				array_unshift($this->aaMemory, array_sum($a_e));
				var_dump(implode("Memory::", $this->aaMemory));
				return true; 
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