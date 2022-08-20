<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\State;

class Storage 
{
	public static $aaStorage;
	
	public function __construct () {
		Self::$aaStorage = array();
		$this->aSlot = array(
			"contract" => State::$aaState["Ia"],
			"slot" => null,
			"value" => null
		);
	}
  		
	public function shift_left ($sHex) {
		return "0x". str_pad($sHex, 32, 0, STR_PAD_LEFT);
	}
    		
	public function shift_right ($sHex) {
		return "0x". str_pad($sHex, 32, 0, STR_PAD_RIGHT);
	}

	public function positioning(&$i_pc, $sHex) {
    
    $sDec = hexdec($sHex);
    $aArguments = Opcodes::$aArguments;
    $iDelta = Opcodes::$aaOpcodes[$sDec][1];
    
		switch ($sDec) {
			case 0x54:
				
			break; //SLOAD
			case 0x55:
				$a_e = array_splice($aaStack, 0, $iDelta);
				$this->aSlot["slot"] = $a_e[1];
				$this->aSlot["value"] = $a_e[0];
				array_push(Self::$aaStorage, $this->aSlot);
			break; //SSTORE
			default: return true; break;
		}
		

		print(PHP_EOL);
		print("Storage::". implode("::", Self::$aaStorage));
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