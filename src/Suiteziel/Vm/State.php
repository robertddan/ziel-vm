<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Org\Session;

class State
{
	public $aaState;
	public static $_aaState;

	public function __construct () {
		$this->aaState = self::$_aaState = array(
			// Ia, the address of the account which owns the code that is executing. 
			"Ia" => Session::$_aData["wallet"][0],
			// Io, the sender address of the transaction that originated this execution. 
			"Io" => "",
			// Ip, the price of gas in the transaction that originated this execution. 
			"Ip" => "",
			// Id, the byte array that is the input data to this execution; if the execution agent is a transaction, this would be the transaction data. 
			"Id" => "",
			// Is, the address of the account which caused the code to be executing; if the execution agent is a transaction, this would be the transaction sender. 
			"Is" => Session::$_aData["wallet"][0], //"transaction sender",
			// Iv, the value, in Wei, passed to this account as part of the same procedure as execution; if the execution agent is a transaction, this would be the transaction value. 
			"Iv" => 0,//70000000000000000000, //"transaction value"
			// Ib, the byte array that is the machine code to be executed. 
			"Ib" => "",
			// IH, the block header of the present block. 
			/*"IH" => array(
				"c" => null,
				"s" => null,
				"i" => null,
				"d" => null,
				"l" => null
			),*/ //array("c","s","i","d","l")
			// Ie, the depth of the present message-call or contract-creation (i.e. the number of CALLs or CREATE(2)s being executed at present). 
			"Ie" => "",
			// Iw, the permission to make modi cations to the state.
			"Iw" => "",
		);
	}

	public function positioning(&$aa_p) { //$i_k = null, $sHex = null, $aArguments = null, $iDelta = null) {
		
		list($sHex, $aArguments, $iDelta, &$i_pc, &$aaStack) = $aa_p;
		switch ($sHex) {
			case 0x00:
				$i_pc = 'STOP';
			break; //STOP
			case 0x56:				
				$a_e = array_unshift($aaStack, 0, $iDelta);
				//var_dump($a_e);
				$i_pc = $a_e[0];
			break; //JUMP
			case 0x57:
				$a_e = array_splice($aaStack, 0, $iDelta);

				if ($a_e[1] != 0) $i_pc = $a_e[0] -1;
				else $i_pc = $i_pc;// + 1;
				//var_dump($a_e);
			break; //JUMPI
			case 0x58:
				array_unshift($aaStack, $i_pc);
			break; //PC
			case 0x62:
			break; //JUMPDEST
			case 0x30:
				array_unshift($aaStack, $this->aaState["Ia"]);
			break; //ADDRESS
			case 0x32:
				array_unshift($aaStack, $this->aaState["Io"]);
			break; //ORIGIN
			case 0x33:
				array_unshift($aaStack, $this->aaState["Is"]);
			break; //CALLER
			case 0x34:
				array_unshift($aaStack, $this->aaState["Iv"]);
			break; //CALLVALUE
			case 0x35:
			break; //CALLDATALOAD
			case 0x36:
				//array_unshift($aaStack, mb_strlen(serialize($aaStack), '8bit')); 
				array_unshift($aaStack, 3); 
		print(PHP_EOL);
		print("Stack::". implode("::", $aaStack));
			break; //CALLDATASIZE
			case 0x37:
			break; //CALLDATACOPY	
			case 0x38:
			break; //CODESIZE

			case 0x3a:
				array_unshift($aaStack, $this->aaState["Ip"]);
			break; //GASPRICE
			case 0x3b:
			break; //EXTCODESIZE
			case 0x3c:
			break; //EXTCODECOPY
				
			case 0x40:
			break; //BLOCKHASH	
			case 0x41:
				array_unshift($aaStack, $this->aaState["IH"]["c"]);
			break; //COINBASE
			case 0x42:
				array_unshift($aaStack, $this->aaState["IH"]["s"]);
			break; //TIMESTAMP
			case 0x43:
				array_unshift($aaStack, $this->aaState["IH"]["i"]);
			break; //NUMBER
			case 0x44:
				array_unshift($aaStack, $this->aaState["IH"]["d"]);
			break; //DIFFICULTY
			case 0x45:
				array_unshift($aaStack, $this->aaState["IH"]["l"]);
			break; //GASLIMIT
				

			case 0x5a:
				array_unshift($aaStack, $this->aaState["Ip"]);
			break; //GAS
			case 0xf0:
			break; //CREATE
			case 0xf1:
			break; //CALL
			case 0xf2:
			break; //CALLCODE
			case 0xf3:
			break; //RETURN
			case 0xf4:
			break; //DELEGATECALL
			case 0xfe:
			break; //INVALID
			case 0xff:
			break; //SELFDESTRUCT
			case 0x00:
				var_dump('DEBUG');
			break; //DEBUG
			default: return true; break;
		}
		
		
		print(PHP_EOL);
		print("State::". implode("::", $this->aaState));
		return true;
	}
}
?>