<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\State;

class Storage 
{
	public $aaStorage;
	
	public function __construct () {
		$this->aaStorage = array();
		$this->aSlot = array(
			"contract" => State::$_aaState["Ia"],
			"slot" => null,
			"value" => null
		);
	}
/*
	public function __construct () {

	}
*/
	public function positioning(&$aa_p) {
		list($sHex, $aArguments, $iDelta, $i_pc, &$aaStack) = $aa_p;
		switch ($sHex) {
			case 0x54:
				
			break; //SLOAD
			case 0x55:
				$a_e = array_splice($aaStack, 0, $iDelta);
				$this->aSlot["slot"] = $a_e[1];
				$this->aSlot["value"] = $a_e[0];
				array_push($this->aaStorage, $this->aSlot);
			break; //SSTORE
			default: return true; break;
		}
		

		print(PHP_EOL);
		print("Storage::". implode("::", $this->aaStorage));
		return true;
	}
}
/*
type Account struct {
	Nonce uint64
	Balance *big.Int
	Root common.Hash // merkle root of the storage trie
	CodeHash []byte
}
*/
?>