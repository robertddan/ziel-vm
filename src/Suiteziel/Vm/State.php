<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Box;

class State extends Box
{
	public $aaState;

	public function __construct () {
		$this->aaState = array(
			// Ia, the address of the account which owns the code that is executing. 
			"Ia" => "",
			// Io, the sender address of the transaction that originated this execution. 
			"Io" => "",
			// Ip, the price of gas in the transaction that originated this execution. 
			"Ip" => "",
			// Id, the byte array that is the input data to this execution; if the execution agent is a transaction, this would be the transaction data. 
			"Id" => "",
			// Is, the address of the account which caused the code to be executing; if the execution agent is a transaction, this would be the transaction sender. 
			"Is" => "",
			// Iv, the value, in Wei, passed to this account as part of the same procedure as execution; if the execution agent is a transaction, this would be the transaction value. 
			"Iv" => "",
			// Ib, the byte array that is the machine code to be executed. 
			"Ib" => "",
			// IH, the block header of the present block. 
			"IH" => "",
			// Ie, the depth of the present message-call or contract-creation (i.e. the number of CALLs or CREATE(2)s being executed at present). 
			"Ie" => "",
			// Iw, the permission to make modi cations to the state.
			"Iw" => "",
		);
	}
/*
	public function __construct () {

	}
*/
	public function positioning($i_k = null, $sHex = null, $aArguments = null, $iDelta = null) {
		switch ($sHex) {
			default: return true; break;
		}
		return true;
	}
}
?>