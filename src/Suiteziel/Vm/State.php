<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Route;

class State extends Route
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

	public function positioning(&$aa_p) { //$i_k = null, $sHex = null, $aArguments = null, $iDelta = null) {
		list($sHex, $aArguments, $iDelta, &$i_pc, &$aaStack) = $aa_p;
		switch ($sHex) {
			case 0x56:
				$i_pc = $i_pc + 100;
				return true; 
			break; //JUMP
			case 0x57:
				$i_pc = $i_pc + 100;
				return true; 
			break; //JUMPI
			case 0x58:
				array_unshift($aaStack, $i_pc);
var_dump($aaStack);
				return true; 
			break; //PC
			default: return true; break;
		}
		return true;
	}
}
?>