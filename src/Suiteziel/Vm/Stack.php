<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Box;

class Stack extends Box
{ 
	public $i_sp; //stack pointer
	public $aaStack;
	private $a_e;
	private $aArguments;
		
	public function __construct () {
		$this->i_sp = 0;
		$this->aaStack = array();
		$this->aArguments = array();
		$this->iDelta = 0;
	}

	public function delta_set($iDelta) {
		$this->iDelta = $iDelta;
	}
	
	public function arguments_get() :array {//$i_k = null, $aArguments = null): int {
		//$i_kLeft = null;
		return $this->aArguments;
	}
		
	public function arguments_set($aArguments) {
		//$i_kLeft = null;
		$this->aArguments = $aArguments;
	}
	
	public function positioning($i_k = null, $sHex = null) {

		
		switch ($sHex) {
			case 0x00: return 1; break; //STOP
			case 0x01:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, array_sum($a_e));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //ADD
			case 0x02:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, array_product($a_e));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //MUL
			case 0x03:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, ($a_e[0] - $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SUB
			case 0x04:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, ($a_e[0] / $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DIV
			case 0x05: 
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, ($a_e[0] / $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SDIV
			case 0x06: 
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[1] == 0) array_unshift($this->aaStack, 0);
				else array_unshift($this->aaStack, ($a_e[0] % $a_e[1]));
				var_dump(implode("::", $this->aaStack));
			break; //MOD
			case 0x07: 
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[1] == 0) array_unshift($this->aaStack, 0);
				else array_unshift($this->aaStack, ($a_e[0] % $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SMOD
			case 0x08: 
				
	/*
				var_dump(array(
					$this->aaStack,
					'delta',
					$this->iDelta,
					count($this->aaStack)
				));
	*/
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[2] == 0) array_unshift($this->aaStack, 0);
				else array_unshift($this->aaStack, ($a_e[0] + ($a_e[1] % $a_e[2])));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //ADDMOD
			case 0x09:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[2] == 0) array_unshift($this->aaStack, 0);
				else array_unshift($this->aaStack, ($a_e[0] * ($a_e[1] % $a_e[2])));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //MULMOD
			case 0x0a: 
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, (pow($a_e[0], $a_e[1])));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //EXP
			case 0x0b:
			
			break; //SIGNEXTEND
			case 0x10:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] < $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LT
			case 0x11: 
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] > $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //GT
			case 0x12: // Where all values are treated as two’s complement signed 256-bit integers.
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] < $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SLT
			case 0x13:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] > $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SGT
			case 0x14:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] == $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //EQ
			case 0x15:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] == 0) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //ISZERO
			case 0x16:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] and $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //AND
			case 0x17:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] or $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //OR
			case 0x18: 
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] xor $a_e[1]) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //XOR
			case 0x19:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				if ($a_e[0] == 0) $i = 1;
				else $i = 0;
				array_unshift($this->aaStack, $i);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //NOT				
			case 0x1a:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				for($i = 0; $i < strlen($a_e[1]); $i++) $a_e[0] = ord($a_e[1]);
				array_unshift($this->aaStack, $a_e[0]);
				var_dump(implode("::", $this->aaStack));
				return true;
			break; //BYTE
			case 0x1b:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, ($a_e[0] >> $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SHL Left shift operation.
			case 0x1c:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, ($a_e[0] << $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SHR Logical right shift operation.
			case 0x1d:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, ($a_e[0] << $a_e[1]));
				var_dump(implode("::", $this->aaStack));
				return true;
			break; //SAR 
			case 0x20:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$s_sha3 = hash('sha3-256', $a_e[1]);
				array_unshift($this->aaStack, $s_sha3);
				var_dump(implode("::", $this->aaStack));
				return true;
			break; //SHA3
			case 0x30:

				var_dump(implode("::", $this->aaStack));
				return true;
			break; //ADDRESS
			case 0x31: return 1; break; //BALANCE
			case 0x32: return 1; break; //ORIGIN
			case 0x33: return 1; break; //CALLER
			case 0x34: return 1; break; //CALLVALUE
			case 0x35: return 1; break; //CALLDATALOAD
			case 0x36: return 1; break; //CALLDATASIZE
			case 0x37: return 1; break; //CALLDATACOPY
			case 0x38: return 1; break; //CODESIZE
			case 0x39: return 1; break; //CODECOPY
			case 0x3a: return 1; break; //GASPRICE
			case 0x3b: return 1; break; //EXTCODESIZE
			case 0x3c: return 1; break; //EXTCODECOPY
			case 0x40: return 1; break; //BLOCKHASH
			case 0x41: return 1; break; //COINBASE
			case 0x42: return 1; break; //TIMESTAMP
			case 0x43: return 1; break; //NUMBER
			case 0x44: return 1; break; //DIFFICULTY
			case 0x45: return 1; break; //GASLIMIT
			case 0x50: return 1; break; //POP
			case 0x51: return 1; break; //MLOAD
			case 0x52: return 1; break; //MSTORE
			case 0x53: return 1; break; //MSTORE8
			case 0x54: return 1; break; //SLOAD
			case 0x55: return 1; break; //SSTORE
			case 0x56: return 1; break; //JUMP
			case 0x57: return 1; break; //JUMPI
			case 0x58: return 1; break; //PC
			case 0x59: return 1; break; //MSIZE
			case 0x5a: return 1; break; //GAS
			case 0x5b: return 1; break; //JUMPDEST
			case 0x60:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, $aArgument);
				return true; 
			break; //PUSH1
			case 0x61: return 1; break; //PUSH2
			case 0x62: return 1; break; //PUSH3
			case 0x63: return 1; break; //PUSH4
			case 0x64: return 1; break; //PUSH5
			case 0x65: return 1; break; //PUSH6
			case 0x66: return 1; break; //PUSH7
			case 0x67: return 1; break; //PUSH8
			case 0x68: return 1; break; //PUSH9
			case 0x69: return 1; break; //PUSH10
			case 0x6a: return 1; break; //PUSH11
			case 0x6b: return 1; break; //PUSH12
			case 0x6c: return 1; break; //PUSH13
			case 0x6d: return 1; break; //PUSH14
			case 0x6e: return 1; break; //PUSH15
			case 0x6f: return 1; break; //PUSH16
			case 0x70: return 1; break; //PUSH17
			case 0x71: return 1; break; //PUSH18
			case 0x72: return 1; break; //PUSH19
			case 0x73: return 1; break; //PUSH20
			case 0x74: return 1; break; //PUSH21
			case 0x75: return 1; break; //PUSH22
			case 0x76: return 1; break; //PUSH23
			case 0x77: return 1; break; //PUSH24
			case 0x78: return 1; break; //PUSH25
			case 0x79: return 1; break; //PUSH26
			case 0x7a: return 1; break; //PUSH27
			case 0x7b: return 1; break; //PUSH28
			case 0x7c: return 1; break; //PUSH29
			case 0x7d: return 1; break; //PUSH30
			case 0x7e: return 1; break; //PUSH31
			case 0x7f: return 1; break; //PUSH32
			case 0x80: return 1; break; //DUP1
			case 0x81: return 1; break; //DUP2
			case 0x82: return 1; break; //DUP3
			case 0x83: return 1; break; //DUP4
			case 0x84: return 1; break; //DUP5
			case 0x85: return 1; break; //DUP6
			case 0x86: return 1; break; //DUP7
			case 0x87: return 1; break; //DUP8
			case 0x88: return 1; break; //DUP9
			case 0x89: return 1; break; //DUP10
			case 0x8a: return 1; break; //DUP11
			case 0x8b: return 1; break; //DUP12
			case 0x8c: return 1; break; //DUP13
			case 0x8d: return 1; break; //DUP14
			case 0x8e: return 1; break; //DUP15
			case 0x8f: return 1; break; //DUP16
			case 0x90: return 1;  break; //SWAP1
			case 0x91: return 1;  break; //SWAP2
			case 0x92: return 1;  break; //SWAP3
			case 0x93: return 1;  break; //SWAP4
			case 0x94: return 1;  break; //SWAP5
			case 0x95: return 1;  break; //SWAP6
			case 0x96: return 1;  break; //SWAP7
			case 0x97: return 1;  break; //SWAP8
			case 0x98: return 1;  break; //SWAP9
			case 0x99: return 1;  break; //SWAP10
			case 0x9a: return 1;  break; //SWAP11
			case 0x9b: return 1;  break; //SWAP12
			case 0x9c: return 1;  break; //SWAP13
			case 0x9d: return 1;  break; //SWAP14
			case 0x9e: return 1;  break; //SWAP15
			case 0x9f: return 1;  break; //SWAP16
			case 0xa0: return 1;  break; //LOG0
			case 0xa1: return 1;  break; //LOG1
			case 0xa2: return 1;  break; //LOG2
			case 0xa3: return 1;  break; //LOG3
			case 0xa4: return 1;  break; //LOG4
			case 0xf0: return 1;  break; //CREATE
			case 0xf1: return 1;  break; //CALL
			case 0xf2: return 1;  break; //CALLCODE
			case 0xf3: return 1;  break; //RETURN
			case 0xf4: return 1;  break; //DELEGATECALL
			//0xfe_jj11_INVALID_s_NaN_s_Designated invalid instruction
			case 0xff: return 1;  break; //SELFDESTRUCT
			default: return true; break;
		}
		return true;
		
		
	}
	
	
	
}

?>