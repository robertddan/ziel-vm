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
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH1
			case 0x61:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH2
			case 0x62:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH3
			case 0x63:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH4
			case 0x64:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH5
			case 0x65:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH6
			case 0x66:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH7
			case 0x67:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH8
			case 0x68:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH9
			case 0x69:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH10
			case 0x6a:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH11
			case 0x6b:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH12
			case 0x6c:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH13
			case 0x6d:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH14
			case 0x6e:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH15
			case 0x6f:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH16
			case 0x70:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH17
			case 0x71:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH18
			case 0x72:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH19
			case 0x73:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH20
			case 0x74:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH21
			case 0x75:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH22
			case 0x76:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH23
			case 0x77:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH24
			case 0x78:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH25
			case 0x79:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH26
			case 0x7a:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH27
			case 0x7b:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH28
			case 0x7c:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH29
			case 0x7d:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH30
			case 0x7e:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH31
			case 0x7f:
				foreach ($this->aArguments as $aArgument) array_unshift($this->aaStack, pack("H*", str_replace($aArgument, "0x", "")));
				return true; 
			break; //PUSH32
			case 0x80:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[0]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP1
			case 0x81:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[1]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP2
			case 0x82:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[2]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP3
			case 0x83:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[3]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP4
			case 0x84:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[4]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP5
			case 0x85:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[5]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP6
			case 0x86:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[6]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP7
			case 0x87:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[7]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP8
			case 0x88:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[8]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP9
			case 0x89:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[9]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP10
			case 0x8a:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[10]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP11
			case 0x8b:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[11]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP12
			case 0x8c:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[12]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP13
			case 0x8d:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[13]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP14
			case 0x8e:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[14]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP15
			case 0x8f:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, $a_e[15]);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //DUP16
			case 0x90:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[1];
				$this->aaStack[1] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP1
			case 0x91:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[2];
				$this->aaStack[2] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP2
			case 0x92:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[3];
				$this->aaStack[3] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP3
			case 0x93:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[4];
				$this->aaStack[4] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP4
			case 0x94:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[5];
				$this->aaStack[5] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP5
			case 0x95:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[6];
				$this->aaStack[6] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP6
			case 0x96:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[7];
				$this->aaStack[7] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP7
			case 0x97:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[8];
				$this->aaStack[8] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP8
			case 0x98:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[9];
				$this->aaStack[9] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP9
			case 0x99:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[10];
				$this->aaStack[10] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP10
			case 0x9a:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[11];
				$this->aaStack[11] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP11
			case 0x9b:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[12];
				$this->aaStack[12] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP12
			case 0x9c:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[13];
				$this->aaStack[13] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP13
			case 0x9d:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[14];
				$this->aaStack[14] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP14
			case 0x9e:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[15];
				$this->aaStack[15] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP15
			case 0x9f:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				$this->aaStack[0] = $a_e[16];
				$this->aaStack[16] = $a_e[0];
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //SWAP16
			case 0xa0:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, 0);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG0
			case 0xa1:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, 0);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG1
			case 0xa2:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, 0);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG2
			case 0xa3:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, 0);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG3
			case 0xa4:
				$a_e = array_splice($this->aaStack, 0, $this->iDelta);
				array_unshift($this->aaStack, 0);
				var_dump(implode("::", $this->aaStack));
				return true; 
			break; //LOG4
			case 0xf0: return 1; break; //CREATE
			case 0xf1: return 1; break; //CALL
			case 0xf2: return 1; break; //CALLCODE
			case 0xf3: return 1; break; //RETURN
			case 0xf4: return 1; break; //DELEGATECALL
			//0xfe_jj11_INVALID_s_NaN_s_Designated invalid instruction
			case 0xff: return 1; break; //SELFDESTRUCT
			default: return true; break;
		}
		return true;
		
		
	}
	
	
	
}

?>