<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Route;

class Storage extends Route
{
	public $aaStorage;
	
	public function __construct () {
		$this->aaStorage = array();
	}
/*
	public function __construct () {

	}
*/
	public function positioning($i_k = null, $sHex = null, $aArguments = null, $iDelta = null) {
		switch ($sHex) {
			case 0x54:
			
			break; //SLOAD
			case 0x55:
				
			break; //SSTORE
			default: return true; break;
		}
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