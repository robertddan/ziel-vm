<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Route;
//use App\Suiteziel\Org\Session;

class State extends Route
{
	public $aaState;
	public static $_aaState;

	public function __construct () {

		$this->aaState = self::$_aaState = array(
			// Ia, the address of the account which owns the code that is executing. 
			"Ia" => "",//Session::$_aData["wallet"][0],
			// Io, the sender address of the transaction that originated this execution. 
			"Io" => "",
			// Ip, the price of gas in the transaction that originated this execution. 
			"Ip" => "",
			// Id, the byte array that is the input data to this execution; if the execution agent is a transaction, this would be the transaction data. 
			"Id" => "",
			// Is, the address of the account which caused the code to be executing; if the execution agent is a transaction, this would be the transaction sender. 
			"Is" => "",
			// Iv, the value, in Wei, passed to this account as part of the same procedure as execution; if the execution agent is a transaction, this would be the transaction value. 
			"Iv" => "", //Session::$_aData["wallet"][0], //70000000000000000000,
			// Ib, the byte array that is the machine code to be executed. 
			"Ib" => "",
			// IH, the block header of the present block. 
			"IH" => "", //array("c","s","i","d","l")
			// Ie, the depth of the present message-call or contract-creation (i.e. the number of CALLs or CREATE(2)s being executed at present). 
			"Ie" => "",
			// Iw, the permission to make modi cations to the state.
			"Iw" => "",
		);
		
		var_dump($this->aaState);
	}

	public function positioning(&$aa_p) { //$i_k = null, $sHex = null, $aArguments = null, $iDelta = null) {
		list($sHex, $aArguments, $iDelta, &$i_pc, &$aaStack) = $aa_p;
		switch ($sHex) {
			case 0x00:
				$i_pc = 'STOP';
			break; //STOP
			case 0x56:				
				$a_e = array_slice($aaStack, 0, $iDelta);
				//var_dump($a_e);
				$i_pc = $a_e[0];
			break; //JUMP
			case 0x57:
				$a_e = array_slice($aaStack, 0, $iDelta);
				if ($a_e[1] != 0) $i_pc = $a_e[0];
				else $i_pc = $i_pc; // + 1;
				//var_dump($a_e);
			break; //JUMPI
			case 0x58:
				array_unshift($aaStack, $i_pc);
			break; //PC
			case 0x62:
			break; //JUMPDEST
			case 0x30:
				array_unshift($aaStack, $this->aaState["Ia"]);
				print("Stack::". implode("::", $aaStack));
			break; //ADDRESS
			case 0x32:
				array_unshift($aaStack, $this->aaState["Io"]);
				print("Stack::". implode("::", $aaStack));
			break; //ORIGIN
			case 0x33:
				array_unshift($aaStack, $this->aaState["Is"]);
				print("Stack::". implode("::", $aaStack));
			break; //CALLER
			case 0x34:
				array_unshift($aaStack, $this->aaState["Iv"]);
				print("Stack::". implode("::", $aaStack));
			break; //CALLVALUE
			case 0x35:
				print("Stack::". implode("::", $aaStack));
			break; //CALLDATALOAD
			case 0x36:
				print("Stack::". implode("::", $aaStack));
			break; //CALLDATASIZE
			case 0x37:
				print("Stack::". implode("::", $aaStack));
			break; //CALLDATACOPY	
			case 0x38:
				print("Stack::". implode("::", $aaStack));
			break; //CODESIZE
			case 0x39:
				print("Stack::". implode("::", $aaStack));
			break; //CODECOPY
			case 0x3a:
				array_unshift($aaStack, $this->aaState["Ip"]);
				print("Stack::". implode("::", $aaStack));
			break; //GASPRICE
			case 0x3b:
				print("Stack::". implode("::", $aaStack));
			break; //EXTCODESIZE
			case 0x3c:
				print("Stack::". implode("::", $aaStack));
			break; //EXTCODECOPY
				
			case 0x40:
				print("Stack::". implode("::", $aaStack));
			break; //BLOCKHASH	
			case 0x41:
				array_unshift($aaStack, $this->aaState["IHc"]);
				print("Stack::". implode("::", $aaStack));
			break; //COINBASE
			case 0x42:
				array_unshift($aaStack, $this->aaState["IHs"]);
				print("Stack::". implode("::", $aaStack));
			break; //TIMESTAMP
			case 0x43:
				array_unshift($aaStack, $this->aaState["IHi"]);
				print("Stack::". implode("::", $aaStack));
			break; //NUMBER
			case 0x44:
				array_unshift($aaStack, $this->aaState["IHd"]);
				print("Stack::". implode("::", $aaStack));
			break; //DIFFICULTY
			case 0x45:
				array_unshift($aaStack, $this->aaState["IHl"]);
				print("Stack::". implode("::", $aaStack));
			break; //GASLIMIT
				
			case 0x50:
				print("Stack::". implode("::", $aaStack));
			break; //POP
			case 0x5a:
				array_unshift($aaStack, $this->aaState["Ip"]);
				print("Stack::". implode("::", $aaStack));
			break; //GAS
			case 0xf0:
				print("Stack::". implode("::", $aaStack));
			break; //CREATE
			case 0xf1:
				print("Stack::". implode("::", $aaStack));
			break; //CALL
			case 0xf2:
				print("Stack::". implode("::", $aaStack));
			break; //CALLCODE
			case 0xf3:
				array_unshift($aaStack, $this->aaState["IHc"]);
				print("Stack::". implode("::", $aaStack));
			break; //RETURN
			case 0xf4:
				array_unshift($aaStack, $this->aaState["IHs"]);
				print("Stack::". implode("::", $aaStack));
			break; //DELEGATECALL
			case 0xfe:
				array_unshift($aaStack, $this->aaState["IHi"]);
				print("Stack::". implode("::", $aaStack));
			break; //INVALID
			case 0xff:
				array_unshift($aaStack, $this->aaState["IHd"]);
				print("Stack::". implode("::", $aaStack));
			break; //SELFDESTRUCT
			default: break;
		}
		
		
		//print("Stack::". implode("::", $aaStack));
		return true;
	}
}
?>