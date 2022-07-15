<?php
namespace App\Suiteziel\Vm;


use App\Suiteziel\Vm\Opcodes;

class Stack
{ 
	public $i_sp; //stack pointer
	public $aaStack;
	private $aaOpcodes;
		
	public function __construct () {
		$this->i_sp = 0;
		$this->aaStack = array();
		$this->aArguments = array();
		
		$this->oOpcodes = new Opcodes(); //diff instance
		$this->aaOpcodes = $this->oOpcodes->aaOpcodes;
		
	}

	public function arguments_get(): array {//$iKey = null, $aArguments = null): int {
		//$iKeyLeft = null;
		return $this->aArguments;
	}
		
	public function arguments_set($aArguments) {//$iKey = null, $aArguments = null): int {
		//$iKeyLeft = null;
		$this->aArguments = $aArguments;
	}
	
	public function positioning($iKey = null, $sHex = null) {

/*
case 0x00: return $this break; //STOP
case 0x01: return $this break; //ADD
case 0x02: return $this break; //MUL
case 0x03: return $this break; //SUB
case 0x04: return $this break; //DIV
case 0x05: return $this break; //SDIV
case 0x06: return $this break; //MOD
case 0x07: return $this break; //SMOD
case 0x08: return $this break; //ADDMOD
case 0x09: return $this break; //MULMOD
case 0x0a: return $this break; //EXP
case 0x0b: return $this break; //SIGNEXTEND
case 0x10: return $this break; //LT
case 0x11: return $this break; //GT
case 0x12: return $this break; //SLT
case 0x13: return $this break; //SGT
case 0x14: return $this break; //EQ
case 0x15: return $this break; //ISZERO
case 0x16: return $this break; //AND
case 0x17: return $this break; //OR
case 0x18: return $this break; //XOR
case 0x19: return $this break; //NOT
case 0x1a: return $this break; //BYTE
case 0x20: return $this break; //SHA3
case 0x30: return $this break; //ADDRESS
case 0x31: return $this break; //BALANCE
case 0x32: return $this break; //ORIGIN
case 0x33: return $this break; //CALLER
case 0x34: return $this break; //CALLVALUE
case 0x35: return $this break; //CALLDATALOAD
case 0x36: return $this break; //CALLDATASIZE
case 0x37: return $this break; //CALLDATACOPY
case 0x38: return $this break; //CODESIZE
case 0x39: return $this break; //CODECOPY
case 0x3a: return $this break; //GASPRICE
case 0x3b: return $this break; //EXTCODESIZE
case 0x3c: return $this break; //EXTCODECOPY
case 0x40: return $this break; //BLOCKHASH
case 0x41: return $this break; //COINBASE
case 0x42: return $this break; //TIMESTAMP
case 0x43: return $this break; //NUMBER
case 0x44: return $this break; //DIFFICULTY
case 0x45: return $this break; //GASLIMIT
case 0x50: return $this break; //POP
case 0x51: return $this break; //MLOAD
case 0x52: return $this break; //MSTORE
case 0x53: return $this break; //MSTORE8
case 0x54: return $this break; //SLOAD
case 0x55: return $this break; //SSTORE
case 0x56: return $this break; //JUMP
case 0x57: return $this break; //JUMPI
case 0x58: return $this break; //PC
case 0x59: return $this break; //MSIZE
case 0x5a: return $this break; //GAS
case 0x5b: return $this break; //JUMPDEST
case 0x60: return $this break; //PUSH1
case 0x61: return $this break; //PUSH2
case 0x62: return $this break; //PUSH3
case 0x63: return $this break; //PUSH4
case 0x64: return $this break; //PUSH5
case 0x65: return $this break; //PUSH6
case 0x66: return $this break; //PUSH7
case 0x67: return $this break; //PUSH8
case 0x68: return $this break; //PUSH9
case 0x69: return $this break; //PUSH10
case 0x6a: return $this break; //PUSH11
case 0x6b: return $this break; //PUSH12
case 0x6c: return $this break; //PUSH13
case 0x6d: return $this break; //PUSH14
case 0x6e: return $this break; //PUSH15
case 0x6f: return $this break; //PUSH16
case 0x70: return $this break; //PUSH17
case 0x71: return $this break; //PUSH18
case 0x72: return $this break; //PUSH19
case 0x73: return $this break; //PUSH20
case 0x74: return $this break; //PUSH21
case 0x75: return $this break; //PUSH22
case 0x76: return $this break; //PUSH23
case 0x77: return $this break; //PUSH24
case 0x78: return $this break; //PUSH25
case 0x79: return $this break; //PUSH26
case 0x7a: return $this break; //PUSH27
case 0x7b: return $this break; //PUSH28
case 0x7c: return $this break; //PUSH29
case 0x7d: return $this break; //PUSH30
case 0x7e: return $this break; //PUSH31
case 0x7f: return $this break; //PUSH32
case 0x80: return $this break; //DUP1
case 0x81: return $this break; //DUP2
case 0x82: return $this break; //DUP3
case 0x83: return $this break; //DUP4
case 0x84: return $this break; //DUP5
case 0x85: return $this break; //DUP6
case 0x86: return $this break; //DUP7
case 0x87: return $this break; //DUP8
case 0x88: return $this break; //DUP9
case 0x89: return $this break; //DUP10
case 0x8a: return $this break; //DUP11
case 0x8b: return $this break; //DUP12
case 0x8c: return $this break; //DUP13
case 0x8d: return $this break; //DUP14
case 0x8e: return $this break; //DUP15
case 0x8f: return $this break; //DUP16
case 0x90: return $this break; //SWAP1
case 0x91: return $this break; //SWAP2
case 0x92: return $this break; //SWAP3
case 0x93: return $this break; //SWAP4
case 0x94: return $this break; //SWAP5
case 0x95: return $this break; //SWAP6
case 0x96: return $this break; //SWAP7
case 0x97: return $this break; //SWAP8
case 0x98: return $this break; //SWAP9
case 0x99: return $this break; //SWAP10
case 0x9a: return $this break; //SWAP11
case 0x9b: return $this break; //SWAP12
case 0x9c: return $this break; //SWAP13
case 0x9d: return $this break; //SWAP14
case 0x9e: return $this break; //SWAP15
case 0x9f: return $this break; //SWAP16
case 0xa0: return $this break; //LOG0
case 0xa1: return $this break; //LOG1
case 0xa2: return $this break; //LOG2
case 0xa3: return $this break; //LOG3
case 0xa4: return $this break; //LOG4
case 0xf0: return $this break; //CREATE
case 0xf1: return $this break; //CALL
case 0xf2: return $this break; //CALLCODE
case 0xf3: return $this break; //RETURN
case 0xf4: return $this break; //DELEGATECALL
0xfe_jj11_INVALID_s_NaN_s_Designated invalid instruction
case 0xff: return $this break; //SELFDESTRUCT

*/
		
	}
	
	
	
}

?>