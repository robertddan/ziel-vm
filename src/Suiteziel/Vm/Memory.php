<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Route;

class Memory extends Route
{
	public $aaMemory;

	public function __construct () {
		$this->aaMemory = array();
	}
/*
	public function __construct () {

	}
	memory[offset:offset+32] = value 
	memory[offset] = value & 0xFF 
	value = memory[offset:offset+32]
*/
	public function positioning(&$aa_p) { //$i_k = null, $sHex = null, $aArguments = null, $iDelta = null) {
		list($sHex, $aArguments, $iDelta, $i_pc, &$aaStack) = $aa_p;
		switch ($sHex) {
			case 0x51:
				$a_s = array_splice($aaStack, 0, $iDelta);
				$a_m = $this->aaMemory[$a_s[0]];
				array_unshift($aaStack, );
				var_dump(implode("Memory::", $this->aaMemory));
			break; //MLOAD
			case 0x52:
				$a_e = array_splice($aaStack, 0, $iDelta);
				$this->aaMemory[$a_e[0]] = $a_e[1];
				//array_unshift($this->aaMemory, array_sum($a_e));
				var_dump(implode("Memory::", $this->aaMemory));
			break; //MSTORE
			case 0x53:
				
			break; //MSTORE8
			case 0x59:
				
			break; //MSIZE
			default: return true; break;
		}
		return true;
	}
}
?>