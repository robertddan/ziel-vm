<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Box;

class Stack extends Box
{ 
	public $i_sp; //stack pointer
	public $aaStack;
	private $aArguments;
		
	public function __construct () {
		$this->i_sp = 0;
		$this->aaStack = array();
		$this->aArguments = array();
	}

	public function arguments_get() :array {//$iKey = null, $aArguments = null): int {
		//$iKeyLeft = null;
		return $this->aArguments;
	}
		
	public function arguments_set($aArguments) {
		//$iKeyLeft = null;
		$this->aArguments = $aArguments;
	}
	
	public function positioning($iKey = null, $sHex = null) {
		return true;
		switch ($sHex) {
			case 0x00: return 0; break; //STOP
			case 0x01: 
				array_unshift($this->aaStack, array_reverse($this->aArguments));
				
				return true; 
			break; //ADD
			case 0x02: return 0; break; //MUL
			case 0x03: return 0; break; //SUB
			case 0x04: return 0; break; //DIV
			case 0x05: return 0; break; //SDIV
			case 0x06: return 0; break; //MOD
			case 0x07: return 0; break; //SMOD
			case 0x08: return 0; break; //ADDMOD
			case 0x09: return 0; break; //MULMOD
			case 0x0a: return 0; break; //EXP
			case 0x0b: return 0; break; //SIGNEXTEND
			case 0x10: return 0; break; //LT
			case 0x11: return 0; break; //GT
			case 0x12: return 0; break; //SLT
			case 0x13: return 0; break; //SGT
			case 0x14: return 0; break; //EQ
			case 0x15: return 0; break; //ISZERO
			case 0x16: return 0; break; //AND
			case 0x17: return 0; break; //OR
			case 0x18: return 0; break; //XOR
			case 0x19: return 0; break; //NOT
			case 0x1a: return 0; break; //BYTE
			case 0x20: return 0; break; //SHA3
			case 0x30: return 0; break; //ADDRESS
			case 0x31: return 0; break; //BALANCE
			case 0x32: return 0; break; //ORIGIN
			case 0x33: return 0; break; //CALLER
			case 0x34: return 0; break; //CALLVALUE
			case 0x35: return 0; break; //CALLDATALOAD
			case 0x36: return 0; break; //CALLDATASIZE
			case 0x37: return 0; break; //CALLDATACOPY
			case 0x38: return 0; break; //CODESIZE
			case 0x39: return 0; break; //CODECOPY
			case 0x3a: return 0; break; //GASPRICE
			case 0x3b: return 0; break; //EXTCODESIZE
			case 0x3c: return 0; break; //EXTCODECOPY
			case 0x40: return 0; break; //BLOCKHASH
			case 0x41: return 0; break; //COINBASE
			case 0x42: return 0; break; //TIMESTAMP
			case 0x43: return 0; break; //NUMBER
			case 0x44: return 0; break; //DIFFICULTY
			case 0x45: return 0; break; //GASLIMIT
			case 0x50: return 0; break; //POP
			case 0x51: return 0; break; //MLOAD
			case 0x52: return 0; break; //MSTORE
			case 0x53: return 0; break; //MSTORE8
			case 0x54: return 0; break; //SLOAD
			case 0x55: return 0; break; //SSTORE
			case 0x56: return 0; break; //JUMP
			case 0x57: return 0; break; //JUMPI
			case 0x58: return 0; break; //PC
			case 0x59: return 0; break; //MSIZE
			case 0x5a: return 0; break; //GAS
			case 0x5b: return 0; break; //JUMPDEST
			case 0x60: return 0; break; //PUSH1
			case 0x61: return 0; break; //PUSH2
			case 0x62: return 0; break; //PUSH3
			case 0x63: return 0; break; //PUSH4
			case 0x64: return 0; break; //PUSH5
			case 0x65: return 0; break; //PUSH6
			case 0x66: return 0; break; //PUSH7
			case 0x67: return 0; break; //PUSH8
			case 0x68: return 0; break; //PUSH9
			case 0x69: return 0; break; //PUSH10
			case 0x6a: return 0; break; //PUSH11
			case 0x6b: return 0; break; //PUSH12
			case 0x6c: return 0; break; //PUSH13
			case 0x6d: return 0; break; //PUSH14
			case 0x6e: return 0; break; //PUSH15
			case 0x6f: return 0; break; //PUSH16
			case 0x70: return 0; break; //PUSH17
			case 0x71: return 0; break; //PUSH18
			case 0x72: return 0; break; //PUSH19
			case 0x73: return 0; break; //PUSH20
			case 0x74: return 0; break; //PUSH21
			case 0x75: return 0; break; //PUSH22
			case 0x76: return 0; break; //PUSH23
			case 0x77: return 0; break; //PUSH24
			case 0x78: return 0; break; //PUSH25
			case 0x79: return 0; break; //PUSH26
			case 0x7a: return 0; break; //PUSH27
			case 0x7b: return 0; break; //PUSH28
			case 0x7c: return 0; break; //PUSH29
			case 0x7d: return 0; break; //PUSH30
			case 0x7e: return 0; break; //PUSH31
			case 0x7f: return 0; break; //PUSH32
			case 0x80: return 0; break; //DUP1
			case 0x81: return 0; break; //DUP2
			case 0x82: return 0; break; //DUP3
			case 0x83: return 0; break; //DUP4
			case 0x84: return 0; break; //DUP5
			case 0x85: return 0; break; //DUP6
			case 0x86: return 0; break; //DUP7
			case 0x87: return 0; break; //DUP8
			case 0x88: return 0; break; //DUP9
			case 0x89: return 0; break; //DUP10
			case 0x8a: return 0; break; //DUP11
			case 0x8b: return 0; break; //DUP12
			case 0x8c: return 0; break; //DUP13
			case 0x8d: return 0; break; //DUP14
			case 0x8e: return 0; break; //DUP15
			case 0x8f: return 0; break; //DUP16
			case 0x90: return 0; break; //SWAP1
			case 0x91: return 0; break; //SWAP2
			case 0x92: return 0; break; //SWAP3
			case 0x93: return 0; break; //SWAP4
			case 0x94: return 0; break; //SWAP5
			case 0x95: return 0; break; //SWAP6
			case 0x96: return 0; break; //SWAP7
			case 0x97: return 0; break; //SWAP8
			case 0x98: return 0; break; //SWAP9
			case 0x99: return 0; break; //SWAP10
			case 0x9a: return 0; break; //SWAP11
			case 0x9b: return 0; break; //SWAP12
			case 0x9c: return 0; break; //SWAP13
			case 0x9d: return 0; break; //SWAP14
			case 0x9e: return 0; break; //SWAP15
			case 0x9f: return 0; break; //SWAP16
			case 0xa0: return 0; break; //LOG0
			case 0xa1: return 0; break; //LOG1
			case 0xa2: return 0; break; //LOG2
			case 0xa3: return 0; break; //LOG3
			case 0xa4: return 0; break; //LOG4
			case 0xf0: return 0; break; //CREATE
			case 0xf1: return 0; break; //CALL
			case 0xf2: return 0; break; //CALLCODE
			case 0xf3: return 0; break; //RETURN
			case 0xf4: return 0; break; //DELEGATECALL
			//0xfe_jj11_INVALID_s_NaN_s_Designated invalid instruction
			case 0xff: return 0; break; //SELFDESTRUCT
		}
		
		
	}
	
	
	
}

?>