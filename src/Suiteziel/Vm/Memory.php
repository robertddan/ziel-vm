<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Route;

class Memory extends Route
{
	public $aaMemory;

	public function __construct () {
		$this->aaMemory = array();
		$this->aaMemory[1234] = array();
	}
/*
	public function __construct () {

	}
*/
	public function positioning(&$aa_p) { //$i_k = null, $sHex = null, $aArguments = null, $iDelta = null) {
		list($sHex, $aArguments, $iDelta, $i_pc, &$aaStack) = $aa_p;
		switch ($sHex) {
			case 0x51:
				$a_s = array_splice($aaStack, 0, $iDelta);
				$a_m = $this->aaMemory[1234][$a_s[0]];
				array_unshift($aaStack, $a_m);
				var_dump("Memory::". implode("::", $this->aaMemory[1234]));
				var_dump("Stack::". implode("::", $aaStack));
			break; //MLOAD
			case 0x52:
				$a_e = array_splice($aaStack, 0, $iDelta); 
				$i=32;
				//$hex_i = base_convert($a_e[0], 10, 16);
				while ($i<$a_e[0]) $i=32+$i; 
				$aMemory = array_fill(0, $i, 0);
				$aMemory[$a_e[0]] = $a_e[1];
				$this->aaMemory[1234] = $aMemory;
				var_dump("Memory::". implode("::", $aMemory));
			break; //MSTORE
			
			case 0x53:
				$a_e = array_splice($aaStack, 0, $iDelta); 
				$i=32;
				//$hex_i = base_convert($a_e[0], 10, 16);
				while ($i<$a_e[0]) $i=32+$i; 
				$aMemory = array_fill(0, $i, 0);
				$aMemory[$a_e[0]] = $a_e[1];
				$this->aaMemory[1234] = $aMemory;
				var_dump("Memory::". implode("::", $aMemory));
			break; //MSTORE8
			case 0x59:
				array_unshift($aaStack, (count($this->aaMemory[1234])/3.2));
				var_dump("Memory::". implode("::", $this->aaMemory[1234]));
				//... Linear Diophantine Equations
				// ...congruence equation (mod 8 or 9)
				// .. 8 ≡ 23 (mod 5)...which is read, “8 is congruent to 23 modulo 5” (or just “mod 5”), by Levin (2019). 
				//References
				//Levin, O. (2019). Discrete mathematics: An open introduction (3 edition). CreateSpace Independent Publishing Platform. http://discrete.openmathbooks.org/pdfs/dmoi-tablet.pdf

			break; //MSIZE
			default: return true; break;
		}
		return true;
	}
}
?>