<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Org\Session;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\VM\Stack;

class State
{
	public $aHes;
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
			"Id" => array('60','57','36','1d','00','00','00','00',
										'00','00','00','00','00','00','00','00',
										'00','00','00','00','00','00','00','00',
										'00','00','00','00','00','00','00','42'),
/*
6057361d e
00000000 00000000 
00000000 00000000 
00000000 00000000 
00000000 00000042
*/

			// Is, the address of the account which caused the code to be executing; if the execution agent is a transaction, this would be the transaction sender. 
			"Is" => Session::$_aData["wallet"][0], //"transaction sender",
			// Iv, the value, in Wei, passed to this account as part of the same procedure as execution; if the execution agent is a transaction, this would be the transaction value. 
			"Iv" => $this->shift_left(0),//70000000000000000000, //"transaction value"
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
	
	public function hes_set ($aHes = null) :bool {
		$this->aHes = $aHes;
		return true;
	}

	public function shift_left ($sHex) {
		return "0x". str_pad($sHex, 32, 0, STR_PAD_LEFT);
	}
    		
	public function shift_right ($sHex) {
		return "0x". str_pad($sHex, 32, 0, STR_PAD_RIGHT);
	}

	public function positioning(&$i_pc, $sHex) {
    
    $sDec = hexdec($sHex);
    $aArguments = Opcodes::$_aArguments;
    $iDelta = Opcodes::$_aaOpcodes[$sDec][1];
		$this->aaState = self::$_aaState;

		switch ($sDec) {
			case 0x00:
				$i_pc = -1;
			break; //STOP
			case 0x56:				
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				//var_dump($a_e);
				$i_pc = $a_e[0] -1;
				print(PHP_EOL);
				print("Stack::". implode("::", Stack::$aaStack));
/*
    0:
    0x000000000000000000000000000000000000000000000000000000000000007a
    1:
    0x0000000000000000000000000000000000000000000000000000000000000004
    2:
    0x0000000000000000000000000000000000000000000000000000000000000024
    3:
    0x0000000000000000000000000000000000000000000000000000000000000073
    4:
    0x0000000000000000000000000000000000000000000000000000000000000078
    5:
    0x000000000000000000000000000000000000000000000000000000006057361d
*/
			break; //JUMP
			case 0x57:
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
#μs[0] if μs[1] 6 = 0
#μpc + 1 otherwise
				if ($a_e[1] != 0) $i_pc = $a_e[0] - 1;
				else $i_pc = $i_pc;// + 1;
        #if ($i_pc == 104) die();
				//var_dump($a_e);
			break; //JUMPI
			case 0x58:
				array_unshift(Stack::$aaStack, $i_pc);
			break; //PC
			case 0x62:
        var_dump($i_pc);

				print(PHP_EOL);
				print("Stack::". implode("::", Stack::$aaStack));
			break; //JUMPDEST
			case 0x30:
				array_unshift(Stack::$aaStack, $this->aaState["Ia"]);
			break; //ADDRESS
			case 0x32:
				array_unshift(Stack::$aaStack, $this->aaState["Io"]);
			break; //ORIGIN
			case 0x33:
				array_unshift(Stack::$aaStack, $this->aaState["Is"]);
			break; //CALLER
			case 0x34:
				array_unshift(Stack::$aaStack, $this->aaState["Iv"]);
			break; //CALLVALUE
			case 0x35:
				
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);

				$aId = array_slice($this->aaState["Id"], 0, 4);
				$ae = array();
				$ie = 0;
				
				foreach($this->aHes as $i_k => $hes) {
					if ($ie == count($aId)) {/*$i_pc = $i_k;*/ break;}
					if ($hes == base_convert($aId[$ie], 16, 10)) {
						array_push($ae, $hes);
						$ie = $ie + 1;
					}
					else {
						$ae = array();
						$ie = 0;
					}
				}
				
				$sArgument = implode("", $aId);
				array_unshift(Stack::$aaStack, '0x'.$sArgument);
				
/*
	if (!empty($aDiff))
	
	foreach ($aId as $aStateId) {
		if ($hes == $aStateId) array_push($ae, $hes);
	}
	$aDiff = array_diff($ae, $aId);
	if (!empty($aDiff)) array_pop($ae); break;
				foreach ($this->aaState["Id"] as $_k => $aStateId) {
					if ($_k >= 31) break;
					$_e = mb_strlen(serialize($aStateId), '8bit');
					if ($_k >= $_e ) $this->aaState["Id"][$_k] = 0;
				}
				
				$sStateId = implode("", $this->aaState["Id"]); 
				array_unshift(Stack::$aaStack, $sStateId);
				
				
				array_unshift(Stack::$aaStack, $this->aaState["Iv"]);
				μ′s[0] ≡ Id[μs[0] . . . (μs[0] + 31)] 
				Id[x] = 0 if x > ‖Id‖
				euclidean
				$this->aaState = self::$_aaState = array(
				// Ia, the address of the account which owns the code that is executing. 
				"Ia" => Session::$_aData["wallet"][0],
				// Io, the sender address of the transaction that originated this execution. 
				"Io" => "",
				// Ip, the price of gas in the transaction that originated this execution. 
				"Ip" => "",
				// Id, the byte array that is the input data to this execution; if the execution agent is a transaction, this would be the transaction data. 
				"Id" => array('60', '57', '36', '1d'),
	*/
				
				#print(PHP_EOL);
				#print("State::". implode("::", $this->aaState["Id"]));
				print(PHP_EOL);
				print("Stack::". implode("::", Stack::$aaStack));
			break; //CALLDATALOAD
			case 0x36:
				$aId = array_slice($this->aaState["Id"], 8, 32);
				
/*
var_dump([
	count($aId),
	$aId,
	strlen(implode($aId))
]);
die();
*/
				//array_unshift(Stack::$aaStack, mb_strlen(serialize(Stack::$aaStack), '8bit')); 
				$i_e = count($aId);
				array_unshift(Stack::$aaStack, $i_e); 
						
				print(PHP_EOL);
				print("Stack::". implode("::", Stack::$aaStack));
			break; //CALLDATASIZE
			case 0x37:
			break; //CALLDATACOPY	
			case 0x38:
			break; //CODESIZE

			case 0x3a:
				array_unshift(Stack::$aaStack, $this->aaState["Ip"]);
			break; //GASPRICE
			case 0x3b:
			break; //EXTCODESIZE
			case 0x3c:
				
			break; //EXTCODECOPY
				
			case 0x40:
			break; //BLOCKHASH	
			case 0x41:
				array_unshift(Stack::$aaStack, $this->aaState["IH"]["c"]);
			break; //COINBASE
			case 0x42:
				array_unshift(Stack::$aaStack, $this->aaState["IH"]["s"]);
			break; //TIMESTAMP
			case 0x43:
				array_unshift(Stack::$aaStack, $this->aaState["IH"]["i"]);
			break; //NUMBER
			case 0x44:
				array_unshift(Stack::$aaStack, $this->aaState["IH"]["d"]);
			break; //DIFFICULTY
			case 0x45:
				array_unshift(Stack::$aaStack, $this->aaState["IH"]["l"]);
			break; //GASLIMIT
				

			case 0x5a:
				array_unshift(Stack::$aaStack, $this->aaState["Ip"]);
			break; //GAS
			case 0xf0:
			break; //CREATE
			case 0xf1:
			break; //CALL
			case 0xf2:
			break; //CALLCODE
			case 0xf3:
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				//var_dump($a_e);
				$i_pc = 'STOP';
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
		foreach($this->aaState as $aaState) {
			if (is_array($aaState)) print("State::". implode("::", $aaState)); 
			//else print(PHP_EOL . "State::"."::". $aaState); 
		}
		return true;
	}
}
?>