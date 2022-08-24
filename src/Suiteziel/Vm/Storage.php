<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\State;
use App\Suiteziel\Vm\Stack;

class Storage 
{
	public $aSlot;
	public static $aaStorage;
	
	public function __construct () {
		Self::$aaStorage = array();
		$this->aSlot = array(
			"contract" => State::$aaState["Ia"],
			"key" => null,
			"value" => null
		);
	}
  		
	public function shift_left ($sHex) {
		return "0x". str_pad($sHex, 64, 0, STR_PAD_LEFT);
	}
    		
	public function shift_right ($sHex) {
		return "0x". str_pad($sHex, 64, 0, STR_PAD_RIGHT);
	}

	public function positioning(&$i_pc, $sHex) {
    
    $sDec = hexdec($sHex);
    $aArguments = Opcodes::$aArguments;
    $iDelta = Opcodes::$aaOpcodes[$sDec][1];
    
		switch ($sDec) {
			case 0x54:
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				foreach (Self::$aaStorage as $oStorage) {
					#$aStorage = (array)$oStorage;
					if ($a_e[0] !== $oStorage->key) continue;
					array_unshift(Stack::$aaStack, $oStorage->value);
					break;
				}
				
				print(
					str_pad("Stack", 10, ":"). 
					implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
				);
			break; //SLOAD
			case 0x55:
				/*
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				$this->aSlot["key"] = $a_e[0];
				$this->aSlot["value"] = $a_e[1];
				array_push(Self::$aaStorage, (object) $this->aSlot);
				*/
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				Self::$aaStorage[$a_e[0]] = $a_e[1];
		print(
			str_pad("Stack", 10, ":"). 
			implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
		);
			break; //SSTORE
			default: return true; break;
		}
		

		print(PHP_EOL);
		foreach(Self::$aaStorage as $k => $aaStorage) print("Storage::". implode("::", (array) $aaStorage));
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