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
	public function test() {
		return  "Hello woorld Storage";
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