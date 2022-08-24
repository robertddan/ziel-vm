<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Org\Session;
use App\Suiteziel\Vm\Opcodes;
use App\Suiteziel\VM\Stack;
use App\Suiteziel\VM\Route;

class State
{
	public $aHes;
	public static $aaState;

	public function __construct () {
		self::$aaState = array(
			// Ia, the address of the account which owns the code that is executing. 
			"Ia" => Session::$_aData["wallet"][0],
			// Io, the sender address of the transaction that originated this execution. 
			"Io" => "",
			// Ip, the price of gas in the transaction that originated this execution. 
			"Ip" => "",
			// Id, the byte array that is the input data to this execution; if the execution agent is a transaction, this would be the transaction data.
      /*
			"Id" => array('60','57','36','1d','00','00','00','00',
										'00','00','00','00','00','00','00','00',
										'00','00','00','00','00','00','00','00',
										'00','00','00','00','00','00','00','42'),
										
			"Id" => array('4f','2b','e9','1f','00','00','00','00',
										'00','00','00','00','00','00','00','00',
										'00','00','00','00','00','00','00','00',
										'00','00','00','00','00','00','00','42'),
									
			"Id" => array('1a','69','52','30','00','00','00','00',
										'00','00','00','00','00','00','00','00',
										'ab','84','83','f6','4d','9c','6d','1e',
										'cf','9b','84','9a','e6','77','dd','33',
										'15','83','5c','b2'),
			*/
			"Id" => array('1a','69','52','30','00','00','00','00',
										'00','00','00','00','00','00','00','00',
										'4b','20','99','3b','c4','81','17','7e',
										'c7','e8','f5','71','ce','ca','e8','a9',
										'e2','2c','02','db'),
/*
0x2be91f
6057361d e
00000000 00000000 
00000000 00000000 
00000000 00000000 
00000000 00000042
*/

			// Is, the address of the account which caused the code to be executing; if the execution agent is a transaction, this would be the transaction sender. 
			"Is" => Session::$_aData["wallet"][0], //"transaction sender",
			// Iv, the value, in Wei, passed to this account as part of the same procedure as execution; if the execution agent is a transaction, this would be the transaction value. 
			"Iv" => $this->shift_left('16'), //70000000000000000000, //"transaction value"
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
	
	public function hes_set () :bool {
		$this->aHes = Route::$aHex;
		return true;
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
    
    if (!$this->hes_set()) die('$this->hes_set()');
    
		switch ($sDec) {
			case 0x00:
				$i_pc = -1;
			break; //STOP
			case 0x56:				
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				foreach($a_e as &$s_x) $s_x = hexdec($s_x);
				$i_pc = $a_e[0] - 1;
				print("i_pc: ".( $i_pc + 1));
				print(PHP_EOL);
				print(
					str_pad("Stack", 10, ":"). 
					implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
				);
				print(PHP_EOL);
				#if (!in_array($i_pc, array(12, 411))) die($i_pc);
			break; //JUMP
			case 0x57:
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				$oaFor = gmp_init($a_e[1]);
				foreach($a_e as &$s_x) $s_x = hexdec($s_x);
				$iResult = gmp_cmp($oaFor, 0);
				if ($iResult !== 0) $i_pc = $a_e[0] - 1;
				else $i_pc = $i_pc;
				print("i_pc: ". ($i_pc + 1));
				print(PHP_EOL);
				print(
					str_pad("Stack", 10, ":"). 
					implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
				);
				print(PHP_EOL);
				#if (!in_array($i_pc, array(12, 115, 429, 461))) die($i_pc);
			break; //JUMPI
			case 0x58:
				array_unshift(Stack::$aaStack, $i_pc);
			break; //PC
			case 0x5b:
				print("i_pc: ". $i_pc);
				print(PHP_EOL);
				print(
					str_pad("Stack", 10, ":"). 
					implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
				);
				print(PHP_EOL);
			break; //JUMPDEST
			case 0x30:
				array_unshift(Stack::$aaStack, self::$aaState["Ia"]);
			break; //ADDRESS
			case 0x32:
				array_unshift(Stack::$aaStack, self::$aaState["Io"]);
			break; //ORIGIN
			case 0x33:#
				array_unshift(Stack::$aaStack, $this->shift_left(self::$aaState["Is"])); 
				
				print(
					str_pad("Stack", 10, ":"). 
					implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
				);
				print(PHP_EOL);
			break; //CALLER
			case 0x34:
				array_unshift(Stack::$aaStack, self::$aaState["Iv"]);
				
				
				print(
					str_pad("Stack", 10, ":"). 
					implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
				);
				print(PHP_EOL);
				
			break; //CALLVALUE
			case 0x35:
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				if (hexdec($a_e[0]) == 0)
				{
					$sLeft = array_slice(self::$aaState["Id"], 0, 4);
					$sArgument = $this->shift_right(implode($sLeft));
				}
				else {
					#var_dump([(-1 * (count(self::$aaState["Id"]) -4) ), (count(self::$aaState["Id"])), self::$aaState["Id"]]);
					
					$sRight = array_slice(self::$aaState["Id"], (-1 * count(self::$aaState["Id"]))/2 -4, (count(self::$aaState["Id"])/2 +4) );
					#var_dump($sRight);
					
					$sArgument = $this->shift_left(implode("", $sRight));

				}

				array_unshift(Stack::$aaStack, $sArgument);

				#print("State::". implode("::", self::$aaState["Id"]));
				#print(PHP_EOL);
		print(
			str_pad("Stack", 10, ":"). 
			implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
		);
				print(PHP_EOL);
			break; //CALLDATALOAD
			case 0x36:
				#$aId = array_slice(self::$aaState["Id"], 8, (count(self::$aaState["Id"]) - 8));
				$aId = array_slice(self::$aaState["Id"], (-1 * count(self::$aaState["Id"]))/2 -6, (count(self::$aaState["Id"])/2 +6) );
					
				$i_e = count($aId);
				array_unshift(Stack::$aaStack, $this->shift_left($i_e)); 
				print(
					str_pad("Stack", 10, ":"). 
					implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
				);
				print(PHP_EOL);
			break; //CALLDATASIZE
			case 0x37:
			break; //CALLDATACOPY	
			case 0x38:
			break; //CODESIZE

			case 0x3a:
				array_unshift(Stack::$aaStack, self::$aaState["Ip"]);
			break; //GASPRICE
			case 0x3b:
			break; //EXTCODESIZE
			case 0x3c:
				
			break; //EXTCODECOPY
				
			case 0x40:
			break; //BLOCKHASH	
			case 0x41:
				array_unshift(Stack::$aaStack, self::$aaState["IH"]["c"]);
			break; //COINBASE
			case 0x42:
				array_unshift(Stack::$aaStack, self::$aaState["IH"]["s"]);
			break; //TIMESTAMP
			case 0x43:
				array_unshift(Stack::$aaStack, self::$aaState["IH"]["i"]);
			break; //NUMBER
			case 0x44:
				array_unshift(Stack::$aaStack, self::$aaState["IH"]["d"]);
			break; //DIFFICULTY
			case 0x45:
				array_unshift(Stack::$aaStack, self::$aaState["IH"]["l"]);
			break; //GASLIMIT
				

			case 0x5a:
				array_unshift(Stack::$aaStack, self::$aaState["Ip"]);
			break; //GAS
			case 0xf0:
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				
				array_unshift(Stack::$aaStack, self::$aaState["Ia"]);
				
		print(
			str_pad("Stack", 10, ":"). 
			implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
		);
				print(PHP_EOL);
			break; //CREATE
			case 0xf1:
			break; //CALL
			case 0xf2:
			break; //CALLCODE
			case 0xf3:
				$a_e = array_splice(Stack::$aaStack, 0, $iDelta);
				//var_dump($a_e);
				$i_pc = -1;
				
				print(
					str_pad("Stack", 10, ":"). 
					implode(PHP_EOL.str_pad("", 10, ":") , Stack::$aaStack)
				);
				print(PHP_EOL);
				
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

		$__aState = array();
		foreach(self::$aaState as $k => $aaState) {
			
			if (is_array($aaState)) foreach($aaState as $aState) array_push($__aState, $aState); 
			else array_push($__aState, $aaState); 
		}
		
		#print(PHP_EOL);
    #print("State::". implode("::", $__aState)); 
		print(
			str_pad("State", 10, ":"). 
			implode("::", $__aState)
		);

		
		#print(PHP_EOL);
		#print("Stack::". implode("::", Stack::$aaStack));
    
		return true;
	}
}
?>